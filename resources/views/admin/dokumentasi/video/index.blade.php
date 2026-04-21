@extends('layouts.app')

@section('title', 'Manajemen Dokumentasi Video')

@section('content')
@can('view daftar-video')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header Section --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Daftar Galeri Video</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola galeri video dokumentasi rumah sakit.</p>
            </div>
            @can('create video')
            <flux:button as="a" href="{{ route('admin.dokumentasi.video.create') }}" variant="primary" icon="plus">
                Tambah Video
            </flux:button>
            @endcan
        </div>

        {{-- Table Card --}}
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/80">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700">
                        @forelse ($videos as $video)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 align-top">
                                <img src="{{ $video->thumbnail }}" class="w-24 h-16 object-cover rounded-md bg-zinc-100 dark:bg-zinc-700" alt="thumbnail">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-zinc-900 dark:text-white">{{ $video->judul }}</div>
                                <div class="flex items-center gap-1 mt-1 text-xs text-blue-600 dark:text-blue-400">
                                    {{ Str::limit($video->link, 50) }}
                                    <flux:icon name="link" variant="micro" class="w-3 h-3" />
                                </div>
                            </td>
                            <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                                {{ $video->kategori ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                                {{ $video->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center gap-2 justify-end">
                                    @can('edit video')
                                    <flux:button as="a" href="{{ route('admin.dokumentasi.video.edit', $video) }}" size="sm" variant="ghost" class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg">
                                        <flux:icon name="pencil" class="w-5 h-5" />
                                    </flux:button>
                                    @endcan

                                    @can('delete video')
                                    <form action="{{ route('admin.dokumentasi.video.destroy', $video) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus video ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="danger" class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg">
                                            <flux:icon name="trash" class="w-5 h-5" />
                                        </flux:button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-400">
                                Belum ada video.
                                @can('create video') 
                                <a href="{{ route('admin.dokumentasi.video.create') }}" class="text-blue-600 hover:underline">Tambah video pertama</a>
                                @endcan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($videos->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                {{ $videos->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endcan
@endsection