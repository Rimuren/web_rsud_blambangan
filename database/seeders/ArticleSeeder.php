<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); 

        // Buat beberapa kategori jika belum ada
        $kategoriList = [
            ['nama' => 'Tips Kesehatan', 'slug' => 'tips-kesehatan'],
            ['nama' => 'Nutrisi', 'slug' => 'nutrisi'],
            ['nama' => 'Olahraga', 'slug' => 'olahraga'],
            ['nama' => 'Penyakit', 'slug' => 'penyakit'],
            ['nama' => 'Mental Health', 'slug' => 'mental-health'],
        ];

        $kategoriIds = [];
        foreach ($kategoriList as $kat) {
            $kategori = kategori_artikel_model::firstOrCreate(
                ['slug' => $kat['slug']],
                ['nama' => $kat['nama']]
            );
            $kategoriIds[] = $kategori->id;
        }

        // Pastikan ada user dengan id 1
        $penulisId = 1;
        if (!User::find($penulisId)) {
            // Jika user id 1 tidak ada, buat user dummy atau ambil user pertama
            $user = User::first();
            if ($user) {
                $penulisId = $user->id;
            } else {
                // Buat user minimal
                $user = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password'),
                ]);
                $penulisId = $user->id;
            }
        }

        // Buat 15 artikel
        for ($i = 1; $i <= 15; $i++) {
            $judul = $faker->sentence(rand(5, 10));
            // Hilangkan titik di akhir
            $judul = rtrim($judul, '.');
            
            // Buat konten yang lebih panjang (simulasi artikel)
            $konten = "<p>" . $faker->paragraph(rand(3, 6)) . "</p>";
            $konten .= "<h2>" . $faker->sentence(rand(3, 5)) . "</h2>";
            $konten .= "<p>" . $faker->paragraph(rand(4, 8)) . "</p>";
            $konten .= "<ul>";
            for ($j = 0; $j < rand(3, 5); $j++) {
                $konten .= "<li>" . $faker->sentence(rand(4, 8)) . "</li>";
            }
            $konten .= "</ul>";
            $konten .= "<p>" . $faker->paragraph(rand(3, 5)) . "</p>";

            artikel_model::create([
                'judul' => $judul,
                'slug' => Str::slug($judul) . '-' . $i,
                'konten' => $konten,
                'kategori_id' => $faker->randomElement($kategoriIds),
                'penulis_id' => $penulisId,
                'status' => 'published',
                'published_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'views' => $faker->numberBetween(0, 500),
                'thumbnail' => null,
            ]);
        }

        $this->command->info('15 artikel berhasil di-seed!');
    }
}