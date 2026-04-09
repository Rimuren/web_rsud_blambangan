@extends('layouts.guest.guest')

@section('title', 'Onkologi & Kemoterapi - RSUD Blambangan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; background: #fff; }
    .hero-bg { background-color: #dde8f0; }
    .feature-card {
        background: #f3f7fb;
        border-radius: 18px;
        padding: 28px 20px;
        transition: all 0.2s ease;
    }
    .feature-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1); }
    .icon-wrap {
        width: 48px; height: 48px;
        background: #e4edf5;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 18px;
    }
    .support-bg { background: #e8f0fb; border-radius: 24px; }
    .support-card {
        background: #fff;
        border-radius: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 18px 12px;
        gap: 8px;
        transition: all 0.2s;
    }
    .support-card:hover { transform: translateY(-3px); box-shadow: 0 5px 12px rgba(0,0,0,0.05); }
    .cta-bg { background-color: #dde8f0; }
    .check-item { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #4b6080; }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-12 md:py-16 md:px-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">Oncology &</h1>
                <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-6">Chemotherapy</h1>
                <p class="text-gray-600 text-sm leading-relaxed max-w-sm mb-8">
                    Kami memberikan perawatan kanker yang komprehensif, penuh kasih, dan canggih melalui kolaborasi bedah onkologi dan kemoterapi modern.
                </p>
                <button class="border border-[#0d2d5e] text-[#0d2d5e] text-sm font-bold px-6 py-3 rounded-lg bg-white hover:bg-[#0d2d5e] hover:text-white transition-all">
                    Jadwal Dokter
                </button>
            </div>
            <div class="flex-shrink-1">
                <img src="{{ asset('images/onco.jpg') }}" alt="Onkologi & Kemoterapi" class="w-full h-full max-w-sm rounded-lg shadow-md">
            </div>
        </div>
    </section>

    {{-- PENJELASAN --}}
<section class="px-6 py-8 md:px-20 bg-white">
    <div class="max-w-4xl mx-auto text-center bg-blue-50 rounded-2xl p-6 md:p-8 border border-blue-100">
        <h2 class="text-xl md:text-2xl font-black text-[#0d2d5e] mb-3">Apa Itu Onkologi dan Kemoterapi?</h2>
        <p class="text-gray-700 text-sm md:text-base leading-relaxed">
            <span class="font-bold text-[#0d2d5e]">Onkologi</span> adalah cabang ilmu kedokteran yang mempelajari kanker mulai dari diagnosis, pengobatan, hingga perawatan lanjutan. 
            Sedangkan <span class="font-bold text-[#0d2d5e]">Kemoterapi</span> adalah salah satu metode pengobatan kanker dengan menggunakan obat-obatan khusus untuk membunuh sel kanker atau menghentikan perkembangannya. 
            Kemoterapi bisa diberikan melalui infus atau tablet, dan biasanya dilakukan dalam beberapa siklus. Meskipun memiliki efek samping, tim medis kami akan selalu mendampingi Anda agar pengobatan berjalan senyaman mungkin.
        </p>
    </div>
</section>

{{-- DUKUNGAN PASIEN & KELUARGA --}}
@php
    $supportItems = [
        ['icon' => 'psychology', 'label' => 'Counseling'],
        ['icon' => 'restaurant_menu', 'label' => 'Dietary Plan'],
        ['icon' => 'group', 'label' => 'Support Group'],
        ['icon' => 'healing', 'label' => 'Palliative Care']
    ];
    $supportChecks = [
        'Konsultasi Nutrisi Khusus Onkologi',
        'Layanan Psikologi & Dukungan Emosional',
        'Manajemen Nyeri (Pain Management)'
    ];
@endphp

<section class="px-6 py-12 md:px-20 bg-white">
    <div class="max-w-6xl mx-auto bg-[#eef4fb] rounded-3xl px-6 py-10 md:px-12 md:py-14">
        <div class="flex flex-col md:flex-row items-center gap-12">
            
            {{-- LEFT CONTENT --}}
            <div class="flex-1">
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#0d2d5e] leading-tight mb-4">
                    Dukungan Pasien & Keluarga
                </h2>

                <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-6 max-w-md">
                    Kami memahami bahwa perjuangan melawan kanker tidak hanya secara medis. 
                    Kami menyediakan dukungan menyeluruh mulai dari psikologis hingga nutrisi.
                </p>

                <div class="space-y-3">
                    @foreach ($supportChecks as $check)
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#0d2d5e] text-lg mt-[2px]">check_circle</span>
                        <span class="text-sm text-gray-700 leading-relaxed">{{ $check }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT CARDS --}}
            <div class="flex-shrink-1 w-full md:w-auto">
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($supportItems as $item)
                    <div class="bg-white rounded-2xl p-5 flex flex-col items-center justify-center text-center shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 flex items-center justify-center bg-[#e4edf5] rounded-xl mb-3">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-2xl">
                                {{ $item['icon'] }}
                            </span>
                        </div>
                        <span class="text-sm font-semibold text-[#0d2d5e]">
                            {{ $item['label'] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

    {{-- CTA SECTION --}}
    <section class="cta-bg px-6 py-16 md:px-20 mt-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4">
                Siap membantu perjalanan kesembuhan Anda
            </h2>
            <p class="text-gray-500 text-sm max-w-md mx-auto leading-relaxed">
                Tim spesialis kami siap memberikan konsultasi mendalam mengenai diagnosis dan pilihan terapi yang paling tepat untuk Anda.
            </p>
        </div>
    </section>
</div>
@endsection