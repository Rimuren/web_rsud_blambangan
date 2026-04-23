<div class="space-y-6">
    <div class="space-y-2">
        <flux:label for="nama">Nama Iklan <span class="text-red-500">*</span></flux:label>
        <flux:input id="nama" name="nama" value="{{ old('nama', $iklan->nama ?? '') }}" placeholder="Contoh: Promo Layanan MCU" required />
        @error('nama')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </div>

    <div class="space-y-2">
        <flux:label for="gambar">Gambar Iklan {{ isset($iklan) ? '(opsional)' : '' }} <span class="text-red-500">{{ isset($iklan) ? '' : '*' }}</span></flux:label>
        <input type="file" id="gambar" name="gambar" accept=".png,.jpg,.jpeg,.webp" class="block w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-600 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300" {{ isset($iklan) ? '' : 'required' }} />
        @error('gambar')
            <flux:error>{{ $message }}</flux:error>
        @enderror

        @php
            $previewGambar = isset($iklan) && $iklan->gambar ? asset('storage/' . $iklan->gambar) : null;
        @endphp

        <div
            id="gambar-preview-wrapper"
            data-existing-src="{{ $previewGambar ?? '' }}"
            class="mt-3 overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50 p-3 dark:border-zinc-700 dark:bg-zinc-800/60 {{ $previewGambar ? '' : 'hidden' }}">
            <img
                id="gambar-preview"
                src="{{ $previewGambar ?? '' }}"
                alt="{{ old('nama', $iklan->nama ?? 'Preview gambar iklan') }}"
                class="h-40 w-full rounded-xl object-cover md:h-52" />
            <p id="gambar-preview-name" class="mt-3 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                {{ $previewGambar ? 'Gambar saat ini' : 'Belum ada gambar dipilih' }}
            </p>
        </div>
        <p id="gambar-preview-empty" class="text-sm text-zinc-500 dark:text-zinc-400 {{ $previewGambar ? 'hidden' : '' }}">
            Preview gambar akan muncul di sini setelah file dipilih.
        </p>
    </div>

    <div class="space-y-2">
        <flux:label for="deskripsi">Deskripsi Iklan</flux:label>
        <flux:textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Isi pesan atau deskripsi singkat untuk popup iklan...">{{ old('deskripsi', $iklan->deskripsi ?? '') }}</flux:textarea>
        @error('deskripsi')
            <flux:error>{{ $message }}</flux:error>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="space-y-2">
            <flux:label for="cta_label">Teks Tombol Aksi</flux:label>
            <flux:input id="cta_label" name="cta_label" value="{{ old('cta_label', $iklan->cta_label ?? '') }}" placeholder="Contoh: Lihat Detail" />
            @error('cta_label')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div class="space-y-2">
            <flux:label for="cta_url">Link Tombol Aksi</flux:label>
            <flux:input id="cta_url" name="cta_url" value="{{ old('cta_url', $iklan->cta_url ?? '') }}" placeholder="https://..." />
            @error('cta_url')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>
    </div>

    <div class="rounded-2xl border border-sky-200 bg-sky-50/80 p-4 text-sm text-sky-800 dark:border-sky-900/60 dark:bg-sky-950/40 dark:text-sky-200">
        <div class="flex items-start gap-3">
            <flux:icon name="information-circle" class="mt-0.5 h-5 w-5 shrink-0" />
            <div>
                Gunakan judul singkat, deskripsi 1-2 kalimat, dan tombol aksi yang jelas seperti `Lihat Detail` atau `Daftar Sekarang`. Jika tombol aksi tidak diperlukan, biarkan kolom tombol kosong.
            </div>
        </div>
    </div>

    <div class="space-y-2">
        <flux:label for="is_active">Status Tampil</flux:label>
        <label class="flex items-center gap-3 rounded-2xl border border-zinc-200 px-4 py-3 text-sm text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">
            <input
                id="is_active"
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $iklan->is_active ?? true))
                class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500">
            <span>Aktifkan iklan ini untuk popup home page</span>
        </label>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputGambar = document.getElementById('gambar');
        const previewWrapper = document.getElementById('gambar-preview-wrapper');
        const previewImage = document.getElementById('gambar-preview');
        const previewEmpty = document.getElementById('gambar-preview-empty');
        const previewName = document.getElementById('gambar-preview-name');
        const existingImage = previewWrapper?.dataset.existingSrc || '';
        let objectUrl = null;

        if (!inputGambar || !previewWrapper || !previewImage || !previewEmpty || !previewName) {
            return;
        }

        const showPreview = function (src, altText, label) {
            previewImage.src = src;
            previewImage.alt = altText;
            previewName.textContent = label;
            previewWrapper.classList.remove('hidden');
            previewEmpty.classList.add('hidden');
        };

        const hidePreview = function () {
            previewImage.removeAttribute('src');
            previewImage.alt = 'Preview gambar iklan';
            previewName.textContent = 'Belum ada gambar dipilih';
            previewWrapper.classList.add('hidden');
            previewEmpty.classList.remove('hidden');
        };

        inputGambar.addEventListener('change', function (event) {
            const [file] = event.target.files || [];

            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }

            if (!file) {
                if (existingImage) {
                    showPreview(existingImage, '{{ old('nama', $iklan->nama ?? 'Preview gambar iklan') }}', 'Gambar saat ini');
                } else {
                    hidePreview();
                }

                return;
            }

            objectUrl = URL.createObjectURL(file);
            showPreview(objectUrl, file.name, 'File dipilih: ' + file.name);
        });
    });
</script>
