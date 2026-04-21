<?php

namespace App\Jobs;

use App\Models\dokter_model;
use App\Models\jadwal_dokter_model;
use App\Models\poliklinik_model;
use App\Services\RsudApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
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

    private function toInt($value): ?int
    {
        if (is_null($value)) return null;
        $value = trim((string)$value);
        if ($value === '' || !is_numeric($value)) return null;
        return (int) $value;
    }

    public function handle(RsudApiService $apiService): void
    {
        Log::info('Job FetchDokterFromApi dimulai (incremental)');

        DB::transaction(function () use ($apiService) {
            // ==================== 1. Sinkronisasi Poliklinik ====================
            $clinicsResponse = $apiService->get('clinics');
            if ($clinicsResponse && isset($clinicsResponse['data'])) {
                foreach ($clinicsResponse['data'] as $clinic) {
                    try {
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
                            ]
                        );
                    } catch (\Exception $e) {
                        Log::error("Gagal menyimpan klinik api_id {$clinic['id']}: " . $e->getMessage());
                    }
                }
                Log::info('Data klinik berhasil disimpan/update');
            } else {
                Log::warning('Gagal mengambil data klinik');
            }

            // ==================== 2. Ambil data dokter ====================
            $response = $apiService->get('doctors');
            if (!$response || !isset($response['data']) || !is_array($response['data'])) {
                Log::error('Job gagal: response dokter tidak valid');
                $this->fail('Invalid response from doctors endpoint');
                return;
            }

            // Kumpulkan ID dokter untuk mengambil schedules
            $doctorIds = collect($response['data'])
                ->pluck('dokter.id')
                ->filter()
                ->values()
                ->toArray();

            // Ambil data schedules (gunakan pool jika tersedia, jika tidak loop satu per satu)
            $schedulesMap = [];
            if (!empty($doctorIds)) {
                if (method_exists($apiService, 'poolSchedules')) {
                    $schedulesMap = $apiService->poolSchedules($doctorIds);
                } else {
                    foreach ($doctorIds as $id) {
                        $detail = $apiService->get('schedules', ['dokter_id' => $id]);
                        if ($detail && isset($detail['data'][0])) {
                            $schedulesMap[$id] = $detail['data'][0];
                        }
                    }
                }
            }

            $countDokter = 0;
            $countJadwal = 0;

            // Map poliklinik (api_id => id lokal) untuk akses cepat
            $poliMap = poliklinik_model::pluck('id', 'api_id')->toArray();

            foreach ($response['data'] as $item) {
                if (!isset($item['dokter'])) continue;

                $dokterData = $item['dokter'];
                $apiId = $dokterData['id'] ?? null;
                if (!$apiId) continue;

                $detail = $schedulesMap[$apiId] ?? [];

                // Data dokter
                $nama = $dokterData['nama'] ?? '';
                $spesialis = $detail['spesialis'] ?? $dokterData['spesialis'] ?? null;
                $subspesialis = $detail['subspesialis'] ?? null;
                $kode_bpjs = $detail['kode_bpjs'] ?? null;
                $rating = $detail['rating'] ?? 0;
                $umur = isset($detail['umur']) ? (int) $detail['umur'] : null;
                $image_path = $detail['image_path'] ?? null;
                $pendidikan = isset($detail['pendidikan']) ? json_encode($detail['pendidikan']) : null;

                try {
                    $dokter = dokter_model::updateOrCreate(
                        ['api_id' => $apiId],
                        [
                            'kode' => (string) $apiId,
                            'nama' => $nama,
                            'spesialis' => $spesialis,
                            'subspesialis' => $subspesialis,
                            'kode_bpjs' => $kode_bpjs,
                            'rating' => $rating,
                            'umur' => $umur,
                            'image_path' => $image_path,
                            'pendidikan' => $pendidikan,
                        ]
                    );
                    $countDokter++;
                } catch (\Exception $e) {
                    Log::error("Gagal menyimpan dokter api_id $apiId: " . $e->getMessage());
                    continue;
                }

                // Hapus jadwal lama
                jadwal_dokter_model::where('dokter_id', $dokter->id)->delete();

                // Simpan jadwal baru
                if (isset($item['jadwal_dokter']) && is_array($item['jadwal_dokter'])) {
                    foreach ($item['jadwal_dokter'] as $jadwalItem) {
                        try {
                            $jadwalApiId = $jadwalItem['jadwal_dokter_id'] ?? null;
                            $hari = $jadwalItem['hari'] ?? null;
                            $jamMulai = $jadwalItem['jam_praktek_mulai'] ?? null;
                            $jamSelesai = $jadwalItem['jam_praktek_selesai'] ?? null;
                            if (!$hari || !$jamMulai || !$jamSelesai) continue;

                            // Cari poliklinik_id
                            $poliklinikId = null;
                            $poliApiId = $jadwalItem['poliklinik_id'] ?? null;
                            if ($poliApiId && isset($poliMap[$poliApiId])) {
                                $poliklinikId = $poliMap[$poliApiId];
                            }
                            if (!$poliklinikId && !empty($jadwalItem['poliklinik_nama'])) {
                                $poli = poliklinik_model::where('nama', $jadwalItem['poliklinik_nama'])->first();
                                if ($poli) $poliklinikId = $poli->id;
                            }

                            jadwal_dokter_model::create([
                                'api_id' => $jadwalApiId,
                                'dokter_id' => $dokter->id,
                                'poliklinik_id' => $poliklinikId,
                                'ruangan_id' => $this->toInt($jadwalItem['ruangan_id'] ?? null),
                                'ruangan_nama' => $jadwalItem['ruangan_nama'] ?? null,
                                'kode_jadwal' => $jadwalItem['kode_jadwal'] ?? null,
                                'hari' => $hari,
                                'hari_order' => $this->getHariOrder($hari),
                                'jam_mulai' => $jamMulai,
                                'jam_selesai' => $jamSelesai,
                                'tipe_pelayanan' => $jadwalItem['tipe_pelayanan'] ?? null,
                            ]);
                            $countJadwal++;
                        } catch (\Exception $e) {
                            Log::error("Gagal simpan jadwal dokter api_id $apiId: " . $e->getMessage());
                        }
                    }
                }
            }

            Log::info("Job selesai. Dokter: $countDokter, Jadwal: $countJadwal");
        });
    }
}
