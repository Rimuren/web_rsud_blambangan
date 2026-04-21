@extends('layouts.app')

@section('title', 'Tambah Foto Dokumentasi')

@section('content')
@can('create foto')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Tambah Foto Baru</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Upload foto dokumentasi rumah sakit.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
            <form action="{{ route('admin.dokumentasi.foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="px-6 py-6 space-y-5">
                    {{-- Judul --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">Judul Foto <span class="text-red-500">*</span></flux:label>
                        <flux:input id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Ruang ICU" required />
                        @error('judul') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Upload Gambar + Preview --}}
                    <div class="space-y-1.5">
                        <flux:label for="gambar">Upload Gambar <span class="text-red-500">*</span></flux:label>
                        
                        {{-- Area upload (drag & click) --}}
                        <label for="gambar" id="upload-area" class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-zinc-200 dark:border-zinc-600 rounded-xl py-10 px-4 text-center cursor-pointer hover:border-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-all">
                            <div class="w-11 h-11 rounded-full bg-white dark:bg-zinc-700 border border-zinc-200 dark:border-zinc-600 flex items-center justify-center">
                                <flux:icon name="photo" class="text-zinc-400 w-5 h-5" />
                            </div>
                            <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Klik untuk upload atau drag and drop</p>
                            <p class="text-xs text-zinc-400">JPG, JPEG, PNG (maks. 2MB)</p>
                        </label>

                        {{-- Preview gambar --}}
                        <div id="preview-container" class="hidden mt-3">
                            <img id="image-preview" class="rounded-xl border border-zinc-200 dark:border-zinc-700 max-h-48 w-auto object-cover" alt="Preview foto">
                            <button type="button" id="remove-preview" class="text-xs text-red-500 mt-2 hover:underline">Hapus preview</button>
                        </div>

                        <input type="file" id="gambar" name="gambar" accept=".png,.jpg,.jpeg" class="hidden" required />
                        @error('gambar') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-1.5">
                        <flux:label for="kategori">Kategori</flux:label>
                        <flux:select id="kategori" name="kategori">
                            <flux:select.option value="">-- Pilih kategori --</flux:select.option>
                            <flux:select.option value="ruang_perawatan">Ruang Perawatan</flux:select.option>
                            <flux:select.option value="fasilitas">Fasilitas</flux:select.option>
                            <flux:select.option value="tenaga_medis">Tenaga Medis</flux:select.option>
                            <flux:select.option value="kegiatan">Kegiatan</flux:select.option>
                            <flux:select.option value="lainnya">Lainnya</flux:select.option>
                        </flux:select>
                        @error('kategori') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-1.5">
                        <flux:label for="deskripsi">Deskripsi Foto</flux:label>
                        <flux:textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsikan foto ini...">{{ old('deskripsi') }}</flux:textarea>
                        @error('deskripsi') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                    <flux:button as="a" href="{{ route('admin.dokumentasi.foto.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary" icon="check">Simpan Foto</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Elemen DOM
    const fileInput = document.getElementById('gambar');
    const uploadArea = document.getElementById('upload-area');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removePreviewBtn = document.getElementById('remove-preview');

    // Saat file dipilih
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Validasi tipe file (opsional, karena sudah di html)
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                alert('Format file harus JPG, JPEG, atau PNG.');
                fileInput.value = ''; // reset input
                hidePreview();
                return;
            }
            // Validasi ukuran (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB.');
                fileInput.value = '';
                hidePreview();
                return;
            }

            // Tampilkan preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                // Sembunyikan teks "Klik untuk upload" agar lebih rapi (opsional)
                // uploadArea.classList.add('opacity-50');
            };
            reader.readAsDataURL(file);
        } else {
            hidePreview();
        }
    });

    // Hapus preview dan reset input file
    function hidePreview() {
        previewContainer.classList.add('hidden');
        imagePreview.src = '';
        fileInput.value = '';
        // uploadArea.classList.remove('opacity-50');
    }

    removePreviewBtn.addEventListener('click', function() {
        hidePreview();
    });

    // Optional: Drag and drop support sederhana
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/20');
    });
    uploadArea.addEventListener('dragleave', (e) => {
        uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/20');
    });
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/20');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            fileInput.files = e.dataTransfer.files;
            // trigger change event
            const changeEvent = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(changeEvent);
        } else {
            alert('Harap drop file gambar (JPG, JPEG, PNG).');
        }
    });
</script>
@endcan
@endsection