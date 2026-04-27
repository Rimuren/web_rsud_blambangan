<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PoliklinikService
{
  protected PoliklinikApiService $apiService;
  protected PoliklinikFallbackService $fallbackService;

  protected const CACHE_KEY_FAIL = 'api_clinics_fail';

  public function __construct(
    PoliklinikApiService $apiService,
    PoliklinikFallbackService $fallbackService
  ) {
    $this->apiService = $apiService;
    $this->fallbackService = $fallbackService;
  }

  public function getPoliklinik(Request $request): LengthAwarePaginator
  {
    // Jika API lagi gagal → langsung DB
    if (Cache::get(self::CACHE_KEY_FAIL, false)) {
      Log::info('Clinics API cooldown → fallback DB');
      return $this->fallbackService->fetch($request);
    }

    // Coba API
    $live = $this->apiService->fetchLive($request);

    if ($live !== null) {
      Cache::forget(self::CACHE_KEY_FAIL);
      Log::info('Menggunakan data poliklinik dari API');
      return $live;
    }

    // API gagal → fallback
    Cache::put(self::CACHE_KEY_FAIL, true, now()->addMinutes(5));
    Log::warning('API poliklinik gagal → fallback DB');

    return $this->fallbackService->fetch($request);
  }
}
