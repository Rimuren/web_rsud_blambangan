<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    // Data master semua poliklinik
    private function getPolies()
    {
        return [
            [
                'name' => 'ANASTHESI',
                'icon' => 'medical_services',
                'type' => 'Spesialis',
                'slug' => 'anasthesi',
                'description' => 'Dokter anestesi adalah dokter spesialis yang bertanggung jawab dalam proses pembiusan sebelum pasien menjalani operasi atau prosedur medis lainnya.',
                'doctors' => [
                    ['name' => 'dr. Ahmad Fauzi, Sp.An', 'title' => 'KIC', 'specialist' => 'Anestesiologi & Terapi Intensif', 'days' => 'Senin, Rabu, Jumat', 'hours' => '08.00 – 13.00 WIB'],
                    ['name' => 'dr. Siti Rahayu, Sp.An', 'title' => 'M.Kes', 'specialist' => 'Anestesiologi & Manajemen Nyeri', 'days' => 'Selasa, Kamis', 'hours' => '09.00 – 14.00 WIB'],
                ]
            ],
            [
                'name' => 'ANAK',
                'icon' => 'child_care',
                'type' => 'Spesialis',
                'slug' => 'anak',
                'description' => 'Poliklinik Anak melayani kesehatan bayi, balita, anak, dan remaja dengan pendekatan ramah anak.',
                'doctors' => [
                    ['name' => 'dr. Rina Wijaya, Sp.A', 'title' => '', 'specialist' => 'Pediatri', 'days' => 'Senin – Jumat', 'hours' => '08.00 – 12.00 WIB'],
                ]
            ],
            [
                'name' => 'UMUM',
                'icon' => 'medical_information',
                'type' => 'Umum',
                'slug' => 'umum',
                'description' => 'Poliklinik Umum melayani konsultasi kesehatan dasar, pemeriksaan fisik, dan penanganan awal penyakit.',
                'doctors' => []
            ],
    
        ];
    }

    // Halaman index
    public function index()
    {
        $polies = $this->getPolies();
        return view('guest.layanan-rawat-jalan.index', compact('polies'));
    }

    // Halaman detail
    public function show($slug)
    {
        $polies = $this->getPolies();
        $poli = collect($polies)->firstWhere('slug', $slug);

        if (!$poli) {
            abort(404);
        }

        return view('guest.layanan-rawat-jalan.detail', compact('poli'));
    }
}