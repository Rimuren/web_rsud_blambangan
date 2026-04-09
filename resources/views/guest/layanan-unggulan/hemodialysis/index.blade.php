@extends('layouts.guest.guest')

@section('title', 'Hemodialysis Center')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; background: #fff; }
    .hero-bg { background-color: #dde8f0; }
    .underline-orange {
        display: block;
        width: 52px;
        height: 4px;
        background: #e05a1a;
        border-radius: 2px;
        margin: 8px auto 0;
    }
    .facility-card {
        background: #fff;
        border: 1px solid #e5edf4;
        border-radius: 14px;
        padding: 28px 18px 22px;
        text-align: center;
        transition: all 0.2s ease;
    }
    .facility-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.1);
        border-color: #e05a1a;
    }
    .icon-circle {
        width: 52px;
        height: 52px;
        background: #eaf1f7;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }
    .protocol-icon {
        width: 40px;
        height: 40px;
        background: #0d2d5e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .alert-bar {
        background: #f0f5fa;
        border-radius: 12px;
        border: 1px solid #dce8f0;
    }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-12 md:py-16 md:px-16">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">Hemodialysis</h1>
                <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-5">Center</h1>
                <p class="text-gray-600 text-sm leading-relaxed max-w-sm mb-8">
                    Di pusat hemodialisis kami, Anda mendapat perawatan ginjal pakai teknologi high-flux. Kami fokus pada kenyamanan dan keamanan Anda selama terapi, tanpa mengorbankan kualitas medis.
                </p>
                <div class="flex gap-3 flex-wrap">
                    <button class="bg-[#0d2d5e] text-white text-sm font-bold px-6 py-3 rounded-lg hover:bg-[#0a2248] transition">Hubungi Kami</button>
                    <button class="border border-[#0d2d5e] text-[#0d2d5e] text-sm font-bold px-6 py-3 rounded-lg bg-white hover:bg-[#f0f5fa] transition">Jadwal Dokter</button>
                </div>
            </div>
            <div class="flex-1 flex justify-end">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden w-120 h-160">
                    <img src="{{ asset('images/hemodialysis.jpg') }}" alt="Hemodialysis Center" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- PENJELASAN HEMODIALISIS --}}
    <section class="px-6 py-8 md:px-16 bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block bg-blue-50 text-[#0d2d5e] text-xs font-bold px-3 py-1 rounded-full mb-3">Apa Itu Hemodialisis?</div>
            <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                Hemodialisis adalah prosedur medis untuk menyaring limbah dan kelebihan cairan dari darah <br class="hidden md:block">
                ketika ginjal sudah tidak dapat melakukannya sendiri. Pusat kami menyediakan layanan dialisis <br class="hidden md:block">
                berkualitas tinggi dengan teknologi canggih dan tim profesional yang siap membantu Anda.
            </p>
        </div>
    </section>

    {{-- FASILITAS HEMODIALISIS --}}
    @php
        $facilities = [
            [
                'title' => 'Reclining Chairs',
                'desc' => 'Kursi medis ergonomis yang dapat disesuaikan untuk kenyamanan maksimal selama prosedur.',
                'svg' => '<rect x="3" y="8" width="14" height="10" rx="3" stroke="#0d2d5e" stroke-width="1.8" fill="none"/><path d="M17 12 L22 10 L22 18 L17 16" stroke="#0d2d5e" stroke-width="1.6" fill="none" stroke-linejoin="round"/><line x1="7" y1="18" x2="6" y2="23" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round"/><line x1="13" y1="18" x2="14" y2="23" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round"/>'
            ],
            [
                'title' => 'Entertainment',
                'desc' => 'Dilengkapi dengan TV layar datar dan koneksi Wi-Fi di setiap unit.',
                'svg' => '<rect x="3" y="5" width="20" height="14" rx="2.5" stroke="#0d2d5e" stroke-width="1.8" fill="none"/><line x1="9" y1="21" x2="17" y2="21" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/><line x1="13" y1="19" x2="13" y2="21" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>'
            ],
            [
                'title' => 'Healthy Snacks',
                'desc' => 'Penyajian makanan ringan dan minuman sehat yang disesuaikan dengan diet pasien.',
                'svg' => '<path d="M8 6 C8 6 6 10 8 13 C10 16 8 20 8 20" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round" fill="none"/><path d="M13 4 L13 10 C13 12.2 14.8 14 17 14 C19.2 14 21 12.2 21 10 L21 4" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round" fill="none"/><line x1="13" y1="14" x2="13" y2="22" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><line x1="9" y1="22" x2="19" y2="22" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><line x1="17" y1="4" x2="17" y2="10" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round" stroke-dasharray="0"/>'
            ],
            [
                'title' => 'Full AC Room',
                'desc' => 'Ruangan dengan kontrol suhu optimal dan sistem filtrasi udara HEPA filter.',
                'svg' => '<line x1="13" y1="3" x2="13" y2="23" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><line x1="3" y1="13" x2="23" y2="13" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><line x1="5.5" y1="5.5" x2="20.5" y2="20.5" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><line x1="20.5" y1="5.5" x2="5.5" y2="20.5" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/><circle cx="13" cy="13" r="3.5" stroke="#0d2d5e" stroke-width="1.7" fill="none"/>'
            ]
        ];
    @endphp

    <section class="px-6 py-12 md:py-16 md:px-16 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-4">
                <h2 class="text-xl font-black text-[#0d2d5e]">Fasilitas Hemodialisis</h2>
                <span class="underline-orange mb-4"></span>
                <p class="text-gray-500 text-sm mt-6 max-w-lg mx-auto leading-relaxed">
                    Kami memahami bahwa kenyamanan adalah kunci selama perawatan. Nikmati fasilitas premium kami yang dirancang khusus untuk kenyamanan Anda.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 mt-10">
                @foreach ($facilities as $facility)
                <div class="facility-card">
                    <div class="icon-circle">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
                            {!! $facility['svg'] !!}
                        </svg>
                    </div>
                    <h3 class="font-black text-[#0d2d5e] text-sm mb-2">{{ $facility['title'] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $facility['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ALERT BAR --}}
    <section class="px-6 py-6 md:px-16">
        <div class="max-w-5xl mx-auto">
            <div class="alert-bar flex items-center justify-center gap-3 px-6 py-4">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0">
                    <circle cx="10" cy="10" r="8" stroke="#0d2d5e" stroke-width="1.6" fill="none"/>
                    <line x1="10" y1="9" x2="10" y2="14" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
                    <circle cx="10" cy="6.5" r="0.9" fill="#0d2d5e"/>
                </svg>
                <p class="text-[#0d2d5e] text-sm font-semibold">Layanan Gawat Darurat tersedia 24 Jam melalui Unit Gawat Darurat.</p>
            </div>
        </div>
    </section>
</div>
@endsection