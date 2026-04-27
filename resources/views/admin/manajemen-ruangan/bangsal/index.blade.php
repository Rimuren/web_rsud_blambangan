<x-layouts::app :title="'Daftar Bangsal'">
    <x-slot:header>
        Daftar Bangsal
    </x-slot:header>

    @php
    $totalKapasitas = collect($data)->sum('total_kapasitas');

    $totalTerisi = collect($data)->sum(fn($b) =>
    collect($b['kelas'])->sum('terisi')
    );

    $totalKosong = collect($data)->sum(fn($b) =>
    collect($b['kelas'])->sum('kosong')
    );

    $occupancy = $totalKapasitas > 0
    ? round(($totalTerisi / $totalKapasitas) * 100)
    : 0;

    $criticalCount = collect($data)->filter(function ($b) {
    $kapasitas = collect($b['kelas'])->sum('kapasitas');
    $terisi = collect($b['kelas'])->sum('terisi');
    return $kapasitas > 0 && (($terisi / $kapasitas) * 100) >= 90;
    })->count();
    @endphp

    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mt-2">
            <div>
                <flux:heading size="2xl">Daftar Bangsal</flux:heading>
                <flux:text variant="muted" class="max-w-md">
                    Hospital Infrastructure & Capacity Management System
                </flux:text>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total -->
        <flux:card class="flex flex-col p-6 transition-all hover:shadow-md h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-xl bg-sky-100 dark:bg-sky-900/50 text-sky-600 dark:text-sky-400">
                    <flux:icon name="building-storefront" class="size-5" />
                </div>
            </div>
            <div class="mt-auto">
                <flux:text size="sm" variant="muted" class="font-semibold tracking-wide uppercase">
                    Total Capacity
                </flux:text>
                <div class="flex items-baseline gap-1 mt-1">
                    <flux:heading size="3xl">{{ $totalKapasitas }}</flux:heading>
                    <flux:text size="sm" variant="muted">Beds</flux:text>
                </div>
            </div>
        </flux:card>

        <!-- Occupancy -->
        <flux:card class="flex flex-col p-6 transition-all hover:shadow-md h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400">
                    <flux:icon name="chart-pie" class="size-5" />
                </div>
            </div>
            <div class="mt-auto">
                <flux:text size="sm" variant="muted" class="font-semibold tracking-wide uppercase">
                    Overall Occupancy
                </flux:text>
                <flux:heading size="3xl" class="mt-1">
                    {{ $occupancy }}%
                </flux:heading>
            </div>
        </flux:card>

        <!-- Critical -->
        <flux:card class="flex flex-col p-6 transition-all hover:shadow-md h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-xl bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400">
                    <flux:icon name="exclamation-triangle" class="size-5" />
                </div>
            </div>
            <div class="mt-auto">
                <flux:text size="sm" variant="muted" class="font-semibold tracking-wide uppercase">
                    Critical Wards
                </flux:text>
                <div class="flex items-baseline gap-1 mt-1">
                    <flux:heading size="3xl">{{ $criticalCount }}</flux:heading>
                    <flux:text size="sm" variant="muted">Units</flux:text>
                </div>
            </div>
        </flux:card>

        <!-- Available -->
        <flux:card class="flex flex-col p-6 transition-all hover:shadow-md h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 rounded-xl bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400">
                    <flux:icon name="truck" class="size-5" />
                </div>
            </div>
            <div class="mt-auto">
                <flux:text size="sm" variant="muted" class="font-semibold tracking-wide uppercase">
                    Available ER
                </flux:text>
                <div class="flex items-baseline gap-1 mt-1">
                    <flux:heading size="3xl">{{ $totalKosong }}</flux:heading>
                    <flux:text size="sm" variant="muted">Beds</flux:text>
                </div>
            </div>
        </flux:card>
    </div>

    <!-- Table -->
    <flux:card class="p-0 overflow-hidden">

        <!-- Toolbar dengan Search -->
        <div class="flex flex-col gap-3 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:w-72">
                <input type="text" id="searchBangsal" placeholder="Cari nama bangsal..."
                    class="w-full pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg text-sm focus:ring-primary focus:border-primary outline-none bg-white dark:bg-zinc-800">
                <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400 pointer-events-none" />
            </div>
            <div class="flex items-center gap-2">
                <button id="resetFilterBtn" class="text-sm text-zinc-600 dark:text-zinc-300 hover:text-primary transition">Reset</button>
                <flux:button variant="ghost" size="sm" square icon="funnel" />
                <flux:button variant="ghost" size="sm" square icon="ellipsis-vertical" />
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full divide-y divide-zinc-200 dark:divide-zinc-700" id="bangsalTable">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th class="w-[26%] px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Bangsal</th>
                        <th class="w-[12%] px-4 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Kapasitas</th>
                        <th class="w-[12%] px-4 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Kosong</th>
                        <th class="w-[12%] px-4 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Terisi</th>
                        <th class="w-[26%] px-6 py-4 text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">Occupancy</th>
                        <th class="w-[12%] px-6 py-4 text-center text-xs font-bold text-zinc-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($data as $bangsal)
                    @php
                    $kapasitas = collect($bangsal['kelas'])->sum('kapasitas');
                    $terisi = collect($bangsal['kelas'])->sum('terisi');
                    $kosong = collect($bangsal['kelas'])->sum('kosong');
                    $persen = $kapasitas > 0 ? round(($terisi / $kapasitas) * 100) : 0;
                    @endphp

                    <tr class="bangsal-row transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-800/50" data-name="{{ strtolower($bangsal['nama']) }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full 
                                    {{ $persen >= 90 ? 'bg-red-600' : ($persen >= 70 ? 'bg-amber-500' : 'bg-green-500') }}">
                                </div>
                                <span class="font-medium text-zinc-800 dark:text-zinc-100">
                                    {{ $bangsal['nama'] }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center font-medium whitespace-nowrap">{{ $kapasitas }}</td>
                        <td class="px-4 py-4 text-center font-medium whitespace-nowrap
                            {{ $kosong == 0 ? 'text-red-600' : 'text-blue-600' }}">
                            {{ $kosong }}
                        </td>
                        <td class="px-4 py-4 text-center font-medium whitespace-nowrap">{{ $terisi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-24 h-2 overflow-hidden bg-zinc-200 rounded-full dark:bg-zinc-700">
                                    <div class="h-full rounded-full {{ $persen >= 90 ? 'bg-red-600' : ($persen >= 70 ? 'bg-amber-500' : 'bg-green-500') }}" style="width: {{ $persen }}%;">
                                    </div>
                                </div>
                                @if($persen >= 90)
                                <flux:badge color="red" size="sm">{{ $persen }}%</flux:badge>
                                @else
                                <span class="text-xs font-semibold text-zinc-600 dark:text-zinc-400">{{ $persen }}%</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <flux:button variant="ghost" size="sm">
                                Lihat Detail
                            </flux:button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-zinc-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </flux:card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchBangsal');
            const rows = document.querySelectorAll('.bangsal-row');
            const resetBtn = document.getElementById('resetFilterBtn');

            function filterRows() {
                const keyword = searchInput.value.toLowerCase().trim();
                rows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    if (name && name.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', filterRows);
            }
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    filterRows();
                });
            }
            filterRows(); // initial call
        });
    </script>
</x-layouts::app>