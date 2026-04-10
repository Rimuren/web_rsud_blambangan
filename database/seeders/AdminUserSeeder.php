<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $MasterRole = Role::firstOrCreate(['name' => 'Master','guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);

        // Super Admin

        $MasterAdmin = User::firstOrCreate(
            ['email' => 'master@rsud.com'],
            [
                'name' => 'Master Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $MasterAdmin->assignRole($MasterRole);

        $superAdmin = User::firstOrCreate(
            ['email' => 'administrator@rsud.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Admin 1
        $admin1 = User::firstOrCreate(
            ['email' => 'admin1@rsud.com'],
            [
                'name' => 'Admin Satu',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin1->assignRole($adminRole);

        // Admin 2
        $admin2 = User::firstOrCreate(
            ['email' => 'admin2@rsud.com'],
            [
                'name' => 'Admin Dua',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin2->assignRole($adminRole);

        $this->command->info('Admin accounts created:');
        $this->command->info('Master : master@rsud.com / password');
        $this->command->info('Super Admin: administrator@rsud.com / password');
        $this->command->info('Admin 1: admin1@rsud.com / password');
        $this->command->info('Admin 2: admin2@rsud.com / password');
    }
}
