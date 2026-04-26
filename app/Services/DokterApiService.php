<?php

namespace App\Services;

use App\Models\dokter_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Services\Traits\DoctorDataHelper;

class DokterApiService
{
    use DoctorDataHelper;

    protected RsudApiService $apiService;
    protected const CACHE_KEY_LIVE = 'doctors_live_data';

    public function __construct(RsudApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function fetchLive(Request $request): ?array
    {
        $cacheKey = $this->getCacheKey($request);
        if (Cache::has($cacheKey)) {
            Log::info('Mengambil data dokter dari cache (API live)');
            return Cache::get($cacheKey);
        }

        $response = $this->apiService->get('doctors', [], 5);
        if (!$response || !isset($response['data'])) {
            return null;
        }

        $now = Carbon::now('Asia/Jakarta');
        Carbon::setLocale('id');
        $hariIni = $now->translatedFormat('l');

        $doctors = [];
        $poliklinikSet = [];

        foreach ($response['data'] as $item) {
            $dokterData = $item['dokter'] ?? [];
            $jadwalList = $item['jadwal_dokter'] ?? [];
            $apiId = $dokterData['id'] ?? null;
            $namaDokter = $dokterData['nama'] ?? '';

            $dokterDb = null;
            if ($apiId) {
                $dokterDb = dokter_model::where('api_id', $apiId)->first();
            }
            if (!$dokterDb && !empty($namaDokter)) {
                $dokterDb = dokter_model::where('nama', $namaDokter)->first();
            }

            $spesialis = $dokterDb->spesialis ?? null;
            $imageUrl = $dokterDb->image_url ?? null;

            $reguler = [];
            $eksekutif = [];

            foreach ($jadwalList as $jadwal) {
                $hari = $jadwal['hari'] ?? '';
                $jamMulai = $jadwal['jam_praktek_mulai'] ?? '';
                $jamSelesai = $jadwal['jam_praktek_selesai'] ?? '';
                $tipe = $jadwal['tipe_pelayanan'] ?? 'onsite';
                $poliklinikNama = $jadwal['poliklinik_nama'] ?? '';

                if (!$hari || !$jamMulai || !$jamSelesai) continue;
                if (!empty($poliklinikNama)) $poliklinikSet[] = $poliklinikNama;

                $isToday = ($hari === $hariIni);
                $isOpen = false;
                if ($isToday) {
                    $start = Carbon::createFromTimeString($jamMulai, 'Asia/Jakarta');
                    $end = Carbon::createFromTimeString($jamSelesai, 'Asia/Jakarta');
                    $isOpen = $now->between($start, $end);
                }

                $jadwalItem = [
                    'hari'      => $hari,
                    'mulai'     => $jamMulai,
                    'selesai'   => $jamSelesai,
                    'tipe'      => $tipe,
                    'poliklinik' => $poliklinikNama,
                    'is_today'  => $isToday,
                    'is_open'   => $isOpen,
                ];

                if (stripos($poliklinikNama, 'EKSEKUTIF') !== false) {
                    $eksekutif[] = $jadwalItem;
                } else {
                    $reguler[] = $jadwalItem;
                }
            }

            $hariOrder = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
            usort($reguler, fn($a, $b) => ($hariOrder[$a['hari']] ?? 0) <=> ($hariOrder[$b['hari']] ?? 0));
            usort($eksekutif, fn($a, $b) => ($hariOrder[$a['hari']] ?? 0) <=> ($hariOrder[$b['hari']] ?? 0));

            $allPolis = [];
            foreach ($reguler as $j) $allPolis[] = $j['poliklinik'];
            foreach ($eksekutif as $j) $allPolis[] = $j['poliklinik'];
            $uniquePolis = array_values(array_unique($allPolis));

            $doctors[] = [
                'api_id'     => $apiId,
                'name'       => $namaDokter,
                'spesialis'  => $spesialis,
                'image_url'  => $imageUrl,
                'reguler'    => $reguler,
                'eksekutif'  => $eksekutif,
                'polikliniks' => $uniquePolis,
            ];
        }

        $doctors = $this->applyFilters($doctors, $request);
        $poliklinikList = array_values(array_unique($poliklinikSet));

        $doctorObjects = collect($doctors)->map(fn($d, $idx) => $this->toDoctorObject($d, $idx));
        $paginated = $this->paginate($doctorObjects->toArray(), $request);

        $result = ['dokters' => $paginated, 'poliklinikList' => $poliklinikList];
        Cache::put($cacheKey, $result, now()->addMinutes(5));

        return $result;
    }

    private function getCacheKey(Request $request): string
    {
        $query = http_build_query($request->only(['search', 'poliklinik', 'hari', 'page']));
        return self::CACHE_KEY_LIVE . '_' . md5($query);
    }
}
