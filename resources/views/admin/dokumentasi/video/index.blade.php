@extends('layouts.app')

@section('title', 'Manajemen Dokumentasi Video')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Daftar Galeri Video</h2>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola galeri video dokumentasi rumah sakit.</p>
        </div>
        <flux:button variant="primary">
            <flux:icon name="plus" class="size-5 mr-2" />
            Tambah Video
        </flux:button>
    </div>

    {{-- Table Card --}}
    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-800/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider w-48">Video</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Informasi & Deskripsi</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-black/20 to-black/30 flex items-center justify-center">
                                    <flux:icon name="play" class="w-12 h-12 text-white drop-shadow-2xl relative z-10 group-hover:scale-110 transition-transform duration-200" />
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-semibold text-zinc-900 dark:text-white text-base">Profil Fasilitas Rumah Sakit 2024</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    https://youtube.com/watch?v=dQw4w9WgXcQ
                                    <flux:icon name="link" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Video sinematik memperkenalkan fasilitas terbaru: gedung VIP, radiologi digital, ruang operasi hybrid.
                            </p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-black/20 to-black/30 flex items-center justify-center">
                                    <flux:icon name="play" class="w-12 h-12 text-white drop-shadow-2xl relative z-10 group-hover:scale-110 transition-transform duration-200" />
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-semibold text-zinc-900 dark:text-white text-base">Edukasi Cuci Tangan 6 Langkah</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    https://youtube.com/watch?v=v_abc123
                                    <flux:icon name="link" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Panduan lengkap WHO 6 langkah cuci tangan untuk pencegahan infeksi nosokomial di fasilitas kesehatan.
                            </p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-black/20 to-black/30 flex items-center justify-center">
                                    <flux:icon name="play" class="w-12 h-12 text-white drop-shadow-2xl relative z-10 group-hover:scale-110 transition-transform duration-200" />
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-semibold text-zinc-900 dark:text-white text-base">Testimoni Pasien Jantung Sukses</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    https://vimeo.com/99887766
                                    <flux:icon name="link" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Kisah nyata kesembuhan pasien jantung koroner setelah operasi bypass oleh tim kardiologi terdepan.
                            </p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center gap-2 justify-end">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

