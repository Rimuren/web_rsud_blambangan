<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DokterService
{
    protected DokterApiService $apiService;
    protected DokterFallbackService $fallbackService;
    protected const CACHE_KEY_API_FAIL = 'api_doctors_fail';

    public function __construct(DokterApiService $apiService, DokterFallbackService $fallbackService)
    {
        $this->apiService = $apiService;
        $this->fallbackService = $fallbackService;
    }

    public function getDokters(Request $request): array
    {
        // Jika dalam cooldown (API pernah gagal dalam 5 menit), langsung fallback ke DB
        if (Cache::get(self::CACHE_KEY_API_FAIL, false)) {
            Log::info('API dokter cooldown -> fallback DB');
            return $this->fallbackService->fetch($request);
        }

        // Coba ambil live data dari API (dengan cache 5 menit)
        $liveData = $this->apiService->fetchLive($request);
        if ($liveData !== null) {
            Cache::forget(self::CACHE_KEY_API_FAIL);
            Log::info('Menggunakan data dokter dari API (live)');
            return $liveData;
        }

        // API gagal, aktifkan cooldown 5 menit dan fallback ke DB
        Cache::put(self::CACHE_KEY_API_FAIL, true, now()->addMinutes(5));
        Log::info('API gagal, menggunakan fallback database');
        return $this->fallbackService->fetch($request);
    }
}
