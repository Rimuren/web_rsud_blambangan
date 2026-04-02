<?php

namespace App\Jobs;

use App\Models\dokter_model;
use App\Models\jadwal_dokter_model;
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

    private function getHariOrder(string $hari): int
    {
        $map = [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7,
        ];
        return $map[$hari] ?? 0;
    }

    public function handle(RsudApiService $apiService): void
    {
        Log::info('Job FetchDokterFromApi dimulai');

        $response = $apiService->get('doctors');
        if ($response === null || !isset($response['data']) || !is_array($response['data'])) {
            Log::error('Job gagal: response tidak valid');
            $this->fail('Invalid response from doctors endpoint');
            return;
        }

        $countDokter = 0;
        $countJadwal = 0;

        foreach ($response['data'] as $item) {
            if (!isset($item['dokter']) || !is_array($item['dokter'])) {
                continue;
            }

            $dokterData = $item['dokter'];
            $apiId = $dokterData['id'] ?? null;
            if (!$apiId) continue;

            // --- Simpan data dasar dokter ---
            try {
                $dokter = dokter_model::updateOrCreate(
                    ['kode' => (string) $apiId],
                    [
                        'nama'      => $dokterData['nama'] ?? '',
                        'spesialis' => $dokterData['spesialis'] ?? null,
                    ]
                );
                $countDokter++;
            } catch (\Exception $e) {
                Log::error("Gagal menyimpan dokter ID $apiId: " . $e->getMessage());
                continue;
            }

            // --- Ambil data lengkap dokter dari endpoint schedules ---
            try {
                $detailResponse = $apiService->get('schedules', ['dokter_id' => $apiId]);
                if ($detailResponse && isset($detailResponse['data'][0])) {
                    $detail = $detailResponse['data'][0];

                    $dokter->update([
                        'kode_bpjs'    => $detail['kode_bpjs'] ?? null,
                        'rating'       => $detail['rating'] ?? 0,
                        'umur'         => isset($detail['umur']) ? (int) $detail['umur'] : null,
                        'image_path'   => $detail['image_path'] ?? null,
                        'pendidikan'   => is_array($detail['pendidikan']) ? json_encode($detail['pendidikan']) : $detail['pendidikan'],
                        'subspesialis' => $detail['subspesialis'] ?? null,
                        'spesialis'    => $detail['spesialis'] ?? $dokter->spesialis,
                    ]);
                } else {
                    Log::warning("Data detail tidak ditemukan untuk dokter ID $apiId");
                }
            } catch (\Exception $e) {
                Log::error("Gagal mengambil data detail dokter ID $apiId: " . $e->getMessage());
            }

            // --- Hapus jadwal lama, simpan jadwal baru dari endpoint doctors ---
            jadwal_dokter_model::where('dokter_id', $dokter->id)->delete();

            if (isset($item['jadwal_dokter']) && is_array($item['jadwal_dokter'])) {
                foreach ($item['jadwal_dokter'] as $jadwalItem) {
                    try {
                        jadwal_dokter_model::create([
                            'dokter_id'      => $dokter->id,
                            'poliklinik_id'  => $jadwalItem['poliklinik_id'] ?? null,
                            'ruangan_id'     => $jadwalItem['ruangan_id'] ?? null,
                            'kode_jadwal'    => $jadwalItem['kode_jadwal'] ?? null,
                            'hari'           => $jadwalItem['hari'] ?? null,
                            'hari_order'     => $this->getHariOrder($jadwalItem['hari'] ?? ''),
                            'jam_mulai'      => $jadwalItem['jam_praktek_mulai'] ?? null,
                            'jam_selesai'    => $jadwalItem['jam_praktek_selesai'] ?? null,
                            'tipe_pelayanan' => $jadwalItem['tipe_pelayanan'] ?? null,
                        ]);
                        $countJadwal++;
                    } catch (\Exception $e) {
                        Log::error("Gagal menyimpan jadwal untuk dokter ID {$dokter->id}: " . $e->getMessage());
                    }
                }
            }
        }

        Log::info("Job selesai. Dokter: $countDokter, Jadwal: $countJadwal");
    }
}
