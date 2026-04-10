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
        // Create roles

        $MasterRole = Role::firstOrCreate([
            'name' => 'Master',
            'guard_name' => 'web'
        ]);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        if (Permission::count() === 0) {
            $this->call(PermissionSeeder::class);
        }

        // Assign all permissions to Super Admin
        $MasterRole->syncPermissions(Permission::all());
        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions(Permission::all());

        $this->command->info('Roles created: Master, Super Admin, Admin');
        $this->command->info('Master and Super Admin has all permissions.');
    }
}
