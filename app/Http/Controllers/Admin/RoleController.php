<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller implements HasMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    public static function middleware()
    {
        return [
            new Middleware('permission:role.view', only: ['index']),
            new Middleware('permission:role.create', only: ['create', 'store']),
            new Middleware('permission:role.update', only: ['edit', 'update']),
            new Middleware('permission:role.delete', only: ['destroy']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MASTER & ROLE CHECK
    |--------------------------------------------------------------------------
    */

    public static function isMaster(): bool
    {
        $user = Auth::user();
        return $user && $user->roles->contains('name', 'Master');
    }

    public static function canAssignSuperAdmin(): bool
    {
        return self::isMaster();
    }

    public static function getAvailableRoles()
    {
        if (self::isMaster()) {
            return Role::where('name', '!=', 'Master')->orderBy('name')->get();
        }

        return Role::whereNotIn('name', ['Master', 'Super Admin'])
            ->orderBy('name')
            ->get();
    }

    public static function canModifyUser($targetUser): bool
    {
        $currentUser = Auth::user();
        if (!$currentUser) return false;

        if ($targetUser->roles->contains('name', 'Master')) {
            return $currentUser->id === $targetUser->id;
        }

        if ($targetUser->roles->contains('name', 'Super Admin')) {
            if ($currentUser->roles->contains('name', 'Master')) {
                return true;
            }
            return $currentUser->id === $targetUser->id;
        }

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | PERMISSION GROUPING (REST STYLE)
    |--------------------------------------------------------------------------
    */

    private function getGroupedPermissions()
    {
        $groups = [
            'Akses Admin' => ['admin-access'],

            'Artikel' => [
                'artikel.view',
                'artikel.create',
                'artikel.update',
                'artikel.delete',
            ],

            'Kategori' => [
                'kategori.view',
                'kategori.create',
                'kategori.update',
                'kategori.delete',
            ],

            'Akun' => [
                'akun.view',
                'akun.create',
                'akun.update',
                'akun.delete',
                'akun.reset_password',
            ],

            'Role' => [
                'role.view',
                'role.create',
                'role.update',
                'role.delete',
            ],

            'Foto' => [
                'foto.view',
                'foto.create',
                'foto.update',
                'foto.delete',
            ],

            'Video' => [
                'video.view',
                'video.create',
                'video.update',
                'video.delete',
            ],

            'Iklan' => [
                'iklan.view',
                'iklan.create',
                'iklan.update',
                'iklan.delete',
                'iklan.toggle_status',
            ],

            'Dokter' => [
                'dokter.view',
                'spesialis.view',
            ],

            'Ruangan' => [
                'bangsal.view',
                'kelas.view',
            ],
        ];

        $grouped = [];

        foreach ($groups as $groupName => $permNames) {
            $perms = Permission::whereIn('name', $permNames)
                ->orderBy('name')
                ->get();

            if ($perms->count()) {
                $grouped[$groupName] = $perms;
            }
        }

        $usedNames = collect($groups)->flatten()->toArray();

        $others = Permission::whereNotIn('name', $usedNames)
            ->orderBy('name')
            ->get();

        if ($others->count()) {
            $grouped['Lainnya'] = $others;
        }

        return $grouped;
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE POLICY CHECK
    |--------------------------------------------------------------------------
    */

    public static function canEditRole($roleName): bool
    {
        if (self::isMaster()) {
            return $roleName !== 'Master';
        }

        return !in_array($roleName, ['Master', 'Super Admin']);
    }

    public static function canDeleteRole($roleName): bool
    {
        return self::canEditRole($roleName);
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $roles = self::isMaster()
            ? Role::with('permissions')->paginate(10)
            : Role::with('permissions')
            ->whereNotIn('name', ['Master', 'Super Admin'])
            ->paginate(10);

        $roles->getCollection()->transform(function ($role) {
            $role->can_edit = self::canEditRole($role->name);
            $role->can_delete = self::canDeleteRole($role->name);
            return $role;
        });

        return view('admin.akun.role.index', compact('roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $groupedPermissions = $this->getGroupedPermissions();
        return view('admin.akun.role.create', compact('groupedPermissions'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $roleName = trim($validated['name']);

        // Super Admin special case
        if (strcasecmp($roleName, 'Super Admin') === 0) {
            if (!self::isMaster()) {
                return back()->with('error', 'Hanya Master yang dapat membuat Super Admin.');
            }

            $role = Role::create(['name' => 'Super Admin']);
        } else {
            $role = Role::create(['name' => $roleName]);
        }

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        if (!self::canEditRole($role->name)) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Tidak dapat mengedit role ini.');
        }

        $groupedPermissions = $this->getGroupedPermissions();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.akun.role.edit', compact(
            'role',
            'groupedPermissions',
            'rolePermissions'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        if (!self::canEditRole($role->name)) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Tidak dapat mengedit role ini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update(['name' => trim($validated['name'])]);

        $permissions = !empty($validated['permissions'])
            ? Permission::whereIn('id', $validated['permissions'])->pluck('name')
            : [];

        $role->syncPermissions($permissions);

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if (!self::canDeleteRole($role->name)) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Tidak dapat menghapus role ini.');
        }

        $role->delete();

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
