@extends('layouts.app')

@section('title', 'Tambah Foto')

@section('content')

@can('foto.create')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white">
                Tambah Foto
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">
                Upload foto dokumentasi rumah sakit.
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">

            <form
                action="{{ route('admin.dokumentasi.foto.store') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="px-6 py-6 space-y-5">

                    {{-- JUDUL --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">
                            Judul Foto <span class="text-red-500">*</span>
                        </flux:label>

                        <flux:input
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Contoh: Ruang ICU"
                            required />

                        @error('judul')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- UPLOAD --}}
                    <div class="space-y-1.5">
                        <flux:label for="gambar">
                            Upload Gambar <span class="text-red-500">*</span>
                        </flux:label>

                        {{-- AREA --}}
                        <label
                            for="gambar"
                            id="upload-area"
                            class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-zinc-200 dark:border-zinc-600 rounded-xl py-10 px-4 text-center cursor-pointer hover:border-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition">
                            <flux:icon name="photo" class="w-5 h-5 text-zinc-400" />

                            <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Klik atau drag file
                            </p>

                            <p class="text-xs text-zinc-400">
                                JPG, JPEG, PNG (maks 2MB)
                            </p>
                        </label>

                        {{-- PREVIEW --}}
                        <div id="preview-container" class="hidden mt-3 space-y-2">
                            <img
                                id="image-preview"
                                class="rounded-xl border border-zinc-200 max-h-48 object-cover">

                            <button
                                type="button"
                                id="remove-preview"
                                class="text-xs text-red-500 hover:underline">
                                Hapus preview
                            </button>
                        </div>

                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept=".png,.jpg,.jpeg"
                            class="hidden"
                            required />

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
                            <option value="{{ $value }}">{{ $label }}</option>
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
                            rows="4"
                            placeholder="Deskripsikan foto...">{{ old('deskripsi') }}</flux:textarea>

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
                        Simpan Foto
                    </flux:button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const fileInput = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeBtn = document.getElementById('remove-preview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];

        if (!file) return hidePreview();

        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Format harus JPG, JPEG, PNG');
            return hidePreview();
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Maksimal 2MB');
            return hidePreview();
        }

        const reader = new FileReader();
        reader.onload = e => {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    function hidePreview() {
        previewContainer.classList.add('hidden');
        imagePreview.src = '';
        fileInput.value = '';
    }

    removeBtn.addEventListener('click', hidePreview);
</script>

@endcan
@endsection