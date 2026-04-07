@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan - Cath Lab')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .blue-underline {
        display: block;
        width: 48px;
        height: 4px;
        background: #e05a1a;
        border-radius: 2px;
        margin-top: 8px;
    }
    .hero-bg { background-color: #dde8f0; }
    .card-advantage {
        background: #f3f7fb;
        border-radius: 20px;
        padding: 28px 24px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    .card-advantage:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
        border-color: #e05a1a;
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
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-white text-gray-800">
    {{-- HERO SECTION --}}
    <section class="hero-bg px-6 py-16 md:px-20">
        <div class="max-w-2xl mx-auto md:mx-0">
            <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">
                Catheterization Laboratory
            </h1>
            <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-4 md:mb-6">
                (Cath Lab)
            </h1>
            <p class="text-gray-600 text-base leading-relaxed max-w-sm">
                Layanan modern untuk memeriksa dan menangani masalah jantung serta pembuluh darah, dengan alat canggih yang membantu prosedur jantung demi menyelamatkan nyawa pasien.
            </p>
        </div>
    </section>

    {{-- TENTANG CATH LAB --}}
    <section class="px-6 py-12 md:px-20">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row gap-12 md:gap-16">
                <!-- Judul & Deskripsi - lebih ke kiri -->
                <div class="flex-1 md:pr-4">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-1">Tentang Cath Lab</h2>
                    <span class="blue-underline mb-6"></span>
                    
                    <div class="space-y-4 text-gray-600 text-[15px] leading-relaxed mt-4">
                        <p>
                            Cath Lab atau Laboratorium Kateterisasi adalah ruang prosedur di rumah sakit di mana spesialis jantung melakukan tes diagnostik dan prosedur invasif minimal untuk mendiagnosis dan mengobati penyakit kardiovaskular.
                        </p>
                        <p>
                            Laboratorium kami beroperasi 24/7 untuk menangani keadaan darurat jantung seperti serangan jantung (STEMI), memastikan pasien menerima intervensi secepat mungkin untuk meminimalkan kerusakan otot jantung.
                        </p>
                        <div class="text-center md:text-left mt-6">
                            <a href="https://www.instagram.com/reel/DP8ZHf5EUKd/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#0d2d5e] hover:bg-[#e05a1a] text-white font-semibold py-3 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="white">
                                    <polygon points="7,4 20,12 7,20"/>
                                </svg>
                                Tonton Video Fasilitas Cath Lab
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="flex-1 md:mt-18">
                    <div class="bg-[#e4ecf3] rounded-2xl border border-gray-200 shadow-md overflow-hidden">
                        <img src="{{ asset('images/cathlab.jpg') }}" alt="Cath Lab RSUD Blambangan" class="w-full h-full object-cover min-h-[250px] md:min-h-[300px]">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JENIS TINDAKAN --}}
    <section class="px-6 py-12 md:px-20">
        <div class="max-w-5xl mx-auto">
            <div class="bg-[#e4ecf4] rounded-2xl px-6 py-10 md:px-10 md:py-12">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-2">Jenis Tindakan</h2>
                    <p class="text-gray-500 text-sm max-w-md mx-auto">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($procedures as $index => $proc)
                    <div class="flex gap-4 items-start bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-[#0d2d5e] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div>
                            <h4 class="font-black text-[#0d2d5e] text-base md:text-lg mb-1">{{ $proc['title'] }}</h4>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $proc['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</div>
@endsection