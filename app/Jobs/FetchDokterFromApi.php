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

    /**
     * Mapping hari ke angka untuk sorting (opsional).
     */
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

        if ($response === null) {
            Log::error('Job gagal: response null');
            $this->fail('Response null');
            return;
        }

        if (!isset($response['data']) || !is_array($response['data'])) {
            Log::error('Job gagal: response tidak memiliki key "data" atau bukan array', ['response' => $response]);
            $this->fail('Invalid response structure');
            return;
        }

        $items = $response['data'];
        $countDokter = 0;
        $countJadwal = 0;

        foreach ($items as $item) {
            if (!isset($item['dokter']) || !is_array($item['dokter'])) {
                Log::warning('Item tanpa data dokter, dilewati', $item);
                continue;
            }

            $dokterData = $item['dokter'];
            $apiId = $dokterData['id'] ?? null;
            if (!$apiId) {
                Log::warning('Data dokter tanpa id, dilewati', $dokterData);
                continue;
            }

            // Simpan atau update data dokter
            try {
                $dokter = dokter_model::updateOrCreate(
                    ['kode' => (string) $apiId], // simpan API id ke kolom kode
                    [
                        'nama'         => $dokterData['nama'] ?? '',
                        'kode_bpjs'    => $dokterData['kode_bpjs'] ?? null,
                        'spesialis'    => $dokterData['spesialis'] ?? null,
                        'subspesialis' => $dokterData['subspesialis'] ?? null,
                        'pendidikan'   => $dokterData['pendidikan'] ?? null,
                        'umur'         => isset($dokterData['umur']) ? (int) $dokterData['umur'] : null,
                        'rating'       => $dokterData['rating'] ?? 0,
                        'image_path'   => $dokterData['image_path'] ?? null,
                    ]
                );
                $countDokter++;
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan dokter', [
                    'api_id' => $apiId,
                    'error'  => $e->getMessage()
                ]);
                continue; // skip jadwal jika dokter gagal
            }

            // Hapus jadwal lama untuk dokter ini (biar selalu sinkron)
            jadwal_dokter_model::where('dokter_id', $dokter->id)->delete();

            // Simpan jadwal baru jika ada
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
                        Log::error('Gagal menyimpan jadwal', [
                            'dokter_id' => $dokter->id,
                            'jadwal'    => $jadwalItem,
                            'error'     => $e->getMessage()
                        ]);
                    }
                }
            }
        }

        Log::info("Job FetchDokterFromApi selesai. Dokter: $countDokter, Jadwal: $countJadwal");
    }
}
