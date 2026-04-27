<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dokter_model;
use App\Models\Jam_operasional_model;
use App\Models\artikel_model;
use App\Models\User;
use App\Models\poliklinik_model;
use App\Models\Photo_model;
use App\Models\Video_model;
use App\Models\bangsal_model;
use App\Services\DokterService;
use App\Models\bangsal_kelas_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements HasMiddleware
{

protected DokterService $dokterService;

    public function __construct(DokterService $dokterService)
    {
        $this->dokterService = $dokterService;
    }

    public static function middleware()
    {
        return [
            new Middleware('permission:admin.access', only: ['index']),
        ];
    }

    /**
     * Display admin dashboard with all statistics.
     */
    public function index()
    {
        // ========================
        // DATA DARI CONTROLLER LAMA
        // ========================
        $spesialisList = dokter_model::select('spesialis')
            ->distinct()
            ->whereNotNull('spesialis')
            ->pluck('spesialis')
            ->toArray();

        $jam_operasionals = Jam_operasional_model::query()
            ->orderBy('hari')
            ->get();

        // ========================
        // DATA DARI CONTROLLER BARU
        // ========================
        // Article Statistics
        $totalArticles = artikel_model::count();
        $publishedArticles = artikel_model::where('status', 'published')->count();
        $draftArticles = artikel_model::where('status', 'draft')->count();

        // User Statistics
        $totalAdminUsers = User::count();

        // ========================
        // DOKTER - Hanya hitung jumlah dokter aktif
        // ========================
        $dokterData = $this->dokterService->getDokters(new Request());
        $totalDokter = $dokterData['dokters']->total();

        // Polyclinic Statistics
        $totalPoliklinik = poliklinik_model::count();

        // Gallery Statistics (Photos & Videos)
        $totalPhotos = Photo_model::count();
        $totalVideos = Video_model::count();

        // ========================
        // DATA BANGSAL & KELAS RUANGAN
        // ========================
        $bangsals = bangsal_model::with('bangsalKelas')->get();

        // Hitung total capacity dari semua bangsal
        $totalCapacity = $bangsals->sum(function($bangsal) {
            return $bangsal->bangsalKelas->sum('bed_kapasitas');
        });

        // Hitung total terisi dari semua bangsal
        $totalTerisi = $bangsals->sum(function($bangsal) {
            return $bangsal->bangsalKelas->sum('bed_terisi');
        });

        // Overall Occupancy (persentase)
        $overallOccupancy = $totalCapacity > 0 ? round(($totalTerisi / $totalCapacity) * 100) : 0;

        // Hitung critical wards (okupansi >= 90%) dan warning wards (70-89%)
        $criticalWards = collect();
        $warningWards = collect();

        foreach ($bangsals as $bangsal) {
            $kapasitas = $bangsal->bangsalKelas->sum('bed_kapasitas');
            $terisi = $bangsal->bangsalKelas->sum('bed_terisi');
            $persen = $kapasitas > 0 ? round(($terisi / $kapasitas) * 100) : 0;

            if ($persen >= 90) {
                $criticalWards->push($bangsal);
            } elseif ($persen >= 70) {
                $warningWards->push($bangsal);
            }
        }

        // Available ER (IGD)
        $availableER = $bangsals->filter(function($bangsal) {
            return stripos($bangsal->nama, 'IGD') !== false || 
                   stripos($bangsal->jenis, 'IGD') !== false ||
                   stripos($bangsal->nama, 'UGD') !== false;
        })->sum(function($bangsal) {
            $kapasitas = $bangsal->bangsalKelas->sum('bed_kapasitas');
            $terisi = $bangsal->bangsalKelas->sum('bed_terisi');
            return $kapasitas - $terisi;
        });

        // Jika tidak ada IGD, gunakan total available beds
        if ($availableER <= 0) {
            $availableER = $totalCapacity - $totalTerisi;
        }

        return view('admin.dashboard', compact(
            // Data dari controller lama
            'spesialisList',
            'jam_operasionals',
            // Data artikel
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            // Data user & staff
            'totalAdminUsers',
            'totalDokter',
            'totalPoliklinik',
            // Data gallery
            'totalPhotos',
            'totalVideos',
            // Data utama untuk dashboard
            'bangsals',
            'totalCapacity',
            'overallOccupancy',
            'criticalWards',
            'warningWards',
            'availableER'
        ));
    }
}