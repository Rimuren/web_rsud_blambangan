<x-layouts::app :title="'Edit Dokter Manual'">
    <x-slot:header>{{ __('Edit Dokter Manual') }}</x-slot:header>

    @can('dokter.update')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Edit Dokter Manual</h1>
                <p class="text-sm text-zinc-500 mt-1">Perbarui data dokter manual.</p>
            </div>

            <form method="POST" action="{{ route('admin.dokter.update', $dokter->id) }}" enctype="multipart/form-data">
                @csrf 
                
                @method('PUT')
                <flux:card class="overflow-hidden p-0">
                    <div class="p-6 space-y-5">
                        <div class="space-y-1.5">
                            <flux:label for="nama">Nama Dokter <span class="text-red-500">*</span></flux:label>
                            <flux:input id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" required />
                            @error('nama') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="spesialis">Spesialis</flux:label>
                            <flux:input id="spesialis" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" />
                            @error('spesialis') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="image_path">Foto Profil</flux:label>
                            @if($dokter->image_url)
                            <div class="mb-2">
                                <img src="{{ $dokter->image_url }}" class="h-20 w-20 object-cover rounded-full">
                            </div>
                            @endif
                            <input type="file" name="image_path" accept="image/*" class="w-full text-sm border rounded-lg p-2" />
                            @error('image_path') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <flux:label>Jadwal Praktik</flux:label>
                                <button type="button" id="addJadwalBtn" class="text-xs text-primary hover:underline">+ Tambah Jadwal</button>
                            </div>
                            <div id="jadwalContainer">
                                @foreach($dokter->jadwal_dokter as $jadwal)
                                <div class="jadwal-item p-4 mb-3 border rounded-lg bg-zinc-50 dark:bg-zinc-800/30 relative">
                                    <button type="button" class="remove-jadwal absolute top-2 right-2 text-red-500 hover:text-red-700">✕</button>
                                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium mb-1">Hari</label>
                                            <select name="jadwal[{{ $jadwal->id }}][hari]" class="w-full rounded border p-2 text-sm" required>
                                                <option value="">Pilih Hari</option>
                                                <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium mb-1">Jam Mulai</label>
                                            <input type="time" name="jadwal[{{ $jadwal->id }}][jam_mulai]" class="w-full rounded border p-2 text-sm" value="{{ $jadwal->jam_mulai }}" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium mb-1">Jam Selesai</label>
                                            <input type="time" name="jadwal[{{ $jadwal->id }}][jam_selesai]" class="w-full rounded border p-2 text-sm" value="{{ $jadwal->jam_selesai }}" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium mb-1">Tipe Pelayanan</label>
                                            <input type="text" name="jadwal[{{ $jadwal->id }}][tipe_pelayanan]" class="w-full rounded border p-2 text-sm" value="{{ $jadwal->tipe_pelayanan }}">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium mb-1">Poliklinik</label>
                                            <select name="jadwal[{{ $jadwal->id }}][poliklinik_id]" class="w-full rounded border p-2 text-sm" required>
                                                <option value="">Pilih Poliklinik</option>
                                                @foreach($polikliniks as $poli)
                                                <option value="{{ $poli->id }}" {{ $jadwal->poliklinik_id == $poli->id ? 'selected' : '' }}>{{ $poli->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </flux:card>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.dokter.index') }}">
                        <flux:button variant="ghost">Batal</flux:button>
                    </a>
                    <flux:button type="submit" variant="primary">Update Dokter</flux:button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const polikliniks = @json($polikliniks);
        const jadwalContainer = document.getElementById('jadwalContainer');
        let nextId = Date.now();

        function addJadwalRow() {
            const id = nextId++;
            const hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const poliOptions = polikliniks.map(p => `<option value="${p.id}">${p.nama}</option>`).join('');
            const html = `
                <div class="jadwal-item p-4 mb-3 border rounded-lg bg-zinc-50 dark:bg-zinc-800/30 relative">
                    <button type="button" class="remove-jadwal absolute top-2 right-2 text-red-500 hover:text-red-700">✕</button>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                        <div>
                            <label class="block text-xs font-medium mb-1">Hari</label>
                            <select name="jadwal[new_${id}][hari]" class="w-full rounded border p-2 text-sm" required>
                                <option value="">Pilih Hari</option>
                                ${hariOptions.map(h => `<option value="${h}">${h}</option>`).join('')}
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Jam Mulai</label>
                            <input type="time" name="jadwal[new_${id}][jam_mulai]" class="w-full rounded border p-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Jam Selesai</label>
                            <input type="time" name="jadwal[new_${id}][jam_selesai]" class="w-full rounded border p-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Tipe Pelayanan</label>
                            <input type="text" name="jadwal[new_${id}][tipe_pelayanan]" class="w-full rounded border p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium mb-1">Poliklinik</label>
                            <select name="jadwal[new_${id}][poliklinik_id]" class="w-full rounded border p-2 text-sm" required>
                                <option value="">Pilih Poliklinik</option>
                                ${poliOptions}
                            </select>
                        </div>
                    </div>
                </div>
            `;
            jadwalContainer.insertAdjacentHTML('beforeend', html);
        }

        document.getElementById('addJadwalBtn').addEventListener('click', addJadwalRow);
        jadwalContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-jadwal')) {
                e.target.closest('.jadwal-item').remove();
            }
        });
    </script>
    @endcan
</x-layouts::app>