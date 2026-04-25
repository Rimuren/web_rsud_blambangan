<?php

namespace App\Services\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait DoctorDataHelper
{
  protected function formatJadwalArray(array $jadwalItems): array
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

  protected function toDoctorObject(array $doctorData, int $index): object
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

  protected function applyFilters(array $doctors, Request $request): array
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

  protected function paginate(array $items, Request $request, ?int $total = null): LengthAwarePaginator
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
