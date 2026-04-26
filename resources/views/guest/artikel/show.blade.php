@extends('layouts.guest.guest')

@section('title', $article->judul)

@section('content')
{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* Styling untuk konten artikel */
    .prose {
        color: #374151;
        max-width: 100%;
        word-break: break-word;
        overflow-wrap: break-word;
        font-size: 0.9rem;  
        line-height: 1.5;   
    }
    .prose * {
        max-width: 100%;
    }
    .prose table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    .prose pre {
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    .prose h1, .prose h2, .prose h3, .prose h4 {
        color: #000000b9;
        font-weight: 700;
        margin-top: 1.2em;
        margin-bottom: 0.4em;
    }
    /* Paragraf */
    .prose p {
        font-size: 0.9rem;
        margin: 0 0 0 0 !important;
        line-height: 1.5;
        opacity: 1;
    }
    /* List styling */
    .prose ul, .prose ol {
        list-style: none !important;
        padding-left: 0 !important;
        margin-left: 1.2em;
        margin-bottom: 0.5em;
        margin-top: 0;
    }
    .prose li {
        position: relative;
        padding-left: 1.5em;
        margin-bottom: 0.15em;
        font-size: 0.9rem;
        line-height: 1.4;
        opacity: 1; 
    }
    /* Indentasi untuk baris penjelasan dalam list */
    .prose li br + span,
    .prose li .ql-indent-1,
    .prose li[style*="padding-left"] {
        display: inline-block;
        padding-left: 30px !important;
    }
    
    .prose li,
    .prose p {
        white-space: pre-wrap;
    }
    
    /* Tambahan untuk meniru indentasi tab */
    .prose .indented-line,
    .prose .ql-indented-line {
        padding-left: 30px !important;
        display: block !important;
    }
    
    /* Style khusus untuk baris penjelasan */
    .prose li:has(+ li) > br + span,
    .prose li > br + span {
        padding-left: 30px;
        display: inline-block;
    }
    /* Counter untuk ordered list */
    .prose ol {
        counter-reset: list-item !important;
    }
    .prose ol li {
        counter-increment: list-item !important;
    }
    .prose ol li::before {
        content: counter(list-item) ". " !important;
        position: absolute;
        left: 0;
        top: 0;
    }
    /* Untuk bullet list */
    .prose ul li::before {
        content: "• " !important;
        position: absolute;
        left: 0;
        top: 0;
    }
    .prose blockquote {
        border-left: 4px solid #f97316;
        padding-left: 1.2em;
        font-style: italic;
        color: #4b5563;
        margin: 1em 0;
    }
    .prose a {
        color: #2563eb;
        text-decoration: underline;
    }
    .prose a:hover {
        color: #1e3a8a;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    html, body { 
        overflow-x: hidden; 
        width: 100%; 
        max-width: 100%; 
    }

    .prose img {
        max-width: 100% !important;
        width: auto !important;
        height: auto !important;
        max-height: 70vh !important;
        object-fit: contain !important;
        border-radius: 0.75rem;
        margin: 1em auto;
        display: block;
    }
    .prose img[style*="width:100%"],
    .prose img[width="100%"] {
        width: auto !important;
        max-width: 100% !important;
    }
    .prose .ql-align-center img,
    .prose .ql-align-left img,
    .prose .ql-align-right img {
        width: auto !important;
        max-width: 100% !important;
    }
    
    /* Thumbnail artikel */
    .article-thumbnail {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f3f4f6;
        padding: 0;
        width: 100%;
        margin: 0;
        line-height: 0;
    }
    .article-thumbnail img {
        max-width: 100% !important;
        width: auto !important;
        height: auto !important;
        max-height: 70vh !important;
        object-fit: contain !important;
        border-radius: 0.75rem;
        display: block;
        margin: 0 auto;
    }
    
    /* Pastikan semua parent tidak memotong */
    .prose, .prose figure, .prose div, .prose p, .prose span {
        overflow: visible !important;
        max-height: none !important;
    }
    
    /* Ukuran heading */
    .prose h1 { font-size: 1.6rem; }
    .prose h2 { font-size: 1.4rem; }
    .prose h3 { font-size: 1.2rem; }
    .prose h4 { font-size: 1.1rem; }
    
    /* Responsif */
    @media (max-width: 768px) {
        .prose img,
        .article-thumbnail img {
            max-height: 60vh !important;
        }
    }
    @media (min-width: 1024px) {
        .prose img,
        .article-thumbnail img {
            max-height: 80vh !important;
        }
    }

    /* Responsif mobile */
    @media (max-width: 767px) {
        .prose {
            font-size: 0.8rem;
            line-height: 1.45;
        }
        .prose p, .prose li {
            font-size: 0.8rem;
        }
        .prose h1 { font-size: 1.4rem; }
        .prose h2 { font-size: 1.2rem; }
        .prose h3 { font-size: 1.05rem; }
        .prose h4 { font-size: 1rem; }
        .prose ul, .prose ol {
            margin-left: 0.8rem;
            margin-bottom: 0.5rem;
        }
        .prose li {
            margin-bottom: 0.1em;
        }
        .prose blockquote {
            padding-left: 0.8rem;
            margin: 0.8rem 0;
        }
    }
</style>

<div class="min-h-screen py-6 md:py-10 px-4 md:px-7 bg-[#e8f0f7]">
    <div class="max-w-7xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex mb-6 text-sm text-gray-500 overflow-x-auto whitespace-nowrap pb-1" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('guest.home') }}" class="hover:text-blue-600 transition">
                        <i class="fa-solid fa-home text-xs mr-1"></i>Beranda
                    </a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs text-gray-400"></i></li>
                <li>
                    <a href="{{ route('guest.artikel.index') }}" class="hover:text-blue-600 transition">Artikel</a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs text-gray-400"></i></li>
                <li>
                    <a href="{{ route('guest.artikel.index', ['kategori' => $article->kategori->slug ?? '']) }}" class="hover:text-blue-600 transition">
                        {{ $article->kategori->nama ?? 'Kategori' }}
                    </a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-gray-700 font-medium truncate max-w-[150px] md:max-w-md">{{ $article->judul }}</li>
            </ol>
        </nav>

        {{-- Grid Utama: Konten + Sidebar --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            {{-- Kolom Kiri: Artikel Utama --}}
            <div class="lg:col-span-2">
                <article class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
                @if($article->thumbnail)
                    <div class="article-thumbnail">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->judul }}">
                    </div>
                @endif

                    <div class="p-4 md:p-8">
                        <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm text-gray-500 mb-4 pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar text-blue-500"></i>
                                <span>{{ $article->published_at->isoFormat('dddd, D MMMM Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fa-regular fa-user text-blue-500"></i>
                                <span>Oleh: {{ $article->penulis->name ?? 'Admin' }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fa-regular fa-folder text-blue-500"></i>
                                <span>{{ $article->kategori->nama ?? 'Umum' }}</span>
                            </div>
                             <div class="flex items-center gap-1.5">
                                <i class="fa-regular fa-eye text-blue-500"></i>
                                <span>{{ number_format($article->views) }} dilihat</span>
                            </div>
                        </div>

                        <h1 class="text-xl md:text-4xl font-extrabold text-blue-900 leading-tight mb-6">
                            {{ $article->judul }}
                        </h1>

                        <div class="prose max-w-none text-gray-700">
                            {!! $article->konten !!}
                        </div>

                        <div class="border-t border-gray-200 mt-8 pt-6 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-medium text-gray-600">Bagikan:</span>
                                <div class="flex items-center gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                        <i class="fa-brands fa-facebook-f text-sm"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center rounded-full bg-sky-400 text-white hover:bg-sky-500 transition">
                                        <i class="fa-brands fa-x-twitter text-sm"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . ' ' . url()->current()) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition">
                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                    </a>
                                    <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                            class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition"
                                            title="Salin tautan">
                                        <i class="fa-regular fa-copy text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                @if($relatedArticles->count())
                <section class="mb-8">
                    <h2 class="text-xl md:text-2xl font-bold text-blue-900 mb-4 flex items-center">
                        <i class="fa-regular fa-newspaper text-orange-500 mr-2"></i>
                        Artikel Terkait
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($relatedArticles as $related)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col h-full">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                     alt="{{ $related->judul }}" 
                                     class="w-full h-100 md:h-40 object-cover">
                            @else
                                <div class="w-full h-100 md:h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-image text-2xl"></i>
                                </div>
                            @endif
                            <div class="p-3 flex flex-col flex-grow">
                                <span class="text-xs text-blue-600 font-medium mb-1">{{ $related->kategori->nama ?? '' }}</span>
                                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2 text-sm">{{ $related->judul }}</h3>
                                <p class="text-xs text-gray-500 mb-3">
                                    <i class="fa-regular fa-calendar mr-1"></i>{{ $related->published_at->format('d M Y') }}
                                </p>
                                <a href="{{ route('guest.artikel.detail', $related->slug) }}" 
                                   class="text-blue-600 text-xs font-medium hover:text-blue-800 mt-auto flex items-center gap-1">
                                    Baca <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-4">
                    <h3 class="text-lg font-bold text-blue-900 mb-3 flex items-center">
                        <i class="fa-regular fa-clock text-orange-500 mr-2"></i>
                        Artikel Terbaru
                    </h3>
                    <div class="space-y-3">
                        @if($latestArticles->count())
                            @foreach($latestArticles as $item)
                            <div class="flex gap-3 items-start">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                                        <i class="fa-regular fa-image text-sm"></i>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('guest.artikel.detail', $item->slug) }}" 
                                       class="font-medium text-gray-800 hover:text-blue-600 transition line-clamp-2 text-xs block mb-1">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="flex flex-wrap items-center gap-x-2 text-xs text-gray-400">
                                        <span><i class="fa-regular fa-eye text-blue-400"></i> {{ number_format($item->views) }}</span>
                                        <span><i class="fa-regular fa-calendar text-blue-400"></i> {{ $item->published_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if(!$loop->last) <hr class="my-1 border-gray-100"> @endif
                            @endforeach
                        @else
                            <p class="text-gray-500 text-sm">Belum ada artikel terbaru.</p>
                        @endif
                    </div>
                    <a href="{{ route('guest.artikel.index') }}" class="inline-flex items-center text-blue-600 text-xs font-medium hover:text-blue-800 mt-3">
                        Lihat semua <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-4">
                    <h3 class="text-lg font-bold text-blue-900 mb-3 flex items-center">
                        <i class="fa-regular fa-star text-orange-500 mr-2"></i>
                        Rekomendasi
                    </h3>
                    <div class="space-y-3">
                        @if($recommendedArticles->count())
                            @foreach($recommendedArticles as $item)
                            <div class="flex gap-3 items-start">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                         alt="{{ $item->judul }}" 
                                         class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                                        <i class="fa-regular fa-image text-sm"></i>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('guest.artikel.detail', $item->slug) }}" 
                                       class="font-bold text-gray-800 hover:text-blue-600 transition line-clamp-2 text-xs block mb-1">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="flex flex-wrap items-center gap-x-2 text-xs text-gray-400">
                                        <span><i class="fa-regular fa-eye text-blue-400"></i> {{ number_format($item->views) }}</span>
                                        <span><i class="fa-regular fa-calendar text-blue-400"></i> {{ $item->published_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if(!$loop->last) <hr class="my-1 border-gray-100"> @endif
                            @endforeach
                        @else
                            <p class="text-gray-500 text-sm">Belum ada rekomendasi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center lg:text-left">
            <a href="{{ route('guest.artikel.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke daftar artikel
            </a>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Tautan berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.prose li').forEach(li => {
            li.removeAttribute('data-value');
            li.removeAttribute('value');
        });
        document.querySelectorAll('.prose ol').forEach(ol => {
            ol.removeAttribute('start');
            ol.style.counterReset = 'list-item';
        });
        const style = document.createElement('style');
        style.textContent = `
            .prose ol { counter-reset: list-item !important; }
            .prose ol li { counter-increment: list-item !important; }
            .prose ol li::before { content: counter(list-item) ". " !important; }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection