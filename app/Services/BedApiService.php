<?php

namespace App\Services;

use App\Models\bangsal_model;
use App\Models\kelas_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BedApiService
{
  protected RsudApiService $api;

  public function __construct(RsudApiService $api)
  {
    $this->api = $api;
  }

  public function fetch(): ?array
  {
    $response = $this->api->get('ketersediaan-tempat-tidur');

    if (!$response || !isset($response['data'])) {
      return null;
    }

    $result = [];

    foreach ($response['data'] as $item) {
      $bangsal = [
        'api_id' => $item['bangsal_id'],
        'nama' => $item['nama'],
        'deskripsi' => $item['deskripsi'],
        'foto' => $item['foto'],
        'total_kapasitas' => $item['total_kapasitas_bed'],
        'kelas' => []
      ];

      foreach ($item['data'] as $kelas) {
        $bangsal['kelas'][] = [
          'kelas_id' => $kelas['kelas_id'],
          'nama' => $kelas['kelas'],
          'kapasitas' => $kelas['bed_kapasitas'],
          'terisi' => $kelas['bed_terisi'],
          'kosong' => $kelas['bed_kosong'],
        ];
      }

      $result[] = $bangsal;
    }
    $this->syncToDatabase($result);

    return $result;
  }

  protected function syncToDatabase(array $data)
  {
    DB::transaction(function () use ($data) {

      foreach ($data as $b) {

        $bangsal = bangsal_model::updateOrCreate(
          ['id' => $b['api_id']],
          [
            'nama' => $b['nama'],
            'deskripsi' => $b['deskripsi'],
            'foto' => $b['foto']
          ]
        );

        $syncData = [];

        foreach ($b['kelas'] as $k) {

          $kelas = kelas_model::updateOrCreate(
            ['api_id' => $k['kelas_id']],
            ['nama' => $k['nama']]
          );

          $syncData[$kelas->id] = [
            'bed_kapasitas' => $k['kapasitas'],
            'bed_terisi' => $k['terisi'],
            'bed_kosong' => $k['kosong'],
          ];
        }

        $bangsal->kelas()->sync($syncData);
      }
    });
  }
}