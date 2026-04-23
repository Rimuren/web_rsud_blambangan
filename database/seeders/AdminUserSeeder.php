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
        // Ambil role yang sudah dibuat
        $masterRole = Role::firstOrCreate(['name' => 'Master', 'guard_name' => 'web']);
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $reviewRole = Role::firstOrCreate(['name' => 'Review', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer', 'guard_name' => 'web']);

        // --- USER YANG SUDAH ADA (tetap dipertahankan) ---
        $masterAdmin = User::firstOrCreate(
            ['email' => 'master@rsud.com'],
            ['name' => 'Master Administrator', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $masterAdmin->assignRole($masterRole);

        $superAdmin = User::firstOrCreate(
            ['email' => 'administrator@rsud.com'],
            ['name' => 'Super Administrator', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $superAdmin->assignRole($superAdminRole);

        $admin1 = User::firstOrCreate(
            ['email' => 'admin1@rsud.com'],
            ['name' => 'Admin Satu', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $admin1->assignRole($adminRole);

        $admin2 = User::firstOrCreate(
            ['email' => 'admin2@rsud.com'],
            ['name' => 'Admin Dua', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $admin2->assignRole($adminRole);

        // ========== 6 USER BARU ==========
        // 2 user dengan role Review
        $review1 = User::firstOrCreate(
            ['email' => 'reviewer1@rsud.com'],
            ['name' => 'Reviewer Satu', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $review1->assignRole($reviewRole);

        $review2 = User::firstOrCreate(
            ['email' => 'reviewer2@rsud.com'],
            ['name' => 'Reviewer Dua', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $review2->assignRole($reviewRole);

        // 2 user dengan role Editor
        $editor1 = User::firstOrCreate(
            ['email' => 'editor1@rsud.com'],
            ['name' => 'Editor Satu', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $editor1->assignRole($editorRole);

        $editor2 = User::firstOrCreate(
            ['email' => 'editor2@rsud.com'],
            ['name' => 'Editor Dua', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $editor2->assignRole($editorRole);

        // 2 user dengan role Viewer
        $viewer1 = User::firstOrCreate(
            ['email' => 'viewer1@rsud.com'],
            ['name' => 'Viewer Satu', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $viewer1->assignRole($viewerRole);

        $viewer2 = User::firstOrCreate(
            ['email' => 'viewer2@rsud.com'],
            ['name' => 'Viewer Dua', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );
        $viewer2->assignRole($viewerRole);

        // Informasi ke console
        $this->command->info('All user accounts (6 accounts) have been created:');
        $this->command->info('Master       : master@rsud.com / password');
        $this->command->info('Super Admin  : administrator@rsud.com / password');
        $this->command->info('Admin 1      : admin1@rsud.com / password');
        $this->command->info('Admin 2      : admin2@rsud.com / password');
        $this->command->info('Reviewer 1   : reviewer1@rsud.com / password');
        $this->command->info('Reviewer 2   : reviewer2@rsud.com / password');
        $this->command->info('Editor 1     : editor1@rsud.com / password');
        $this->command->info('Editor 2     : editor2@rsud.com / password');
        $this->command->info('Viewer 1     : viewer1@rsud.com / password');
        $this->command->info('Viewer 2     : viewer2@rsud.com / password');
    }
}
