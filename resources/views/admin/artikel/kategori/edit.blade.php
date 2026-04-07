<x-layouts::app :title="__('Edit Kategori Artikel')">
  <x-slot:header>{{ __('Edit Kategori Artikel') }}</x-slot:header>

  <div class="p-4 md:p-6 lg:p-8">
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
      <div>
        <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Edit Kategori</h2>
        <p class="text-zinc-500 dark:text-zinc-400 mt-2">Ubah data kategori artikel.</p>
      </div>
      <div>
        <flux:button as="a" href="{{ route('admin.artikel.kategori.index') }}" variant="outline" class="cursor-pointer">
          <flux:icon name="arrow-left" class="size-4 mr-2" /> Kembali
        </flux:button>
      </div>
    </div>

    <flux:card class="max-w-2xl mx-auto">
      <form method="POST" action="{{ route('admin.artikel.kategori.update', $kategori->id) }}" class="p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="space-y-1.5">
          <flux:label>Nama Kategori <span class="text-red-500">*</span></flux:label>
          <flux:input name="nama" value="{{ old('nama', $kategori->nama) }}" required autofocus />
          @error('nama') <flux:error>{{ $message }}</flux:error> @enderror
          <p class="text-xs text-zinc-500">Slug akan diperbarui otomatis jika nama berubah.</p>
        </div>

        <div class="space-y-1.5">
          <flux:label>Deskripsi (Opsional)</flux:label>
          <textarea name="deskripsi" rows="3" class="w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 px-3 py-2 text-sm">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
          @error('deskripsi') <flux:error>{{ $message }}</flux:error> @enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
          <flux:button as="a" href="{{ route('admin.artikel.kategori.index') }}" variant="ghost">Batal</flux:button>
          <flux:button type="submit" variant="primary">Perbarui</flux:button>
        </div>
      </form>
    </flux:card>
  </div>
</x-layouts::app>