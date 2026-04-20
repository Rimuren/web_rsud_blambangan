@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white">Edit Video</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Ubah informasi video YouTube.</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
            <form action="{{ route('admin.dokumentasi.video.update', $video) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="px-6 py-6 space-y-5">
                    {{-- Judul --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">Judul Video <span class="text-red-500">*</span></flux:label>
                        <flux:input id="judul" name="judul" value="{{ old('judul', $video->judul) }}" required />
                        @error('judul') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Link YouTube --}}
                    <div class="space-y-1.5">
                        <flux:label for="link">Link YouTube <span class="text-red-500">*</span></flux:label>
                        <flux:input id="link" name="link" value="{{ old('link', $video->link) }}" required />
                        @error('link') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Preview thumbnail --}}
                    <div id="preview-area" class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-xl space-y-3">
                        <p class="text-sm font-medium">Thumbnail Saat Ini:</p>
                        <img id="thumbnail-preview" class="w-48 h-32 object-cover rounded-lg border border-zinc-200" src="{{ $video->thumbnail }}" alt="thumbnail">
                        <p class="text-xs text-zinc-400">Thumbnail akan diperbarui otomatis jika link diubah.</p>
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-1.5">
                        <flux:label for="kategori">Kategori</flux:label>
                        <flux:select id="kategori" name="kategori">
                            <option value="">-- Pilih kategori --</option>
                            <option value="profil" {{ old('kategori', $video->kategori) == 'profil' ? 'selected' : '' }}>Profil Rumah Sakit</option>
                            <option value="layanan" {{ old('kategori', $video->kategori) == 'layanan' ? 'selected' : '' }}>Layanan Medis</option>
                            <option value="edukasi" {{ old('kategori', $video->kategori) == 'edukasi' ? 'selected' : '' }}>Edukasi Kesehatan</option>
                            <option value="kegiatan" {{ old('kategori', $video->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="testimoni" {{ old('kategori', $video->kategori) == 'testimoni' ? 'selected' : '' }}>Testimoni Pasien</option>
                        </flux:select>
                        @error('kategori') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-1.5">
                        <flux:label for="deskripsi">Deskripsi</flux:label>
                        <flux:textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $video->deskripsi) }}</flux:textarea>
                        @error('deskripsi') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                </div>

                <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                    <flux:button as="a" href="{{ route('admin.dokumentasi.video.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary" icon="check">Update Video</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const linkInput = document.getElementById('link');
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
        }
    }

    linkInput.addEventListener('input', updatePreview);
</script>
@endsection