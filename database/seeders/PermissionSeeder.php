<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $defaultPermissions = [
        // Access permissions
        'admin-access',

        // Akun permissions
        'manage akun',
        'view daftar-akun',
        'create akun',
        'edit akun',
        'delete akun',
        
        // Role permissions
        'manage roles',
        'view roles',
        'create roles',
        'edit roles',
        'delete roles',

        // Dokter permission
        'manage dokter',
        'view daftar-dokter',
        'view daftar-spesialis',
        
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->defaultPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        
        $this->command->info('Default permissions seeded successfully!');
    }
}
