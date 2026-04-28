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

class SyncDokterFromApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 300;

    public function handle(RsudApiService $apiService): void
    {
        Log::info('[SYNC DOKTER] Proses dimulai');

        DB::transaction(function () use ($apiService) {

            // Sinkron Poliklinik 
            Log::info('[SYNC POLI] Ambil data poliklinik');
            $clinicsResponse = $apiService->get('clinics');

            if (!$clinicsResponse || !isset($clinicsResponse['data'])) {
                Log::error('[SYNC POLI] Gagal ambil data poliklinik');
            } else {
                $count = 0;
                foreach ($clinicsResponse['data'] as $clinic) {
                        $slug = \Illuminate\Support\Str::slug($clinic['nama']);

                        $existing = poliklinik_model::where('slug', $slug)
                            ->where('api_id', '!=', $clinic['id'])
                            ->exists();

                        if ($existing) {
                            $slug .= '-' . $clinic['id'];
    }
                    poliklinik_model::updateOrCreate(
                        ['api_id' => $clinic['id']],
                        [
                            'nama' => $clinic['nama'],
                            'slug' => $slug,
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
                    $count++;
                }
                Log::info('[SYNC POLI] Berhasil sync poliklinik', ['total' => $count]);
            }

            // Ambil Data Dokter 
            Log::info('[SYNC DOKTER] Ambil data dokter');
            $response = $apiService->get('doctors');

            if (!$response || !isset($response['data'])) {
                Log::error('[SYNC DOKTER] Response tidak valid');
                return;
            }

            Log::info('[SYNC DOKTER] Data dokter diterima', ['total' => count($response['data'])]);

            // Ambil Schedules 
            $doctorIds = collect($response['data'])
                ->pluck('dokter.id')
                ->filter()
                ->values()
                ->toArray();

            Log::info('[SYNC SCHEDULE] Ambil jadwal dokter', ['total_dokter' => count($doctorIds)]);

            $schedulesMap = [];
            if (method_exists($apiService, 'poolSchedules')) {
                $schedulesMap = $apiService->poolSchedules($doctorIds);
                Log::info('[SYNC SCHEDULE] Menggunakan poolSchedules', ['total_schedule' => count($schedulesMap)]);
            } else {
                foreach ($doctorIds as $id) {
                    $detail = $apiService->get('schedules', ['dokter_id' => $id]);
                    if ($detail && isset($detail['data'][0])) {
                        $schedulesMap[$id] = $detail['data'][0];
                    }
                }
                Log::warning('[SYNC SCHEDULE] poolSchedules tidak tersedia, fallback loop');
            }

            $polis = poliklinik_model::pluck('id', 'api_id')->toArray();
            $dokterCount = 0;
            $jadwalCount = 0;
            $allApiIds = []; // kumpulkan semua api_id dari response

            // Loop 
            foreach ($response['data'] as $item) {
                $dokterData = $item['dokter'] ?? [];
                if (!$dokterData) {
                    Log::warning('[SYNC DOKTER] Data dokter kosong', $item);
                    continue;
                }

                $apiId = $dokterData['id'] ?? null;
                if (!$apiId) {
                    Log::warning('[SYNC DOKTER] Dokter tanpa ID', $dokterData);
                    continue;
                }

                $allApiIds[] = $apiId;

                $detail = $schedulesMap[$apiId] ?? [];
                $dokter = dokter_model::where('api_id', $apiId)->first();
                $isManual = $dokter && $dokter->is_manual;

                if ($isManual) {
                    Log::info('[SYNC DOKTER] Skip update manual', ['api_id' => $apiId, 'nama' => $dokter->nama]);
                    $dokter->update([
                        'rating' => $detail['rating'] ?? $dokter->rating,
                        'image_path' => $detail['image_path'] ?? $dokter->image_path,
                    ]);
                } else {
                    $dokter = dokter_model::updateOrCreate(
                        ['api_id' => $apiId],
                        [
                            'kode' => (string) $apiId,
                            'nama' => $dokterData['nama'] ?? '',
                            'spesialis' => $detail['spesialis'] ?? $dokterData['spesialis'] ?? null,
                            'subspesialis' => $detail['subspesialis'] ?? null,
                            'kode_bpjs' => $detail['kode_bpjs'] ?? null,
                            'rating' => $detail['rating'] ?? 0,
                            'umur' => isset($detail['umur']) ? (int) $detail['umur'] : null,
                            'image_path' => $detail['image_path'] ?? null,
                            'pendidikan' => is_array($detail['pendidikan'] ?? null) ? json_encode($detail['pendidikan']) : ($detail['pendidikan'] ?? null),
                            'source' => 'api',
                            'is_manual' => false,
                            'is_active' => true,
                        ]
                    );
                    $dokterCount++;
                }

                // Proses Jadwal 
                $existingJadwalApiIds = [];
                foreach ($item['jadwal_dokter'] ?? [] as $jadwalItem) {
                    $jadwalApiId = $jadwalItem['jadwal_dokter_id'] ?? null;
                    if (!$jadwalApiId) continue;

                    $existingJadwalApiIds[] = $jadwalApiId;

                    $existingJadwal = jadwal_dokter_model::where('api_id', $jadwalApiId)->first();
                    if ($existingJadwal && $existingJadwal->is_manual) {
                        Log::info('[SYNC JADWAL] Skip manual', ['jadwal_api_id' => $jadwalApiId]);
                        continue;
                    }

                    $hari = $jadwalItem['hari'] ?? '';
                    $jamMulai = $jadwalItem['jam_praktek_mulai'] ?? '';
                    $jamSelesai = $jadwalItem['jam_praktek_selesai'] ?? '';
                    if (!$hari || !$jamMulai || !$jamSelesai) {
                        Log::warning('[SYNC JADWAL] Data tidak lengkap', $jadwalItem);
                        continue;
                    }

                    $poliklinikId = $polis[$jadwalItem['poliklinik_id'] ?? null] ?? null;

                    jadwal_dokter_model::updateOrCreate(
                        ['api_id' => $jadwalApiId],
                        [
                            'dokter_id' => $dokter->id,
                            'poliklinik_id' => $poliklinikId,
                            'hari' => $hari,
                            'jam_mulai' => $jamMulai,
                            'jam_selesai' => $jamSelesai,
                            'hari_order' => $this->getHariOrder($hari),
                            'ruangan_id' => $this->toIntOrNull($jadwalItem['ruangan_id'] ?? null),
                            'ruangan_nama' => $jadwalItem['ruangan_nama'] ?? null,
                            'kode_jadwal' => $jadwalItem['kode_jadwal'] ?? null,
                            'tipe_pelayanan' => $jadwalItem['tipe_pelayanan'] ?? null,
                            'source' => 'api',
                            'is_manual' => false,
                            'is_active' => true,
                        ]
                    );
                    $jadwalCount++;
                }

                // Hapus jadwal API yang tidak ada di response
                jadwal_dokter_model::where('dokter_id', $dokter->id)
                    ->where('source', 'api')
                    ->whereNotIn('api_id', $existingJadwalApiIds)
                    ->delete();
            }

            // Nonaktifkan Dokter API yang tidak ada 
            $allApiIds = array_unique($allApiIds);
            dokter_model::where('source', 'api')
                ->whereNotIn('api_id', $allApiIds)
                ->update(['is_active' => false]);

            Log::info('[SYNC SUMMARY]', [
                'dokter_terproses' => $dokterCount,
                'jadwal_terproses' => $jadwalCount,
                'dokter_api_aktif' => count($allApiIds),
            ]);
        });

        Log::info('[SYNC DOKTER] Proses selesai');
    }

    private function getHariOrder($hari): int
    {
        $order = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
        return $order[$hari] ?? 0;
    }

    private function toIntOrNull($value)
    {
        if ($value === null || $value === '' || $value === 'null') return null;
        return filter_var($value, FILTER_VALIDATE_INT) !== false ? (int) $value : null;
    }
}
