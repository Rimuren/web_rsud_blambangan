@extends('layouts.guest.guest')

@section('title', 'Galeri Foto')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    {{-- Header --}}
    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
        </svg>
        <h1 class="text-lg font-bold tracking-widest uppercase text-gray-900" style="letter-spacing: 0.1em;">Photo Gallery</h1>
    </div>

    {{-- Grid Galeri --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-9">
        @forelse($fotos as $foto)
        <div class="gallery-card border border-gray-200 rounded-lg overflow-hidden bg-white hover:shadow-lg transition">
            <img src="{{ $foto->gambar ? asset('storage/' . $foto->gambar) : asset('images/placeholder.jpg') }}"
                 alt="{{ $foto->judul }}"
                 class="w-full h-56 object-cover">
            <div class="px-4 py-3">
                <p class="text-sm font-semibold text-gray-900">{{ $foto->judul }}</p>
                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $foto->deskripsi }}</p>
                <span class="inline-block mt-2 text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full capitalize">{{ $foto->kategori }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-24">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-width="1.5"/>
                <circle cx="8.5" cy="8.5" r="1.5" stroke-width="1.5"/>
                <polyline points="21 15 16 10 5 21" stroke-width="1.5"/>
            </svg>
            <h3 class="text-xl font-medium text-gray-700">Belum ada foto</h3>
            <p class="text-gray-500 mt-2">Galeri foto akan segera diisi.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination Custom --}}
    @if($fotos->hasPages())
    <div class="flex items-center justify-center gap-1 mt-10">
        {{-- Previous --}}
        @if($fotos->onFirstPage())
            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-300 text-sm cursor-not-allowed">&#8249;</span>
        @else
            <a href="{{ $fotos->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 text-sm">&#8249;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach($fotos->getUrlRange(1, $fotos->lastPage()) as $page => $url)
            @if($page == $fotos->currentPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white text-sm font-medium">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        @if($fotos->hasMorePages())
            <a href="{{ $fotos->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 text-sm">&#8250;</a>
        @else
            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-300 text-sm cursor-not-allowed">&#8250;</span>
        @endif
    </div>
    @endif
</div>

{{-- Optional: tambahan CSS untuk line-clamp jika belum support --}}
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection