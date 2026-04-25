<x-layouts::app :title="__('Edit Poliklinik')">
    <x-slot:header>{{ __('Edit Poliklinik') }}</x-slot:header>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Edit Poliklinik</h1>
                <p class="text-sm text-zinc-500 mt-1">Ubah data poliklinik.</p>
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border">
                <form method="POST" action="{{ route('admin.dokter.poliklinik.update', $poliklinik->id) }}" class="divide-y">
                    @csrf
                    @method('PUT')
                    <div class="px-6 py-6 space-y-5">
                        <div class="space-y-1.5">
                            <flux:label for="nama">Nama Poliklinik <span class="text-red-500">*</span></flux:label>
                            <flux:input id="nama" name="nama" value="{{ old('nama', $poliklinik->nama) }}" required />
                            @error('nama') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="kode_bpjs">Kode BPJS</flux:label>
                            <flux:input id="kode_bpjs" name="kode_bpjs" value="{{ old('kode_bpjs', $poliklinik->kode_bpjs) }}" />
                            @error('kode_bpjs') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="tarif_konsultasi">Tarif Konsultasi</flux:label>
                            <flux:input id="tarif_konsultasi" name="tarif_konsultasi" type="number" value="{{ old('tarif_konsultasi', $poliklinik->tarif_konsultasi) }}" />
                            @error('tarif_konsultasi') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                    </div>
                    <div class="px-6 py-4 flex justify-end gap-3 bg-zinc-50/50 rounded-b-2xl">
                        <a href="{{ route('admin.dokter.poliklinik.index') }}">
                            <flux:button variant="ghost">Batal</flux:button>
                        </a>
                        <flux:button type="submit" variant="primary">Update</flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>