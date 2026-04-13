<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\kategori_artikel_model;
use Illuminate\Database\Seeder;

class KategoriArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ketegoris= [
            [
                'nama' => 'kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'kategori yang bersangkutan dengan kesehatan',
            ],
            [
                'nama' => 'olahraga',
                'slug' => 'olahraga',
                'deskripsi' => 'kategori yang bersangkutan dengan olahraga',
            ],
            [
                'nama' => 'makanan sehat',
                'slug' => 'makanan sehat',
                'deskripsi' => 'kategori yang bersangkutan dengan makanan sehat',
            ],
        ];

        foreach ($ketegoris as $kategori ){
            kategori_artikel_model::firstOrCreate(['nama' => $kategori['nama']],$kategori
            );
        }
        $this->command->info('Successfully created ' . count($kategori) . ' kategori artikel!');
    }
}
