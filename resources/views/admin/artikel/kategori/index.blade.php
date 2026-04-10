<x-layouts::app :title="__('Manajemen Kategori Artikel')">
    <x-slot:header>
        {{ __('Manajemen Kategori Artikel') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Kategori Artikel</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola kategori untuk mengorganisir konten artikel rumah sakit Anda.</p>
            </div>
            <div>
                <a href="{{ route('admin.artikel.kategori.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Kategori
                    </flux:button>
                </a>
            </div>
        </div>

        {{-- Categories Table --}}
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($kategori as $kat)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">{{ $kat->nama }}</p>
                                @if($kat->deskripsi)
                                <p class="text-xs text-zinc-500 mt-1">{{ Str::limit($kat->deskripsi, 60) }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ $kat->slug }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('admin.artikel.kategori.edit', $kat->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                    <form action="{{ route('admin.artikel.kategori.destroy', $kat->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                            <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-zinc-500">Belum ada kategori. Klik "Tambah Kategori" untuk menambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </flux:card>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
            <p class="text-xs text-zinc-500">Menampilkan 1-3 dari 3 kategori</p>
            <div class="flex gap-2">
                <flux:button size="sm" variant="outline" class="cursor-pointer" disabled>
                    <flux:icon name="chevron-left" class="size-4" />
                </flux:button>
                <flux:button size="sm" variant="primary" class="cursor-pointer">1</flux:button>
                <flux:button size="sm" variant="outline" class="cursor-pointer" disabled>
                    <flux:icon name="chevron-right" class="size-4" />
                </flux:button>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Kategori --}}
    <div
        x-data="{ open: false }"
        x-on:open-modal.window="if ($event.detail === 'tambah-kategori') open = true"
        x-on:keydown.escape.window="open = false"
        x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        {{-- Backdrop --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm"
            @click="open = false"
        ></div>

        {{-- Modal Content --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white dark:bg-zinc-900 rounded-xl shadow-2xl w-full max-w-md"
        >
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Tambah Kategori Baru</h3>
                    <button type="button" @click="open = false" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300">
                        <flux:icon name="x-mark" class="size-5" />
                    </button>
                </div>

                <div class="mb-4">
                    <label for="category_name" class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-1">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        id="category_name"
                        placeholder="Contoh: Berita, Promosi, Edukasi"
                        class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                    />
                </div>

                <div class="flex justify-end gap-3">
                    <flux:button variant="ghost" @click="open = false" class="cursor-pointer">
                        Batal
                    </flux:button>
                    <flux:button
                        variant="primary"
                        class="cursor-pointer"
                        @click="
                            let name = document.getElementById('category_name').value.trim();
                            if (name) {
                                alert(`Kategori '${name}' akan ditambahkan (simulasi).`);
                                open = false;
                                document.getElementById('category_name').value = '';
                            } else {
                                alert('Nama kategori tidak boleh kosong.');
                            }
                        "
                    >
                        Simpan Kategori
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</x-layouts::app>