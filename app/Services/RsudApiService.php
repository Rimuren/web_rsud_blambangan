<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Pool;

class RsudApiService
{
  protected string $baseUrl;
  protected string $cacheKey = 'rsud_api_token';

  public function __construct()
  {
    $this->baseUrl = rtrim(config('api.rsud.base_url'), '/');
  }

  /**
   * Public entry: ambil token valid (cache-aware)
   */
  public function getToken(): ?string
  {
    return Cache::remember($this->cacheKey, now()->addDays(6), function () {
      return $this->fetchNewToken();
    });
  }

  /**
   * Ambil token baru dari API (NO CACHE di sini)
   */
  protected function fetchNewToken(): ?string
  {
    try {
      $response = Http::timeout(15)->post(
        $this->baseUrl . '/token',
        [
          'email' => config('api.rsud.email'),
          'password' => config('api.rsud.password'),
        ]
      );

      if (!$response->successful()) {
        Log::error('Gagal ambil token API', [
          'status' => $response->status(),
          'body'   => $response->body()
        ]);
        return null;
      }

      $data = $response->json()['data'] ?? [];

      $token   = $data['token'] ?? null;
      $expires = $data['expires_in'] ?? 604800;

      if (!$token) {
        Log::error('Token kosong dari API');
        return null;
      }

      // Simpan TTL sedikit lebih cepat (antisipasi expired)
      Cache::put(
        $this->cacheKey,
        $token,
        now()->addSeconds($expires - 60)
      );

      return $token;
    } catch (\Exception $e) {
      Log::error('Exception ambil token: ' . $e->getMessage());
      return null;
    }
  }

  /**
   * Base request handler
   */
  protected function request(string $method, string $endpoint, array $data = [], int $timeout = 3): ?array
  {
    $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

    try {
      $token = $this->getToken();

      $response = Http::timeout($timeout)
        ->retry(3, 500)
        ->when($token, fn($req) => $req->withToken($token))
        ->$method($url, $data);

      // Auto refresh token jika expired
      if ($response->status() === 401) {
        Log::warning('Token expired, refresh token...');

        Cache::forget($this->cacheKey);

        $newToken = $this->fetchNewToken();

        if (!$newToken) return null;

        $response = Http::withToken($newToken)
          ->timeout(3)
          ->$method($url, $data);
      }

      if ($response->successful()) {
        return $response->json();
      }

      Log::warning('API gagal', [
        'method'   => strtoupper($method),
        'endpoint' => $endpoint,
        'status'   => $response->status(),
        'body'     => $response->body(),
      ]);

      return null;
    } catch (\Exception $e) {
      Log::error('API Exception: ' . $e->getMessage(), [
        'endpoint' => $endpoint
      ]);
      return null;
    }
  }


  public function poolSchedules(array $doctorIds): array
  {
    $token = $this->getToken();

    if (!$token) {
      Log::error('Token tidak tersedia untuk poolSchedules');
      return [];
    }

    $responses = Http::pool(function (Pool $pool) use ($doctorIds, $token) {
      return collect($doctorIds)->map(function ($id) use ($pool, $token) {
        return $pool->withToken($token)
          ->get($this->baseUrl . '/schedules', [
            'dokter_id' => $id
          ]);
      });
    });

    $result = [];

    foreach ($responses as $index => $res) {
      if ($res->successful()) {
        $data = $res->json()['data'][0] ?? null;
        if ($data) {
          $result[$doctorIds[$index]] = $data;
        }
      }
    }

    return $result;
  }

  /**
   * Shortcut methods
   */
  public function get(string $endpoint, array $query = [], int $timeout = 3): ?array
  {
    return $this->request('get', $endpoint, $query, $timeout);
  }

  public function post(string $endpoint, array $data = []): ?array
  {
    return $this->request('post', $endpoint, $data);
  }

  public function put(string $endpoint, array $data = []): ?array
  {
    return $this->request('put', $endpoint, $data);
  }

  public function delete(string $endpoint, array $data = []): ?array
  {
    return $this->request('delete', $endpoint, $data);
  }
}
