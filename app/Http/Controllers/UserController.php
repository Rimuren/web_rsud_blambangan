<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view daftar-akun', only: ['index']),
            new Middleware('permission:create akun', only: ['create', 'store']),
            new Middleware('permission:edit akun', only: ['edit', 'update']),
            new Middleware('permission:reset password', only: ['resetPasswordForm', 'resetPassword']),
            new Middleware('permission:delete akun', only: ['destroy']),
        ];
    }

    private function isMasterUser($user): bool
    {
        return $user->roles->contains('name', 'Master');
    }

    private function isSuperAdminUser($user): bool
    {
        return $user->roles->contains('name', 'Super Admin') && !$this->isMasterUser($user);
    }

    private function isReservedUserName($name)
    {
        $nameLower = strtolower(trim($name));
        $reserved = [
            'master',
            'master administrator',
            'super administrator',
            'superadmin',
            'super admin',
            'admin master',
            'master admin'
        ];
        return in_array($nameLower, $reserved);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        $currentUserId = Auth::id();
        $isMaster = RoleController::isMaster();
        $isSuperAdmin = $currentUser && $currentUser->roles->contains('name', 'Super Admin') && !$isMaster;

        $query = User::with('roles');

        if ($isMaster) {
            $users = $query->paginate(10);
        } elseif ($isSuperAdmin) {
            $users = $query->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Master');
            })->paginate(10);
        } else {
            $users = $query->whereDoesntHave('roles', function ($q) {
                $q->whereIn('name', ['Master', 'Super Admin']);
            })->paginate(10);
        }

        // Add virtual properties
        $users->getCollection()->transform(function ($user) use ($currentUserId) {
            $user->can_edit_reset = RoleController::canModifyUser($user);
            $user->can_delete = RoleController::canModifyUser($user)
                && !$user->roles->contains('name', 'Master')
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
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.akun.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Hanya non-Master yang dicek nama reserved-nya
        if (!RoleController::isMaster() && $this->isReservedUserName($request->name)) {
            return redirect()->route('admin.akun.create')
                ->with('error', 'Nama akun tidak boleh menggunakan kata "Master" atau "Super Administrator".')
                ->withInput();
        }

        $selectedRole = $request->filled('role') ? Role::find($request->role) : null;

        if (RoleController::isMaster()) {
            if ($selectedRole && $selectedRole->name === 'Master') {
                return redirect()->route('admin.akun.create')
                    ->with('error', 'Role Master tidak dapat diassign.')
                    ->withInput();
            }
        } else {
            if ($selectedRole && $selectedRole->name === 'Master') {
                return redirect()->route('admin.akun.create')
                    ->with('error', 'Role Master tidak dapat diassign ke akun manapun.')
                    ->withInput();
            }
            if ($selectedRole && $selectedRole->name === 'Super Admin') {
                return redirect()->route('admin.akun.create')
                    ->with('error', 'Hanya Master yang dapat memberikan role Super Admin.')
                    ->withInput();
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($selectedRole) {
            $user->assignRole($selectedRole);
        }

        return redirect()->route('admin.akun.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')->with('error', 'Anda tidak memiliki izin untuk mengedit akun ini.');
        }
        $roles = RoleController::getAvailableRoles();
        $userRole = $user->roles->first();
        return view('admin.akun.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat mengedit akun ini.');
        }

        if ($this->isMasterUser($user)) {
            $validator = Validator::make($request->all(), [
                'password' => 'nullable|string|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.akun.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('admin.akun.index')
                    ->with('success', 'Password Master berhasil diubah.');
            }
            return redirect()->route('admin.akun.index')
                ->with('info', 'Tidak ada perubahan pada akun Master.');
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:3|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.akun.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Hanya non-Master yang dicek nama reserved
        if (!RoleController::isMaster() && $this->isReservedUserName($request->name)) {
            return redirect()->route('admin.akun.edit', $id)
                ->with('error', 'Nama akun tidak boleh menggunakan kata "Master" atau "Super Administrator".')
                ->withInput();
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        // ROLE SYNC LOGIC (sama seperti sebelumnya)
        if (RoleController::isMaster()) {
            if ($request->filled('role')) {
                $role = Role::find($request->role);
                if ($role && $role->name !== 'Master') {
                    $user->syncRoles([$role]);
                } else {
                    $user->syncRoles([]);
                }
            } else {
                $user->syncRoles([]);
            }
        } else {
            if ($request->filled('role')) {
                $role = Role::find($request->role);
                if ($role) {
                    if ($role->name === 'Master') {
                        return redirect()->route('admin.akun.edit', $id)
                            ->with('error', 'Role Master tidak dapat diassign.');
                    }
                    if ($this->isSuperAdminUser($user) && $role->name !== 'Super Admin') {
                        return redirect()->route('admin.akun.edit', $id)
                            ->with('error', 'Super Admin tidak dapat mengubah role sendiri menjadi selain Super Admin.');
                    }
                    if ($role->name === 'Super Admin') {
                        return redirect()->route('admin.akun.edit', $id)
                            ->with('error', 'Hanya Master yang dapat memberikan role Super Admin.');
                    }
                    $user->syncRoles([$role]);
                }
            } else {
                if (!$this->isSuperAdminUser($user)) {
                    $user->syncRoles([]);
                }
            }
        }

        return redirect()->route('admin.akun.index')->with('success', 'User berhasil diperbarui.');
    }

    public function resetPasswordForm($id)
    {
        $user = User::findOrFail($id);
        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Anda tidak memiliki izin untuk mereset password akun ini.');
        }
        $roles = RoleController::getAvailableRoles();
        $userRole = $user->roles->first();
        return view('admin.akun.reset-password', compact('user', 'roles', 'userRole'));
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat mereset password akun ini.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.akun.index')->with('success', 'Password berhasil direset.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Gunakan canModifyUser untuk otorisasi dasar (termasuk cek Master & Super Admin)
        if (!RoleController::canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus akun ini.');
        }

        // Master tidak bisa dihapus (walaupun canModifyUser mengizinkan dirinya sendiri, kita cegah)
        if ($this->isMasterUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Akun Master tidak dapat dihapus.');
        }

        // Cegah menghapus akun sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.akun.index')->with('success', 'User berhasil dihapus.');
    }
}
