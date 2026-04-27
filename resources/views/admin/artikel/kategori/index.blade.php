<x-layouts::app :title="__('Manajemen Kategori Artikel')">
    <x-slot:header>
        {{ __('Manajemen Kategori Artikel') }}
    </x-slot:header>

    @can('kategori.view')
    <div class="p-4 md:p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Kategori Artikel</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola kategori untuk mengorganisir konten artikel rumah sakit Anda.</p>
            </div>
            <div>
                @can('kategori.create')
                <a href="{{ route('admin.artikel.kategori.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Kategori
                    </flux:button>
                </a>
                @endcan
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        {{-- Tabel Kategori --}}
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Jumlah Artikel</th>
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
                            <td class="px-6 py-4 text-sm text-center text-zinc-600 dark:text-zinc-400">
                            {{ $kat->artikels_count ?? 0 }} artikel
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    @can('kategori.update')
                                    <a href="{{ route('admin.artikel.kategori.edit', $kat->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                    @endcan

                                    @can('kategori.delete')
                                    <form action="{{ route('admin.artikel.kategori.destroy', $kat->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                            <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-zinc-500">
                                Belum ada kategori. Klik "Tambah Kategori" untuk menambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($kategori->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $kategori->firstItem() ?? 0 }} - {{ $kategori->lastItem() ?? 0 }} dari {{ $kategori->total() }} kategori
                </p>
                <div class="flex gap-2">
                    {{ $kategori->links() }}
                </div>
            </div>
            @endif
        </flux:card>
    </div>

    @can('kategori.delete')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @endcan
    
    @endcan
</x-layouts::app>