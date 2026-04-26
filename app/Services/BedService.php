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
    return Cache::remember('beds_data', 60, function () {

      if (Cache::get(self::CACHE_FAIL)) {
        Log::info('API bed cooldown → pakai DB');
        return $this->fallback->fetch();
      }

      $data = $this->api->fetch();

      if ($data !== null) {
        Cache::forget(self::CACHE_FAIL);
        Log::info('Data bed dari API');
        return $data;
      }

      Cache::put(self::CACHE_FAIL, true, now()->addMinutes(5));

      Log::warning('API bed gagal → fallback DB');
      return $this->fallback->fetch();
    });
  }
}