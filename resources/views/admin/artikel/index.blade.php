<x-layouts::app :title="__('Manajemen Artikel')">
    <x-slot:header>
        {{ __('Manajemen Artikel') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">

        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Artikel</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola semua konten artikel kesehatan dan berita rumah sakit Anda.</p>
            </div>
            <div>
                <a href="{{ route('admin.artikel.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Artikel Baru
                    </flux:button>
                </a>
            </div>
        </div>

        {{-- Filter & Search --}}
        <flux:card class="p-4 mb-6">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Filter Kategori:</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.artikel.index') }}"
                        class="px-3 py-1 text-xs rounded-lg {{ !request('kategori') ? 'bg-primary text-white' : 'border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800' }} transition-all">
                        Semua
                    </a>
                    @foreach($kategoris as $kat)
                    <a href="{{ route('admin.artikel.index', ['kategori' => $kat->slug]) }}"
                        class="px-3 py-1 text-xs rounded-lg {{ request('kategori') == $kat->slug ? 'bg-primary text-white' : 'border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800' }} transition-all">
                        {{ $kat->nama }}
                    </a>
                    @endforeach
                </div>
                <div class="ml-auto relative">
                    <input name="search" value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64"
                        placeholder="Cari artikel..." type="text" />
                    <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>
            </form>
        </flux:card>

        {{-- Tabel Artikel --}}
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Judul Artikel</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Penulis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($artikels as $artikel)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">{{ $artikel->judul }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                $warna = match($artikel->kategori->nama ?? '') {
                                'Kesehatan' => 'blue',
                                'Tips' => 'amber',
                                'Berita RS' => 'indigo',
                                default => 'gray'
                                };
                                @endphp
                                <flux:badge color="{{ $warna }}" size="sm">{{ $artikel->kategori->nama ?? '-' }}</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">{{ $artikel->penulis->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($artikel->status === 'published')
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-semibold text-emerald-600">Published</span>
                                </div>
                                @else
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-zinc-400"></span>
                                    <span class="text-xs font-semibold text-zinc-500">Draft</span>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">{{ $artikel->created_at->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    {{-- Tombol preview (belum ada route show, bisa diarahkan ke halaman depan atau kosong) --}}
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer" title="Preview">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                            <flux:icon name="pencil" class="size-4" />
                                        </flux:button>
                                    </a>
                                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="cursor-pointer text-red-600" title="Hapus">
                                            <flux:icon name="trash" class="size-4" />
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-zinc-500">
                                Belum ada artikel. Klik "Tambah Artikel Baru" untuk menambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($artikels->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $artikels->firstItem() ?? 0 }} - {{ $artikels->lastItem() ?? 0 }} dari {{ $artikels->total() }} artikel
                </p>
                <div class="flex gap-2">
                    {{ $artikels->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </flux:card>
    </div>
</x-layouts::app>