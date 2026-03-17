<?php

namespace App\Jobs;

use App\Models\dokter_model;
use App\Services\RsudApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchDokterFromApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 60;

    public function handle(RsudApiService $apiService): void
    {
        Log::info('Job FetchDokterFromApi dimulai');

        $response = $apiService->get('doctors');

        if ($response === null) {
            Log::error('Job gagal: response null');
            $this->fail('Response null');
            return;
        }

        // Cek apakah response memiliki struktur {status, code, message, data}
        if (!isset($response['data']) || !is_array($response['data'])) {
            Log::error('Job gagal: response tidak memiliki key "data" atau bukan array', ['response' => $response]);
            $this->fail('Invalid response structure');
            return;
        }

        $items = $response['data'];
        $count = 0;

        foreach ($items as $item) {
            // Pastikan ada key 'dokter'
            if (!isset($item['dokter']) || !is_array($item['dokter'])) {
                Log::warning('Item tanpa data dokter, dilewati', $item);
                continue;
            }

            $dokterData = $item['dokter'];

            // Gunakan 'id' dari API sebagai identifier unik (disimpan di kolom 'kode')
            $apiId = $dokterData['id'] ?? null;
            if (!$apiId) {
                Log::warning('Data dokter tanpa id, dilewati', $dokterData);
                continue;
            }

            // Mapping field dari API ke kolom database
            try {
                dokter_model::updateOrCreate(
                    ['kode' => $apiId], // simpan API id ke kolom kode
                    [
                        'nama'         => $dokterData['nama'] ?? '',
                        'kode_bpjs'    => $dokterData['kode_bpjs'] ?? null, // jika ada
                        'spesialis'    => $dokterData['spesialis'] ?? null,
                        'subspesialis' => $dokterData['subspesialis'] ?? null,
                        'pendidikan'   => $dokterData['pendidikan'] ?? null,
                        'umur'         => isset($dokterData['umur']) ? (int) $dokterData['umur'] : null,
                        'rating'       => $dokterData['rating'] ?? 0,
                        'image_path'   => $dokterData['image_path'] ?? null,
                    ]
                );
                $count++;
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan dokter', [
                    'api_id' => $apiId,
                    'error'  => $e->getMessage()
                ]);
            }
        }

        Log::info("Job FetchDokterFromApi selesai. Total tersimpan: $count");
    }
}
