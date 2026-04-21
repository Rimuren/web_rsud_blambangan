<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Roles yang sudah ada
        $masterRole = Role::firstOrCreate(['name' => 'Master', 'guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $reviewRole = Role::firstOrCreate(['name' => 'Review', 'guard_name' => 'web']);

        // === ROLE BARU ===
        $editorRole = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer', 'guard_name' => 'web']);

        // Jalankan PermissionSeeder jika belum ada permission
        if (Permission::count() === 0) {
            $this->call(PermissionSeeder::class);
        }

        // 1. Master, Super Admin, Admin : semua permission
        $masterRole->syncPermissions(Permission::all());
        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions(Permission::all());

        // 2. Review : semua permission yang mengandung 'view'
        $viewPermissions = Permission::where('name', 'like', '%view%')->get();
        $reviewRole->syncPermissions($viewPermissions);

        // 3. Editor : permission create, edit, delete untuk artikel, kategori, foto, video
        $editorPermissions = Permission::where(function ($query) {
            $query->where('name', 'like', 'create%')
                ->orWhere('name', 'like', 'edit%')
                ->orWhere('name', 'like', 'delete%');
        })->where(function ($query) {
            $query->where('name', 'like', '%artikel%')
                ->orWhere('name', 'like', '%kategori%')
                ->orWhere('name', 'like', '%foto%')
                ->orWhere('name', 'like', '%video%');
        })->get();
        $editorRole->syncPermissions($editorPermissions);

        // 4. Viewer : hanya permission 'view daftar-*' (semua view)
        $viewerPermissions = Permission::where('name', 'like', 'view daftar-%')->get();
        $viewerRole->syncPermissions($viewerPermissions);

        $this->command->info('Roles created: Master, Super Admin, Admin, Review, Editor, Viewer');
        $this->command->info('Permission assignments completed.');
    }
}
