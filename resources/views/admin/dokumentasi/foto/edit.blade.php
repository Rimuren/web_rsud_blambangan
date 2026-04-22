@extends('layouts.app')

@section('title', 'Edit Foto')

@section('content')
@can('foto.update')

<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white">
                Edit Foto
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">
                Ubah informasi foto dokumentasi.
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">

            <form
                action="{{ route('admin.dokumentasi.foto.update', $photo) }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="px-6 py-6 space-y-5">

                    {{-- JUDUL --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">
                            Judul Foto <span class="text-red-500">*</span>
                        </flux:label>

                        <flux:input
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $photo->judul) }}"
                            required />

                        @error('judul')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- PREVIEW --}}
                    <div class="space-y-1.5">
                        <flux:label>Gambar Saat Ini</flux:label>

                        <div class="flex items-center gap-3 p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-xl">
                            <img
                                src="{{ asset('storage/' . $photo->gambar) }}"
                                class="w-20 h-20 object-cover rounded-lg">
                            <div class="text-sm text-zinc-600 dark:text-zinc-300 break-all">
                                {{ $photo->gambar }}
                            </div>
                        </div>
                    </div>

                    {{-- UPLOAD --}}
                    <div class="space-y-1.5">
                        <flux:label for="gambar">Ganti Gambar</flux:label>

                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept=".png,.jpg,.jpeg"
                            class="block w-full text-sm text-zinc-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-full file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100" />

                        @error('gambar')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="space-y-1.5">
                        <flux:label for="kategori">Kategori</flux:label>

                        <flux:select id="kategori" name="kategori">
                            <option value="">-- Pilih kategori --</option>

                            @foreach ([
                            'ruang_perawatan' => 'Ruang Perawatan',
                            'fasilitas' => 'Fasilitas',
                            'tenaga_medis' => 'Tenaga Medis',
                            'kegiatan' => 'Kegiatan',
                            'lainnya' => 'Lainnya'
                            ] as $value => $label)
                            <option value="{{ $value }}" {{ $photo->kategori == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </flux:select>

                        @error('kategori')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="space-y-1.5">
                        <flux:label for="deskripsi">Deskripsi</flux:label>

                        <flux:textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4">{{ old('deskripsi', $photo->deskripsi) }}</flux:textarea>

                        @error('deskripsi')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="px-6 py-4 flex justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                    <flux:button
                        as="a"
                        href="{{ route('admin.dokumentasi.foto.index') }}"
                        variant="ghost">
                        Batal
                    </flux:button>

                    <flux:button type="submit" variant="primary" icon="check">
                        Update Foto
                    </flux:button>
                </div>

            </form>
        </div>
    </div>
</div>

@endcan
@endsection