<?php

namespace App\Services;

use App\Models\dokter_model;
use App\Models\poliklinik_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\Traits\DoctorDataHelper;

class DokterFallbackService
{
  use DoctorDataHelper;

  public function fetch(Request $request): array
  {
    $now = Carbon::now('Asia/Jakarta');
    Carbon::setLocale('id');
    $hariIni = $now->translatedFormat('l');

    $query = dokter_model::with(['jadwal_dokter.poliklinik']);

    if ($request->filled('search')) {
      $search = strtolower($request->search);
      $query->where(function ($q) use ($search) {
        $q->whereRaw('LOWER(nama) like ?', ["%{$search}%"])
          ->orWhereRaw('LOWER(spesialis) like ?', ["%{$search}%"]);
      });
    }

    if ($request->filled('poliklinik') && $request->poliklinik != 'Semua Poliklinik') {
      $query->whereHas('jadwal_dokter.poliklinik', function ($q) use ($request) {
        $q->where('nama', $request->poliklinik);
      });
    }

    if ($request->filled('hari') && $request->hari != 'Semua Hari') {
      $query->whereHas('jadwal_dokter', function ($q) use ($request) {
        $q->where('hari', $request->hari);
      });
    }

    $dokters = $query->paginate(10)->withQueryString();

    Log::info('Fallback database digunakan', [
      'total' => $dokters->total(),
      'params' => $request->only(['search', 'poliklinik', 'hari'])
    ]);

    $doctorObjects = [];
    $poliklinikSet = [];

    foreach ($dokters->getCollection() as $dokter) {
      $reguler = [];
      $eksekutif = [];

      foreach ($dokter->jadwal_dokter as $jadwal) {
        $poliklinikNama = $jadwal->poliklinik->nama ?? null;
        if (!$poliklinikNama) continue;

        $poliklinikSet[] = $poliklinikNama;

        $hari = $jadwal->hari;
        $jamMulai = $jadwal->jam_mulai;
        $jamSelesai = $jadwal->jam_selesai;

        $isToday = ($hari === $hariIni);
        $isOpen = false;
        if ($isToday && $jamMulai && $jamSelesai) {
          $start = Carbon::createFromTimeString($jamMulai, 'Asia/Jakarta');
          $end = Carbon::createFromTimeString($jamSelesai, 'Asia/Jakarta');
          $isOpen = $now->between($start, $end);
        }

        $jadwalItem = [
          'hari' => $hari,
          'mulai' => $jamMulai,
          'selesai' => $jamSelesai,
          'tipe' => $jadwal->tipe_pelayanan,
          'poliklinik' => $poliklinikNama,
          'is_today' => $isToday,
          'is_open' => $isOpen,
        ];

        if (stripos($poliklinikNama, 'EKSEKUTIF') !== false) {
          $eksekutif[] = $jadwalItem;
        } else {
          $reguler[] = $jadwalItem;
        }
      }

      $hariOrder = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
      usort($reguler, fn($a, $b) => ($hariOrder[$a['hari']] ?? 0) <=> ($hariOrder[$b['hari']] ?? 0));
      usort($eksekutif, fn($a, $b) => ($hariOrder[$a['hari']] ?? 0) <=> ($hariOrder[$b['hari']] ?? 0));

      $allPolis = array_merge(
        array_column($reguler, 'poliklinik'),
        array_column($eksekutif, 'poliklinik')
      );

      $doctorData = [
        'api_id' => $dokter->api_id,
        'name' => $dokter->nama,
        'spesialis' => $dokter->spesialis,
        'image_url' => $dokter->image_url,
        'reguler' => $reguler,
        'eksekutif' => $eksekutif,
        'polikliniks' => array_values(array_unique($allPolis)),
      ];

      $doctorObjects[] = $this->toDoctorObject($doctorData, $dokter->id);
    }

    $dokters->setCollection(collect($doctorObjects));

    $allPoliklinik = poliklinik_model::pluck('nama')->toArray();
    $poliklinikList = array_unique(array_merge($poliklinikSet, $allPoliklinik));

    return [
      'dokters' => $dokters,
      'poliklinikList' => array_values($poliklinikList),
    ];
  }
}
