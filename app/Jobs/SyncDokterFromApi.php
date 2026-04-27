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

            $response = $this->fetchDoctors($apiService);
            if (!$response) return;

            $schedulesMap = $this->fetchSchedules($apiService, $response);

            $polis = $this->getPoliklinikMap();
            if (empty($polis)) return;

            $this->processDoctors($response, $schedulesMap, $polis);
        });

        Log::info('[SYNC DOKTER] Proses selesai');
    }

    // ===============================
    // FETCH DATA
    // ===============================

    private function fetchDoctors(RsudApiService $apiService): ?array
    {
        Log::info('[SYNC DOKTER] Ambil data dokter');

        $response = $apiService->get('doctors');

        if (!$response || !isset($response['data'])) {
            Log::error('[SYNC DOKTER] Response tidak valid');
            return null;
        }

        Log::info('[SYNC DOKTER] Data dokter diterima', [
            'total' => count($response['data'])
        ]);

        return $response['data'];
    }

    private function fetchSchedules(RsudApiService $apiService, array $data): array
    {
        $doctorIds = collect($data)
            ->pluck('dokter.id')
            ->filter()
            ->values()
            ->toArray();

        Log::info('[SYNC SCHEDULE] Ambil jadwal dokter', [
            'total_dokter' => count($doctorIds)
        ]);

        if (method_exists($apiService, 'poolSchedules')) {
            $map = $apiService->poolSchedules($doctorIds);

            Log::info('[SYNC SCHEDULE] Menggunakan poolSchedules', [
                'total_schedule' => count($map)
            ]);

            return $map;
        }

        $map = [];
        foreach ($doctorIds as $id) {
            $detail = $apiService->get('schedules', ['dokter_id' => $id]);
            if ($detail && isset($detail['data'][0])) {
                $map[$id] = $detail['data'][0];
            }
        }

        Log::warning('[SYNC SCHEDULE] poolSchedules tidak tersedia, fallback loop');

        return $map;
    }

    private function getPoliklinikMap(): array
    {
        $polis = poliklinik_model::pluck('id', 'api_id')->toArray();

        if (empty($polis)) {
            Log::error('[SYNC DOKTER] Gagal: Poliklinik belum ada');
        }

        return $polis;
    }

    // ===============================
    // PROCESS DATA
    // ===============================

    private function processDoctors(array $data, array $schedulesMap, array $polis): void
    {
        $dokterCount = 0;
        $jadwalCount = 0;
        $allApiIds = [];

        foreach ($data as $item) {

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

            $dokter = $this->syncDokter($apiId, $dokterData, $detail, $dokterCount);

            $jadwalCount += $this->syncJadwal(
                $dokter,
                $item['jadwal_dokter'] ?? [],
                $polis
            );
        }

        $this->deactivateMissingDoctors($allApiIds);

        Log::info('[SYNC SUMMARY]', [
            'dokter_terproses' => $dokterCount,
            'jadwal_terproses' => $jadwalCount,
            'dokter_api_aktif' => count(array_unique($allApiIds)),
        ]);
    }

    // ===============================
    // SYNC CORE
    // ===============================

    private function syncDokter($apiId, $dokterData, $detail, &$counter)
    {
        $dokter = dokter_model::where('api_id', $apiId)->first();
        $isManual = $dokter && $dokter->is_manual;

        if ($isManual) {
            Log::info('[SYNC DOKTER] Skip update manual', [
                'api_id' => $apiId,
                'nama' => $dokter->nama
            ]);

            $dokter->update([
                'rating' => $detail['rating'] ?? $dokter->rating,
                'image_path' => $detail['image_path'] ?? $dokter->image_path,
            ]);

            return $dokter;
        }

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
                'pendidikan' => is_array($detail['pendidikan'] ?? null)
                    ? json_encode($detail['pendidikan'])
                    : ($detail['pendidikan'] ?? null),
                'source' => 'api',
                'is_manual' => false,
                'is_active' => true,
            ]
        );

        $counter++;

        return $dokter;
    }

    private function syncJadwal($dokter, array $jadwalList, array $polis): int
    {
        $count = 0;
        $existingIds = [];

        foreach ($jadwalList as $jadwalItem) {

            $apiId = $jadwalItem['jadwal_dokter_id'] ?? null;
            if (!$apiId) continue;

            $existingIds[] = $apiId;

            $existing = jadwal_dokter_model::where('api_id', $apiId)->first();
            if ($existing && $existing->is_manual) {
                Log::info('[SYNC JADWAL] Skip manual', ['jadwal_api_id' => $apiId]);
                continue;
            }

            $hari = $jadwalItem['hari'] ?? '';
            $mulai = $jadwalItem['jam_praktek_mulai'] ?? '';
            $selesai = $jadwalItem['jam_praktek_selesai'] ?? '';

            if (!$hari || !$mulai || !$selesai) {
                Log::warning('[SYNC JADWAL] Data tidak lengkap', $jadwalItem);
                continue;
            }

            $poliId = $polis[$jadwalItem['poliklinik_id'] ?? null] ?? null;

            jadwal_dokter_model::updateOrCreate(
                ['api_id' => $apiId],
                [
                    'dokter_id' => $dokter->id,
                    'poliklinik_id' => $poliId,
                    'hari' => $hari,
                    'jam_mulai' => $mulai,
                    'jam_selesai' => $selesai,
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

            $count++;
        }

        // delete jadwal lama
        jadwal_dokter_model::where('dokter_id', $dokter->id)
            ->where('source', 'api')
            ->whereNotIn('api_id', $existingIds)
            ->delete();

        return $count;
    }

    private function deactivateMissingDoctors(array $apiIds): void
    {
        dokter_model::where('source', 'api')
            ->whereNotIn('api_id', array_unique($apiIds))
            ->update(['is_active' => false]);
    }

    // ===============================
    // UTIL
    // ===============================

    private function getHariOrder($hari): int
    {
        return [
            'Senin' => 1,
            'Selasa' => 2,
            'Rabu' => 3,
            'Kamis' => 4,
            'Jumat' => 5,
            'Sabtu' => 6,
            'Minggu' => 7
        ][$hari] ?? 0;
    }

    private function toIntOrNull($value)
    {
        if ($value === null || $value === '' || $value === 'null') return null;
        return filter_var($value, FILTER_VALIDATE_INT) !== false ? (int) $value : null;
    }
}
