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

    /**
     * Check whether the currently logged in user can grant the Super Admin role.
     */
    private function canAssignSuperAdmin(): bool
    {
        $currentUser = Auth::user();
        return $currentUser && $currentUser->roles->contains('name', 'Super Admin');
    }

    /**
     * Check whether the logged in user is allowed to modify the target user.
     */
    private function canModifyUser(User $targetUser): bool
    {
        $isTargetSuperAdmin = $targetUser->roles->contains('name', 'Super Admin');
        if (!$isTargetSuperAdmin) {
            return true; // Not Super Admin, user can edit with their assigned permission
        }

        $currentUser = Auth::user();
        if (!$currentUser) {
            return false;
        }

        $isCurrentSuperAdmin = $currentUser->roles->contains('name', 'Super Admin');
        return $isCurrentSuperAdmin && $currentUser->id === $targetUser->id;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // BUSINESS LOGIC: get all users with their roles
        $users = User::with('roles')->paginate(10);
        $roles = Role::orderBy('name')->get();
        return view('admin.akun.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // DATA PREPARATION: filter roles based on super admin status.
        $currentUser = Auth::user();
        if ($currentUser->roles->contains('name', 'Super Admin')) {
            $roles = Role::orderBy('name')->get();
        } else {
            $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name')->get();
        }
        return view('admin.akun.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDATION LOGIC
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

        // SUPER ADMIN ASSIGNMENT CHECK
        $selectedRole = $request->filled('role') ? Role::find($request->role) : null;
        if ($selectedRole && $selectedRole->name === 'Super Admin' && !$this->canAssignSuperAdmin()) {
            return redirect()->route('admin.akun.create')
                ->with('error', 'Anda tidak memiliki izin untuk membuat akun dengan role Super Admin.')
                ->withInput();
        }

        // USER CREATION
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ASSIGN ROLE IF PROVIDED
        if ($selectedRole) {
            $user->assignRole($selectedRole);
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // AUTHORIZATION CHECK
        $user = User::with('roles')->findOrFail($id);
        if (!$this->canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit akun Super Admin lain.');
        }

        // DATA PREPARATION: filter roles based on super admin status
        $currentUser = Auth::user();
        if ($currentUser->roles->contains('name', 'Super Admin')) {
            $roles = Role::orderBy('name')->get();
        } else {
            $roles = Role::where('name', '!=', 'Super Admin')->orderBy('name')->get();
        }

        $userRole = $user->roles->first();

        return view('admin.akun.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // AUTHORIZATION CHECK
        $user = User::findOrFail($id);
        if (!$this->canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat mengedit akun Super Admin lain.');
        }

        // VALIDATION LOGIC
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

        // UPDATE BASIC DATA
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        // ROLE SYNC LOGIC
        if ($request->filled('role')) {
            $role = Role::find($request->role);
            if ($role) {
                // PREVENT SUPER ADMIN CHANGING ITS OWN ROLE
                $isTargetSuperAdmin = $user->roles->contains('name', 'Super Admin');
                if ($isTargetSuperAdmin && $role->name !== 'Super Admin') {
                    return redirect()->route('admin.akun.edit', $id)
                        ->with('error', 'Super Admin tidak dapat mengubah role sendiri menjadi selain Super Admin.');
                }

                // PREVENT ASSIGNING SUPER ADMIN TO OTHERS IF CURRENT USER IS NOT SUPER ADMIN
                if ($role->name === 'Super Admin' && !$this->canAssignSuperAdmin()) {
                    return redirect()->route('admin.akun.edit', $id)
                        ->with('error', 'Anda tidak memiliki izin untuk memberikan role Super Admin.');
                }

                $user->syncRoles([$role]);
            }
        } else {
            // IF NO ROLE SELECTED, DO NOT REMOVE SUPER ADMIN ROLE
            if (!$user->roles->contains('name', 'Super Admin')) {
                $user->syncRoles([]);
            }
        }

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Show reset password form.
     */
    public function resetPasswordForm($id)
    {
        // AUTHORIZATION CHECK
        $user = User::findOrFail($id);
        if (!$this->canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Anda tidak memiliki izin untuk mereset password Super Admin lain.');
        }

        // DATA PREPARATION
        $roles = Role::orderBy('name')->get();
        $userRole = $user->roles->first();

        return view('admin.akun.reset-password', compact('user', 'roles', 'userRole'));
    }

    /**
     * Reset the specified user password.
     */
    public function resetPassword(Request $request, $id)
    {
        // AUTHORIZATION CHECK
        $user = User::findOrFail($id);
        if (!$this->canModifyUser($user)) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat mereset password Super Admin lain.');
        }

        // VALIDATION LOGIC
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // PASSWORD UPDATE
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.akun.index')
            ->with('success', 'Password berhasil direset.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // AUTHORIZATION AND BUSINESS LOGIC
        $user = User::findOrFail($id);

        // PREVENT DELETING SUPER ADMIN
        if ($user->roles->contains('name', 'Super Admin')) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat menghapus akun Super Admin.');
        }

        // PREVENT DELETING OWN ACCOUNT
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.akun.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.akun.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
