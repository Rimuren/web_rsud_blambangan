<?php

namespace App\Jobs;

use App\Models\poliklinik_model;
use App\Services\RsudApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncPoliklinikFromApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(RsudApiService $apiService): void
    {
        Log::info('[SYNC POLIKLINIK] Mulai');

        $response = $apiService->get('clinics', [], 5);

        if (!$response || !isset($response['data'])) {
            Log::error('[SYNC POLIKLINIK] Gagal ambil data');
            return;
        }

        DB::transaction(function () use ($response) {
            foreach ($response['data'] as $clinic) {
                poliklinik_model::updateOrCreate(
                    ['api_id' => $clinic['id']],
                    [
                        'nama' => $clinic['nama'],
                        'kode_bpjs' => $clinic['kode_bpjs'] ?? null,
                        'image' => $clinic['image'] ?? null,
                        'background_img' => $clinic['background_img'] ?? null,
                        'tarif_konsultasi' => $clinic['tarif_konsultasi'] ?? 0,
                        'jumlah_dokter' => $clinic['dokter'] ?? 0,
                        'senin' => $clinic['senin'] ?? false,
                        'selasa' => $clinic['selasa'] ?? false,
                        'rabu' => $clinic['rabu'] ?? false,
                        'kamis' => $clinic['kamis'] ?? false,
                        'jumat' => $clinic['jumat'] ?? false,
                        'sabtu' => $clinic['sabtu'] ?? false,
                        'minggu' => $clinic['minggu'] ?? false,
                        'source' => 'api',
                        'is_active' => true,
                    ]
                );
            }
        });

        Log::info('[SYNC POLIKLINIK] Selesai');
    }
}
