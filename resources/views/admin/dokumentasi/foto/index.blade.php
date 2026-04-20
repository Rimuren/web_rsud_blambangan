@extends('layouts.app')

@section('title', 'Manajemen Dokumentasi Foto')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Dokumentasi</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola galeri foto dan video rumah sakit untuk konten dokumentasi.</p>
        </div>
        <flux:button as="a" href="{{ route('admin.dokumentasi.foto.create') }}" variant="primary" size="lg" class="shadow-lg">
            <flux:icon name="plus" class="w-5 h-5" />
            Tambah Foto
        </flux:button>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-zinc-200 dark:border-zinc-800 mb-8">
        <div class="-mb-px flex space-x-8">
            <flux:button as="a" href="{{ route('admin.dokumentasi.foto.index') }}" variant="ghost" size="sm" class="pb-4 text-sm font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 whitespace-nowrap flex items-center gap-2">
                <flux:icon name="image" class="w-4 h-4" />
                Foto
            </flux:button>
            <flux:button as="a" href="{{ route('admin.dokumentasi.video.index') }}" variant="ghost" size="sm" class="pb-4 text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300 border-b-2 border-transparent hover:border-zinc-300 dark:hover:border-zinc-600 whitespace-nowrap flex items-center gap-2 transition-colors">
                <flux:icon name="video" class="w-4 h-4" />
                Video
            </flux:button>
        </div>
    </div>

    {{-- Filter Form (seperti form pencarian) --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.dokumentasi.foto.index') }}" class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end">
                {{-- Keyword Search --}}
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-1.5">Cari Foto</label>
                    <flux:input name="search" value="{{ request('search') }}" placeholder="Judul atau deskripsi..." class="w-full" />
                </div>
                {{-- Kategori Filter --}}
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-1.5">Kategori</label>
                    <flux:select name="kategori" value="{{ request('kategori') }}" class="w-full">
                        <option value="">Semua Kategori</option>
                        <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="fasilitas" {{ request('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="dokter" {{ request('kategori') == 'dokter' ? 'selected' : '' }}>Dokter & Staff</option>
                        <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </flux:select>
                </div>
                {{-- Action Buttons --}}
                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary" class="flex-1 justify-center">
                        <flux:icon name="magnifying-glass" class="w-4 h-4" />
                        Filter
                    </flux:button>
                    <flux:button as="a" href="{{ route('admin.dokumentasi.foto.index') }}" variant="ghost" class="flex-1 justify-center">
                        Reset
                    </flux:button>
                </div>
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <flux:card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/60">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wider w-48">Foto</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wider">Informasi & Deskripsi</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wider w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800 bg-white dark:bg-zinc-900">
                    @forelse($fotos as $foto)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40 transition duration-150">
                        <td class="px-6 py-4 align-top whitespace-nowrap">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-800 relative overflow-hidden shadow-sm">
                                <img src="{{ $foto->gambar ? asset('storage/' . $foto->gambar) : asset('images/placeholder.jpg') }}" 
                                     alt="{{ $foto->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover hover:scale-105 transition duration-300">
                            </div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="space-y-1.5">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-base">{{ $foto->judul }}</h3>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs">
                                    <span class="inline-flex items-center gap-1 text-zinc-500 dark:text-zinc-400">
                                        <flux:icon name="document-text" variant="micro" class="w-3.5 h-3.5" />
                                        {{ basename($foto->gambar) }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium">
                                        <flux:icon name="tag" variant="micro" class="w-3 h-3" />
                                        {{ ucfirst($foto->kategori) }}
                                    </span>
                                </div>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed line-clamp-2">
                                    {{ $foto->deskripsi ?: 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4 align-top whitespace-nowrap">
                            <div class="flex justify-end items-center gap-1">
                                <a href="{{ route('admin.dokumentasi.foto.edit', $foto) }}" 
                                   class="p-2 rounded-lg text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition"
                                   title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5" />
                                </a>
                                <form action="{{ route('admin.dokumentasi.foto.destroy', $foto) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 rounded-lg text-zinc-500 hover:text-red-600 dark:text-zinc-400 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                            title="Hapus">
                                        <flux:icon name="trash" class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <flux:icon name="image" class="w-14 h-14 text-zinc-400 dark:text-zinc-600" />
                                <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium">Belum ada foto dokumentasi</p>
                                <flux:button as="a" href="{{ route('admin.dokumentasi.foto.create') }}" variant="primary" size="sm" class="mt-2">
                                    Tambah Foto Pertama
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($fotos->hasPages())
        <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30">
            {{ $fotos->links() }}
        </div>
        @endif
    </flux:card>
</div>
@endsection