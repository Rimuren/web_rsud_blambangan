<x-layouts::app :title="'Manajemen Dokter'">
    <x-slot:header>
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Dokter</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola dokter, spesialisasi dan jadwal praktik rumah sakit.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">

        <flux:card class="p-4 mb-6">
            <form method="GET" action="{{ route('admin.dokter.index') }}" class="flex flex-wrap items-start gap-4">
                <!-- Label filter -->
                <div class="flex items-center gap-2 shrink-0 mt-1">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Spesialis:</span>
                </div>

                <!-- Area scroll horizontal untuk tombol filter -->
                <div class="flex-1 min-w-0 overflow-x-auto pb-1 scrollbar-thin scrollbar-thumb-zinc-300 dark:scrollbar-thumb-zinc-600">
                    <div class="flex gap-2 whitespace-nowrap">
                        @php
                        $current = request('spesialis');
                        $validSpesialis = array_filter($spesialisList, function($item) {
                        return !empty(trim($item));
                        });
                        $filters = ['Semua' => null] + array_combine($validSpesialis, $validSpesialis);
                        @endphp

                        @foreach ($filters as $label => $value)
                        <a href="{{ route('admin.dokter.index', $value ? array_merge(request()->except('spesialis'), ['spesialis' => $value]) : request()->except('spesialis')) }}"
                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-full transition-all duration-200 
                           {{ $current == $value 
                               ? 'bg-primary text-white shadow-sm' 
                               : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 hover:shadow-sm' }}">
                            {{ $label }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Pencarian dan reset -->
                <div class="flex items-center gap-3 shrink-0">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokter..."
                            class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64">
                        <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                    </div>

                    @if(request('search') || request('spesialis'))
                    <a href="{{ route('admin.dokter.index') }}" class="text-sm text-primary hover:underline whitespace-nowrap">
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </flux:card>

        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-16">Foto</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Dokter</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Spesialis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center w-16">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokters as $dokter)
                        @php
                        $jadwals = $dokter->jadwal_dokter;
                        $uniqueHari = $jadwals ? $jadwals->pluck('hari')->unique()->sortBy(function($hari) {
                        $order = ['Senin'=>1,'Selasa'=>2,'Rabu'=>3,'Kamis'=>4,'Jumat'=>5,'Sabtu'=>6,'Minggu'=>7];
                        return $order[$hari] ?? 0;
                        }) : collect();
                        @endphp
                        <tr class="doctor-row hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors cursor-pointer" data-id="{{ $dokter->id }}">
                            <td class="px-6 py-4">
                                <div style="width: 48px; height: 48px;" class="rounded-full overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                    @if($dokter->image_url)
                                    <img src="{{ $dokter->image_url }}" alt="{{ $dokter->nama }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
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
                            <td class="flex justify-center px-6 py-4">
                                @php
                                $colors = ['blue', 'emerald', 'orange', 'purple', 'pink', 'indigo'];
                                $color = $colors[$dokter->id % count($colors)] ?? 'blue';
                                $spesialis = $dokter->spesialis ?: 'null';
                                @endphp
                                <flux:badge color="{{ $color }}" size="sm">{{ $spesialis }}</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                @if($uniqueHari->count())
                                {{ $uniqueHari->implode(', ') }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <flux:button size="sm" variant="ghost" class="toggle-detail" data-id="{{ $dokter->id }}">
                                    <flux:icon name="eye" class="size-4" />
                                </flux:button>
                            </td>
                        </tr>

                        <tr id="detail-{{ $dokter->id }}" class="detail-row hidden bg-zinc-50/70 dark:bg-zinc-800/40">
                            <td colspan="5" class="px-6 py-4">
                                <div class="pl-8">
                                    <h4 class="text-sm font-semibold mb-2 text-zinc-700 dark:text-zinc-300">Detail Jadwal Praktik</h4>
                                    @if($jadwals && $jadwals->count())
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($jadwals as $jadwal)
                                        <div class="border-l-2 border-blue-500 pl-3 py-1">
                                            <div class="text-sm font-medium text-zinc-800 dark:text-white">{{ $jadwal->hari }}</div>
                                            <div class="text-xs text-zinc-600 dark:text-zinc-400">
                                                {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                                            </div>
                                            @if($jadwal->poliklinik_nama ?? false)
                                            <div class="text-xs text-zinc-500">Poli: {{ $jadwal->poliklinik_nama }}</div>
                                            @endif
                                            @if($jadwal->ruangan_nama ?? false)
                                            <div class="text-xs text-zinc-500">Ruangan: {{ $jadwal->ruangan_nama }}</div>
                                            @endif
                                            @if($jadwal->tipe_pelayanan)
                                            <div class="text-xs text-zinc-500">Tipe: {{ $jadwal->tipe_pelayanan }}</div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <p class="justify-center flex text-sm text-zinc-500">Tidak ada jadwal</p>
                                    @endif
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

    <script>
        function toggleDetail(dokterId) {
            const detailRow = document.getElementById(`detail-${dokterId}`);
            if (detailRow) {
                detailRow.classList.toggle('hidden');
            }
        }

        document.querySelectorAll('.toggle-detail').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dokterId = this.getAttribute('data-id');
                toggleDetail(dokterId);
            });
        });

        document.querySelectorAll('.doctor-row').forEach(row => {
            row.addEventListener('click', function(e) {
                if (e.target.closest('.toggle-detail')) {
                    return;
                }
                const dokterId = this.getAttribute('data-id');
                toggleDetail(dokterId);
            });
        });
    </script>
</x-layouts::app>