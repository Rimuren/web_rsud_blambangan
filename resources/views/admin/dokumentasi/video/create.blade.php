@extends('layouts.app')

@section('title', 'Tambah Video')

@section('content')
@can('video.create')

<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white">
                Tambah Video
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">
                Masukkan link YouTube, thumbnail akan otomatis diambil.
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">

            <form action="{{ route('admin.dokumentasi.video.store') }}" method="POST">
                @csrf

                <div class="px-6 py-6 space-y-5">

                    {{-- JUDUL --}}
                    <div class="space-y-1.5">
                        <flux:label for="judul">
                            Judul Video <span class="text-red-500">*</span>
                        </flux:label>

                        <flux:input
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Contoh: Profil Rumah Sakit"
                            required />

                        @error('judul')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- LINK --}}
                    <div class="space-y-1.5">
                        <flux:label for="link">
                            Link YouTube <span class="text-red-500">*</span>
                        </flux:label>

                        <flux:input
                            id="link"
                            name="link"
                            value="{{ old('link') }}"
                            placeholder="https://youtu.be/... atau https://youtube.com/watch?v=..."
                            required />

                        @error('link')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- PREVIEW --}}
                    <div id="preview-area" class="hidden p-4 bg-zinc-50 dark:bg-zinc-900 rounded-xl space-y-3">
                        <p class="text-sm font-medium">Preview Thumbnail:</p>

                        <img
                            id="thumbnail-preview"
                            class="w-48 h-32 object-cover rounded-lg border border-zinc-200"
                            alt="thumbnail preview">

                        <p class="text-xs text-zinc-400">
                            Thumbnail akan disimpan otomatis dari YouTube.
                        </p>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="space-y-1.5">
                        <flux:label for="deskripsi">Deskripsi</flux:label>

                        <flux:textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            placeholder="Deskripsi singkat...">{{ old('deskripsi') }}</flux:textarea>

                        @error('deskripsi')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="px-6 py-4 flex justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                    <flux:button
                        as="a"
                        href="{{ route('admin.dokumentasi.video.index') }}"
                        variant="ghost">
                        Batal
                    </flux:button>

                    <flux:button type="submit" variant="primary" icon="check">
                        Simpan Video
                    </flux:button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
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
            thumbnailImg.src = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
            previewArea.classList.remove('hidden');
        } else {
            previewArea.classList.add('hidden');
            thumbnailImg.src = '';
        }
    }

    linkInput.addEventListener('input', updatePreview);
    if (linkInput.value) updatePreview();
</script>

@endcan
@endsection