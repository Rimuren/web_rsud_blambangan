@extends('layouts.app')

@section('title', 'Detail Artikel')

@section('content')

<div class="max-w-3xl mx-auto py-8 px-4">

    {{-- Back Button --}}
    <div class="mb-6">
        <flux:button href="{{ route('artikel.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Kembali ke Daftar Artikel
        </flux:button>
    </div>

    {{-- Article Card --}}
    <flux:card class="overflow-hidden p-0">

        {{-- Hero Image --}}
        <div class="w-full h-72 bg-zinc-100 overflow-hidden">
            <img
                src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : 'https://placehold.co/800x300/e2e8f0/94a3b8?text=Tidak+Ada+Gambar' }}"
                alt="{{ $artikel->judul }}"
                class="w-full h-full object-cover"
            />
        </div>

        <div class="p-8">

            {{-- Category & Date --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="text-sm font-semibold text-teal-600">{{ $artikel->kategori ?? 'Umum' }}</span>
                <span class="text-zinc-300">·</span>
                <span class="text-sm text-zinc-400">
                    {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl font-bold text-zinc-900 leading-snug mb-5">
                {{ $artikel->judul }}
            </h1>

            {{-- Author --}}
            <div class="flex items-center gap-3 mb-7">
                <div class="w-10 h-10 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center">
                    <flux:icon name="user" class="w-5 h-5 text-zinc-400" />
                </div>
                <span class="text-sm font-semibold text-zinc-700">{{ $artikel->author ?? 'Admin' }}</span>
            </div>

            <flux:separator class="mb-7" />

            {{-- Article Body --}}
            <div class="prose prose-zinc max-w-none text-sm leading-relaxed text-zinc-700 mb-8">
                {!! $artikel->konten !!}
            </div>

            {{-- Tags --}}
            @if($artikel->tags)
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach(explode(',', $artikel->tags) as $tag)
                <span class="text-xs font-medium px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 border border-teal-200">
                    #{{ trim($tag) }}
                </span>
                @endforeach
            </div>
            @endif

            <flux:separator class="mb-6" />

            {{-- Admin Action Buttons --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <flux:button
                        href="{{ route('artikel.edit', $artikel->id) }}"
                        variant="primary"
                        icon="pencil-square"
                        size="sm"
                    >
                        Edit Artikel
                    </flux:button>

                    <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <flux:button
                            type="submit"
                            variant="danger"
                            icon="trash"
                            size="sm"
                        >
                            Hapus
                        </flux:button>
                    </form>
                </div>

                {{-- Status Badge --}}
                <div>
                    @if($artikel->status === 'published')
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-green-100 text-green-700 border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span>
                            Dipublikasikan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 inline-block"></span>
                            Draft
                        </span>
                    @endif
                </div>
            </div>

        </div>
    </flux:card>

    {{-- Recommended Articles --}}
    <div class="mt-12">

        {{-- Section Heading --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-6 h-1 rounded-full bg-orange-500"></div>
            <h2 class="text-xl font-bold text-zinc-800">Artikel Terkait</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @forelse($artikelTerkait as $item)
            <flux:card class="overflow-hidden p-0 hover:shadow-md transition-shadow">

                {{-- Thumbnail --}}
                <div class="w-full h-44 bg-zinc-100 overflow-hidden">
                    <img
                        src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://placehold.co/400x180/e2e8f0/94a3b8?text=No+Image' }}"
                        alt="{{ $item->judul }}"
                        class="w-full h-full object-cover"
                    />
                </div>

                <div class="p-4">

                    {{-- Category & Read Time --}}
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-teal-600 uppercase tracking-wider">
                            {{ $item->kategori ?? 'Umum' }}
                        </span>
                        <span class="text-xs text-zinc-400 flex items-center gap-1">
                            <flux:icon name="clock" class="w-3 h-3" />
                            {{ $item->read_time ?? '5' }} min read
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-sm font-bold text-zinc-800 leading-snug mb-2">
                        {{ $item->judul }}
                    </h3>

                    {{-- Excerpt --}}
                    <p class="text-xs text-zinc-500 leading-relaxed mb-4 line-clamp-2">
                        {{ Str::limit(strip_tags($item->konten), 100) }}
                    </p>

                    {{-- Read More --}}
                    <flux:button
                        href="{{ route('artikel.show', $item->id) }}"
                        variant="ghost"
                        size="xs"
                        icon-trailing="arrow-right"
                        class="!text-teal-600 !px-0 hover:!bg-transparent hover:!text-teal-800"
                    >
                        READ MORE
                    </flux:button>

                </div>
            </flux:card>
            @empty
            <div class="col-span-2 py-10 text-center text-zinc-400">
                <flux:icon name="document-text" class="w-10 h-10 mx-auto mb-2 opacity-30" />
                <p class="text-sm">Tidak ada artikel terkait.</p>
            </div>
            @endforelse
        </div>

    </div>

</div>

@endsection