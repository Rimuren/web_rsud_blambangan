<?php

namespace App\Services;

use App\Models\dokter_model;
use App\Models\poliklinik_model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DokterFallbackService
{
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
        $q->where('nama', $request->poliklinik); // exact match
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

  // ----------------------------------------------------------------------
  // Helper methods (sama dengan di DokterApiService)
  // ----------------------------------------------------------------------
  private function formatJadwalArray(array $jadwalItems): array
  {
    $result = [];
    foreach ($jadwalItems as $j) {
      $item = new \stdClass();
      $item->hari = $j['hari'];
      $item->jam_mulai = $j['mulai'];
      $item->jam_selesai = $j['selesai'];
      $item->tipe = $j['tipe'];
      $item->poliklinik_nama = $j['poliklinik'];
      $item->is_today = $j['is_today'];
      $item->is_open = $j['is_open'];
      $result[] = $item;
    }
    return $result;
  }

  private function toDoctorObject(array $doctorData, int $index): object
  {
    $obj = new \stdClass();
    $obj->id = $doctorData['api_id'] ?? ('api_' . time() . '_' . $index);
    $obj->nama = !empty($doctorData['name']) ? $doctorData['name'] : 'Dokter';
    $obj->kode = '';

    $poliklinikString = implode(', ', $doctorData['polikliniks']);
    $obj->poliklinik = !empty($poliklinikString) ? $poliklinikString : 'Tidak tersedia';
    $obj->spesialis = $doctorData['spesialis'] ?? null;
    $obj->image_url = $doctorData['image_url'] ?? null;

    $obj->poliklinik_badges = $doctorData['polikliniks'];
    $obj->reguler = $this->formatJadwalArray($doctorData['reguler']);
    $obj->eksekutif = $this->formatJadwalArray($doctorData['eksekutif']);
    $obj->has_jadwal = (count($doctorData['reguler']) + count($doctorData['eksekutif'])) > 0;

    $jadwalCollection = collect();
    foreach ($doctorData['reguler'] as $j) {
      $jadwal = new \stdClass();
      $jadwal->hari = $j['hari'];
      $jadwal->jam_mulai = $j['mulai'];
      $jadwal->jam_selesai = $j['selesai'];
      $jadwal->tipe_pelayanan = $j['tipe'];
      $jadwal->poliklinik_nama = $j['poliklinik'];
      $jadwal->ruangan_nama = null;
      $jadwalCollection->push($jadwal);
    }
    foreach ($doctorData['eksekutif'] as $j) {
      $jadwal = new \stdClass();
      $jadwal->hari = $j['hari'];
      $jadwal->jam_mulai = $j['mulai'];
      $jadwal->jam_selesai = $j['selesai'];
      $jadwal->tipe_pelayanan = $j['tipe'];
      $jadwal->poliklinik_nama = $j['poliklinik'];
      $jadwal->ruangan_nama = null;
      $jadwalCollection->push($jadwal);
    }
    $obj->jadwal_dokter = $jadwalCollection;

    $uniqueHari = $jadwalCollection->pluck('hari')->unique()->sortBy(function ($h) {
      $order = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
      return $order[$h] ?? 0;
    });
    $obj->hari_list = $uniqueHari->implode(', ') ?: 'Tidak tersedia';

    $colors = ['blue', 'emerald', 'orange', 'purple', 'pink', 'indigo'];
    $obj->badge_color = $colors[abs(crc32($obj->id)) % count($colors)];
    $obj->specialty_display = !empty($obj->spesialis) ? $obj->spesialis : $obj->poliklinik;

    return $obj;
  }
}
