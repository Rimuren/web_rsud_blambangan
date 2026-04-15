<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = kategori_artikel_model::firstOrCreate(
        ['slug' => 'tips-kesehatan'],
            ['nama' => 'Tips Kesehatan']
        );

        artikel_model::create([
            'judul' => 'Artikel Pertama',
            'slug' => Str::slug('Artikel Pertama'),
            'konten' => '<p>Isi artikel pertama...</p>',
            'kategori_id' => $kategori->id,
            'penulis_id' => 1,
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
