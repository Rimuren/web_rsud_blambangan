@extends('layouts.app')

@section('title', 'Tambah Video')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white">Tambah Video Baru</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Masukkan link YouTube, thumbnail akan otomatis diambil.</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
            <form action="{{ route('admin.dokumentasi.video.store') }}" method="POST">
                @csrf

                <div class="px-6 py-6 space-y-5">
                    {{-- Judul --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">Judul Video <span class="text-red-500">*</span></flux:label>
                        <flux:input id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Profil Rumah Sakit" required />
                        @error('judul') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Link YouTube --}}
                    <div class="space-y-1.5">
                        <flux:label for="link">Link YouTube <span class="text-red-500">*</span></flux:label>
                        <flux:input id="link" name="link" value="{{ old('link') }}" placeholder="https://youtu.be/... atau https://www.youtube.com/watch?v=..." required />
                        @error('link') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Preview thumbnail & video ID (live preview) --}}
                    <div id="preview-area" class="hidden p-4 bg-zinc-50 dark:bg-zinc-900 rounded-xl space-y-3">
                        <p class="text-sm font-medium">Preview Thumbnail:</p>
                        <img id="thumbnail-preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200" src="" alt="thumbnail preview">
                        <p class="text-xs text-zinc-400">Thumbnail akan disimpan otomatis dari YouTube.</p>
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-1.5">
                        <flux:label for="kategori">Kategori</flux:label>
                        <flux:select id="kategori" name="kategori">
                            <flux:select.option value="">-- Pilih kategori --</flux:select.option>
                            <flux:select.option value="profil">Profil Rumah Sakit</flux:select.option>
                            <flux:select.option value="layanan">Layanan Medis</flux:select.option>
                            <flux:select.option value="edukasi">Edukasi Kesehatan</flux:select.option>
                            <flux:select.option value="kegiatan">Kegiatan</flux:select.option>
                            <flux:select.option value="testimoni">Testimoni Pasien</flux:select.option>
                        </flux:select>
                        @error('kategori') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-1.5">
                        <flux:label for="deskripsi">Deskripsi</flux:label>
                        <flux:textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi singkat tentang video...">{{ old('deskripsi') }}</flux:textarea>
                        @error('deskripsi') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                </div>

                <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                    <flux:button as="a" href="{{ route('admin.dokumentasi.video.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary" icon="check">Simpan Video</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const linkInput = document.getElementById('link');
    const previewArea = document.getElementById('preview-area');
    const thumbnailImg = document.getElementById('thumbnail-preview');

    function extractYouTubeId(url) {
        const patterns = [
            /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/,
            /youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/
        ];
        for (let pattern of patterns) {
            const match = url.match(pattern);
            if (match) return match[1];
        }
        return null;
    }

    function updatePreview() {
        const url = linkInput.value.trim();
        const videoId = extractYouTubeId(url);
        if (videoId) {
            const thumbUrl = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
            thumbnailImg.src = thumbUrl;
            previewArea.classList.remove('hidden');
        } else {
            previewArea.classList.add('hidden');
            thumbnailImg.src = '';
        }
    }

    linkInput.addEventListener('input', updatePreview);
    // Trigger once if old value exists
    if (linkInput.value) updatePreview();
</script>
@endsection