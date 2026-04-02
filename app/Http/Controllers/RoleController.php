<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:create roles', only: ['create', 'store']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('admin.akun.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.akun.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create(['name' => $validated['name']]);

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->pluck('name');
            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        if (in_array($role->name, ['Super Admin'])) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role ini tidak dapat diedit.');
        }

        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.akun.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        if (in_array($role->name, ['Super Admin'])) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role ini tidak dapat diedit.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update(['name' => $validated['name']]);

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
        $role = Role::findOrFail($id);
        if (in_array($role->name, ['Super Admin'])) {
            return redirect()->route('admin.akun.role.index')
                ->with('error', 'Role ini tidak dapat dihapus.');
        }

        $role->delete();

        return redirect()->route('admin.akun.role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
