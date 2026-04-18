@extends('layouts.guest.guest')

@section('title', 'Layanan Rawat Inap')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#137fec",
                    "hospital-blue": "#003366",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101922",
                    "secondary": "#ff9500",
                },
                fontFamily: { "display": ["Inter", "sans-serif"] },
                borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
            },
        },
    }
</script>
<style>
    /* Sembunyikan scrollbar untuk semua browser modern */
    /* Chrome, Safari, Edge */
    ::-webkit-scrollbar {
        display: none;
    }
    /* Firefox */
    html {
        scrollbar-width: none;
    }
    /* Internet Explorer 10+ (opsional) */
    body {
        -ms-overflow-style: none;
    }

    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
    /* Optimasi performa: hindari repaint berlebihan */
    .group {
        will-change: transform;
        transform: translateZ(0);
        backface-visibility: hidden;
    }
    /* Optimasi gambar background agar smooth */
    [style*="background-image"] {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transform: translateZ(0);
    }
</style>

<div class="relative min-h-screen w-full overflow-x-hidden bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
    <div class="flex flex-col">
        <div class="px-4 md:px-10 lg:px-20 flex justify-center py-10">
            <div class="max-w-[1280px] w-full">
                {{-- Header dengan animasi fade-down --}}
                <div class="flex flex-wrap justify-between items-end gap-3 p-4 mb-6" data-aos="fade-down" data-aos-duration="800">
                    <div class="flex flex-col gap-3">
                        <h1 class="text-hospital-blue dark:text-primary text-3xl md:text-4xl lg:text-5xl font-black tracking-tight">Layanan Rawat Inap</h1>
                        <p class="text-slate-600 dark:text-slate-400 text-base md:text-lg max-w-2xl">Berbagai pilihan ruang perawatan yang nyaman, dari suite premium hingga unit perawatan intensif.</p>
                    </div>
                </div>

                {{-- Daftar Ruangan --}}
                @php
                    $rooms = [
                        [
                            'name' => 'VIP / VVIP',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Gedung Prof. dr. Imanoedin. Kamar eksklusif dengan privasi maksimal. Hanya 4 kamar. Terintegrasi dengan poli eksekutif.',
                            'amenities' => [
                                ['icon' => 'king_bed', 'label' => 'Bed'],
                                ['icon' => 'ac_unit', 'label' => 'AC Central'],
                                ['icon' => 'tv', 'label' => 'Smart TV'],
                                ['icon' => 'wifi', 'label' => 'WiFi'],
                                ['icon' => 'kitchen', 'label' => 'Kitchenette'],
                                ['icon' => 'chat', 'label' => 'Booking WA'],
                            ],
                            'img' => asset('images/vvip1.png'),
                        ],
                        [
                            'name' => 'Tawang Alun',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Ruang khusus Penyakit Dalam & Stroke. Tim dokter spesialis 24 jam dengan peralatan medis modern.',
                            'amenities' => [
                                ['icon' => 'monitor_heart', 'label' => 'Cardiac Monitor'],
                                ['icon' => 'airwave', 'label' => 'Oksigen'],
                                ['icon' => 'event_seat', 'label' => 'Kursi Keluarga'],
                                ['icon' => 'notifications', 'label' => 'Nurse Call'],
                            ],
                            'img' => asset('images/template.png'),
                        ],
                        [
                            'name' => 'Sekardalu',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Ruang Perinatologi untuk perawatan bayi risiko tinggi. Inkubator modern & tim perawat neonatal berpengalaman.',
                            'amenities' => [
                                ['icon' => 'baby_changing_station', 'label' => 'Inkubator'],
                                ['icon' => 'monitor_heart', 'label' => 'Neonatal Monitor'],
                                ['icon' => 'thermostat', 'label' => 'Temperature Control'],
                                ['icon' => 'medical_services', 'label' => 'Perawat Khusus'],
                                ['icon' => 'lightbulb', 'label' => 'Fototerapi'],
                            ],
                            'img' => asset('images/template.png'),
                        ],
                        [
                            'name' => 'Agung Wilis',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Ruang Bedah & Kecelakaan. Fasilitas operasi modern dengan tim bedah siap menangani kasus darurat.',
                            'amenities' => [
                                ['icon' => 'surgical', 'label' => 'Ruang Operasi'],
                                ['icon' => 'healing', 'label' => 'Perawatan Luka'],
                                ['icon' => 'group', 'label' => 'Tim Bedah'],
                                ['icon' => 'local_hospital', 'label' => 'ICU Siap'],
                            ],
                            'img' => asset('images/agungwilis.jpg'),
                        ],
                        [
                            'name' => 'Sayu Wiwit',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Ruang Persalinan & Rawat Gabung. Fasilitas persalinan nyaman, perawatan ibu dan bayi dalam satu ruangan.',
                            'amenities' => [
                                ['icon' => 'pregnancy', 'label' => 'Ruang Bersalin'],
                                ['icon' => 'baby_changing_station', 'label' => 'Perawatan Bayi'],
                                ['icon' => 'bathroom', 'label' => 'Kamar Mandi'],
                                ['icon' => 'restaurant', 'label' => 'Katering Ibu'],
                                ['icon' => 'family_restroom', 'label' => 'Ruang Keluarga'],
                            ],
                            'img' => asset('images/sayuwiwit.jpg'),
                        ],
                        [
                            'name' => 'Mas Alit',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Ruang Perawatan Anak ramah anak. Fasilitas bermain & dokter spesialis anak berpengalaman.',
                            'amenities' => [
                                ['icon' => 'child_care', 'label' => 'Area Bermain'],
                                ['icon' => 'family_restroom', 'label' => 'Ruang Keluarga'],
                                ['icon' => 'pediatrics', 'label' => 'Dokter Anak'],
                                ['icon' => 'tv', 'label' => 'Hiburan'],
                                ['icon' => 'crib', 'label' => 'Baby Crib'],
                            ],
                            'img' => asset('images/masalit.png'),
                        ],
                        [
                            'name' => 'Pulmo Center',
                            'status' => 'Tersedia',
                            'status_badge' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'description' => 'Pusat perawatan paru-paru. Fasilitas bronkoskopi, ventilator canggih & tim spesialis paru.',
                            'amenities' => [
                                ['icon' => 'air', 'label' => 'Air Purifier'],
                                ['icon' => 'monitor_heart', 'label' => 'O2 Monitoring'],
                                ['icon' => 'ventilator', 'label' => 'Ventilator'],
                                ['icon' => 'medical_services', 'label' => 'Terapi Inhalasi'],
                                ['icon' => 'pulmonology', 'label' => 'Spesialis Paru'],
                            ],
                            'img' => asset('images/pulmo.png'),
                        ],
                        [
                            'name' => 'ICU',
                            'status' => 'Unit Khusus',
                            'status_badge' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                            'description' => 'Intensive Care Unit. Perawatan intensif pasien kritis dengan pemantauan 24 jam & life support modern.',
                            'amenities' => [
                                ['icon' => 'vital_signs', 'label' => 'Monitor 24/7'],
                                ['icon' => 'ventilator', 'label' => 'Life Support'],
                                ['icon' => 'group', 'label' => 'Tim Intensif'],
                                ['icon' => 'emergency', 'label' => 'Emergency Ready'],
                                ['icon' => 'medication', 'label' => 'Infusion Pump'],
                            ],
                            'img' => asset('images/icu.png'),
                        ],
                        [
                            'name' => 'ICCU',
                            'status' => 'Unit Khusus',
                            'status_badge' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                            'description' => 'Intensive Cardiac Care Unit. Perawatan intensif jantung, EKG 24 jam & tim kardiologi.',
                            'amenities' => [
                                ['icon' => 'ecg', 'label' => 'EKG 24 Jam'],
                                ['icon' => 'monitor_heart', 'label' => 'Cardiac Monitor'],
                                ['icon' => 'bolt', 'label' => 'Defibrillator'],
                                ['icon' => 'favorite', 'label' => 'Spesialis Jantung'],
                                ['icon' => 'pacemaker', 'label' => 'Pacemaker Ready'],
                            ],
                            'img' => asset('images/iccu.png'),
                        ],
                    ];
                @endphp

                {{-- Grid Layout: 3 kolom pada desktop, 2 pada tablet, 1 pada mobile --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                    @foreach ($rooms as $index => $room)
                    <div class="group bg-white dark:bg-slate-900 rounded-xl shadow-lg border border-slate-100 dark:border-slate-800 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col h-full"
                         data-aos="fade-up" 
                         data-aos-duration="600" 
                         data-aos-delay="{{ $index * 50 }}" 
                         data-aos-offset="50">
                        {{-- Gambar dengan lazy loading menggunakan background-image (tetap smooth) --}}
                        <div class="w-full aspect-[4/3] bg-center bg-cover bg-no-repeat" style="background-image: url('{{ $room['img'] }}');"></div>
                        
                        {{-- Konten --}}
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <h2 class="text-hospital-blue dark:text-slate-100 text-xl font-bold">{{ $room['name'] }}</h2>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap {{ $room['status_badge'] }}">{{ $room['status'] }}</span>
                            </div>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-4">{{ $room['description'] }}</p>
                            <div class="flex flex-wrap gap-3 mt-auto">
                                @foreach ($room['amenities'] as $amenity)
                                <div class="flex items-center gap-1 text-hospital-blue dark:text-primary">
                                    <span class="material-symbols-outlined text-lg">{{ $amenity['icon'] }}</span>
                                    <span class="text-xs">{{ $amenity['label'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- AOS JS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inisialisasi AOS dengan konfigurasi ringan dan optimal
    AOS.init({
        once: true,          // Animasi sekali saja
        offset: 80,         // Jarak scroll sebelum animasi
        duration: 600,      // Durasi animasi
        easing: 'ease-out', // Efek easing
        mirror: false,      // Tidak animasi ulang saat scroll ke atas
        disable: false,     // Aktif di semua device
        startEvent: 'DOMContentLoaded', // Mulai setelah DOM siap
    });
</script>
@endsection