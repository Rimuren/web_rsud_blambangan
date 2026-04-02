<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        // $userRole = Role::firstOrCreate([
        //     'name' => 'user',
        //     'guard_name' => 'web',
        // ]);

        $permissions = Permission::all();

        $adminRole->syncPermissions(Permission::all());
        // $userRole->givePermissionTo('user-access');

        if ($permissions->isEmpty()) {
            $this->call(PermissionSeeder::class);
            $permissions = Permission::all();
        }

        $adminRole->syncPermissions($permissions);

        $this->command->info('Admin role created with all permissions!');
        // $this->command->info('User role created with view permissions!');
    }
}
