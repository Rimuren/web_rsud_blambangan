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

    /* ===== ANIMATION STYLES ===== */
    .fade-up, .fade-left, .fade-right, .fade-in {
        opacity: 0;
        transition: opacity 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        will-change: opacity, transform;
    }
    .fade-up {
        transform: translateY(30px);
    }
    .fade-left {
        transform: translateX(-30px);
    }
    .fade-right {
        transform: translateX(30px);
    }
    .fade-in {
        transform: scale(0.98);
    }
    /* Visible state */
    .fade-up.visible, .fade-left.visible, .fade-right.visible, .fade-in.visible {
        opacity: 1;
        transform: translateX(0) translateY(0) scale(1);
    }

    /* Staggered delay for doctor cards */
    .stagger-card:nth-child(1) { transition-delay: 0.05s; }
    .stagger-card:nth-child(2) { transition-delay: 0.1s; }
    .stagger-card:nth-child(3) { transition-delay: 0.15s; }
    /* Stagger for benefit items */
    .stagger-benefit:nth-child(1) { transition-delay: 0.05s; }
    .stagger-benefit:nth-child(2) { transition-delay: 0.1s; }
    .stagger-benefit:nth-child(3) { transition-delay: 0.15s; }
    .stagger-benefit:nth-child(4) { transition-delay: 0.2s; }
    /* Stagger for procedure items */
    .stagger-procedure:nth-child(1) { transition-delay: 0.05s; }
    .stagger-procedure:nth-child(2) { transition-delay: 0.1s; }
    .stagger-procedure:nth-child(3) { transition-delay: 0.15s; }
    .stagger-procedure:nth-child(4) { transition-delay: 0.2s; }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-16 md:px-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
            <div class="flex-1 fade-left">
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
            <div class="flex-1 fade-right">
                <div class="bg-[#e4ecf3] rounded-2xl border border-gray-200 shadow-md overflow-hidden">
                    <img src="{{ asset('images/dsa.jpg') }}" alt="DSA Icon" class="w-full h-full object-contain">
                </div>
            </div>
        </div>
    </section>

    {{-- MANFAAT LAYANAN & PROSEDUR PEMERIKSAAN --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-5xl mx-auto fade-up">
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
                            @foreach ($benefits as $index => $benefit)
                            <div class="flex items-start gap-3 fade-up stagger-benefit">
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
                            @foreach ($procedures as $index => $procedure)
                            <div class="flex items-start gap-3 fade-up stagger-procedure">
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
                    @foreach ($doctors as $index => $doctor)
                    <div class="doctor-card fade-up stagger-card">
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
            <div class="section-cta px-6 py-12 md:px-10 md:py-14 text-center fade-up">
                <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4 leading-snug max-w-lg mx-auto">
                    Percayakan Kesehatan Anda pada Ahlinya
                </h2>
                <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Dapatkan konsultasi dengan tim spesialis kami untuk evaluasi mendalam mengenai kondisi pembuluh darah Anda.
                </p>
                <button class="btn-outline fade-in">Inquiry & FAQ</button>
            </div>
        </div>
    </section>
</div>

<script>
    (function() {
        // All animated elements
        const animatedElements = document.querySelectorAll('.fade-up, .fade-left, .fade-right, .fade-in');
        
        // Intersection Observer for better performance
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -20px 0px" });
        
        animatedElements.forEach(el => {
            observer.observe(el);
        });
        
        // Also trigger on load for elements already visible
        const checkVisibleOnLoad = () => {
            animatedElements.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50 && !el.classList.contains('visible')) {
                    el.classList.add('visible');
                }
            });
        };
        window.addEventListener('load', checkVisibleOnLoad);
        window.addEventListener('scroll', () => {
            animatedElements.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50 && !el.classList.contains('visible')) {
                    el.classList.add('visible');
                }
            });
        });
        
        // Additional hover effect for doctor cards (already in CSS, but add micro-interaction)
        const cards = document.querySelectorAll('.doctor-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-6px)';
                card.style.transition = 'transform 0.25s ease, box-shadow 0.25s ease';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
            });
        });
    })();
</script>
@endsection