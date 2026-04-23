<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSUD Blambangan')</title>

<<<<<<< HEAD
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    {{-- HEADER / NAVBAR --}}
    <header class="w-full bg-white shadow-sm border-b">
        <nav class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('build/assets/logo.png') }}" 
                     alt="Logo RSUD Blambangan"
                     class="h-10 w-auto object-contain">

                <span class="text-lg md:text-xl font-semibold text-gray-800">
                    RSUD Blambangan
                </span>
            </a>

            {{-- MENU --}}
            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="relative text-sm md:text-base font-medium transition 
                   {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    Beranda

                    @if(request()->routeIs('home'))
                        <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-blue-600 rounded"></span>
                    @endif
                </a>

                <a href="{{ route('profil') }}"
                   class="relative text-sm md:text-base font-medium transition 
                   {{ request()->routeIs('profil') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    Profil

                    @if(request()->routeIs('profil'))
                        <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-blue-600 rounded"></span>
                    @endif
                </a>

            </div>

        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white text-center py-4 text-sm">
        © {{ date('Y') }} RSUD Blambangan. All rights reserved.
    </footer>

</body>
</html>
=======
@section('title', 'Profil RSUD Blambangan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    :root {
        /* Animasi awal halaman */
        --fade-duration: 0.8s;
        --fade-direction: fade-up;
        
        /* Animasi scroll reveal */
        --reveal-duration: 0.6s;
        --reveal-delay-step: 0.1s;
    }

    body { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
    }
    html, body { 
        overflow-x: hidden; 
        width: 100%; 
        max-width: 100%; 
    }

    /* ========== ANIMASI AWAL HALAMAN (fade container) ========== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeLeft {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes fadeRight {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .fade-container {
        animation-duration: var(--fade-duration);
        animation-fill-mode: both;
        animation-timing-function: ease-out;
    }
    .fade-container[data-direction="fade-in"] { animation-name: fadeIn; }
    .fade-container[data-direction="fade-up"] { animation-name: fadeUp; }
    .fade-container[data-direction="fade-down"] { animation-name: fadeDown; }
    .fade-container[data-direction="fade-left"] { animation-name: fadeLeft; }
    .fade-container[data-direction="fade-right"] { animation-name: fadeRight; }
    .fade-container[data-direction="zoom-in"] { animation-name: zoomIn; }

    /* ========== ANIMASI SCROLL REVEAL ========== */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity var(--reveal-duration) ease-out, transform var(--reveal-duration) ease-out;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
    /* Opsi variasi arah (bisa ditambahkan class tambahan) */
    .reveal-left {
        transform: translateX(-30px);
    }
    .reveal-left.visible {
        transform: translateX(0);
    }
    .reveal-right {
        transform: translateX(30px);
    }
    .reveal-right.visible {
        transform: translateX(0);
    }
    .reveal-scale {
        transform: scale(0.95);
    }
    .reveal-scale.visible {
        transform: scale(1);
    }

    /* Efek hover interaktif */
    button, img, .stat-card, .facility-card {
        transition: all 0.2s ease;
    }
    button:hover {
        transform: translateY(-2px);
    }
    img:hover {
        transform: scale(1.02);
    }
    .stat-card:hover, .facility-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
    }
</style>

<div class="bg-slate-50 text-gray-800 fade-container" data-direction="fade-up" style="--fade-duration: 0.8s;">
    {{-- HERO SECTION (tidak perlu scroll reveal karena sudah di-fade container) --}}
    <section class="bg-blue-50 py-16 px-6 text-center">
        <div class="max-w-2xl mx-auto">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-2xl mb-6 bg-white shadow-md">
                <img src="{{ asset('images/logo.png') }}" alt="Logo RSUD Blambangan" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Profil Rumah Sakit</h1>
            <p class="text-gray-500 text-base leading-relaxed max-w-md mx-auto">
                Berkomitmen menyediakan layanan kesehatan prima yang berfokus pada keselamatan pasien dan teknologi medis terdepan untuk kesejahteraan masyarakat.
            </p>
        </div>
    </section>

    {{-- SEJARAH --}}
    <section class="max-w-6xl mx-auto px-6 py-20 reveal">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-0.5 bg-teal-500"></div>
                    <span class="text-teal-500 text-xs font-semibold uppercase tracking-widest">Sejarah</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Jejak Langkah Pengabdian Kami</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Berdiri sejak tahun 1930 sebagai Pusat Kesehatan Sederhana jaman Belanda, yang hanya melayani Pelayanan Kesehatan Dasar dan Penyakit Menular hingga sekarang berkembang menjadi Rumah Sakit Kelas B Pemerintah dan lulus Akreditasi PARIPURNA KARS 2012. Kini telah menjadi Pusat Rujukan Spesialis di kabupaten Banyuwangi, RSUD Blambangan selalu berbenah dalam hal pelayanan kesehatan sehingga dapat menyajikan pelayanan yang modern dan berkelas.
                </p>
            </div>
            <div class="relative">
                <img src="{{ asset('images/gambar-1.jpg') }}" alt="Rumah Sakit" class="w-full rounded-2xl object-cover h-64 md:h-72">
                <div class="absolute bottom-9 left-10 transform translate-y-1/2 -translate-x-1/2 bg-white rounded-2xl shadow-lg px-8 py-4 text-center min-w-max">
                    <p class="text-4xl font-extrabold text-teal-600">90+</p>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-1">Tahun Melayani</p>
                </div>
            </div>
        </div>
    </section>

    {{-- KOMITMEN --}}
    <section class="max-w-6xl mx-auto px-6 pb-8 pt-12 reveal">
        <div class="rounded-3xl px-6 md:px-10 py-12 md:py-14 text-center text-white bg-[#0F3D5E]">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-10 h-px bg-teal-400"></div>
                <span class="text-teal-400 text-xs font-semibold uppercase tracking-widest">Maklumat Pelayanan</span>
                <div class="w-10 h-px bg-teal-400"></div>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold mb-8">Komitmen Kami Kepada Masyarakat</h2>
            <div class="relative max-w-2xl mx-auto">
                <svg class="absolute -top-3 -left-2 w-7 h-7 text-teal-400 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.17 17c.51 0 .98-.29 1.2-.74l1.42-2.84c.14-.28.21-.58.21-.89V8c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v5c0 .55.45 1 1 1h2l-1 2c-.36.72.17 1.53 1 1.53h.17zm10 0c.51 0 .98-.29 1.2-.74l1.42-2.84c.14-.28.21-.58.21-.89V8c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v5c0 .55.45 1 1 1h2l-1 2c-.36.72.17 1.53 1 1.53h.17z"/>
                </svg>
                <p class="text-blue-100 text-sm leading-loose px-4">
                    Maklumat sejak tahun 1930 sebagai Pusat Kesehatan Sederhana jaman Belanda, yang hanya melayani Pelayanan Kesehatan Dasar dan Penyakit Menular hingga sekarang berkembang menjadi Rumah Sakit Kelas B Pemerintah dan lulus Akreditasi PARIPURNA KARS 2012. Kini telah menjadi Pusat Rujukan Spesialis di kabupaten Banyuwangi. RSUD Blambangan selalu berbenah dalam hal pelayanan kesehatan sehingga dapat menyajikan pelayanan yang modern dan berkelas.
                </p>
                <svg class="absolute -bottom-4 -right-2 w-7 h-7 text-teal-400 opacity-80 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.17 17c.51 0 .98-.29 1.2-.74l1.42-2.84c.14-.28.21-.58.21-.89V8c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v5c0 .55.45 1 1 1h2l-1 2c-.36.72.17 1.53 1 1.53h.17zm10 0c.51 0 .98-.29 1.2-.74l1.42-2.84c.14-.28.21-.58.21-.89V8c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v5c0 .55.45 1 1 1h2l-1 2c-.36.72.17 1.53 1 1.53h.17z"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-2xl p-8 text-white bg-[#0F3D5E] reveal reveal-left">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="text-xl font-bold">Visi</h3>
                </div>
                <p class="text-blue-200 text-sm leading-relaxed">
                    Menjadi pusat pelayanan kesehatan rujukan utama yang unggul dalam teknologi dan pelayanan yang humanis bagi seluruh lapisan masyarakat pada tahun 2030.
                </p>
            </div>
            <div class="rounded-2xl p-8 text-white bg-[#0F3D5E] reveal reveal-right">
                <div class="flex items-center gap-2 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-bold">Misi</h3>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5 text-white">1</div>
                        <p class="text-blue-200 text-sm leading-relaxed">Menyelenggarakan pelayanan medis yang bermutu dan mengutamakan keselamatan pasien.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5 text-white">2</div>
                        <p class="text-blue-200 text-sm leading-relaxed">Mengembangkan sumber daya manusia yang profesional dan berintegritas tinggi.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5 text-white">3</div>
                        <p class="text-blue-200 text-sm leading-relaxed">Menyediakan sarana dan prasarana medis yang modern dan terintegrasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-1 h-7 rounded-full bg-teal-500"></div>
            <h2 class="text-2xl font-bold text-gray-900">Fasilitas Rumah Sakit</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $facilities = [
                    [
                        'title' => 'IGD 24 Jam',
                        'desc' => 'Siaga melayani kondisi darurat kapan saja dengan tim medis ahli.',
                        'img' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=500&auto=format&fit=crop',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 0h13.5M3.375 9.75h.375m-.375 3h.375m13.125-3h.375m-.375 3h.375M6.375 9h11.25" />'
                    ],
                    [
                        'title' => 'Laboratorium Modern',
                        'desc' => 'Fasilitas pengujian medis lengkap dengan hasil yang cepat dan akurat.',
                        'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=500&auto=format&fit=crop',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1-.26 2.242-1.31 1.554l-3.04-2.027a9.126 9.126 0 01-9.705 0L4.11 17.856c-1.05.688-2.311-.554-1.311-1.554L4.2 14.9" />'
                    ],
                    [
                        'title' => 'Rawat Inap VVIP',
                        'desc' => 'Kamar perawatan yang nyaman dengan fasilitas setara hotel berbintang.',
                        'img' => 'https://images.unsplash.com/photo-1598256989261-7f657bc3e10e?w=500&auto=format&fit=crop',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />'
                    ]
                ];
            @endphp
            @foreach ($facilities as $index => $facility)
            <div class="facility-card reveal reveal-scale" style="transition-delay: {{ $index * 0.1 }}s;">
                <div class="relative rounded-xl overflow-hidden mb-4 h-48">
                    <img src="{{ $facility['img'] }}" alt="{{ $facility['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3 w-8 h-8 rounded-lg flex items-center justify-center bg-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            {!! $facility['icon'] !!}
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">{{ $facility['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $facility['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-6xl mx-auto px-6 pb-16 reveal">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 rounded-2xl border-2 border-dashed border-teal-500 bg-teal-50 px-8 py-6">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-full flex items-center justify-center bg-teal-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-900 text-sm">Butuh Bantuan Medis?</p>
                    <p class="text-gray-500 text-sm">Hubungi call center kami.</p>
                </div>
            </div>
            <button class="text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-md hover:opacity-90 transition whitespace-nowrap bg-[#0F3D5E]">
                Hubungi Kami: (0333) 421118
            </button>
        </div>
    </section>
</div>

<script>
    // Scroll Reveal Animation menggunakan Intersection Observer
    document.addEventListener('DOMContentLoaded', function() {
        const revealElements = document.querySelectorAll('.reveal');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Optional: jika ingin sekali muncul saja, bisa di-uncomment baris berikut
                    // observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,   // Muncul saat 10% elemen terlihat
            rootMargin: '0px 0px -20px 0px' // Sedikit offset agar lebih halus
        });
        
        revealElements.forEach(el => observer.observe(el));
    });
</script>
@endsection
>>>>>>> 9e9b5e6449f280e22f788d43bdc5bb6c901c3726
