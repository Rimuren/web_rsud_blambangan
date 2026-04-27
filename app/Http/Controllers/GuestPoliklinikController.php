<?php

namespace App\Http\Controllers;

use App\Models\poliklinik_model;
use Carbon\Carbon;

class GuestPoliklinikController extends Controller
{
    // Halaman daftar semua poliklinik
    public function index()
    {
        $polies = poliklinik_model::where('is_active', true)
            ->whereNotNull('slug')
            ->orderBy('nama')
            ->get()
            ->map(function ($poli) {
                return [
                    'name'         => $poli->nama,
                    'slug'         => $poli->slug,
                    'type'         => stripos($poli->nama, 'eksekutif') !== false ? 'Eksekutif' : 'Spesialis',
                    'icon'         => $this->mapIcon($poli->nama),
                    'dokter_count' => $poli->jumlah_dokter,
                ];
            });

        return view('guest.layanan-rawat-jalan.index', compact('polies'));
    }

    // Halaman detail satu poliklinik beserta jadwal dokternya
    public function show($slug)
    {
        $poli = poliklinik_model::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Ambil semua jadwal yang terkait dengan poliklinik ini
        $jadwal = $poli->jadwal_dokter()
            ->with('dokter')
            ->where('is_active', true)
            ->orderBy('hari_order')
            ->get();

        // Helper memformat jam (support "H:i" atau "Y-m-d H:i:s")
        $formatTime = function ($time) {
            if (preg_match('/^\d{2}:\d{2}(:\d{2})?$/', trim($time))) {
                return substr($time, 0, 5);
            }
            return Carbon::parse($time)->format('H:i');
        };

        // Susun ulang data dokter dengan schedules (hari + jam per baris)
        $doctors = [];
        foreach ($jadwal as $j) {
            if (!$j->dokter) continue;
            $dokterId = $j->dokter->id;

            if (!isset($doctors[$dokterId])) {
                $doctors[$dokterId] = [
                    'name'        => $j->dokter->nama,
                    'title'       => $j->dokter->subspesialis ?? '',
                    'specialist'  => $j->dokter->spesialis ?? 'Spesialis',
                    'badge_class' => 'bg-blue-50 text-blue-700 border border-blue-200',
                    'schedules'   => [],
                ];
            }

            $jamMulai   = $formatTime($j->jam_mulai);
            $jamSelesai = $formatTime($j->jam_selesai);

            $doctors[$dokterId]['schedules'][] = [
                'days'   => $j->hari,
                'hours' => $jamMulai . ' – ' . $jamSelesai . ' WIB',
            ];
        }

        // Data akhir yang dikirim ke view
        $poliDetail = [
            'name'        => $poli->nama,
            'slug'        => $poli->slug,
            'icon'        => $this->mapIcon($poli->nama),
            'description' => 'Layanan unggulan ' . $poli->nama,
            'doctors'     => array_values($doctors),
        ];

        return view('guest.layanan-rawat-jalan.detail', compact('poliDetail'));
    }

    // Pemetaan ikon
    private function mapIcon(string $name): string
    {
        $icons = [
            'anak'              => 'child_care',
            'anestesi'          => 'medical_services',
            'bedah'             => 'content_cut',
            'ortopedi'          => 'skeleton',
            'syaraf'            => 'neurology',
            'saraf'             => 'neurology',
            'onkologi'          => 'biotech',
            'gigi'              => 'dentistry',
            'gizi'              => 'restaurant',
            'jantung'           => 'cardiology',
            'jiwa'              => 'mindfulness',
            'kulit'             => 'dermatology',
            'mata'              => 'visibility',
            'obgyn'             => 'pregnant_woman',
            'paru'              => 'pulmonology',
            'penyakit dalam'    => 'stethoscope',
            'psikologi'         => 'psychology',
            'rehab'             => 'physical_therapy',
            'tht'               => 'hearing',
            'umum'              => 'medical_information',
            'urologi'           => 'water_drop',
            'vct'               => 'shield_with_heart',
            'eswl'              => 'bolt',
            'fetomaternal'      => 'baby_changing_station',
            'hemodialisa'       => 'water_drop',
            'thorax'            => 'syringe',
        ];
        $nameLower = strtolower($name);
        foreach ($icons as $key => $icon) {
            if (str_contains($nameLower, $key)) return $icon;
        }
        return 'medical_information';
    }
}