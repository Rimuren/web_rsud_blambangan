<x-layouts::app :title="__('Manajemen Artikel')">
    <x-slot:header>{{ __('Manajemen Artikel') }}</x-slot:header>

    <div class="p-4 md:p-6 lg:p-8 max-w-full overflow-hidden">
        {{-- Header & Action --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Artikel</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">
                    Kelola semua konten artikel kesehatan dan berita rumah sakit Anda.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="button" id="delete-selected-btn"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    <flux:icon name="trash" class="size-4" />
                    Hapus Terpilih (<span id="selected-count">0</span>)
                </button>

                <a href="{{ route('admin.artikel.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Artikel Baru
                    </flux:button>
                </a>
            </div>
        </div>

        {{-- STATISTIK INFORMATIF --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <flux:card class="p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <flux:icon name="document-text" class="size-5 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Total Artikel</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $totalArtikel ?? 0 }}</p>
                    </div>
                </div>
            </flux:card>
            <flux:card class="p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
                        <flux:icon name="check-circle" class="size-5 text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Published</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $publishedCount ?? 0 }}</p>
                    </div>
                </div>
            </flux:card>
            <flux:card class="p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg">
                        <flux:icon name="pencil" class="size-5 text-amber-600 dark:text-amber-400" />
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Draft</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $draftCount ?? 0 }}</p>
                    </div>
                </div>
            </flux:card>
            <flux:card class="p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <flux:icon name="eye" class="size-5 text-purple-600 dark:text-purple-400" />
                    </div>
                    <div>
                        <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Total Dilihat</p>
                        <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $totalViews ?? 0 }}</p>
                    </div>
                </div>
            </flux:card>
        </div>

        {{-- FILTER KATEGORI & SEARCH --}}
        <flux:card class="p-4 mb-6">
            <form method="GET" class="space-y-3">
                <div class="flex items-center gap-2">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                        Filter Kategori:
                    </span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 xl:grid-cols-5 gap-2">
                    <a href="{{ route('admin.artikel.index') }}"
                        class="inline-flex items-center justify-between px-3 py-1.5 text-xs font-medium rounded-lg transition-all {{ !request('kategori') ? 'bg-primary text-white shadow-sm' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700' }}">
                        <span class="truncate">Semua</span>
                        <span class="ml-1.5 flex-shrink-0 {{ !request('kategori') ? 'text-white/80' : 'text-zinc-500' }}">
                            ({{ $totalArtikel ?? 0 }})
                        </span>
                    </a>

                    @foreach($kategoris as $kat)
                        <a href="{{ route('admin.artikel.index', ['kategori' => $kat->slug]) }}"
                            class="inline-flex items-center justify-between px-3 py-1.5 text-xs font-medium rounded-lg transition-all {{ request('kategori') == $kat->slug ? 'bg-primary text-white shadow-sm' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700' }}">
                            <span class="truncate max-w-[80px]" title="{{ $kat->nama }}">{{ $kat->nama }}</span>
                            <span class="ml-1.5 flex-shrink-0 {{ request('kategori') == $kat->slug ? 'text-white/80' : 'text-zinc-500' }}">
                                ({{ $kat->artikels_count ?? 0 }})
                            </span>
                        </a>
                    @endforeach
                </div>

                <div class="relative">
                    <input name="search" value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        placeholder="Cari artikel berdasarkan judul atau konten..." type="text" />
                    <flux:icon name="magnifying-glass"
                        class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>

                @if(request('kategori') || request('search'))
                    <div class="pt-2 border-t border-zinc-200 dark:border-zinc-700 text-xs text-zinc-500 flex items-center gap-2">
                        <flux:icon name="information-circle" class="size-4" />
                        <span>
                            Menampilkan 
                            @if(request('kategori'))
                                kategori <strong>{{ $kategoris->firstWhere('slug', request('kategori'))->nama ?? '' }}</strong>
                            @endif
                            @if(request('search'))
                                @if(request('kategori')) dan @endif
                                pencarian "<strong>{{ request('search') }}</strong>"
                            @endif
                            ({{ $artikels->total() }} artikel)
                        </span>
                        <a href="{{ route('admin.artikel.index') }}" class="ml-auto text-primary hover:underline">
                            Reset filter
                        </a>
                    </div>
                @endif
            </form>
        </flux:card>

        {{-- FORM MASS DELETE --}}
        <form id="mass-delete-form" action="{{ route('admin.artikel.mass-destroy') }}" method="POST">
            @csrf
            @method('DELETE')
        </form>

        {{-- TABEL ARTIKEL --}}
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <colgroup>
                        <col class="w-10">
                        <col class="w-2/6 min-w-[200px]">
                        <col class="w-1/6 min-w-[140px]"> {{-- Sedikit lebih lebar untuk kategori panjang --}}
                        <col class="w-1/6 min-w-[120px] hidden md:table-cell">
                        <col class="w-24">
                        <col class="w-20">
                        <col class="w-28">
                        <col class="w-24">
                    </colgroup>
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-3 py-3">
                                <input type="checkbox" id="select-all"
                                    class="rounded border-zinc-300 dark:border-zinc-600 text-primary">
                            </th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase">Judul Artikel</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase">Kategori</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase hidden md:table-cell">Penulis</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase">Status</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase">Dilihat</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase">Tanggal</th>
                            <th class="px-3 py-3 text-xs font-bold text-zinc-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($artikels as $artikel)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-3 py-3">
                                <input type="checkbox"
                                    name="ids[]"
                                    value="{{ $artikel->id }}"
                                    form="mass-delete-form"
                                    class="item-checkbox rounded border-zinc-300 dark:border-zinc-600 text-primary">
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex items-center gap-2">
                                    @if($artikel->thumbnail)
                                        <img src="{{ asset('storage/'.$artikel->thumbnail) }}" 
                                             class="w-8 h-8 rounded object-cover flex-shrink-0" 
                                             alt="thumb">
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-zinc-900 dark:text-white truncate" title="{{ $artikel->judul }}">
                                            {{ Str::limit($artikel->judul, 40) }}
                                        </p>
                                        <p class="text-xs text-zinc-500 truncate">
                                            {{ Str::limit(strip_tags($artikel->konten), 40) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3">
                                @php
                                    $namaKategori = $artikel->kategori->nama ?? '-';
                                    $warna = match($namaKategori) {
                                        'Kesehatan' => 'blue',
                                        'Tips' => 'amber',
                                        'Berita RS' => 'indigo',
                                        default => 'gray'
                                    };
                                @endphp
                                <div title="{{ $namaKategori }}">
                                    <flux:badge color="{{ $warna }}" size="sm" class="inline-block max-w-full">
                                        <span class="truncate block">
                                            {{ Str::limit($namaKategori, 20) }}
                                        </span>
                                    </flux:badge>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-sm text-zinc-600 dark:text-zinc-400 truncate hidden md:table-cell" title="{{ $artikel->penulis->name ?? '-' }}">
                                {{ $artikel->penulis->name ?? '-' }}
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
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
                            <td class="px-3 py-3 text-sm text-zinc-600 dark:text-zinc-400 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <flux:icon name="eye" class="size-3.5 text-zinc-400" />
                                    {{ number_format($artikel->views ?? 0, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-3 py-3 text-sm text-zinc-500 whitespace-nowrap">
                                {{ $artikel->created_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex justify-center items-center gap-1">
                                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="inline-flex">
                                        <flux:button size="sm" variant="ghost" class="!p-1">
                                            <flux:icon name="pencil" class="size-4" />
                                        </flux:button>
                                    </a>
                                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}"
                                        method="POST"
                                        class="delete-single-form inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit"
                                            size="sm"
                                            variant="danger"
                                            class="!p-1 text-red-600 opacity-75 hover:opacity-100 transition-opacity">
                                            <flux:icon name="trash" class="size-4" />
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-zinc-500">
                                <div class="flex flex-col items-center gap-3">
                                    <flux:icon name="document" class="size-10 text-zinc-300" />
                                    <p>Belum ada artikel.</p>
                                    <a href="{{ route('admin.artikel.create') }}" class="text-primary text-sm font-medium hover:underline">
                                        Buat artikel pertama →
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($artikels->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row justify-between items-center gap-2">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $artikels->firstItem() ?? 0 }} - {{ $artikels->lastItem() ?? 0 }} 
                    dari {{ $artikels->total() }} artikel
                </p>
                {{ $artikels->links() }}
            </div>
            @endif
        </flux:card>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const deleteBtn = document.getElementById('delete-selected-btn');
            const massForm = document.getElementById('mass-delete-form');
            const selectedCountSpan = document.getElementById('selected-count');
            const checkboxes = () => document.querySelectorAll('.item-checkbox');

            function updateDeleteButton() {
                const checked = document.querySelectorAll('.item-checkbox:checked');
                const count = checked.length;
                selectedCountSpan.textContent = count;
                deleteBtn.disabled = count === 0;
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes().forEach(cb => cb.checked = this.checked);
                    updateDeleteButton();
                });
            }

            document.querySelectorAll('.item-checkbox').forEach(cb => {
                cb.addEventListener('change', updateDeleteButton);
            });

            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    const selected = document.querySelectorAll('.item-checkbox:checked');
                    if (selected.length === 0) return;

                    if (confirm(`Hapus ${selected.length} artikel terpilih?`)) {
                        massForm.submit();
                    }
                });
            }

            document.querySelectorAll('.delete-single-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Hapus artikel ini? Tindakan tidak dapat dibatalkan.')) {
                        e.preventDefault();
                    }
                });
            });

            updateDeleteButton();
        });
    </script>
</x-layouts::app>