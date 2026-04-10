@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan - DSA')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .hero-bg { background-color: #dde8f0; }
    .blue-underline {
        display: block;
        width: 48px;
        height: 4px;
        background: #e05a1a;
        border-radius: 2px;
        margin-top: 8px;
    }
    .section-border-left {
        border-left: 4px solid #0d2d5e;
        padding-left: 14px;
    }
    .check-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #374151;
        font-size: 14px;
        line-height: 1.6;
    }
    .check-item svg { flex-shrink: 0; margin-top: 2px; }
    .section-dokter {
        background: #e4ecf4;
        border-radius: 24px;
    }
    .doctor-card {
        background: #fff;
        border: 1px solid #e5edf4;
        border-radius: 16px;
        padding: 24px 20px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .doctor-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #e05a1a;
    }
    .avatar-circle {
        width: 80px;
        height: 80px;
        background: #dde8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .section-cta {
        background: #e4ecf4;
        border-radius: 24px;
    }
    .btn-outline {
        border: 1.5px solid #0d2d5e;
        color: #0d2d5e;
        border-radius: 999px;
        padding: 10px 28px;
        font-weight: 700;
        font-size: 14px;
        background: transparent;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-outline:hover {
        background: #0d2d5e;
        color: #fff;
    }
    html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-16 md:px-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">
                    Layanan Unggulan:
                </h1>
                <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-4 md:mb-6">
                    DSA
                </h1>
                <p class="text-gray-600 text-base leading-relaxed max-w-lg">
                    Digital Subtraction Angiography (DSA) adalah teknik pemeriksaan radiologi intervensi untuk mendapatkan gambaran pembuluh darah secara detail dan akurat untuk diagnosis serta terapi penyumbatan atau kelainan pembuluh darah.
                </p>
            </div>
            <div class="flex-1">
                <div class="bg-[#e4ecf3] rounded-2xl border border-gray-200 shadow-md overflow-hidden">
                    <img src="{{ asset('images/dsa.jpg') }}" alt="DSA Icon" class="w-full h-full object-contain">
                </div>
            </div>
        </div>
    </section>

 {{-- MANFAAT LAYANAN & PROSEDUR PEMERIKSAAN --}}
<section class="px-6 py-10 md:px-20">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
            <div class="flex flex-col md:flex-row gap-8 md:gap-12">
                {{-- Manfaat Layanan --}}
                <div class="flex-1">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Manfaat Layanan</h2>
                        <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                    </div>
                    <div class="space-y-4">
                        @php
                            $benefits = [
                                'Visualisasi pembuluh darah yang sangat tajam dan presisi.',
                                'Minim sayatan (minimally invasive) sehingga pemulihan lebih cepat.',
                                'Mampu mendeteksi kelainan pembuluh darah otak (stroke), jantung, dan perifer.',
                                'Akurasi tinggi dalam penentuan tindakan medis lanjutan.'
                            ];
                        @endphp
                        @foreach ($benefits as $benefit)
                        <div class="flex items-start gap-3">
                            <svg class="flex-shrink-0 mt-1" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                                <path d="M8 12 L11 15 L16 9" stroke="#e05a1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-gray-700 text-base md:text-lg">{{ $benefit }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Prosedur Pemeriksaan --}}
                <div class="flex-1">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Prosedur Pemeriksaan</h2>
                        <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                    </div>
                    <div class="space-y-4">
                        @php
                            $procedures = [
                                'Persiapan pasien dan puasa sesuai instruksi medis.',
                                'Penyuntikan zat kontras melalui kateter tipis.',
                                'Pengambilan gambar radiologi real-time oleh dokter spesialis.',
                                'Observasi pasca-tindakan di ruang pemulihan khusus.'
                            ];
                        @endphp
                        @foreach ($procedures as $procedure)
                        <div class="flex items-start gap-3">
                            <svg class="flex-shrink-0 mt-1" width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                                <path d="M8 12 L11 15 L16 9" stroke="#e05a1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-gray-700 text-base md:text-lg">{{ $procedure }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    {{-- TIM DOKTER SPESIALIS --}}
    <section class="px-6 py-12 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="section-dokter px-6 py-10 md:px-10 md:py-12">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Tim Dokter Spesialis</h2>
                    <p class="text-gray-500 text-sm max-w-md mx-auto">
                        Tim ahli kami yang berdedikasi untuk prosedur DSA.
                    </p>
                </div>

                @php
                    $doctors = [
                        [
                            'name' => 'dr. Adrian Perkasa,<br/>Sp.Rad(K)',
                            'title' => 'Spesialis Radiologi Intervensi',
                            'consultant' => 'Konsultan Senior Serebrovaskular'
                        ],
                        [
                            'name' => 'dr. Sarah Wijaya, Sp.N(K)',
                            'title' => 'Spesialis Neurologi',
                            'consultant' => 'Konsultan Neurointervensi'
                        ],
                        [
                            'name' => 'dr. Budi Hartono, Sp.JP(K)',
                            'title' => 'Spesialis Jantung & Pembuluh Darah',
                            'consultant' => 'Konsultan Kardiologi Intervensi'
                        ]
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($doctors as $doctor)
                    <div class="doctor-card">
                        <div class="avatar-circle">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                                <circle cx="18" cy="13" r="7" stroke="#8aa5be" stroke-width="2" fill="none"/>
                                <path d="M4 34 C4 26 10 22 18 22 C26 22 32 26 32 34" stroke="#8aa5be" stroke-width="2" stroke-linecap="round" fill="none"/>
                            </svg>
                        </div>
                        <h3 class="font-black text-[#0d2d5e] text-base mb-1">{!! $doctor['name'] !!}</h3>
                        <p class="text-[#1a56db] font-bold text-sm mb-2">{{ $doctor['title'] }}</p>
                        <p class="text-gray-500 text-sm">{{ $doctor['consultant'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="px-6 pb-20 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="section-cta px-6 py-12 md:px-10 md:py-14 text-center">
                <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4 leading-snug max-w-lg mx-auto">
                    Percayakan Kesehatan Anda pada Ahlinya
                </h2>
                <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Dapatkan konsultasi dengan tim spesialis kami untuk evaluasi mendalam mengenai kondisi pembuluh darah Anda.
                </p>
                <button class="btn-outline">Inquiry & FAQ</button>
            </div>
        </div>
    </section>
</div>
@endsection