<x-layouts::app :title="'Manajemen Dokter'">
    <x-slot:header>
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Dokter</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola dokter, spesialisasi dan jadwal praktik rumah sakit.</p>
            </div>
            <div>
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <!-- Filter and Search -->
        <flux:card class="p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Filter Spesialis:</span>
                </div>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="primary" class="cursor-pointer">Semua</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Penyakit Dalam</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Anak</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Orthopedi</flux:button>
                </div>
                <div class="ml-auto relative">
                    <input class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64" placeholder="Cari dokter..." type="text" />
                    <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>
            </div>
        </flux:card>

        <!-- Doctors Table -->
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-16">Foto</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Dokter</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Spesialis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($dokters as $dokter)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                    @if($dokter->image_path)
                                    <img src="{{ $dokter->image_path }}" alt="{{ $dokter->nama }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-400 text-xs">No Image</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white line-clamp-1">{{ $dokter->nama }}</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $dokter->kode }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                $colors = ['blue', 'emerald', 'orange', 'purple', 'pink', 'indigo'];
                                $color = $colors[$dokter->id % count($colors)] ?? 'blue';
                                $spesialis = $dokter->spesialis ?: 'Umum';
                                @endphp
                                <flux:badge color="{{ $color }}" size="sm">{{ $spesialis }}</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                @php
                                $jadwalGroup = $dokter->jadwal_dokter ? $dokter->jadwal_dokter->groupBy('hari') : collect();
                                @endphp

                                @if($jadwalGroup->count())
                                <ul class="space-y-1">
                                    @foreach($jadwalGroup as $hari => $jadwals)
                                    @php
                                    $jamList = $jadwals->map(function($j) {
                                    $mulai = substr($j->jam_mulai, 0, 5);
                                    $selesai = substr($j->jam_selesai, 0, 5);
                                    return $mulai . '-' . $selesai;
                                    })->implode(', ');
                                    @endphp
                                    <li>
                                        <span class="font-medium">{{ $hari }}</span>
                                        <span class="text-xs text-zinc-500 dark:text-zinc-400"> ({{ $jamList }})</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 hover:text-red-500">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="calendar" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-zinc-500">
                                Tidak ada data dokter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($dokters->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $dokters->firstItem() }}-{{ $dokters->lastItem() }} dari {{ $dokters->total() }} dokter
                </p>
                <div class="flex gap-2">
                    {{ $dokters->links() }}
                </div>
            </div>
            @endif
        </flux:card>
    </div>
</x-layouts::app>