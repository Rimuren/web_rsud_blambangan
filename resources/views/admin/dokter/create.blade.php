<x-layouts::app :title="'Tambah Dokter Manual'">
    <x-slot:header>{{ __('Tambah Dokter Manual') }}</x-slot:header>

    @can('dokter.create')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Tambah Dokter Manual</h1>
                <p class="text-sm text-zinc-500 mt-1">Dokter yang ditambahkan secara manual tidak akan disinkron ulang oleh API.</p>
            </div>

            <form method="POST" action="{{ route('admin.dokter.store') }}" enctype="multipart/form-data">
                @csrf

                <flux:card class="overflow-hidden p-0">
                    <div class="p-6 space-y-5">
                        <div class="space-y-1.5">
                            <flux:label for="nama">Nama Dokter <span class="text-red-500">*</span></flux:label>
                            <flux:input id="nama" name="nama" value="{{ old('nama') }}" required />
                            @error('nama') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="spesialis">Spesialis</flux:label>
                            <flux:input id="spesialis" name="spesialis" value="{{ old('spesialis') }}" />
                            @error('spesialis') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="image_path">Foto Profil</flux:label>
                            <input type="file" name="image_path" accept="image/*" class="w-full text-sm border rounded-lg p-2" />
                            @error('image_path') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <flux:label>Jadwal Praktik</flux:label>
                                <button type="button" id="addJadwalBtn" class="text-xs text-primary hover:underline">+ Tambah Jadwal</button>
                            </div>
                            <div id="jadwalContainer">
                                <!-- Template jadwal akan ditambahkan via JS -->
                            </div>
                            @error('jadwal') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                    </div>
                </flux:card>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.dokter.index') }}">
                        <flux:button variant="ghost">Batal</flux:button>
                    </a>
                    <flux:button type="submit" variant="primary">Simpan Dokter</flux:button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const polikliniks = @json($polikliniks);
        const jadwalContainer = document.getElementById('jadwalContainer');
        let jadwalCount = 0;

        function addJadwalRow(jadwalData = null) {
            const id = jadwalCount++;
            const hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const poliOptions = polikliniks.map(p => `<option value="${p.id}" ${jadwalData && jadwalData.poliklinik_id == p.id ? 'selected' : ''}>${p.nama}</option>`).join('');
            const html = `
                <div class="jadwal-item p-4 mb-3 border rounded-lg bg-zinc-50 dark:bg-zinc-800/30 relative">
                    <button type="button" class="remove-jadwal absolute top-2 right-2 text-red-500 hover:text-red-700">✕</button>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                        <div>
                            <label class="block text-xs font-medium mb-1">Hari</label>
                            <select name="jadwal[${id}][hari]" class="w-full rounded border p-2 text-sm" required>
                                <option value="">Pilih Hari</option>
                                ${hariOptions.map(h => `<option value="${h}" ${jadwalData && jadwalData.hari == h ? 'selected' : ''}>${h}</option>`).join('')}
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Jam Mulai</label>
                            <input type="time" name="jadwal[${id}][jam_mulai]" class="w-full rounded border p-2 text-sm" value="${jadwalData ? jadwalData.jam_mulai : ''}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Jam Selesai</label>
                            <input type="time" name="jadwal[${id}][jam_selesai]" class="w-full rounded border p-2 text-sm" value="${jadwalData ? jadwalData.jam_selesai : ''}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Tipe Pelayanan</label>
                            <input type="text" name="jadwal[${id}][tipe_pelayanan]" class="w-full rounded border p-2 text-sm" placeholder="onsite / telemed" value="${jadwalData ? jadwalData.tipe_pelayanan : ''}">
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Poliklinik</label>
                            <select name="jadwal[${id}][poliklinik_id]" class="w-full rounded border p-2 text-sm" required>
                                <option value="">Pilih Poliklinik</option>
                                ${poliOptions}
                            </select>
                        </div>
                    </div>
                </div>
            `;
            jadwalContainer.insertAdjacentHTML('beforeend', html);
        }

        document.getElementById('addJadwalBtn').addEventListener('click', () => addJadwalRow());
        // Optional: tambah minimal satu row
        addJadwalRow();

        jadwalContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-jadwal')) {
                e.target.closest('.jadwal-item').remove();
            }
        });
    </script>
    @endcan
</x-layouts::app>