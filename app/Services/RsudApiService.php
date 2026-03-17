<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RsudApiService
{
  protected string $baseUrl;
  protected ?string $token;

  public function __construct()
  {
    $this->baseUrl = config('api.rsud.base_url');
    $this->token   = config('api.rsud.token');
  }

  /**
   * GET request ke endpoint tertentu.
   *
   * @param string $endpoint Contoh: 'doctors', 'patients'
   * @param array $queryParams Parameter query string (optional)
   * @return array|null
   */
  public function get(string $endpoint, array $queryParams = []): ?array
  {
    $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

    try {
      $http = Http::timeout(30)->retry(3, 500);

      if ($this->token) {
        $http->withToken($this->token);
      } else {
        Log::warning('API token tidak dikonfigurasi');
      }

      $response = $http->get($url, $queryParams);

      $response = Http::withToken($this->token)
        ->timeout(30)
        ->retry(3, 500) // 3 kali percobaan, jeda 500ms
        ->get($url, $queryParams);

      if ($response->successful()) {
        return $response->json();
      }

      Log::warning("API request gagal: $endpoint", [
        'status' => $response->status(),
        'body'   => $response->body()
      ]);

      return null;
    } catch (\Exception $e) {
      Log::error("Exception saat memanggil API $endpoint: " . $e->getMessage());
      return null;
    }
  }
}
