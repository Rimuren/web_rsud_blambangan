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
            new Middleware('permission:view daftar-role', only: ['index']),
            new Middleware('permission:create role', only: ['create', 'store']),
            new Middleware('permission:edit role', only: ['edit', 'update']),
            new Middleware('permission:delete role', only: ['destroy']),
        ];
    }

    // --- Master related checks ---
    public static function isMaster(): bool
    {
        $user = Auth::user();
        return $user && $user->roles->contains('name', 'Master');
    }

    // Hanya Master yang boleh assign role Super Admin
    public static function canAssignSuperAdmin(): bool
    {
        return self::isMaster();
    }

    // Role Master tidak bisa di-assign ke siapapun (tidak akan muncul di dropdown)
    public static function getAvailableRoles()
    {
        if (self::isMaster()) {
            // Master: semua role kecuali Master (Master tidak bisa di-assign)
            return Role::where('name', '!=', 'Master')->orderBy('name')->get();
        }
        // Non-Master: hanya role selain Master dan Super Admin
        return Role::whereNotIn('name', ['Master', 'Super Admin'])->orderBy('name')->get();
    }
    /**
     * Cek apakah current user bisa memodifikasi target user.
     * - Master bisa memodifikasi dirinya sendiri (untuk reset password) dan semua user lain.
     * - Super Admin hanya bisa memodifikasi dirinya sendiri (terbatas).
     * - Selain kedua role diatas bisa dimodifikasi oleh siapa saja yang memiliki permission.
     */
    public static function canModifyUser($targetUser): bool
    {
        $currentUser = Auth::user();
        if (!$currentUser) return false;

        // Jika target adalah Master
        if ($targetUser->roles->contains('name', 'Master')) {
            return $currentUser->id === $targetUser->id; // hanya Master sendiri
        }

        // Jika target memiliki role Super Admin
        if ($targetUser->roles->contains('name', 'Super Admin')) {
            // Master bisa memodifikasi Super Admin
            if ($currentUser->roles->contains('name', 'Master')) {
                return true;
            }
            // Super Admin hanya bisa memodifikasi dirinya sendiri
            return $currentUser->id === $targetUser->id;
        }

        // User biasa bisa dimodifikasi siapa saja dengan permission
        return true;
    }

    // --- Reserved role name (Super Admin / Master variations) ---
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
            'admin-super',
            'master'
        ];
        return in_array($nameLower, $reserved);
    }

    // --- Grouped permissions ---
    private function getGroupedPermissions()
    {
        $groups = [
            'Akses ke halaman admin' => ['admin-access'],
            'Manage' => ['manage artikel', 'manage akun', 'manage dokumentasi', 'manage dokter', 'manage ruangan'],
            'Artikel' => ['view daftar-artikel', 'create artikel', 'edit artikel', 'delete artikel'],
            'Kategori Artikel' => ['view daftar-kategori', 'create kategori', 'edit kategori', 'delete kategori'],
            'Akun' => ['view daftar-akun', 'create akun', 'edit akun', 'reset password', 'delete akun'],
            'Role' => ['view daftar-role', 'create role', 'edit role', 'delete role'],
            'Foto' => ['view daftar-foto', 'create foto', 'edit foto', 'delete foto'],
            'Video' => ['view daftar-video', 'create video', 'edit video', 'delete video'],
            'Dokter' => ['view daftar-dokter', 'view daftar-spesialis'],
            'Ruangan' => ['view daftar-bangsal', 'view daftar-kelas'],
        ];

        $grouped = [];
        foreach ($groups as $groupName => $permNames) {
            $perms = Permission::whereIn('name', $permNames)->orderBy('name')->get();
            if ($perms->count()) $grouped[$groupName] = $perms;
        }
        $usedNames = collect($groups)->flatten()->toArray();
        $otherPerms = Permission::whereNotIn('name', $usedNames)->orderBy('name')->get();
        if ($otherPerms->count()) $grouped['Lainnya'] = $otherPerms;
        return $grouped;
    }

    public static function canEditRole($roleName): bool
    {
        if (self::isMaster()) {
            // Master bisa edit semua role kecuali Master itu sendiri
            return $roleName !== 'Master';
        }
        // Non-Master tidak bisa edit Master dan Super Admin
        return !in_array($roleName, ['Master', 'Super Admin']);
    }

    public static function canDeleteRole($roleName): bool
    {
        return self::canEditRole($roleName);
    }

    // --- CRUD for roles (Master dan Super Admin tidak bisa diedit/dihapus) ---
    public function index()
    {
        if (self::isMaster()) {
            $roles = Role::with('permissions')->paginate(10);
        } else {
            $roles = Role::with('permissions')
                ->whereNotIn('name', ['Master', 'Super Admin'])
                ->paginate(10);
        }

        // Tambahkan properti virtual untuk setiap role
        $roles->getCollection()->transform(function ($role) {
            $role->can_edit = self::canEditRole($role->name);
            $role->can_delete = self::canDeleteRole($role->name);
            return $role;
        });

        return view('admin.akun.role.index', compact('roles'));
    }

    public function create()
    {
        $groupedPermissions = $this->getGroupedPermissions();
        return view('admin.akun.role.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Role dengan nama tersebut sudah ada.',
            'permissions.*.exists' => 'Permission tidak valid.',
        ]);

        $roleName = trim($validated['name']);

        // KHUSUS: Master membuat role Super Admin
        if (strcasecmp($roleName, 'Super Admin') === 0) {
            if (Role::where('name', 'Super Admin')->exists()) {
                return redirect()->route('admin.akun.role.create')
                    ->with('error', 'Role Super Admin sudah ada.')
                    ->withInput();
            }
            if (!self::isMaster()) {
                return redirect()->route('admin.akun.role.create')
                    ->with('error', 'Hanya Master yang dapat membuat role Super Admin.')
                    ->withInput();
            }
            $role = Role::create(['name' => 'Super Admin']);
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
                $role->syncPermissions($permissions);
            }
            return redirect()->route('admin.akun.role.index')->with('success', 'Role Super Admin berhasil ditambahkan.');
        }

        // Reserved name check untuk role lain (termasuk jika Master coba buat 'Master')
        if ($this->isReservedRoleName($validated['name'])) {
            return redirect()->route('admin.akun.role.create')
                ->with('error', 'Nama role tidak boleh menggunakan kata "Super Admin" atau "Master".')
                ->withInput();
        }

        // Cegah pembuatan role Master
        if (strcasecmp($roleName, 'Master') === 0) {
            return redirect()->route('admin.akun.role.create')
                ->with('error', 'Role Master tidak dapat dibuat (hanya via seeder).')
                ->withInput();
        }

        // Role biasa
        $role = Role::create(['name' => $roleName]);
        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        }
        return redirect()->route('admin.akun.role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        // Cegah edit role Master (tidak boleh oleh siapa pun)
        if ($role->name === 'Master') {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role Master tidak dapat diedit.');
        }

        // Cegah edit role Super Admin jika current user bukan Master
        if ($role->name === 'Super Admin' && !self::isMaster()) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit role Super Admin.');
        }

        $groupedPermissions = $this->getGroupedPermissions();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.akun.role.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        // Cegah update role Master
        if ($role->name === 'Master') {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role Master tidak dapat diedit.');
        }

        // Cegah update role Super Admin jika bukan Master
        if ($role->name === 'Super Admin' && !self::isMaster()) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit role Super Admin.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Role dengan nama tersebut sudah ada.',
            'permissions.*.exists' => 'Permission tidak valid.',
        ]);

        $newName = trim($validated['name']);

        // KHUSUS: role Super Admin (diedit oleh Master) – hanya boleh update permissions, nama tidak boleh berubah
        if ($role->name === 'Super Admin') {
            if (strcasecmp($newName, 'Super Admin') !== 0) {
                return redirect()->route('admin.akun.role.edit', $role->id)
                    ->with('error', 'Nama role Super Admin tidak dapat diubah.')
                    ->withInput();
            }
            if (!empty($validated['permissions'])) {
                $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('admin.akun.role.index')->with('success', 'Role Super Admin berhasil diperbarui.');
        }

        // Reserved name check untuk role biasa
        if ($this->isReservedRoleName($validated['name'])) {
            return redirect()->route('admin.akun.role.edit', $role->id)
                ->with('error', 'Nama role tidak boleh menggunakan kata "Super Admin" atau "Master".')
                ->withInput();
        }

        // Cegah mengubah role menjadi Master
        if (strcasecmp($newName, 'Master') === 0) {
            return redirect()->route('admin.akun.role.edit', $role->id)
                ->with('error', 'Tidak dapat mengubah role menjadi Master.')
                ->withInput();
        }

        // Update role biasa
        $role->update(['name' => $newName]);
        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.akun.role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        // Cegah hapus role Master
        if ($role->name === 'Master') {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role Master tidak dapat dihapus.');
        }

        // Cegah hapus role Super Admin jika current role bukan Master
        if ($role->name === 'Super Admin' && !self::isMaster()) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus role Super Admin.');
        }

        $role->delete();
        return redirect()->route('admin.akun.role.index')->with('success', 'Role berhasil dihapus.');
    }
}
