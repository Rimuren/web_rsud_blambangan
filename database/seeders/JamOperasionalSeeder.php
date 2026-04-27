<?php

namespace Database\Seeders;

use App\Models\jam_operasional;
use App\Models\Jam_operasional_model;
use Illuminate\Database\Seeder;

class JamOperasionalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = [
            [
                'hari' => 1,
                'jam_buka' => '07:00',
                'jam_tutup' => '14:00',
                'is_closed' => false,
            ],
            [
                'hari' => 2,
                'jam_buka' => '07:00',
                'jam_tutup' => '14:00',
                'is_closed' => false,
            ],
            [
                'hari' => 3,
                'jam_buka' => '07:00',
                'jam_tutup' => '14:00',
                'is_closed' => false,
            ],
            [
                'hari' => 4,
                'jam_buka' => '07:00',
                'jam_tutup' => '14:00',
                'is_closed' => false,
            ],
            [
                'hari' => 5,
                'jam_buka' => '07:00',
                'jam_tutup' => '11:00',
                'is_closed' => false,
            ],
            [
                'hari' => 6,
                'jam_buka' => '07:00',
                'jam_tutup' => '12:00',
                'is_closed' => false,
            ],
            [
                'hari' => 7,
                'jam_buka' => null,
                'jam_tutup' => null,
                'is_closed' => true,
            ],
        ];

        foreach ($items as $item) {
            Jam_operasional_model::updateOrCreate(
                ['hari' => $item['hari']],
                $item
            );
        }
    }
}
