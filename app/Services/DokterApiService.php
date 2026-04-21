<?php

namespace App\Services;

use App\Models\dokter_model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DokterApiService
{
  protected RsudApiService $apiService;

  public function __construct(RsudApiService $apiService)
  {
    $this->apiService = $apiService;
  }

  public function fetch(Request $request): ?array
  {
    $response = $this->apiService->get('doctors', [], 3);
    if (!$response || !isset($response['data'])) {
      return null;
    }

    $now = Carbon::now('Asia/Jakarta');
    Carbon::setLocale('id');
    $hariIni = $now->translatedFormat('l');

    $doctors = [];
    $poliklinikSet = [];

    foreach ($response['data'] as $item) {
      $dokterData = $item['dokter'] ?? [];
      $jadwalList = $item['jadwal_dokter'] ?? [];
      $apiId = $dokterData['id'] ?? null;
      $namaDokter = $dokterData['nama'] ?? '';

      $dokterDb = null;
      if ($apiId) {
        $dokterDb = dokter_model::where('api_id', $apiId)->first();
      }
      if (!$dokterDb && !empty($namaDokter)) {
        $dokterDb = dokter_model::where('nama', $namaDokter)->first();
      }

      $spesialis = $dokterDb->spesialis ?? null;
      $imageUrl = $dokterDb->image_url ?? null;

      $reguler = [];
      $eksekutif = [];

      foreach ($jadwalList as $jadwal) {
        $hari = $jadwal['hari'] ?? '';
        $jamMulai = $jadwal['jam_praktek_mulai'] ?? '';
        $jamSelesai = $jadwal['jam_praktek_selesai'] ?? '';
        $tipe = $jadwal['tipe_pelayanan'] ?? 'onsite';
        $poliklinikNama = $jadwal['poliklinik_nama'] ?? '';

        if (!$hari || !$jamMulai || !$jamSelesai) continue;
        if (!empty($poliklinikNama)) $poliklinikSet[] = $poliklinikNama;

        $isToday = ($hari === $hariIni);
        $isOpen = false;
        if ($isToday) {
          $start = Carbon::createFromTimeString($jamMulai, 'Asia/Jakarta');
          $end = Carbon::createFromTimeString($jamSelesai, 'Asia/Jakarta');
          $isOpen = $now->between($start, $end);
        }

        $jadwalItem = [
          'hari'      => $hari,
          'mulai'     => $jamMulai,
          'selesai'   => $jamSelesai,
          'tipe'      => $tipe,
          'poliklinik' => $poliklinikNama,
          'is_today'  => $isToday,
          'is_open'   => $isOpen,
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

      $allPolis = [];
      foreach ($reguler as $j) $allPolis[] = $j['poliklinik'];
      foreach ($eksekutif as $j) $allPolis[] = $j['poliklinik'];
      $uniquePolis = array_values(array_unique($allPolis));

      $doctors[] = [
        'api_id'     => $apiId,
        'name'       => $namaDokter,
        'spesialis'  => $spesialis,
        'image_url'  => $imageUrl,
        'reguler'    => $reguler,
        'eksekutif'  => $eksekutif,
        'polikliniks' => $uniquePolis,
      ];
    }

    $doctors = $this->applyFilters($doctors, $request);
    $poliklinikList = array_values(array_unique($poliklinikSet));

    $doctorObjects = collect($doctors)->map(fn($d, $idx) => $this->toDoctorObject($d, $idx));
    $paginated = $this->paginate($doctorObjects->toArray(), $request);

    return ['dokters' => $paginated, 'poliklinikList' => $poliklinikList];
  }

  // ----------------------------------------------------------------------
  // Helper methods
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

  private function applyFilters(array $doctors, Request $request): array
  {
    $poliklinik = $request->input('poliklinik');
    if (!empty($poliklinik) && $poliklinik != 'Semua Poliklinik') {
      $doctors = array_filter($doctors, function ($d) use ($poliklinik) {
        foreach ($d['polikliniks'] as $p) {
          if (stripos($p, $poliklinik) !== false) return true;
        }
        return false;
      });
      $doctors = array_values($doctors);
    }

    $hari = $request->input('hari');
    if (!empty($hari) && $hari != 'Semua Hari') {
      $doctors = array_filter($doctors, function ($d) use ($hari) {
        foreach ($d['reguler'] as $j) if ($j['hari'] === $hari) return true;
        foreach ($d['eksekutif'] as $j) if ($j['hari'] === $hari) return true;
        return false;
      });
      $doctors = array_values($doctors);
    }

    if ($request->filled('search')) {
      $search = strtolower($request->search);
      $doctors = array_filter($doctors, fn($d) => stripos($d['name'], $search) !== false);
      $doctors = array_values($doctors);
    }

    return $doctors;
  }

  private function paginate(array $items, Request $request, ?int $total = null): LengthAwarePaginator
  {
    $perPage = 10;
    $currentPage = $request->input('page', 1);
    $collection = collect($items);
    $totalItems = $total ?? $collection->count();
    $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
    return new LengthAwarePaginator(
      $currentItems,
      $totalItems,
      $perPage,
      $currentPage,
      ['path' => $request->url(), 'query' => $request->query()]
    );
  }
}
