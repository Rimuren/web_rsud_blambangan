<x-layouts::app.sidebar :title="'Edit Foto'">
    <flux:main>
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Edit Foto</h1>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Edit informasi foto dokumentasi.</p>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <form action="{{ route('admin.dokumentasi.foto.update', $foto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="px-6 py-6 space-y-5">
                            {{-- Judul --}}
                            <div class="space-y-1.5">
                                <flux:label for="judul">Judul Foto <span class="text-red-500">*</span></flux:label>
                                <flux:input id="judul" name="judul" value="{{ old('judul', $foto->judul) }}" required />
                                @error('judul') <flux:error>{{ $message }}</flux:error> @enderror
                            </div>

                            {{-- Gambar saat ini --}}
                            <div class="space-y-1.5">
                                <flux:label>Gambar Saat Ini</flux:label>
                                <div class="flex items-center gap-3 p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-xl">
                                    <img src="{{ asset('storage/' . $foto->gambar) }}" class="w-20 h-20 object-cover rounded-lg">
                                    <div class="text-sm text-zinc-600 dark:text-zinc-300 break-all">{{ $foto->gambar }}</div>
                                </div>
                            </div>

                            {{-- Ganti Gambar --}}
                            <div class="space-y-1.5">
                                <flux:label for="gambar">Ganti Gambar (opsional)</flux:label>
                                <input type="file" id="gambar" name="gambar" accept=".png,.jpg,.jpeg" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                @error('gambar') <flux:error>{{ $message }}</flux:error> @enderror
                            </div>

                            {{-- Kategori --}}
                            <div class="space-y-1.5">
                                <flux:label for="kategori">Kategori</flux:label>
                                <flux:select id="kategori" name="kategori">
                                    <flux:select.option value="">-- Pilih kategori --</flux:select.option>
                                    <flux:select.option value="ruang_perawatan" {{ $foto->kategori == 'ruang_perawatan' ? 'selected' : '' }}>Ruang Perawatan</flux:select.option>
                                    <flux:select.option value="fasilitas" {{ $foto->kategori == 'fasilitas' ? 'selected' : '' }}>Fasilitas</flux:select.option>
                                    <flux:select.option value="tenaga_medis" {{ $foto->kategori == 'tenaga_medis' ? 'selected' : '' }}>Tenaga Medis</flux:select.option>
                                    <flux:select.option value="kegiatan" {{ $foto->kategori == 'kegiatan' ? 'selected' : '' }}>Kegiatan</flux:select.option>
                                    <flux:select.option value="lainnya" {{ $foto->kategori == 'lainnya' ? 'selected' : '' }}>Lainnya</flux:select.option>
                                </flux:select>
                                @error('kategori') <flux:error>{{ $message }}</flux:error> @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="space-y-1.5">
                                <flux:label for="deskripsi">Deskripsi Foto</flux:label>
                                <flux:textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $foto->deskripsi) }}</flux:textarea>
                                @error('deskripsi') <flux:error>{{ $message }}</flux:error> @enderror
                            </div>
                        </div>

                        <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                            <flux:button as="a" href="{{ route('admin.dokumentasi.foto.index') }}" variant="ghost">Batal</flux:button>
                            <flux:button type="submit" variant="primary" icon="check">Update Foto</flux:button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>