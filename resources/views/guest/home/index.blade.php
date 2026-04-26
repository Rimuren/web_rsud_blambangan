@extends('layouts.guest.guest')

@section('title', 'Beranda')

@section('content')
@php
    $guestHomeHeroImages = [
        asset('images/hero1.png'),
        asset('images/hero2.png'),
        asset('images/hero3.png'),
    ];
@endphp

<div
    id="guest-home-config"
    data-popup-session-key="{{ $popupIklans->isNotEmpty() ? 'popup-iklan-shown' : '' }}"
    data-hero-images='@json($guestHomeHeroImages)'>
</div>

@if($popupIklans->isNotEmpty())
<div id="iklan-popup-overlay" class="guest-floating-ad pointer-events-none fixed inset-0 z-[999]">
    <div class="guest-floating-ad__backdrop absolute inset-0"></div>
    <div class="guest-floating-ad__wrap flex items-center justify-center px-4">
        <div class="guest-floating-ad__inner relative w-full max-w-lg">
            <button
                type="button"
                id="close-iklan-popup"
                class="pointer-events-auto absolute -right-3 -top-3 z-20 flex h-9 w-9 items-center justify-center rounded-full bg-black text-white shadow-lg transition hover:bg-zinc-700"
                aria-label="Tutup iklan">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="guest-floating-ad__card pointer-events-auto w-full overflow-hidden rounded-2xl bg-white shadow-2xl">
                <div class="guest-floating-ad__slides">
                    @foreach($popupIklans as $popupIklan)
                    <article class="guest-floating-ad__slide {{ $loop->first ? 'is-active' : '' }}" data-iklan-slide>
                        <div class="relative w-full bg-zinc-100" style="aspect-ratio: 4/3;">
                            <span class="absolute left-3 top-3 z-10 inline-flex items-center rounded-full bg-black/80 px-2.5 py-1 text-[11px] font-semibold tracking-wide text-white">
                                {{ $loop->iteration }} / {{ $popupIklans->count() }}
                            </span>
                            <img
                                src="{{ asset('storage/' . $popupIklan->gambar) }}"
                                alt="{{ $popupIklan->nama }}"
                                class="h-full w-full object-contain"
                            >
                        </div>
                        <div class="px-6 pb-6 pt-5">
                            <h2 class="text-lg font-bold leading-snug text-zinc-900">
                                {{ $popupIklan->nama }}
                            </h2>
                            <p class="mt-1.5 text-sm leading-relaxed text-zinc-500">
                                {{ $popupIklan->deskripsi ?: 'Informasi terbaru dari RSUD Blambangan untuk Anda.' }}
                            </p>
                            <div class="mt-5 flex flex-wrap items-center gap-2.5">
                                @if ($popupIklan->cta_label && $popupIklan->cta_url)
                                <a href="{{ $popupIklan->cta_url }}"
                                    target="_blank"
                                    class="rounded-lg bg-black px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-zinc-800">
                                    {{ $popupIklan->cta_label }}
                                </a>
                                @endif
                            </div>
                            <div class="mt-4 flex items-center gap-3">
                                <span class="shrink-0 text-xs text-zinc-400">
                                    <span data-iklan-popup-countdown>600</span>s
                                </span>
                                <div class="h-1 flex-1 overflow-hidden rounded-full bg-zinc-100">
                                    <div class="popup-progress-bar h-full rounded-full bg-black transition-all" data-iklan-popup-progress></div>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <button
                type="button"
                id="iklan-popup-prev"
                class="pointer-events-auto absolute -left-12 top-1/2 -translate-y-1/2 flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-md ring-1 ring-zinc-900/10 transition hover:bg-zinc-50"
                aria-label="Iklan sebelumnya">
                <svg class="h-4 w-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button
                type="button"
                id="iklan-popup-next"
                class="pointer-events-auto absolute -right-12 top-1/2 -translate-y-1/2 flex h-9 w-9 items-center justify-center rounded-full bg-white shadow-md ring-1 ring-zinc-900/10 transition hover:bg-zinc-50"
                aria-label="Iklan berikutnya">
                <svg class="h-4 w-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
@endif

    {{-- HERO SECTION --}}
    <section class="relative w-full min-h-[280px] sm:min-h-[400px] md:min-h-[550px] overflow-hidden">
    <img src="{{ asset('images/hero1.png') }}" alt="RSUD Blambangan" id="hero-image"
        class="hero-image absolute inset-0 w-full h-full z-0 object-cover" 
        loading="eager" fetchpriority="high"
        style="object-position: 75% 55%;">
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
    <div class="container mx-auto px-4 -mt-4 md:-mt-12 relative z-20 scroll-reveal">
        <div class="bg-white rounded-2xl shadow-2xl p-5 max-w-5xl mx-auto">
            <form method="GET" action="{{ route('guest.daftar-dokter.index') }}" class="flex flex-col md:flex-row gap-4 md:gap-5">
                <div class="flex-1">
                    <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">CARI DOKTER</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama Dokter"
                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
                <div class="flex-1">
                    <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">POLIKLINIK</label>
                    <select name="poliklinik" class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="">Semua Poliklinik</option>
                        @php
                        $poliklinikList = $poliklinikList ?? [];
                        @endphp
                        @foreach ($poliklinikList as $poli)
                        <option value="{{ $poli }}" {{ request('poliklinik') == $poli ? 'selected' : '' }}>
                            {{ $poli }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-[11px] text-gray-500 uppercase tracking-wide font-semibold mb-1.5">PILIH HARI</label>
                    <select name="hari" class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="">Semua Hari</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $day)
                        <option value="{{ $day }}" {{ request('hari') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:w-auto w-full flex items-end">
                    <button type="submit" class="w-full bg-[#1e3a5f] hover:bg-blue-900 text-white rounded-lg py-2.5 px-4 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <span class="text-sm font-semibold">Cari Dokter</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JAM OPERASIONAL & LAYANAN DARURAT --}}
    <section class="relative z-10 mt-6 md:mt-8 scroll-reveal">
        <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- CARD JAM OPERASIONAL --}}
            <div class="bg-[#000B50] text-white px-6 md:px-8 py-8">
                <h2 class="text-lg md:text-xl font-bold mb-4 md:mb-5">Jam Operasional</h2>
                @if($jam_operasionals->isNotEmpty())
                    <div class="relative">
                        {{-- LIST JAM OPERASIONAL --}}
                        <div
                            id="jam-operasional-list"
                            class="jam-operasional-list flex flex-col gap-0 text-sm overflow-y-auto pr-1 custom-scrollbar"
                            style="max-height: 150px;"
                        >
                            @foreach($jam_operasionals as $index => $item)
                                <div class="flex items-center justify-between gap-4 border-b border-white/10 py-3 {{ $loop->last ? 'border-b-0' : '' }}">
                                    <span class="font-semibold text-white">
                                        {{ $item->hari_label }}
                                    </span>
                                    <span class="{{ $item->jam_operasional ? 'text-white/85' : 'text-white/40 italic' }}">
                                        {{ $item->jam_operasional ?: 'Tutup' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- GRADIENT FADE + SCROLL INDICATOR (hanya jika item > 3) --}}
                        @if($jam_operasionals->count() > 3)
                            <div id="jam-scroll-indicator" class="pointer-events-none absolute bottom-0 left-0 right-0">
                                {{-- Gradient fade --}}
                                <div class="h-10 bg-gradient-to-t from-[#000B50] to-transparent"></div>
                                {{-- Teks & ikon scroll --}}
                                <div class="flex items-center justify-center gap-1.5 pb-1 pt-0.5">
                                    <svg class="w-3 h-3 text-white/60 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                    <span class="text-[10px] font-semibold uppercase tracking-widest text-white/50">Scroll untuk lihat semua</span>
                                    <svg class="w-3 h-3 text-white/60 animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-4 text-sm text-white/80">
                        Jam operasional belum tersedia.
                    </div>
                @endif
            </div>

            {{-- CARD LAYANAN DARURAT --}}
            <div class="bg-[#D10000] text-white px-6 md:px-8 py-8">
                <h2 class="text-lg md:text-xl font-bold mb-2">Layanan Darurat 24 Jam</h2>
                <p class="text-white/75 text-sm mb-4 md:mb-5 leading-relaxed">Dalam situasi darurat, jangan ragu untuk segera menghubungi kami</p>
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-lg md:text-xl font-bold tracking-wide">(0333) 4211188</span>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN UNGGULAN --}}
    <section class="bg-white py-10 md:py-14 px-4 scroll-reveal">
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
                ['title' => 'Digital Subtraction Angiography', 'img' => 'dsa.jpg', 'route' => 'guest.layanan-unggulan.dsa.index'],
                ['title' => 'Cath Lab', 'img' => 'cathlab1.jpg', 'route' => 'guest.layanan-unggulan.cathlab.index'],
                ['title' => 'Hemodialysis Center', 'img' => 'hemodialysis.jpg', 'route' => 'guest.layanan-unggulan.hemodialysis.index'],
                ['title' => 'Oncology & Chemotherapy', 'img' => 'onco.jpg', 'route' => 'guest.layanan-unggulan.oncology.index'],
                ];
                @endphp
                @foreach ($services as $service)
                <a href="{{ route($service['route']) }}" class="block scroll-reveal-child">
                    <div class="service-card relative rounded-2xl overflow-hidden h-40 md:h-48 group cursor-pointer shadow-md">
                        <img src="{{ asset('images/' . $service['img']) }}"
                            alt="{{ $service['title'] }}"
                            class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                            <h4 class="text-white font-bold text-sm leading-snug">
                                {{ $service['title'] }}
                            </h4>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BERITA & ARTIKEL --}}
    <section class="bg-gray-50 py-10 md:py-12 px-4 scroll-reveal">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-5 md:mb-6 flex-wrap gap-2">
                <h2 class="text-lg md:text-xl font-bold text-gray-900">Berita &amp; Artikel Kesehatan</h2>
                <a href="{{ route('guest.artikel.index') }}" class="text-blue-600 text-sm font-semibold flex items-center hover:underline">Lihat Artikel →</a>
            </div>

            {{-- DAFTAR ARTIKEL --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-6 mb-6 md:mb-8">
                @forelse ($topArticles as $article)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all scroll-reveal-child">
                    <a href="{{ route('guest.artikel.detail', $article->slug) }}" class="block">
                        <div class="relative h-36 md:h-40 overflow-hidden bg-gradient-to-br from-blue-900 via-blue-700 to-cyan-500">
                            @if ($article->thumbnail)
                            <img
                                src="{{ asset('storage/' . $article->thumbnail) }}"
                                alt="{{ $article->judul }}"
                                class="h-full w-full object-cover transition duration-300 hover:scale-105">
                            @else
                            <div class="flex h-full items-center justify-center">
                                <svg class="w-12 h-12 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A3.375 3.375 0 0011.25 4.875V3.75m0 0A2.25 2.25 0 019 1.5m2.25 2.25A2.25 2.25 0 0013.5 1.5m-9 12.75h15a1.5 1.5 0 011.5 1.5v4.125a1.125 1.125 0 01-1.125 1.125H4.125A1.125 1.125 0 013 19.875V15.75a1.5 1.5 0 011.5-1.5z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                    </a>

                    <div class="p-4">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-wide">
                                {{ $article->kategori->nama ?? 'Artikel' }}
                            </span>
                            <span class="text-[11px] font-semibold text-gray-400">
                                {{ number_format($article->views ?? 0) }} views
                            </span>
                        </div>

                        <h3 class="text-sm font-bold text-gray-900 mt-1.5 mb-2 leading-snug">
                            <a href="{{ route('guest.artikel.detail', $article->slug) }}" class="hover:text-blue-700 transition">
                                {{ $article->judul }}
                            </a>
                        </h3>

                        <p class="text-xs text-gray-500 mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->konten), 110) }}
                        </p>

                        <a href="{{ route('guest.artikel.detail', $article->slug) }}" class="text-xs font-semibold text-blue-600 hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>
                @empty
                <div class="sm:col-span-2 md:col-span-3 bg-white rounded-2xl border border-gray-200 px-6 py-12 text-center text-gray-500">
                    Artikel populer belum tersedia.
                </div>
                @endforelse
            </div>

            {{-- LIST KATEGORI ARTIKEL --}}
            @if($topArticleCategories->isNotEmpty())
            <div class="bg-white rounded-xl p-4 mb-6 md:mb-8 shadow-sm border border-gray-100 scroll-reveal-child">
                <div class="flex flex-wrap gap-2 md:gap-3 justify-center items-center text-xs text-gray-600">
                    <span class="font-bold text-gray-800">Kategori Artikel:</span>
                    @forelse ($topArticleCategories as $index => $category)
                    @php
                    $categoryClasses = [
                        'bg-blue-100 text-blue-800',
                        'bg-red-100 text-red-700',
                        'bg-green-100 text-green-700',
                        'bg-purple-100 text-purple-700',
                        'bg-orange-100 text-orange-700',
                        'bg-teal-100 text-teal-700',
                    ];
                    @endphp
                    <a href="{{ route('guest.artikel.index', ['kategori' => $category->slug ?? '']) }}" 
                       class="{{ $categoryClasses[$index % count($categoryClasses)] }} px-3 py-1 rounded-full hover:opacity-80 transition">
                        {{ $category->nama ?? $category }}
                    </a>
                    @empty
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Belum ada kategori</span>
                    @endforelse
                </div>
                <p class="text-center text-[11px] text-gray-400 mt-2">Klik kategori untuk melihat artikel terkait</p>
            </div>
            @endif

            <div class="text-center scroll-reveal-child">
                <a href="{{ route('guest.artikel.index') }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 md:px-10 py-3 rounded-xl shadow transition text-sm md:text-base">Lihat Lebih Banyak</a>
            </div>
        </div>
    </section>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== HERO SLIDESHOW ==========
    const heroConfig = document.getElementById('guest-home-config');
    let heroImages = [];
    
    if (heroConfig && heroConfig.dataset.heroImages) {
        try {
            heroImages = JSON.parse(heroConfig.dataset.heroImages);
        } catch(e) {
            console.error('Gagal parse hero images:', e);
        }
    }
    
    if (heroImages.length === 0) {
        heroImages = [
            '{{ asset("images/hero1.png") }}',
            '{{ asset("images/hero2.png") }}',
            '{{ asset("images/hero3.png") }}'
        ];
    }
    
    const heroImage = document.getElementById('hero-image');
    let currentHeroIndex = 0;
    
    function changeHeroImage() {
        if (!heroImage || heroImages.length === 0) return;
        currentHeroIndex = (currentHeroIndex + 1) % heroImages.length;
        heroImage.style.opacity = '0.5';
        setTimeout(() => {
            heroImage.src = heroImages[currentHeroIndex];
            setTimeout(() => {
                heroImage.style.opacity = '1';
            }, 50);
        }, 150);
    }
    
    if (heroImages.length > 1) {
        setInterval(changeHeroImage, 5000);
    }
    
    if (heroImage) {
        heroImage.style.transition = 'opacity 0.3s ease-in-out';
        heroImage.style.opacity = '1';
    }
    
    // ========== JAM OPERASIONAL SCROLL INDICATOR ==========
    const jamList = document.getElementById('jam-operasional-list');
    const jamIndicator = document.getElementById('jam-scroll-indicator');

    if (jamList && jamIndicator) {
        function updateScrollIndicator() {
            const atBottom = jamList.scrollTop + jamList.clientHeight >= jamList.scrollHeight - 4;
            jamIndicator.style.opacity = atBottom ? '0' : '1';
            jamIndicator.style.transition = 'opacity 0.3s ease';
        }
        jamList.addEventListener('scroll', updateScrollIndicator);
        updateScrollIndicator();
    }
});
</script>
</div>

<style>
/* Custom scrollbar jam operasional */
.jam-operasional-list.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) rgba(255,255,255,0.05);
}
.jam-operasional-list.custom-scrollbar::-webkit-scrollbar {
    width: 3px;
}
.jam-operasional-list.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
}
.jam-operasional-list.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.3);
    border-radius: 10px;
}
.jam-operasional-list.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,0.55);
}

/* Animasi bounce pelan untuk ikon scroll */
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(4px); }
}
.animate-bounce-slow {
    animation: bounce-slow 1.4s ease-in-out infinite;
}

/* Animasi lain */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(3px); }
}
.animate-bounce {
    animation: bounce 1s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 0.6; }
    50% { opacity: 1; }
}
.animate-pulse {
    animation: pulse 1.5s ease-in-out infinite;
}
</style>
@endsection