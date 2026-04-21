@extends('layouts.guest.guest')

@section('title', 'Daftar Dokter')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#003366",
                    "background-light": "#f8fafc",
                    "accent-teal": "#0d9488"
                },
                fontFamily: {
                    "display": ["Public Sans", "sans-serif"]
                }
            }
        }
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400;
        color: #003366;
    }

    body {
        font-family: 'Public Sans', sans-serif;
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
    {{-- Baris filter dan pencarian --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div class="flex flex-wrap items-center gap-3">
            {{-- Filter Poliklinik --}}
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-700 dark:text-slate-300 whitespace-nowrap">Poliklinik:</span>
                <select onchange="window.location.href=this.value" class="px-4 py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                    <option value="{{ route('guest.daftar-dokter.index', request()->except(['poliklinik','page'])) }}">Semua Poliklinik</option>
                    @foreach($poliklinikList as $poli)
                    <option value="{{ route('guest.daftar-dokter.index', array_merge(request()->except(['poliklinik','page']), ['poliklinik' => $poli])) }}" {{ request('poliklinik') == $poli ? 'selected' : '' }}>
                        {{ $poli }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Hari --}}
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-slate-700 dark:text-slate-300 whitespace-nowrap">Hari:</span>
                <select onchange="window.location.href=this.value" class="px-4 py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                    <option value="{{ route('guest.daftar-dokter.index', request()->except(['hari','page'])) }}">Semua Hari</option>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $day)
                    <option value="{{ route('guest.daftar-dokter.index', array_merge(request()->except(['hari','page']), ['hari' => $day])) }}" {{ request('hari') == $day ? 'selected' : '' }}>
                        {{ $day }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Pencarian --}}
        <form method="GET" class="md:w-72">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dokter..." class="w-full pl-10 pr-4 py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
            </div>
        </form>
    </div>

    {{-- Daftar Dokter --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse($dokters as $doctor)
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition duration-200">
            <div class="flex flex-col lg:flex-row">
                {{-- Profil & info dasar --}}
                <div class="p-6 lg:w-1/3 flex gap-4 border-b lg:border-b-0 lg:border-r border-slate-100">
                    <div class="w-24 h-24 rounded-xl bg-slate-100 overflow-hidden shrink-0">
                        <img src="{{ $doctor->image_url ?? 'https://ui-avatars.com/api/?background=003366&color=fff&name='.urlencode($doctor->nama) }}" class="w-full h-full object-cover" alt="{{ $doctor->nama }}">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-white">{{ $doctor->nama }}</h3>
                        @if($doctor->poliklinik_badges)
                        <div class="mt-1 flex flex-wrap gap-1">
                            @foreach($doctor->poliklinik_badges as $badge)
                            <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded-full">{{ $badge }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Jadwal praktik --}}
                <div class="p-6 lg:w-2/3 bg-slate-50/50 dark:bg-slate-800/30 space-y-4">
                    @if($doctor->reguler)
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-primary">calendar_month</span>
                            <h4 class="font-semibold text-slate-800 dark:text-slate-200">Jadwal Reguler</h4>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($doctor->reguler as $jadwal)
                            @php
                            $isToday = $jadwal->is_today;
                            $isOpen = $jadwal->is_open;
                            $cardClass = '';
                            $badgeClass = '';
                            if ($isToday) {
                            if ($isOpen) {
                            $cardClass = 'bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500';
                            $badgeClass = 'bg-green-200 text-green-800 dark:bg-green-800/50 dark:text-green-300';
                            } else {
                            $cardClass = 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500';
                            $badgeClass = 'bg-red-200 text-red-800 dark:bg-red-800/50 dark:text-red-300';
                            }
                            } else {
                            $cardClass = 'border-l-4 border-transparent';
                            }
                            @endphp
                            <div class="flex flex-wrap justify-between items-center border-b border-slate-200 dark:border-slate-700 pb-2 mb-1 {{ $cardClass }} pl-2 rounded-r">
                                <div>
                                    <span class="font-medium text-sm">{{ $jadwal->hari }}</span>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 ml-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </div>
                                @if($isToday)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $isOpen ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"></path>
                                    </svg>
                                    {{ $isOpen ? 'Buka' : 'Tutup' }}
                                </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($doctor->eksekutif)
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-amber-600">star</span>
                            <h4 class="font-semibold text-amber-700">Jadwal Eksekutif</h4>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($doctor->eksekutif as $jadwal)
                            @php
                            $isToday = $jadwal->is_today;
                            $isOpen = $jadwal->is_open;
                            $cardClass = '';
                            $badgeClass = '';
                            if ($isToday) {
                            if ($isOpen) {
                            $cardClass = 'bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500';
                            $badgeClass = 'bg-green-200 text-green-800 dark:bg-green-800/50 dark:text-green-300';
                            } else {
                            $cardClass = 'bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500';
                            $badgeClass = 'bg-red-200 text-red-800 dark:bg-red-800/50 dark:text-red-300';
                            }
                            } else {
                            $cardClass = 'border-l-4 border-transparent';
                            }
                            @endphp
                            <div class="flex flex-wrap justify-between items-center border-b border-amber-100 dark:border-amber-900/30 pb-2 mb-1 {{ $cardClass }} pl-2 rounded-r">
                                <div>
                                    <span class="font-medium text-sm">{{ $jadwal->hari }}</span>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 ml-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </div>
                                @if($isToday)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $isOpen ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"></path>
                                    </svg>
                                    {{ $isOpen ? 'Buka' : 'Tutup' }}
                                </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @unless($doctor->has_jadwal)
                    <p class="text-slate-400 text-sm">Tidak ada jadwal praktik.</p>
                    @endunless
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-xl shadow-sm">
            <span class="material-symbols-outlined text-6xl text-slate-300">search_off</span>
            <p class="text-slate-500 mt-2">Tidak ada dokter yang ditemukan.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $dokters->appends(request()->query())->links() }}
    </div>

    <div class="mt-12 text-center text-slate-400 text-sm">
        <p>menampilkan {{ $dokters->firstItem() ?? 0 }} - {{ $dokters->lastItem() ?? 0 }} dari {{ $dokters->total() ?? 0 }} dokter</p>
        <p class="mt-1 italic">Jadwal dapat berubah sewaktu-waktu.</p>
    </div>
</div>
@endsection