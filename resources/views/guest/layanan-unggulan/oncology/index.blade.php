@extends('layouts.guest.guest')

@section('title', 'Onkologi & Kemoterapi - RSUD Blambangan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .hero-bg { background-color: #dde8f0; }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-12 md:py-16 md:px-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 items-center">
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#0d2d5e] leading-tight">
                    Oncology &
                </h1>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#e05a1a] leading-tight mb-4">
                    Chemotherapy
                </h1>
                <p class="text-gray-600 text-base md:text-lg leading-relaxed max-w-md">
                    Kami memberikan perawatan kanker yang komprehensif, penuh kasih, dan canggih melalui kolaborasi bedah onkologi dan kemoterapi modern.
                </p>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-md">
                    <img src="{{ asset('images/onco.jpg') }}" alt="Onkologi & Kemoterapi" class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG ONKOLOGI & KEMOTERAPI --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Tentang Onkologi & Kemoterapi</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                </div>
                <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed text-center">
                    <p>
                        <span class="font-bold text-[#0d2d5e]">Onkologi</span> adalah cabang ilmu kedokteran yang mempelajari kanker mulai dari diagnosis, pengobatan, hingga perawatan lanjutan. 
                        Sedangkan <span class="font-bold text-[#0d2d5e]">Kemoterapi</span> adalah metode pengobatan kanker dengan obat-obatan khusus untuk membunuh sel kanker atau menghentikan perkembangannya.
                    </p>
                    <p>
                        Kemoterapi dapat diberikan melalui infus atau tablet, biasanya dalam beberapa siklus. Tim medis kami selalu mendampingi Anda untuk meminimalkan efek samping dan memastikan pengobatan berjalan senyaman mungkin.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN & DUKUNGAN --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="bg-[#e4ecf4] rounded-2xl px-6 py-8 md:px-8 md:py-10">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Dukungan Pasien & Keluarga</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full mb-4"></div>
                    <p class="text-gray-500 text-sm md:text-base max-w-md mx-auto">
                        Perjuangan melawan kanker tidak hanya medis. Kami menyediakan dukungan menyeluruh.
                    </p>
                </div>

                @php
                    $supportServices = [
                        ['title' => 'Counseling', 'desc' => 'Dukungan psikologis dan konseling untuk pasien dan keluarga.'],
                        ['title' => 'Dietary Plan', 'desc' => 'Rencana nutrisi khusus onkologi yang disusun oleh ahli gizi.'],
                        ['title' => 'Support Group', 'desc' => 'Komunitas pasien untuk berbagi pengalaman dan motivasi.'],
                        ['title' => 'Palliative Care', 'desc' => 'Perawatan paliatif untuk meningkatkan kualitas hidup.']
                    ];
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($supportServices as $index => $service)
                    <div class="flex gap-4 items-start bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-[#0d2d5e] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div>
                            <h4 class="font-black text-[#0d2d5e] text-base md:text-lg mb-1">{{ $service['title'] }}</h4>
                            <p class="text-gray-500 text-sm md:text-base leading-relaxed">{{ $service['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN TAMBAHAN --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Layanan Pendukung</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                </div>
                <div class="space-y-3">
                    @php
                        $additionalServices = [
                            'Konsultasi Nutrisi Khusus Onkologi',
                            'Layanan Psikologi & Dukungan Emosional',
                            'Manajemen Nyeri (Pain Management)',
                            'Rehabilitasi Medik Pasca Kemoterapi'
                        ];
                    @endphp
                    @foreach ($additionalServices as $service)
                    <div class="flex items-start gap-3">
                        <svg class="flex-shrink-0 mt-1" width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                            <path d="M8 12 L11 15 L16 9" stroke="#e05a1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-gray-700 text-base md:text-lg">{{ $service }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-[#e4ecf4] rounded-2xl p-8 text-center">
                <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4">Siap Membantu Perjalanan Kesembuhan Anda</h2>
                <p class="text-gray-600 text-base max-w-md mx-auto leading-relaxed mb-6">
                    Tim spesialis kami siap memberikan konsultasi mendalam mengenai diagnosis dan pilihan terapi yang paling tepat untuk Anda.
                </p>
            </div>
        </div>
    </section>
</div>
@endsection