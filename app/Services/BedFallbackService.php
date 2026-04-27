<?php

namespace App\Services;

use App\Models\bangsal_model;

class BedFallbackService
{
  public function fetch(): array
  {
    $bangsalList = bangsal_model::with('kelas')->get();

    return $bangsalList->map(function ($b) {
      return [
        'id' => $b->id,
        'nama' => $b->nama,
        'deskripsi' => $b->deskripsi,
        'foto' => $b->foto,
        'total_kapasitas' => $b->kelas->sum('kapasitas'),
        'kelas' => $b->kelas->map(function ($k) {
          return [
            'kelas_id' => $k->id,
            'nama' => $k->nama,
            'kapasitas' => $k->pivot->bed_kapasitas,
            'terisi' => $k->pivot->bed_terisi,
            'kosong' => $k->pivot->bed_kosong,
          ];
        })
      ];
    })->toArray();
  }
}