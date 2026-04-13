@extends('layouts.guest.guest')

@section('title', 'Hemodialysis Center')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
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
                    Hemodialysis
                </h1>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#e05a1a] leading-tight mb-4">
                    Center
                </h1>
                <p class="text-gray-600 text-base md:text-lg leading-relaxed max-w-md">
                    Pusat hemodialisis modern dengan teknologi high-flux, dirancang untuk kenyamanan dan keamanan Anda selama terapi ginjal.
                </p>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-md">
                    <img src="{{ asset('images/hemodialysis.jpg') }}" alt="Hemodialysis Center" class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG HEMODIALISIS --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Tentang Hemodialisis</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                </div>
                <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed text-center">
                    <p>
                        <span class="font-bold text-[#0d2d5e]">Hemodialisis</span> adalah prosedur medis untuk menyaring limbah dan kelebihan cairan dari darah ketika ginjal sudah tidak dapat melakukannya sendiri. Pusat kami menyediakan layanan dialisis berkualitas tinggi dengan teknologi canggih.
                    </p>
                    <p>
                        Tim profesional kami siap membantu Anda 24/7 dengan protokol keamanan ketat dan peralatan <span class="font-bold text-[#e05a1a]">high-flux</span> untuk hasil terapi yang optimal dan kenyamanan maksimal.
                    </p>
                    <div class="text-center pt-4">
                        <a href="#" class="inline-flex items-center gap-2 bg-[#0d2d5e] hover:bg-[#e05a1a] text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            Konsultasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FASILITAS & LAYANAN (mirip Jenis Tindakan) --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="bg-[#e4ecf4] rounded-2xl px-6 py-8 md:px-8 md:py-10">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Fasilitas Unggulan</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full mb-4"></div>
                    <p class="text-gray-500 text-sm md:text-base max-w-md mx-auto">
                        Kenyamanan Anda adalah prioritas kami. Nikmati fasilitas premium selama menjalani terapi.
                    </p>
                </div>

                @php
                    $facilities = [
                        [
                            'title' => 'Reclining Chairs',
                            'desc' => 'Kursi medis ergonomis yang dapat disesuaikan untuk kenyamanan maksimal selama prosedur 4-5 jam.'
                        ],
                        [
                            'title' => 'Entertainment System',
                            'desc' => 'TV layar datar pribadi dan koneksi Wi-Fi di setiap unit untuk mengisi waktu selama terapi.'
                        ],
                        [
                            'title' => 'Healthy Snacks',
                            'desc' => 'Penyajian makanan ringan dan minuman sehat yang disesuaikan dengan diet pasien ginjal.'
                        ],
                        [
                            'title' => 'Full AC & HEPA Filter',
                            'desc' => 'Ruangan ber-AC sentral dengan sistem filtrasi udara HEPA untuk lingkungan steril dan nyaman.'
                        ]
                    ];
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($facilities as $index => $facility)
                    <div class="flex gap-4 items-start bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-[#0d2d5e] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div>
                            <h4 class="font-black text-[#0d2d5e] text-base md:text-lg mb-1">{{ $facility['title'] }}</h4>
                            <p class="text-gray-500 text-sm md:text-base leading-relaxed">{{ $facility['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- PROSEDUR HEMODIALISIS (card tambahan) --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Prosedur Hemodialisis</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                </div>
                <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed text-center">
                    <p>
                        Prosedur hemodialisis dilakukan sebanyak <span class="font-bold text-[#e05a1a]">2-3 kali per minggu</span>, setiap sesi berlangsung sekitar 4-5 jam. Darah dialirkan ke mesin dialisis melalui akses vaskular (fistula, graft, atau kateter).
                    </p>
                    <p>
                        Kami menggunakan <span class="font-bold text-[#0d2d5e]">dialyzer high-flux</span> modern yang lebih efisien dalam membuang molekul sedang dan besar, serta meminimalkan efek samping. Seluruh proses diawasi oleh dokter spesialis ginjal dan perawat berpengalaman.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ALERT BAR 24/7 (card kecil) --}}
    <section class="px-6 py-6 md:px-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 flex items-center justify-center gap-3 px-6 py-4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="#e05a1a" stroke-width="1.6"/>
                    <line x1="12" y1="8" x2="12" y2="12" stroke="#e05a1a" stroke-width="1.8" stroke-linecap="round"/>
                    <circle cx="12" cy="16" r="0.8" fill="#e05a1a"/>
                </svg>
                <p class="text-[#0d2d5e] text-sm md:text-base font-semibold">Layanan Gawat Darurat tersedia <span class="text-[#e05a1a]">24 jam</span> melalui Unit Gawat Darurat.</p>
            </div>
        </div>
    </section>
</div>
@endsection