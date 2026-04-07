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

        // Manage option permissions
        'manage artikel',
        'manage akun',
        'manage dokumentasi',
        'manage dokter',
        'manage ruangan',
        
        // Artikel permissions
        'view daftar-artikel',
        'create artikel',
        'edit artikel',
        'delete artikel',

        // Kategori artikel permissions
        'view kategori',
        'create kategori',
        'edit kategori',
        'delete kategori',

        // Akun permissions
        'view daftar-akun',
        'create akun',
        'edit akun',
        'reset password',
        'delete akun',

        // Role permissions
        'view role',
        'create role',
        'edit role',
        'delete role',

        // Foto permissions
        'view foto',
        'create foto',
        'edit foto',
        'delete foto',

        // Video permissions
        'view video',
        'create video',
        'edit video',
        'delete video',

        // Dokter permissions
        'view daftar-dokter',
        'view daftar-spesialis',

        // Ruangan permissions
        'view bangsal',
        'view daftar-kelas',
        
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
