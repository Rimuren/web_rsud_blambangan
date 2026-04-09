<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view role', only: ['index']),
            new Middleware('permission:create role', only: ['create', 'store']),
            new Middleware('permission:edit role', only: ['edit', 'update']),
            new Middleware('permission:delete role', only: ['destroy']),
        ];
    }

    // BETTER TO MOVE TO A DEDICATED SERVICE (RoleService) OR A HELPER CLASS
    private function isSuperAdmin(): bool
    {
        $user = Auth::user();
        return $user && $user->roles->contains('name', 'Super Admin');
    }

    // BETTER TO MOVE TO A DEDICATED SERVICE (RoleService) OR A HELPER CLASS
    private function isReservedRoleName($name)
    {
        $nameLower = strtolower(trim($name));
        $reserved = [
            'super admin',
            'super_admin',
            'superadmin',
            'admin super',
            'admin_super',
            'adminsuper',
            'super-admin',
            'admin-super'
        ];
        return in_array($nameLower, $reserved) || $nameLower === 'super admin';
    }

    // BETTER TO MOVE TO A DEDICATED SERVICE (RoleService) OR A HELPER CLASS
    private function getGroupedPermissions()
    {
        $groups = [
            'Akses Admin' => ['admin-access'],
            'Manage' => ['manage artikel', 'manage akun', 'manage dokumentasi', 'manage dokter', 'manage ruangan'],
            'Artikel' => ['view daftar-artikel', 'create artikel', 'edit artikel', 'delete artikel'],
            'Kategori Artikel' => ['view kategori', 'create kategori', 'edit kategori', 'delete kategori'],
            'Akun' => ['view daftar-akun', 'create akun', 'edit akun', 'reset password', 'delete akun'],
            'Role' => ['view role', 'create role', 'edit role', 'delete role'],
            'Foto' => ['view foto', 'create foto', 'edit foto', 'delete foto'],
            'Video' => ['view video', 'create video', 'edit video', 'delete video'],
            'Dokter' => ['view daftar-dokter', 'view daftar-spesialis'],
            'Ruangan' => ['view daftar-bangsal', 'view daftar-kelas'],
        ];

        $grouped = [];
        foreach ($groups as $groupName => $permNames) {
            $perms = Permission::whereIn('name', $permNames)->orderBy('name')->get();
            if ($perms->count()) {
                $grouped[$groupName] = $perms;
            }
        }

        $usedNames = collect($groups)->flatten()->toArray();
        $otherPerms = Permission::whereNotIn('name', $usedNames)->orderBy('name')->get();
        if ($otherPerms->count()) {
            $grouped['Lainnya'] = $otherPerms;
        }

        return $grouped;
    }

    public function index()
    {
        // BUSINESS LOGIC: filtering roles based on super admin status
        if ($this->isSuperAdmin()) {
            $roles = Role::with('permissions')->paginate(10);
        } else {
            $roles = Role::with('permissions')
                ->where('name', '!=', 'Super Admin')
                ->paginate(10);
        }
        return view('admin.akun.role.index', compact('roles'));
    }

    public function create()
    {
        // DATA PREPARATION: grouped permissions
        $groupedPermissions = $this->getGroupedPermissions();
        return view('admin.akun.role.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        // VALIDATION LOGIC
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Role dengan nama tersebut sudah ada. Silakan gunakan nama lain.',
            'permissions.*.exists' => 'Permission yang dipilih tidak valid.',
        ]);

        // RESERVED NAME CHECK
        if ($this->isReservedRoleName($validated['name'])) {
            return redirect()->route('admin.akun.role.create')
                ->with('error', 'Nama role tidak boleh menggunakan kata "Super Admin" atau variasinya karena merupakan role tertinggi sistem.')
                ->withInput();
        }

        $roleName = trim($validated['name']);

        // SUPER ADMIN CREATION GUARD
        if (strcasecmp($roleName, 'Super Admin') === 0) {
            $existingSuperAdmin = Role::where('name', 'Super Admin')->exists();
            if ($existingSuperAdmin) {
                return redirect()->route('admin.akun.role.create')
                    ->with('error', 'Role Super Admin sudah ada. Tidak dapat membuat role Super Admin lagi.')
                    ->withInput();
            }
            if (!$this->isSuperAdmin()) {
                return redirect()->route('admin.akun.role.create')
                    ->with('error', 'Anda tidak memiliki izin untuk membuat role Super Admin.')
                    ->withInput();
            }
        }

        // ROLE CREATION AND PERMISSION SYNC
        $role = Role::create(['name' => $roleName]);

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        // AUTHORIZATION CHECK
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin' && !$this->isSuperAdmin()) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit role Super Admin.');
        }

        // DATA PREPARATION
        $groupedPermissions = $this->getGroupedPermissions();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.akun.role.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        // SUPER ADMIN HANDLING (ONLY PERMISSIONS UPDATE)
        if ($role->name === 'Super Admin') {
            if (!$this->isSuperAdmin()) {
                return redirect()->route('admin.akun.role.index')
                    ->with('error', 'Anda tidak memiliki izin untuk mengupdate role Super Admin.');
            }

            $validated = $request->validate([
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ], [
                'permissions.*.exists' => 'Permission yang dipilih tidak valid.',
            ]);

            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }

            return redirect()->route('admin.akun.role.index')
                ->with('success', 'Role Super Admin berhasil diperbarui (permissions).');
        }

        // FOR NORMAL ROLES: VALIDATION AND UPDATE
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Role dengan nama tersebut sudah ada. Silakan gunakan nama lain.',
            'permissions.*.exists' => 'Permission yang dipilih tidak valid.',
        ]);

        // RESERVED NAME CHECK
        if ($this->isReservedRoleName($validated['name'])) {
            return redirect()->route('admin.akun.role.create')
                ->with('error', 'Nama role tidak boleh menggunakan kata "Super Admin" atau variasinya karena merupakan role tertinggi sistem.')
                ->withInput();
        }

        $newName = trim($validated['name']);

        // PREVENT BECOMING SUPER ADMIN
        if (strcasecmp($newName, 'Super Admin') === 0) {
            $existingSuperAdmin = Role::where('name', 'Super Admin')->exists();
            if ($existingSuperAdmin) {
                return redirect()->route('admin.akun.role.edit', $role->id)
                    ->with('error', 'Role Super Admin sudah ada. Tidak dapat mengubah role ini menjadi Super Admin.')
                    ->withInput();
            }
            if (!$this->isSuperAdmin()) {
                return redirect()->route('admin.akun.role.edit', $role->id)
                    ->with('error', 'Anda tidak memiliki izin untuk membuat role Super Admin.')
                    ->withInput();
            }
        }

        // UPDATE ROLE AND PERMISSIONS
        $role->update(['name' => $newName]);

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // AUTHORIZATION AND BUSINESS LOGIC
        $role = Role::findOrFail($id);

        if ($role->name === 'Super Admin') {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role Super Admin tidak dapat dihapus karena merupakan role tertinggi sistem.');
        }

        $role->delete();

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
