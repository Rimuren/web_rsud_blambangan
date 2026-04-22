<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    public static function middleware()
    {
        return [
            new Middleware('permission:akun.view', only: ['index']),
            new Middleware('permission:akun.create', only: ['create', 'store']),
            new Middleware('permission:akun.update', only: ['edit', 'update']),
            new Middleware('permission:akun.reset_password', only: ['resetPasswordForm', 'resetPassword']),
            new Middleware('permission:akun.delete', only: ['destroy']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    private function isMasterUser($user): bool
    {
        return $user->roles->contains('name', 'Master');
    }

    private function isSuperAdminUser($user): bool
    {
        return $user->roles->contains('name', 'Super Admin') && !$this->isMasterUser($user);
    }

    private function isReservedUserName(string $name): bool
    {
        $reserved = [
            'master',
            'master administrator',
            'super administrator',
            'superadmin',
            'super admin',
            'admin master',
            'master admin'
        ];

        return in_array(strtolower(trim($name)), $reserved);
    }

    private function validateRequest(Request $request, ?int $userId = null)
    {
        return Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|unique:users,email,' . $userId,
            'password' => $userId ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'role'     => 'nullable|exists:roles,id',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LIST & CREATE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $currentUserId = Auth::id();
        $isMaster = RoleController::isMaster();
        $isSuperAdmin = Auth::user()?->roles->contains('name', 'Super Admin') && !$isMaster;

        $query = User::with('roles');

        if ($isMaster) {
            $users = $query->paginate(10);
        } elseif ($isSuperAdmin) {
            $users = $query->whereDoesntHave('roles', fn($q) => $q->where('name', 'Master'))->paginate(10);
        } else {
            $users = $query->whereDoesntHave('roles', fn($q) => $q->whereIn('name', ['Master', 'Super Admin']))->paginate(10);
        }

        $users->getCollection()->transform(function ($user) use ($currentUserId) {
            $user->can_edit_reset = RoleController::canModifyUser($user);
            $user->can_delete = RoleController::canModifyUser($user)
                && !$this->isMasterUser($user)
                && $user->id !== $currentUserId;

            return $user;
        });

        $roles = RoleController::getAvailableRoles();

        return view('admin.akun.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = RoleController::getAvailableRoles();
        return view('admin.akun.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!RoleController::isMaster() && $this->isReservedUserName($request->name)) {
            return back()->with('error', 'Nama akun tidak diperbolehkan.')->withInput();
        }

        $role = $request->filled('role') ? Role::find($request->role) : null;

        // Validasi role
        if ($role) {
            if ($role->name === 'Master') {
                return back()->with('error', 'Role Master tidak dapat diassign.')->withInput();
            }

            if (!RoleController::isMaster() && $role->name === 'Super Admin') {
                return back()->with('error', 'Hanya Master yang dapat assign Super Admin.')->withInput();
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin.akun.index')->with('success', 'User berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - EDIT & UPDATE
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak memiliki izin.');
        }

        $roles = RoleController::getAvailableRoles();
        $userRole = $user->roles->first();

        return view('admin.akun.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')->with('error', 'Tidak dapat mengedit.');
        }

        // Khusus Master: hanya boleh ubah password
        if ($this->isMasterUser($user)) {
            $request->validate(['password' => 'nullable|string|min:8|confirmed']);

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
                return redirect()->route('admin.akun.index')->with('success', 'Password Master diubah.');
            }

            return redirect()->route('admin.akun.index')->with('info', 'Tidak ada perubahan.');
        }

        $validator = $this->validateRequest($request, $id);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!RoleController::isMaster() && $this->isReservedUserName($request->name)) {
            return back()->with('error', 'Nama tidak diperbolehkan.')->withInput();
        }

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        $this->syncRole($request, $user);

        return redirect()->route('admin.akun.index')->with('success', 'User diperbarui.');
    }

    private function syncRole(Request $request, User $user)
    {
        if (!$request->filled('role')) {
            if (!$this->isSuperAdminUser($user)) {
                $user->syncRoles([]);
            }
            return;
        }

        $role = Role::find($request->role);
        if (!$role) return;

        if ($role->name === 'Master') return;

        if (!RoleController::isMaster() && $role->name === 'Super Admin') return;

        if ($this->isSuperAdminUser($user) && $role->name !== 'Super Admin') return;

        $user->syncRoles([$role]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPasswordForm($id)
    {
        $user = User::findOrFail($id);

        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')->with('error', 'Tidak diizinkan.');
        }

        return view('admin.akun.reset-password', compact('user'));
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')->with('error', 'Tidak diizinkan.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Password direset.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!RoleController::canModifyUser($user)) {
            return back()->with('error', 'Tidak diizinkan.');
        }

        if ($this->isMasterUser($user)) {
            return back()->with('error', 'Master tidak bisa dihapus.');
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa hapus diri sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User dihapus.');
    }
}
