@extends('layouts.guest.guest')

@section('title', 'Beranda')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
    body { font-family: 'Inter', system-ui, sans-serif; }
    h1, h2, h3, h4, h5, h6, .heading-font { font-family: 'Poppins', 'Inter', sans-serif; }
    .service-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .service-card:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -12px rgba(0,0,0,0.2); }
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.2rem; appearance: none;
    }
    .hero-image { object-fit: cover; object-position: center; transition: opacity 0.5s ease-in-out; opacity: 1; }
    .hero-image.fade-out { opacity: 0; }
</style>

{{-- HERO SECTION --}}
<section class="relative w-full min-h-[280px] sm:min-h-[400px] md:min-h-[550px] overflow-hidden">
    <img src="{{ asset('images/hero1.png') }}" alt="RSUD Blambangan" id="hero-image"
        class="hero-image absolute inset-0 w-full h-full z-0" loading="eager" fetchpriority="high">
    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/20 to-transparent z-[1]"></div>
    <div class="absolute inset-x-0 bottom-[-25%] h-[30%] md:h-[35%] bg-gradient-to-t from-white from-40% via-white/60 to-transparent z-[1]"></div>
    <div class="relative z-10 container mx-auto px-4 md:px-6 pt-8 sm:pt-12 md:pt-24 pb-8 md:pb-32 flex items-center min-h-[280px] sm:min-h-[400px] md:min-h-[550px]">
        <div class="max-w-xl">
            <p class="text-white/80 text-xs md:text-sm font-medium tracking-widest uppercase mb-2 md:mb-3">Informasi & Layanan RSUD untuk Masyarakat</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-4 md:mb-5">RSUD<br>BLAMBANGAN</h1>
            <p class="text-white/90 text-sm md:text-base leading-relaxed mb-6 md:mb-8 max-w-md">Akses mudah layanan, jadwal dokter, dan informasi kesehatan dalam satu tempat.</p>
            <a href="{{ route('guest.info-kamar.index') }}" class="bg-blue-600 hover:bg-blue-700 px-5 md:px-7 py-2.5 md:py-3 rounded-lg text-white font-semibold inline-block shadow-lg transition text-sm md:text-base">Lihat ketersediaan kamar</a>
        </div>
    </div>
</section>

{{-- SEARCH BAR --}}
<div class="container mx-auto px-4 -mt-4 md:-mt-12 relative z-20">
    <div class="bg-white rounded-2xl shadow-2xl p-5 max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row gap-3 md:gap-4">
            <div class="flex-1">
                <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">CARI DOKTER</label>
                <input type="text" placeholder="Nama Dokter" class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex-1">
                <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">SPESIALISASI</label>
                <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>Semua Spesialis</option>
                    <option>Poli Umum</option>
                    <option>Poli Anak</option>
                    <option>Poli Kandungan</option>
                    <option>Poli Jantung</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">PILIH HARI</label>
                <select class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>Masukkan Hari</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                </select>
            </div>
            <button class="md:w-auto w-full h-10 bg-[#1e3a5f] hover:bg-blue-900 text-white rounded-lg flex items-center justify-center px-4 transition shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <span class="md:hidden ml-2 text-sm font-semibold">Cari Dokter</span>
            </button>
        </div>
    </div>
</div>

{{-- JAM OPERASIONAL & LAYANAN DARURAT --}}
<section class="relative z-10 mt-6 md:mt-8">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="bg-[#000B50] text-white px-6 md:px-8 py-8">
            <h2 class="text-lg md:text-xl font-bold mb-4 md:mb-5">Jam Operasional</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between"><span class="font-semibold">Senin - Kamis</span><span>07:00 - 14:00</span></div>
                <div class="flex justify-between"><span class="font-semibold">Jumat</span><span>07:00 - 11:00</span></div>
                <div class="flex justify-between"><span class="font-semibold">Sabtu</span><span>07:00 - 12:00</span></div>
            </div>
        </div>
        <div class="bg-[#D10000] text-white px-6 md:px-8 py-8">
            <h2 class="text-lg md:text-xl font-bold mb-2">Layanan Darurat 24 Jam</h2>
            <p class="text-white/75 text-sm mb-4 md:mb-5 leading-relaxed">Dalam situasi darurat, jangan ragu untuk segera menghubungi kami</p>
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span class="text-lg md:text-xl font-bold tracking-wide">(0333) 4211188</span>
            </div>
        </div>
    </div>
</section>

{{-- LAYANAN UNGGULAN --}}
<section class="bg-white py-10 md:py-14 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-8 md:mb-10">
            <span class="text-[#00CCB8] text-lg font-bold tracking-widest uppercase">LAYANAN UNGGULAN</span>
            <h2 class="text-[#03007A] text-xl md:text-2xl lg:text-3xl font-bold px-4">Profesional &amp; Terpercaya dalam Perawatan Kesehatan</h2>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden grid md:grid-cols-2 shadow-lg mb-6 md:mb-8">
            <div class="hidden md:block relative min-h-[350px] bg-gradient-to-br from-[#1e4a7a] to-[#0f2d50]">
                <img src="{{ asset('images/spesialis1.png') }}" alt="Dokter Spesialis" class="absolute bottom-0 left-0 w-full h-full object-cover object-top opacity-90">
            </div>
            <div class="p-6 md:p-8">
                <span class="text-[#00CCB8] text-lg font-bold tracking-widest uppercase">OUR SPECIALIST</span>
                <h3 class="text-[#03007A] text-2xl md:text-4xl font-bold leading-snug mt-2 mb-3">Area Spesialisasi Medis yang Berkomitmen pada Keunggulan Medis &amp; Layanan</h3>
                <p class="text-[#707070] text-sm leading-relaxed mb-5 max-w-xl">Tim dokter spesialis kami berdedikasi tinggi memberikan diagnosis akurat, perawatan yang personal dan berkualitas. Kami mengembangkan solusi medis dengan standar tinggi serta memberikan dukungan awal dan perawatan terbaik bagi setiap pasien.</p>
                <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-7 md:px-9 py-2.5 rounded-lg transition">Semua Spesialis</a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-5">
            @php
                $services = [
                    ['title' => 'Digital Subtraction Angiography', 'img' => 'dsa.jpg'],
                    ['title' => 'Cath Lab', 'img' => 'cathlab.jpg'],
                    ['title' => 'Hemodialysis Center', 'img' => 'hemo.jpg'],
                    ['title' => 'Oncology & Chemotherapy', 'img' => 'onco.jpg'],
                ];
            @endphp
            @foreach ($services as $service)
                <div class="service-card relative rounded-2xl overflow-hidden h-40 md:h-48 group cursor-pointer shadow-md">
                    <img src="{{ asset('images/' . $service['img']) }}" alt="{{ $service['title'] }}" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-100 transition-opacity">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                        <h4 class="text-white font-bold text-sm leading-snug">{{ $service['title'] }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BERITA & ARTIKEL --}}
<section class="bg-gray-50 py-10 md:py-12 px-4">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-5 md:mb-6 flex-wrap gap-2">
            <h2 class="text-lg md:text-xl font-bold text-gray-900">Berita &amp; Artikel Kesehatan</h2>
            <a href="#" class="text-blue-600 text-sm font-semibold flex items-center hover:underline">Lihat Artikel →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-6 mb-6 md:mb-8">
            {{-- Artikel 1 --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="relative h-36 md:h-40 overflow-hidden bg-gradient-to-br from-green-800 to-green-600 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <div class="p-4">
                    <span class="text-[10px] font-bold text-red-600 uppercase tracking-wide">Kesehatan</span>
                    <h3 class="text-sm font-bold text-gray-900 mt-1.5 mb-2 leading-snug">Sentuhan Kasih Merawat Bayi dengan Prematuritas</h3>
                    <p class="text-xs text-gray-500 mb-3">Perawatan penuh kasih untuk buah hati tercinta dengan metode terkini.</p>
                    <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Baca Selengkapnya →</a>
                </div>
            </div>
            {{-- Artikel 2 --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                <div class="relative h-36 md:h-40 overflow-hidden bg-gradient-to-br from-blue-800 to-blue-600 flex flex-col items-center justify-center gap-1 text-center">
                    <span class="text-[10px] font-bold tracking-widest text-white/60 uppercase">Hotline</span>
                    <span class="text-white font-extrabold text-base text-center leading-snug px-2">AL APOTEKER ISUN</span>
                </div>
                <div class="p-4">
                    <span class="text-[10px] font-bold text-purple-600 uppercase tracking-wide">Edukasi</span>
                    <h3 class="text-sm font-bold text-gray-900 mt-1.5 mb-2 leading-snug">Hotline Al_Apoteker Isun | Konsultasi Obat</h3>
                    <p class="text-xs text-gray-500 mb-3">Layanan konsultasi apoteker online siap membantu kebutuhan obat Anda 24/7.</p>
                    <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Baca Selengkapnya →</a>
                </div>
            </div>
            {{-- Artikel 3 --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all sm:col-span-2 md:col-span-1">
                <div class="relative h-36 md:h-40 overflow-hidden bg-gradient-to-br from-green-900 to-green-700 flex flex-col items-center justify-center gap-1">
                    <span class="text-[10px] font-bold tracking-widest text-white/60 uppercase">Hotline</span>
                    <span class="text-white font-extrabold text-base text-center leading-snug px-2">CC-GANCANG ARON</span>
                </div>
                <div class="p-4">
                    <span class="text-[10px] font-bold text-red-600 uppercase tracking-wide">Layanan Darurat</span>
                    <h3 class="text-sm font-bold text-gray-900 mt-1.5 mb-2 leading-snug">Hotline Gancang Aron - Siaga 24 Jam</h3>
                    <p class="text-xs text-gray-500 mb-3">Informasi layanan darurat dan pengantaran pasien cepat tanggap.</p>
                    <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 mb-6 md:mb-8 shadow-sm border border-gray-100">
            <div class="flex flex-wrap gap-2 md:gap-3 justify-center items-center text-xs text-gray-600">
                <span class="font-bold text-gray-800">Kategori Artikel:</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">Kategori</span>
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">Kategori</span>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">Kategori</span>
                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full">Kategori</span>
            </div>
            <p class="text-center text-[11px] text-gray-400 mt-2">Temukan informasi-informasi di artikel</p>
        </div>
        <div class="text-center">
            <a href="#" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 md:px-10 py-3 rounded-xl shadow transition text-sm md:text-base">Lihat Lebih Banyak</a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroImages = [
            "{{ asset('images/hero1.png') }}",
            "{{ asset('images/hero2.png') }}",
            "{{ asset('images/hero3.png') }}"
        ];
        let currentIndex = 0;
        const heroImage = document.getElementById('hero-image');
        if (heroImage) {
            setInterval(() => {
                heroImage.classList.add('fade-out');
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % heroImages.length;
                    heroImage.src = heroImages[currentIndex];
                    heroImage.classList.remove('fade-out');
                }, 500);
            }, 3000);
        }
    });
</script>
@endsection