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
        // Jika API pernah gagal dalam 5 menit terakhir, langsung fallback
        if (Cache::get(self::CACHE_KEY_API_FAIL, false)) {
            Log::info('API sedang cooldown, pakai database');
            return $this->fallbackService->fetch($request);
        }

        $apiData = $this->apiService->fetch($request);
        if ($apiData !== null) {
            Cache::forget(self::CACHE_KEY_API_FAIL);
            Log::info('Menggunakan data dokter dari API (live)');
            return $apiData;
        }

        // API gagal, aktifkan cooldown 5 menit
        Cache::put(self::CACHE_KEY_API_FAIL, true, now()->addMinutes(5));
        Log::info('API gagal, menggunakan fallback database');
        return $this->fallbackService->fetch($request);
    }
}
