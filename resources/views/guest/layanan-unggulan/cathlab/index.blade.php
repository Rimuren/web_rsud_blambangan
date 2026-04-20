@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan - Cath Lab')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .hero-bg { background-color: #dde8f0; }
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
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }

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

    /* Staggered delay for cards (optional extra polish) */
    .stagger-item:nth-child(1) { transition-delay: 0.05s; }
    .stagger-item:nth-child(2) { transition-delay: 0.1s; }
    .stagger-item:nth-child(3) { transition-delay: 0.15s; }
    .stagger-item:nth-child(4) { transition-delay: 0.2s; }

    /* Sembunyikan scrollbar vertikal */
::-webkit-scrollbar {
    width: 0;
    background: transparent;
    display: none;
}
html {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE/Edge */
}
body {
    -ms-overflow-style: none;
    overflow-y: auto; /* tetap boleh scroll, scrollbar tidak terlihat */
}
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-12 md:py-16 md:px-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 items-center">
            {{-- Teks dengan animasi fade-left --}}
            <div class="flex-1 fade-left" id="heroText">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#0d2d5e] leading-tight">
                    Catheterization Laboratory
                </h1>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#e05a1a] leading-tight mb-4">
                    (Cath Lab)
                </h1>
                <p class="text-gray-600 text-base md:text-lg leading-relaxed max-w-md">
                    Layanan modern untuk memeriksa dan menangani masalah jantung serta pembuluh darah, dengan alat canggih yang membantu prosedur jantung demi menyelamatkan nyawa pasien.
                </p>
            </div>
  
            {{-- Gambar dengan animasi fade-right --}}
            <div class="flex-1 flex justify-center fade-right" id="heroImage">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-full max-w-md">
                    <img src="{{ asset('images/cathlab1.jpg') }}" alt="Cath Lab RSUD Blambangan" class="w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG CATH LAB --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-4xl mx-auto fade-up" id="aboutCard">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Tentang Cath Lab</h2>
                    <div class="w-16 h-1 bg-[#e05a1a] mx-auto rounded-full"></div>
                </div>
                <div class="space-y-4 text-gray-700 text-base md:text-lg leading-relaxed text-center">
                    <p>
                        <span class="font-bold text-[#0d2d5e]">Cath Lab</span> atau Laboratorium Kateterisasi adalah ruang prosedur di rumah sakit di mana spesialis jantung melakukan tes diagnostik dan prosedur invasif minimal untuk mendiagnosis dan mengobati penyakit kardiovaskular.
                    </p>
                    <p>
                        Laboratorium kami beroperasi <span class="font-bold text-[#e05a1a]">24/7</span> untuk menangani keadaan darurat jantung seperti serangan jantung (STEMI), memastikan pasien menerima intervensi secepat mungkin untuk meminimalkan kerusakan otot jantung.
                    </p>
                    <div class="text-center pt-4 fade-in" id="videoButton">
                        <a href="https://www.instagram.com/reel/DP8ZHf5EUKd/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#0d2d5e] hover:bg-[#e05a1a] text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                                <polygon points="7,4 20,12 7,20"/>
                            </svg>
                            Tonton Video Cath Lab Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JENIS TINDAKAN --}}
    <section class="px-6 py-10 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="bg-[#e4ecf4] rounded-2xl px-6 py-8 md:px-8 md:py-10">
                <div class="text-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Jenis Tindakan</h2>
                    <p class="text-gray-500 text-sm md:text-base max-w-md mx-auto">
                        Layanan intervensi komprehensif untuk berbagai masalah jantung dan pembuluh darah.
                    </p>
                </div>

                @php
                    $procedures = [
                        ['title' => 'Coronary Angiography', 'desc' => 'Prosedur diagnostik untuk melihat penyempitan atau penyumbatan pada pembuluh darah koroner.'],
                        ['title' => 'Angioplasty & Stenting', 'desc' => 'Pemasangan balon dan ring (stent) untuk membuka aliran darah yang tersumbat di jantung.'],
                        ['title' => 'Pacemaker Insertion', 'desc' => 'Pemasangan alat pacu jantung permanen atau sementara untuk gangguan irama jantung.'],
                        ['title' => 'Peripheral Intervention', 'desc' => 'Tindakan intervensi pada pembuluh darah di luar jantung, seperti di kaki atau ginjal.']
                    ];
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($procedures as $index => $proc)
                    <div class="flex gap-4 items-start bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition stagger-item fade-up" data-stagger="{{ $index }}">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-[#0d2d5e] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div>
                            <h4 class="font-black text-[#0d2d5e] text-base md:text-lg mb-1">{{ $proc['title'] }}</h4>
                            <p class="text-gray-500 text-sm md:text-base leading-relaxed">{{ $proc['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    (function() {
        // Semua elemen dengan kelas animasi
        const animatedElements = document.querySelectorAll('.fade-up, .fade-left, .fade-right, .fade-in');
        
        // Fungsi untuk mengecek apakah elemen berada di viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            const buffer = 80; // sedikit buffer agar animasi muncul lebih awal
            return (
                rect.top <= (window.innerHeight - buffer) && rect.bottom >= buffer
            );
        }

        // Fungsi untuk menambahkan class 'visible' pada elemen yang sudah terlihat
        function checkAndShowVisible() {
            animatedElements.forEach(el => {
                if (isElementInViewport(el) && !el.classList.contains('visible')) {
                    el.classList.add('visible');
                }
            });
        }

        // Intersection Observer sebagai fallback dan performa lebih baik
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // stop observing after animation
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -20px 0px" });

        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Cek juga saat halaman dimuat (untuk elemen yang sudah terlihat sebelum observer siap)
        window.addEventListener('load', () => {
            checkAndShowVisible();
        });
        
        // Saat scroll manual, pastikan tetap trigger (meskipun observer sudah bekerja)
        window.addEventListener('scroll', () => {
            checkAndShowVisible();
        });
        
        // Optional: tambahkan efek micro-interaction pada card
        const cards = document.querySelectorAll('.stagger-item');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function(e) {
                this.style.transform = 'translateY(-4px)';
                this.style.transition = 'transform 0.25s ease, box-shadow 0.25s ease';
                this.style.boxShadow = '0 10px 25px -5px rgba(0,0,0,0.1)';
            });
            card.addEventListener('mouseleave', function(e) {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });
    })();
</script>
@endsection