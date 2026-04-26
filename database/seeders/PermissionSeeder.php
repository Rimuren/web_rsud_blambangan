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

        // Access
        'admin.access',

        // Artikel
        'artikel.view',
        'artikel.create',
        'artikel.update',
        'artikel.delete',

        // Kategori Artikel
        'kategori.view',
        'kategori.create',
        'kategori.update',
        'kategori.delete',

        // Akun
        'akun.view',
        'akun.create',
        'akun.update',
        'akun.delete',
        'akun.reset_password',

        // Role
        'role.view',
        'role.create',
        'role.update',
        'role.delete',

        // Foto
        'foto.view',
        'foto.create',
        'foto.update',
        'foto.delete',

        // Video
        'video.view',
        'video.create',
        'video.update',
        'video.delete',

        // Jam Operasional
        'jam_operasional.view',
        'jam_operasional.create',
        'jam_operasional.update',
        'jam_operasional.delete',
        'jam_operasional.toggle_status',

        // Iklan
        'iklan.view',
        'iklan.create',
        'iklan.update',
        'iklan.delete',
        'iklan.toggle_status',

        // Dokter
        'dokter.view',

        'poliklinik.view',
        'poliklinik.create',
        'poliklinik.update',
        'poliklinik.delete',

        // Ruangan / Bangsal / Kelas
        'bangsal.view',
        'kelas.view',
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
