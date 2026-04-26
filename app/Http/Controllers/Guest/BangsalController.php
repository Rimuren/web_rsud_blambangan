<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\BedService;

class BangsalController extends Controller
{
    protected BedService $bedService;

    public function __construct(BedService $bedService)
    {
        $this->bedService = $bedService;
    }

    public function index()
    {
        // Ambil data bangsal + kelas dari service (API live + fallback)
        $bangsalData = $this->bedService->getBeds();

        $rooms = [];
        $totalKapasitas = 0;
        $totalTerisi = 0;
        $totalKosong = 0;

        foreach ($bangsalData as $bangsal) {
            foreach ($bangsal['kelas'] as $kelas) {
                $nama = $bangsal['nama'] . ' - ' . $kelas['nama'];
                $kapasitas = $kelas['kapasitas'];
                $terisi = $kelas['terisi'];
                $kosong = $kelas['kosong'];

                $totalKapasitas += $kapasitas;
                $totalTerisi += $terisi;
                $totalKosong += $kosong;

                $classType = $kelas['nama']; // e.g. "VIP", "Kelas 1", "Intensif", etc.
                $status = $kosong > 0 ? ($kosong <= $kapasitas * 0.1 ? 'Terbatas' : 'Tersedia') : 'Penuh';

                // Badge warna status
                $statusBadge = match ($status) {
                    'Tersedia' => 'bg-emerald-100 text-emerald-800',
                    'Terbatas' => 'bg-amber-100 text-amber-800',
                    'Penuh' => 'bg-slate-100 text-slate-800',
                    default => 'bg-slate-100 text-slate-800',
                };

                // Badge warna kelas
                $classBadge = match ($classType) {
                    'VIP', 'VVIP' => 'bg-purple-100 text-purple-700',
                    'Kelas 1' => 'bg-blue-100 text-blue-700',
                    'Kelas 2' => 'bg-teal-100 text-teal-700',
                    'Kelas 3' => 'bg-slate-200 text-slate-700',
                    'Intensif' => 'bg-red-100 text-red-700',
                    'Isolasi' => 'bg-orange-100 text-orange-700',
                    default => 'bg-gray-100 text-gray-700',
                };

                // Icon
                $icon = match ($classType) {
                    'VIP', 'VVIP' => 'king_bed',
                    'Kelas 1' => 'bedroom_parent',
                    'Kelas 2' => 'bed',
                    'Kelas 3' => 'hotel',
                    'Intensif' => 'emergency',
                    'Isolasi' => 'masks',
                    default => 'bed',
                };
                $iconBg = match ($classType) {
                    'VIP', 'VVIP' => 'bg-primary/10',
                    'Kelas 1' => 'bg-medical-blue/10',
                    'Kelas 2' => 'bg-teal-100',
                    'Kelas 3' => 'bg-slate-100',
                    'Intensif' => 'bg-red-100',
                    'Isolasi' => 'bg-orange-100',
                    default => 'bg-gray-100',
                };
                $iconColor = match ($classType) {
                    'VIP', 'VVIP' => 'text-primary',
                    'Kelas 1' => 'text-medical-blue',
                    'Kelas 2' => 'text-teal-600',
                    'Kelas 3' => 'text-slate-500',
                    'Intensif' => 'text-red-600',
                    'Isolasi' => 'text-orange-600',
                    default => 'text-gray-600',
                };

                $rooms[] = [
                    'name' => $nama,
                    'class' => $classType,
                    'filter_class' => $classType,
                    'class_badge' => $classBadge,
                    'total' => $kapasitas,
                    'available' => $kosong,
                    'status' => $status,
                    'status_badge' => $statusBadge,
                    'icon' => $icon,
                    'icon_bg' => $iconBg,
                    'icon_color' => $iconColor,
                ];
            }
        }

        // Urutkan berdasarkan urutan kelas
        $classOrder = ['VIP', 'VVIP', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Intensif', 'Isolasi'];
        usort($rooms, function ($a, $b) use ($classOrder) {
            $posA = array_search($a['class'], $classOrder);
            $posB = array_search($b['class'], $classOrder);
            return ($posA === false ? 999 : $posA) <=> ($posB === false ? 999 : $posB);
        });

        // Hitung total intensif (opsional untuk kartu terpisah)
        $intensifKapasitas = collect($rooms)->where('class', 'Intensif')->sum('total');
        $intensifTerisi = collect($rooms)->where('class', 'Intensif')->sum('total') - collect($rooms)->where('class', 'Intensif')->sum('available');

        $occupancy = $totalKapasitas > 0 ? round(($totalTerisi / $totalKapasitas) * 100) : 0;

        return view('guest.info-kamar.index', compact(
            'rooms',
            'totalKapasitas',
            'totalTerisi',
            'totalKosong',
            'occupancy',
            'intensifKapasitas',
            'intensifTerisi'
        ));
    }
}
