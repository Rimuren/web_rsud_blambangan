<?php

namespace App\Services;

use App\Services\BedApiService;
use App\Services\BedFallbackService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BedService
{
  protected BedApiService $api;
  protected BedFallbackService $fallback;

  const CACHE_FAIL = 'api_bed_fail';

  public function __construct(BedApiService $api, BedFallbackService $fallback)
  {
    $this->api = $api;
    $this->fallback = $fallback;
  }

  public function getBeds(): array
  {
    // Jika dalam cooldown, langsung fallback
    if (Cache::get(self::CACHE_FAIL)) {
      Log::info('API bed cooldown → pakai DB');
      return $this->fallback->fetch();
    }

    // Coba API live
    $data = $this->api->fetch();
    if ($data !== null) {
      Cache::forget(self::CACHE_FAIL);
      Log::info('Data bed dari API');
      return $data;
    }

    // Gagal → cooldown 2 menit, lalu fallback
    Cache::put(self::CACHE_FAIL, true, now()->addMinutes(2));
    Log::warning('API bed gagal → fallback DB');
    return $this->fallback->fetch();
  }
}