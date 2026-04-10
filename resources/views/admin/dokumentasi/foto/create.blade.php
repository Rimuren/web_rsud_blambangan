<x-layouts::app.sidebar :title="'Tambah Foto'">
    <flux:main>
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                {{-- Header halaman --}}
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Tambah Foto</h1>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Lengkapi informasi foto dokumentasi.</p>
                </div>

                {{-- Form Card --}}
                <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <form action="#" method="POST" enctype="multipart/form-data" class="divide-y divide-zinc-100 dark:divide-zinc-700">
                        @csrf

                        {{-- Section: Informasi Foto --}}
                        <div class="px-6 py-6 space-y-5">
                            <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Informasi Foto</p>

                            {{-- Judul Foto --}}
                            <div class="space-y-1.5">
                                <flux:label for="judul_foto">
                                    Judul Foto <span class="text-red-500">*</span>
                                </flux:label>
                                <flux:input
                                    id="judul_foto"
                                    name="judul_foto"
                                    value="{{ old('judul_foto') }}"
                                    placeholder="Contoh: ruang perawatan"
                                    required />
                                @error('judul_foto')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>

                            {{-- Upload Foto --}}
                            <div class="space-y-1.5">
                                <flux:label for="foto">
                                    Upload Foto <span class="text-red-500">*</span>
                                </flux:label>

                                <label for="foto" class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-zinc-200 dark:border-zinc-600 rounded-xl py-10 px-4 text-center cursor-pointer hover:border-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-all">
                                    <div class="w-11 h-11 rounded-full bg-white dark:bg-zinc-700 border border-zinc-200 dark:border-zinc-600 flex items-center justify-center">
                                        <flux:icon name="photo" class="text-zinc-400 w-5 h-5" />
                                    </div>
                                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Klik untuk upload atau drag and drop</p>
                                    <p class="text-xs text-zinc-400">PNG, JPG, JPEG hingga 5MB</p>
                                </label>
                                <input type="file" id="foto" name="foto" accept=".png,.jpg,.jpeg" class="hidden" />

                                <div class="flex gap-2 mt-2 flex-wrap">
                                    @foreach(['PNG', 'JPG', 'JPEG', 'Maks. 5MB'] as $badge)
                                        <span class="text-xs px-2.5 py-1 rounded-full bg-zinc-100 dark:bg-zinc-700 text-zinc-500 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-600">{{ $badge }}</span>
                                    @endforeach
                                </div>

                                @error('foto')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                        </div>

                        {{-- Section: Detail Tambahan --}}
                        <div class="px-6 py-6 space-y-5">
                            <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Detail Tambahan</p>

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
                                @error('kategori')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>

                            {{-- Deskripsi Foto --}}
                            <div class="space-y-1.5">
                                <flux:label for="deskripsi">Deskripsi Foto</flux:label>
                                <flux:textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    placeholder="Berikan penjelasan singkat mengenai isi foto dokumentasi ini..."
                                    rows="4" />
                                @error('deskripsi')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                            <flux:button as="a" href="#" variant="ghost">Batal</flux:button>
                            <flux:button type="submit" variant="primary" icon="check">Simpan Foto</flux:button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>