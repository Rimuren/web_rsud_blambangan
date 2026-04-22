@extends('layouts.guest.guest')

@section('title', 'Video Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <h1 class="text-base font-bold tracking-widest uppercase text-gray-900">
                Video Gallery
            </h1>
        </div>
        <hr class="border-t border-gray-200" />
    </div>

    {{-- Grid --}}
    @if($videos->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($videos as $video)
        <div class="flex flex-col gap-3">

            {{-- Thumbnail --}}
            <div class="relative rounded-xl overflow-hidden cursor-pointer group"
                style="aspect-ratio:16/9"
                onclick="openVideoModal('{{ $video->link }}')">

                <img src="{{ $video->thumbnail }}"
                    alt="{{ $video->judul }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition">

                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30"></div>

                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center">
                        ▶
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 px-3 py-2">
                    <p class="text-white text-xs">
                        {{ Str::limit($video->judul, 40) }}
                    </p>
                </div>
            </div>

            {{-- Info --}}
            <div>
                <h2 class="text-blue-700 font-bold">{{ $video->judul }}</h2>

                <p class="text-sm text-gray-500 line-clamp-2">
                    {{ $video->deskripsi ?? 'Tidak ada deskripsi' }}
                </p>

                @if($video->kategori)
                <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                    {{ $video->kategori }}
                </span>
                @endif
            </div>

        </div>
        @endforeach

    </div>

    {{ $videos->links() }}

    @else
    <p class="text-center text-gray-500">Belum ada video.</p>
    @endif
</div>
@endsection