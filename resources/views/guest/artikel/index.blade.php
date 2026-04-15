@extends('layouts.guest.guest')

@section('title', 'Daftar Artikel')

@section('content')
{{-- Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
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
            <a href="{{ route('guest.artikel.index') }}" 
               class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold {{ !request('kategori') ? 'bg-blue-900 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }} transition">
                <i class="fa-solid fa-border-all text-xs"></i> Semua Artikel
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('guest.artikel.index', ['kategori' => $cat->slug]) }}" 
               class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium {{ request('kategori') == $cat->slug ? 'bg-blue-900 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }} transition">
                <i class="fa-solid fa-tag text-xs"></i> {{ $cat->nama }}
            </a>
            @endforeach
        </div>

        {{-- Kotak Pencarian --}}
        <div class="bg-white rounded-2xl border border-gray-200 px-5 py-4 mb-8">
            <p class="text-sm font-bold text-blue-900 mb-3">Cari Artikel</p>
            <form method="GET" action="{{ route('guest.artikel.index') }}">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari artikel..." value="{{ request('search') }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-200 pr-10">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
            </form>
        </div>

        {{-- Grid Artikel --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @forelse ($articles as $article)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
            @if($article->thumbnail)
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-56 object-cover">
            @else
                <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400">
                    <i class="fa-regular fa-image text-4xl"></i>
                </div>
            @endif
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-xs text-blue-600 font-medium mb-1">{{ $article->kategori->nama ?? 'Umum' }}</span>
                    <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">{{ $article->judul }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($article->konten), 120) }}
                    </p>
                    <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                        <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> {{ $article->published_at->format('d M Y') }}</span>
                        <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> {{ $article->penulis->name ?? 'Admin' }}</span>
                    </div>
                    <a href="{{ route('guest.artikel.detail', $article->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">
                        Baca selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <i class="fa-regular fa-newspaper text-4xl mb-3"></i>
                <p>Tidak ada artikel yang ditemukan.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection