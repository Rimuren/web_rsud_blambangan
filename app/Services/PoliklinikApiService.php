<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Fluent;

class PoliklinikApiService
{
  protected RsudApiService $apiService;
  protected const CACHE_KEY_LIVE = 'clinics_live_data';

  public function __construct(RsudApiService $apiService)
  {
    $this->apiService = $apiService;
  }

  public function fetchLive(Request $request): ?LengthAwarePaginator
  {
    $cacheKey = $this->getCacheKey($request);

    // Ambil dari cache
    if (Cache::has($cacheKey)) {
      Log::info('Mengambil data poliklinik dari cache');

      $data = Cache::get($cacheKey);

      return new LengthAwarePaginator(
        collect($data['items'])->map(fn($item) => new Fluent($item)),
        $data['total'],
        $data['per_page'],
        $data['current_page'],
        [
          'path' => request()->url(),
          'query' => request()->query(),
        ]
      );
    }

    // Hit API
    $response = $this->apiService->get('clinics', [], 5);

    if (!$response || !isset($response['data'])) {
      return null;
    }

    // Mapping data
    $clinics = collect($response['data'])->map(function ($item) {
      return [
        'id' => $item['id'],
        'api_id' => $item['id'],
        'nama' => $item['nama'],
        'kode_bpjs' => $item['kode_bpjs'] ?? null,
        'image' => $item['image'] ?? null,
        'background_img' => $item['background_img'] ?? null,
        'tarif_konsultasi' => $item['tarif_konsultasi'] ?? 0,
        'jumlah_dokter' => $item['dokter'] ?? 0,
        'is_active' => true,
      ];
    });

    // Filter search
    if ($request->filled('search')) {
      $search = strtolower($request->search);
      $clinics = $clinics->filter(function ($item) use ($search) {
        return str_contains(strtolower($item['nama']), $search);
      });
    }

    // Pagination manual
    $page = (int) $request->get('page', 1);
    $perPage = 10;

    $items = $clinics->values();
    $paginatedItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

    $paginated = new LengthAwarePaginator(
      $paginatedItems->map(fn($item) => new Fluent($item)),
      $items->count(),
      $perPage,
      $page,
      [
        'path' => request()->url(),
        'query' => request()->query(),
      ]
    );

    // SIMPAN CACHE 
    Cache::put($cacheKey, [
      'items' => $paginatedItems->toArray(),
      'total' => $items->count(),
      'per_page' => $perPage,
      'current_page' => $page,
    ], now()->addMinutes(5));

    return $paginated;
  }

  private function getCacheKey(Request $request): string
  {
    $query = http_build_query($request->only(['search', 'page']));
    return self::CACHE_KEY_LIVE . '_' . md5($query);
  }
}
