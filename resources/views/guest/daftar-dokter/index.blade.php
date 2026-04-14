@extends('layouts.guest.guest')

@section('title', 'Daftar Dokter')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#003366",
                    "background-light": "#f8fafc",
                    "background-dark": "#0f172a",
                    "accent-teal": "#0d9488",
                    "accent-slate": "#64748b",
                },
                fontFamily: {
                    "display": ["Public Sans", "sans-serif"]
                },
                borderRadius: {
                    DEFAULT: "0.25rem",
                    lg: "0.5rem",
                    xl: "0.75rem",
                    full: "9999px"
                },
            },
        },
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        color: #003366;
    }

    body {
        font-family: 'Public Sans', sans-serif;
    }

    html,
    body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
    {{-- Search form --}}
    <form method="GET" action="{{ route('guest.daftar-dokter.index') }}" class="max-w-2xl mx-auto mb-6">
        <div class="relative">
            <span class="material-symbols-outlined absolute left-4 top-10 -translate-y-1/2 text-primary">search</span>
            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-12 pr-4 py-4 ..." placeholder="Cari nama dokter atau spesialisasi...">
        </div>
    </form>

    {{-- Filter links --}}
    <div class="flex flex-wrap justify-center gap-2">
        @php
            $currentSpesialis = request('spesialis');
            $validSpesialis = [];
            foreach ($spesialisList ?? [] as $sp) {
                if (!empty(trim($sp))) {
                    $validSpesialis[$sp] = $sp;
                }
            }
            $filters = ['Semua Spesialis' => null] + $validSpesialis;
        @endphp

        @foreach ($filters as $label => $value)
        <a href="{{ route('guest.daftar-dokter.index', array_merge(request()->except('spesialis'), $value ? ['spesialis' => $value] : [])) }}"
            class="px-5 py-2 rounded-full text-sm font-medium transition-colors
                  {{ ($currentSpesialis == $value) 
                      ? 'bg-primary text-white shadow-sm' 
                      : 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary/50' }}">
            {{ $label === 'Semua Spesialis' ? 'Semua Spesialis' : str_replace('Spesialis ', '', $label) }}
        </a>
        @endforeach
    </div>

    {{-- Data Dokter --}}
    @php
    $doctors = $doctors ?? [];
    @endphp

    <div class="grid grid-cols-1 gap-6">
        @foreach ($doctors as $doctor)
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-md transition">
            <div class="flex flex-col lg:flex-row">
                {{-- Profile --}}
                <div class="p-6 lg:w-1/3 flex items-start gap-4 border-b lg:border-b-0 lg:border-r border-slate-100 dark:border-slate-700">
                    <div class="w-24 h-24 lg:w-32 lg:h-32 rounded-xl bg-slate-100 dark:bg-slate-900 overflow-hidden shrink-0">
                        <img src="{{ $doctor['img'] }}" alt="{{ $doctor['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-accent-teal text-xs font-bold uppercase tracking-wider mb-1">
                            {{ str_replace('Spesialis ', '', $doctor['spesialis']) }}
                        </span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">{{ $doctor['name'] }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $doctor['spesialis'] }}</p>
                    </div>
                </div>
                {{-- Schedule --}}
                <div class="p-6 lg:w-2/3 bg-slate-50/50 dark:bg-slate-800/50">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">calendar_month</span>
                        <h4 class="font-semibold text-slate-800 dark:text-slate-200">Jadwal Praktik Mingguan</h4>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                        @php $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; @endphp
                        @foreach ($days as $day)
                        @php
                        $schedule = $doctor['schedule'][$day] ?? 'Tutup';
                        $isClosed = ($schedule == 'Tutup');
                        $bgClass = $isClosed ? 'bg-red-50 dark:bg-red-900/20' : 'bg-blue-50 dark:bg-blue-900/20';
                        $borderClass = $isClosed ? 'border-red-200 dark:border-red-800' : 'border-blue-200 dark:border-blue-800';
                        $textClass = $isClosed ? 'text-red-500' : 'text-primary';
                        $timeClass = $isClosed ? 'text-red-500' : 'font-medium text-slate-700 dark:text-slate-300';
                        @endphp
                        <div class="{{ $bgClass }} p-3 rounded-lg border {{ $borderClass }} flex flex-col items-center">
                            <span class="text-[10px] {{ $textClass }} font-bold uppercase">{{ $day }}</span>
                            <span class="text-xs {{ $timeClass }} mt-1">{{ $schedule }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $dokters->appends(request()->query())->links() }}
    </div>

    {{-- Footer --}}
    <div class="mt-12 text-center text-slate-400 dark:text-slate-600 text-sm">
        <p>
            menampilkan <span class="font-medium text-slate-600 dark:text-slate-400">{{ $dokters->lastItem() ?? 0 }}</span>
            dari <span class="font-medium text-slate-600 dark:text-slate-400">{{ $dokters->total() }}</span> dokter spesialis aktif
        </p>
        <p class="mt-1 italic">Jadwal dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</p>
    </div>
</div>
@endsection