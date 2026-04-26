<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        $roles = [
            'Master',
            'Super Admin',
            'Admin',
            'Review',
            'Editor',
            'Viewer',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        $master      = Role::findByName('Master');
        $superAdmin  = Role::findByName('Super Admin');
        $admin       = Role::findByName('Admin');
        $review      = Role::findByName('Review');
        $editor      = Role::findByName('Editor');
        $viewer      = Role::findByName('Viewer');

        /*
        |--------------------------------------------------------------------------
        | Ensure Permissions Exist
        |--------------------------------------------------------------------------
        */
        if (Permission::count() === 0) {
            $this->call(PermissionSeeder::class);
        }

        $allPermissions = Permission::all();

        /*
        |--------------------------------------------------------------------------
        | 1. Full Access Roles
        |--------------------------------------------------------------------------
        */
        $master->syncPermissions($allPermissions);
        $superAdmin->syncPermissions($allPermissions);
        $admin->syncPermissions($allPermissions);

        /*
        |--------------------------------------------------------------------------
        | 2. Review (View Only)
        |--------------------------------------------------------------------------
        */
        $reviewPermissions = Permission::where('name', 'like', '%.view')->get();
        $review->syncPermissions($reviewPermissions);

        /*
        |--------------------------------------------------------------------------
        | 3. Editor (CRUD Tanpa View Global Sensitif)
        |--------------------------------------------------------------------------
        */
        $editorPermissions = Permission::where(function ($query) {
            $query->whereIn('name', [
                // FOTO
                'foto.create',
                'foto.update',
                'foto.delete',

                // VIDEO
                'video.create',
                'video.update',
                'video.delete',

                // ARTIKEL
                'artikel.create',
                'artikel.update',
                'artikel.delete',

                // KATEGORI
                'kategori.create',
                'kategori.update',
                'kategori.delete',
            ]);
        })->get();

        $editor->syncPermissions($editorPermissions);

        /*
        |--------------------------------------------------------------------------
        | 4. Viewer (Read Only)
        |--------------------------------------------------------------------------
        */
        $viewerPermissions = Permission::whereIn('name', [
            'foto.view',
            'video.view',
            'artikel.view',
            'kategori.view',
        ])->get();

        $viewer->syncPermissions($viewerPermissions);

        /*
        |--------------------------------------------------------------------------
        | Output
        |--------------------------------------------------------------------------
        */
        $this->command->info('Roles & permissions berhasil disinkronisasi.');
    }
}
