@extends('layouts.guest.guest')

@section('title', 'Daftar Artikel')

@section('content')
{{-- Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    /* Manual line-clamp untuk browser yang tidak mendukung Tailwind line-clamp */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="min-h-screen py-10 px-7 bg-[#e8f0f7]">
    <div class="max-w-6xl mx-auto">
        {{-- Header --}}
        <div class="mb-10">
            <span class="inline-block bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full mb-3 tracking-wide uppercase">Jurnal Medis</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight mb-3">
                Wawasan Kesehatan & <span class="text-orange-500"><br>Saran Ahli</span>
            </h1>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-gray-600 text-base max-w-md leading-relaxed">
                    Ikuti perkembangan terbaru dunia medis, tips kesehatan dari dokter spesialis kami, dan panduan lengkap untuk hidup lebih sehat.
                </p>
                <div class="flex items-center gap-1.5 text-gray-500 text-sm whitespace-nowrap">
                    <i class="fa-regular fa-circle-check text-gray-500 text-base"></i>
                    Semua artikel telah ditinjau oleh tim medis kami
                </div>
            </div>
        </div>

        {{-- Filter Kategori --}}
        <div class="flex flex-wrap gap-2 mb-8">
            @php $categories = ['Semua Artikel', 'Tips Kesehatan', 'Berita Medis', 'Gizi', 'Pencegahan Penyakit', 'Kesehatan Mental']; @endphp
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-blue-900 text-white transition">
                <i class="fa-solid fa-border-all text-xs"></i> {{ $categories[0] }}
            </button>
            @foreach (array_slice($categories, 1) as $cat)
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-heart-pulse text-xs text-gray-400"></i> {{ $cat }}
            </button>
            @endforeach
        </div>

        {{-- Kotak Pencarian --}}
        <div class="bg-white rounded-2xl border border-gray-200 px-5 py-4 mb-8">
            <p class="text-sm font-bold text-blue-900 mb-3">Cari Artikel</p>
            <div class="relative">
                <input type="text" placeholder="Cari artikel..."
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-200 pr-10">
                <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            </div>
        </div>

        {{-- Data Artikel (dinamis) dengan ID --}}
        @php
            $articles = [
                [
                    'id' => 1,
                    'title' => 'Kesehatan Jantung 2024: Standar Baru',
                    'summary' => 'Pelajari protokol terbaru untuk kesehatan jantung dan bagaimana pemeriksaan pencegahan berkembang dengan teknologi baru.',
                    'date' => '12 Jan 2024',
                    'author' => 'dr. Sarah Smith',
                    'img' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=280&fit=crop',
                    'category' => 'Tips Kesehatan'
                ],
                [
                    'id' => 2,
                    'title' => 'Mengatasi Asma pada Anak',
                    'summary' => 'Dokter spesialis kami berbagi tips penting mengenali pemicu dan menjaga gaya hidup aktif untuk anak dengan masalah pernapasan.',
                    'date' => '5 Feb 2024',
                    'author' => 'dr. James Lee',
                    'img' => 'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=400&h=280&fit=crop',
                    'category' => 'Kesehatan Anak'
                ],
                [
                    'id' => 3,
                    'title' => 'Kekuatan Diet Nabati',
                    'summary' => 'Ketahui bagaimana perubahan pola makan dapat meningkatkan kesehatan metabolik dan vitalitas jangka panjang menurut penelitian terbaru.',
                    'date' => '10 Mar 2024',
                    'author' => 'Jane Doe, Ahli Gizi',
                    'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=280&fit=crop',
                    'category' => 'Gizi'
                ],
                [
                    'id' => 4,
                    'title' => 'Inovasi Pediatri Modern',
                    'summary' => 'Teknologi medis baru mengubah cara kita merawat generasi mendatang, mulai dari telemedicine hingga wawasan genetik.',
                    'date' => '22 Mar 2024',
                    'author' => 'dr. Robert Chen',
                    'img' => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=400&h=280&fit=crop',
                    'category' => 'Berita Medis'
                ],
                [
                    'id' => 5,
                    'title' => 'Yoga untuk Mengatasi Stres Kronis',
                    'summary' => 'Temukan rangkaian yoga berbasis bukti yang membantu mengatur sistem saraf dan menurunkan kadar kortisol secara alami.',
                    'date' => '2 Apr 2024',
                    'author' => 'Tim Kesehatan',
                    'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&h=280&fit=crop',
                    'category' => 'Kesehatan Mental'
                ],
                [
                    'id' => 6,
                    'title' => 'Memahami Hipertensi (Darah Tinggi)',
                    'summary' => 'Panduan lengkap tentang "pembunuh diam-diam" termasuk tips pemantauan harian dan perubahan gaya hidup yang efektif.',
                    'date' => '15 Apr 2024',
                    'author' => 'dr. Elena Rodriguez',
                    'img' => 'https://images.unsplash.com/photo-1559757175-5700dde675bc?w=400&h=280&fit=crop',
                    'category' => 'Pencegahan Penyakit'
                ]
            ];
        @endphp

        {{-- Grid Artikel --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach ($articles as $article)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
                <img src="{{ $article['img'] }}" alt="{{ $article['title'] }}" class="w-full h-56 object-cover">
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">{{ $article['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">{{ $article['summary'] }}</p>
                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> {{ $article['date'] }}</span>
                        <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> {{ $article['author'] }}</span>
                    </div>
                    {{-- Link menggunakan route dengan parameter ID --}}
                    <a href="{{ route('guest.artikel.detail', $article['id']) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">
                        Baca selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-center gap-1 mt-6 pb-6">
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-white hover:text-gray-600 text-sm transition border border-transparent hover:border-gray-200">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-700 text-white text-sm font-semibold">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">4</button>
            <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">...</span>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">12</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-white hover:text-gray-600 text-sm transition border border-transparent hover:border-gray-200">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</div>
@endsection