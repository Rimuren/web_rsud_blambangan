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
    }
    .prose h1, .prose h2, .prose h3, .prose h4 {
        color: #1e3a8a;
        font-weight: 700;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
    }
    .prose p {
        margin-bottom: 1.25em;
        line-height: 1.75;
    }
    .prose ul, .prose ol {
        margin-left: 1.5em;
        margin-bottom: 1.25em;
    }
    .prose li {
        margin-bottom: 0.25em;
    }
    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 1.5em 0;
    }
    .prose blockquote {
        border-left: 4px solid #f97316;
        padding-left: 1.5em;
        font-style: italic;
        color: #4b5563;
        margin: 1.5em 0;
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
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="min-h-screen py-10 px-7 bg-[#e8f0f7]">
    <div class="max-w-7xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
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
                <li class="text-gray-700 font-medium truncate max-w-[200px] md:max-w-md">{{ $article->judul }}</li>
            </ol>
        </nav>

        {{-- Grid Utama: Konten (kiri) + Sidebar (kanan) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Kolom Kiri: Artikel Utama --}}
            <div class="lg:col-span-2">
                <article class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
                    {{-- Thumbnail --}}
                    @if($article->thumbnail)
                        <div class="w-full h-64 md:h-[420px] overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                                 alt="{{ $article->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="p-6 md:p-8">
                        {{-- Meta Informasi --}}
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-5 pb-5 border-b border-gray-100">
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
                        </div>

                        {{-- Judul --}}
                        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 leading-tight mb-6">
                            {{ $article->judul }}
                        </h1>

                        {{-- Konten Artikel --}}
                        <div class="prose prose-lg max-w-none text-gray-700">
                            {!! $article->konten !!}
                        </div>

                        {{-- Share Section --}}
                        <div class="border-t border-gray-200 mt-10 pt-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-medium text-gray-600">Bagikan:</span>
                                <div class="flex items-center gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-400 text-white hover:bg-sky-500 transition">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . ' ' . url()->current()) }}" 
                                       target="_blank" rel="noopener"
                                       class="w-9 h-9 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                    <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 transition"
                                            title="Salin tautan">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Artikel Terkait (tetap di bawah konten utama) --}}
                @if($relatedArticles->count())
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-blue-900 mb-5 flex items-center">
                        <i class="fa-regular fa-newspaper text-orange-500 mr-3"></i>
                        Artikel Terkait
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($relatedArticles as $related)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col h-full">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                     alt="{{ $related->judul }}" 
                                     class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-image text-3xl"></i>
                                </div>
                            @endif
                            <div class="p-4 flex flex-col flex-grow">
                                <span class="text-xs text-blue-600 font-medium mb-1">{{ $related->kategori->nama ?? '' }}</span>
                                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $related->judul }}</h3>
                                <p class="text-xs text-gray-500 mb-3">
                                    <i class="fa-regular fa-calendar mr-1"></i>{{ $related->published_at->format('d M Y') }}
                                </p>
                                <a href="{{ route('guest.artikel.detail', $related->slug) }}" 
                                   class="text-blue-600 text-sm font-medium hover:text-blue-800 mt-auto flex items-center gap-1">
                                    Baca <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- Kolom Kanan: Sidebar (Artikel Terbaru & Rekomendasi) --}}
            <div class="lg:col-span-1 space-y-8">
                {{-- Artikel Terbaru --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                        <i class="fa-regular fa-clock text-orange-500 mr-2"></i>
                        Artikel Terbaru
                    </h3>
                    <div class="space-y-4">
                        @forelse($latestArticles as $item)
                        <div class="flex gap-3">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('guest.artikel.detail', $item->slug) }}" 
                                   class="font-medium text-gray-800 hover:text-blue-600 transition line-clamp-2 text-sm">
                                    {{ $item->judul }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fa-regular fa-calendar mr-1"></i>{{ $item->published_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm">Belum ada artikel terbaru.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('guest.artikel.index') }}" 
                       class="inline-flex items-center text-blue-600 text-sm font-medium hover:text-blue-800 mt-4">
                        Lihat semua <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                {{-- Artikel Rekomendasi --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                        <i class="fa-regular fa-star text-orange-500 mr-2"></i>
                        Rekomendasi
                    </h3>
                    <div class="space-y-4">
                        @forelse($recommendedArticles as $item)
                        <div class="flex gap-3">
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('guest.artikel.detail', $item->slug) }}" 
                                   class="font-medium text-gray-800 hover:text-blue-600 transition line-clamp-2 text-sm">
                                    {{ $item->judul }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fa-regular fa-calendar mr-1"></i>{{ $item->published_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm">Belum ada rekomendasi.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-8 text-center lg:text-left">
            <a href="{{ route('guest.artikel.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
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
</script>
@endsection