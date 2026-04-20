@extends('layouts.guest.guest')

@section('title', 'Video Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Section Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="15" height="10" rx="2" ry="2"/>
                <polygon points="22 7 17 10.5 17 13.5 22 17 22 7"/>
                <line x1="1" y1="3" x2="5" y2="7"/>
                <line x1="16" y1="3" x2="12" y2="7"/>
            </svg>
            <h1 class="text-base font-bold tracking-widest uppercase text-gray-900" style="letter-spacing: 0.12em;">Video Gallery</h1>
        </div>
        <hr class="border-t border-gray-200" />
    </div>

    {{-- Video Grid --}}
    @if($videos->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach($videos as $video)
        <div class="flex flex-col gap-3">
            <div class="relative rounded-xl overflow-hidden block group cursor-pointer" style="aspect-ratio: 16/9;" data-video-url="{{ $video->link }}" onclick="openVideoModal(this.getAttribute('data-video-url'))">
                <img src="{{ $video->thumbnail }}" alt="{{ $video->judul }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                            <polygon points="5 3 19 12 5 21 5 3"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 px-3 py-2">
                    <p class="text-white text-xs font-medium line-clamp-1" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">{{ Str::limit($video->judul, 40) }}</p>
                </div>
            </div>
            <div>
                <h2 class="text-blue-700 font-bold text-base mb-1">{{ $video->judul }}</h2>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ $video->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                @if($video->kategori)
                <span class="inline-block mt-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $video->kategori }}</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex flex-wrap items-center justify-center gap-1 mt-12">
        @if($videos->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-300 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </span>
        @else
            <a href="{{ $videos->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        @endif

        @php
            $currentPage = $videos->currentPage();
            $lastPage = $videos->lastPage();
            $start = max(1, $currentPage - 2);
            $end = min($lastPage, $currentPage + 2);
        @endphp

        @if($start > 1)
            <a href="{{ $videos->url(1) }}" class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">1</a>
            @if($start > 2) <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">...</span> @endif
        @endif

        @for($i = $start; $i <= $end; $i++)
            @if($i == $currentPage)
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-600 text-white text-sm font-semibold">{{ $i }}</span>
            @else
                <a href="{{ $videos->url($i) }}" class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">{{ $i }}</a>
            @endif
        @endfor

        @if($end < $lastPage)
            @if($end < $lastPage - 1) <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">...</span> @endif
            <a href="{{ $videos->url($lastPage) }}" class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">{{ $lastPage }}</a>
        @endif

        @if($videos->hasMorePages())
            <a href="{{ $videos->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        @else
            <span class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-300 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </span>
        @endif
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500">Belum ada video. Silakan cek lagi nanti.</p>
    </div>
    @endif
</div>

{{-- Modal --}}
<div id="videoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300" onclick="closeVideoModal()">
    <div class="relative w-full max-w-4xl mx-4 rounded-xl overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
        <button onclick="closeVideoModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="relative pt-[56.25%]">
            <iframe id="youtubeEmbed" class="absolute top-0 left-0 w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    function extractYouTubeId(url) {
        if (!url) return null;

        try {
            const parsedUrl = new URL(url);

            // youtu.be/VIDEO_ID
            if (parsedUrl.hostname === 'youtu.be') {
                return parsedUrl.pathname.replace('/', '').split('/')[0];
            }

            // youtube.com/watch?v=VIDEO_ID
            const vParam = parsedUrl.searchParams.get('v');
            if (vParam) {
                return vParam;
            }

            // youtube.com/embed/VIDEO_ID
            const embedMatch = parsedUrl.pathname.match(/\/embed\/([a-zA-Z0-9_-]{11})/);
            if (embedMatch) {
                return embedMatch[1];
            }

            // youtube.com/shorts/VIDEO_ID
            const shortsMatch = parsedUrl.pathname.match(/\/shorts\/([a-zA-Z0-9_-]{11})/);
            if (shortsMatch) {
                return shortsMatch[1];
            }

            return null;
        } catch (e) {
            return null;
        }
    }

    function openVideoModal(videoUrl) {
        if (!videoUrl || videoUrl.trim() === '') {
            alert('URL video tidak ditemukan.');
            return;
        }

        const videoId = extractYouTubeId(videoUrl);

        if (!videoId || videoId.length !== 11) {
            alert('Link YouTube tidak valid.\nURL: ' + videoUrl);
            console.error('Invalid YouTube URL:', videoUrl);
            return;
        }

        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('youtubeEmbed');

        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('youtubeEmbed');

        iframe.src = '';
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
</script>
@endsection