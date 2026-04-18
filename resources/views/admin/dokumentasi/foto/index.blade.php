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

    {{-- Table Card --}}
    <flux:card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider w-48">Foto</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Informasi & Deskripsi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($fotos as $foto)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <img src="{{ $foto->gambar ? asset('storage/' . $foto->gambar) : asset('images/placeholder.jpg') }}" 
                                     alt="{{ $foto->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-200">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-base">{{ $foto->judul }}</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    <span>{{ basename($foto->gambar) }}</span>
                                    <flux:icon name="image" variant="micro" class="w-3 h-3" />
                                    <span class="capitalize">{{ $foto->kategori }}</span>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                {{ $foto->deskripsi }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('admin.dokumentasi.foto.edit', $foto) }}" class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </a>
                                <form action="{{ route('admin.dokumentasi.foto.destroy', $foto) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                        <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-zinc-500 dark:text-zinc-400">
                            <flux:icon name="image" class="w-12 h-12 mx-auto mb-4 opacity-50" />
                            <p class="text-lg font-medium">Belum ada foto dokumentasi</p>
                            <flux:button as="a" href="{{ route('admin.dokumentasi.foto.create') }}" variant="primary" class="mt-4">
                                Tambah Foto Pertama
                            </flux:button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800">
            {{ $fotos->links() }}
        </div>
    </flux:card>
</div>
@endsection