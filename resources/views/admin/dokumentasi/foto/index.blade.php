@extends('layouts.app')

@section('title', 'Manajemen Dokumentasi Foto')

@section('content')
@can('foto.view')
<div class="p-4 md:p-6 lg:p-8">

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">
                Manajemen Dokumentasi
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">
                Kelola galeri foto dan video rumah sakit.
            </p>
        </div>

        @can('foto.create')
        <flux:button
            as="a"
            href="{{ route('admin.dokumentasi.foto.create') }}"
            variant="primary"
            size="lg">
            <flux:icon name="plus" class="w-5 h-5" />
            Tambah Foto
        </flux:button>
        @endcan
    </div>

    {{-- TAB --}}
    <div class="border-b border-zinc-200 dark:border-zinc-800 mb-8">
        <div class="flex space-x-8 -mb-px">
            <flux:button
                as="a"
                href="{{ route('admin.dokumentasi.foto.index') }}"
                variant="ghost"
                size="sm"
                class="pb-4 text-blue-600 border-b-2 border-blue-600 flex items-center gap-2">
                <flux:icon name="image" class="w-4 h-4" />
                Foto
            </flux:button>

            <flux:button
                as="a"
                href="{{ route('admin.dokumentasi.video.index') }}"
                variant="ghost"
                size="sm"
                class="pb-4 text-zinc-500 border-b-2 border-transparent flex items-center gap-2">
                <flux:icon name="video" class="w-4 h-4" />
                Video
            </flux:button>
        </div>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="mb-6">
        <div class="bg-white dark:bg-zinc-900 border rounded-xl p-5 grid md:grid-cols-3 gap-5">

            <flux:input
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul atau deskripsi..." />

            <flux:select name="kategori">
                <option value="">Semua Kategori</option>
                <option value="kegiatan">Kegiatan</option>
                <option value="fasilitas">Fasilitas</option>
                <option value="dokter">Dokter & Staff</option>
                <option value="lainnya">Lainnya</option>
            </flux:select>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" class="flex-1">
                    Filter
                </flux:button>

                <flux:button
                    as="a"
                    href="{{ route('admin.dokumentasi.foto.index') }}"
                    variant="ghost"
                    class="flex-1">
                    Reset
                </flux:button>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <flux:card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y">

                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left">Foto</th>
                        <th class="px-6 py-4 text-left">Informasi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($photos as $photo)
                    <tr class="hover:bg-zinc-50">

                        {{-- IMAGE --}}
                        <td class="px-6 py-4">
                            <img
                                src="{{ asset('storage/'.$photo->gambar) }}"
                                class="w-36 rounded-lg">
                        </td>

                        {{-- INFO --}}
                        <td class="px-6 py-4">
                            <div class="font-bold">{{ $photo->judul }}</div>
                            <div class="text-sm text-zinc-500">
                                {{ $photo->deskripsi ?? '-' }}
                            </div>
                        </td>

                        {{-- ACTION --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">

                                @can('foto.update')
                                <a href="{{ route('admin.dokumentasi.foto.edit', $photo) }}">
                                    Edit
                                </a>
                                @endcan

                                @can('foto.delete')
                                <form method="POST" action="{{ route('admin.dokumentasi.foto.destroy', $photo) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Hapus</button>
                                </form>
                                @endcan

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-10">
                            Belum ada foto
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{ $photos->links() }}
    </flux:card>

</div>
@endcan
@endsection