@extends('layouts.guest.guest')

@section('title', $poliDetail['name'] . ' - Layanan Rawat Jalan')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'navy': {
                        50:  '#eef2ff',
                        100: '#dde6ff',
                        600: '#1e40af',
                        800: '#1e3a8a',
                        900: '#0f2158',
                        950: '#0c1a3a',
                    }
                },
                fontFamily: {
                    sans: ['"Poppins"', 'sans-serif'],
                }
            }
        }
    }
</script>

<style>
    body { font-family: 'Poppins', sans-serif; }
    html, body { overflow-x: hidden; }

    .fade-in {
        animation: fadeIn 0.4s ease both;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .table-row:nth-child(even) { background-color: #f8faff; }
    .table-row:hover            { background-color: #eff4ff; }
</style>

{{-- ─────────────────────────────────────────────── --}}
{{-- PAGE WRAPPER                                     --}}
{{-- ─────────────────────────────────────────────── --}}
<div class="min-h-screen bg-gray-50">
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 space-y-8 fade-in">

    {{-- ── BREADCRUMB & BACK ── --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('guest.layanan-rawat-jalan.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none"
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
            </svg>
            Kembali ke Daftar Poliklinik
        </a>

        <nav class="hidden sm:flex items-center gap-1.5 text-xs text-gray-400">
            <span>Layanan Rawat Jalan</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-600 font-medium">{{ $poliDetail['name'] }}</span>
        </nav>
    </div>

    {{-- ── HERO HEADER ── --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 via-blue-500 to-sky-400"></div>
        <div class="flex flex-col sm:flex-row items-start gap-6 p-6 sm:p-8">
            <div class="flex-shrink-0 w-16 h-16 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center shadow-inner">
                <span class="material-symbols-outlined" style="font-size:32px;color:#1d4ed8;font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 32;">
                    {{ $poliDetail['icon'] }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest mb-1">Layanan Rawat Jalan</p>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-navy-900 tracking-tight leading-tight">
                    {{ $poliDetail['name'] }}
                </h1>
                <div class="mt-2 flex items-center gap-2">
                    <div class="w-10 h-1 bg-blue-500 rounded-full"></div>
                    <div class="w-4 h-1 bg-blue-200 rounded-full"></div>
                </div>
                @if(!empty($poliDetail['description']))
                <p class="mt-3 text-sm sm:text-base text-gray-500 leading-relaxed max-w-xl">
                    {{ $poliDetail['description'] }}
                </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ── TENTANG LAYANAN ── --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                </svg>
            </div>
            <h2 class="text-sm font-bold uppercase tracking-widest text-navy-900">Tentang Layanan</h2>
        </div>
        <div class="px-6 py-5">
            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                {{ $poliDetail['description'] ?? 'Deskripsi layanan belum tersedia.' }}
            </p>
        </div>
    </div>

    {{-- ── JADWAL DOKTER ── --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-700" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                    </svg>
                </div>
                <h2 class="text-sm font-bold uppercase tracking-widest text-navy-900">Jadwal Dokter {{ $poliDetail['name'] }}</h2>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1 text-xs text-amber-600 bg-amber-50 border border-amber-200 rounded-full px-3 py-1 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                </svg>
                Jadwal dapat berubah sewaktu-waktu
            </span>
        </div>

        {{-- Mobile disclaimer --}}
        <p class="sm:hidden text-xs text-amber-600 bg-amber-50 border-b border-amber-100 px-6 py-2 italic">
            * Jadwal dapat berubah sewaktu-waktu tanpa pemberitahuan.
        </p>

        @if(!empty($poliDetail['doctors']))
            {{-- ========== TAMPILAN DESKTOP (TABEL) ========== --}}
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full text-sm min-w-[560px]">
                    <thead>
                        <tr class="bg-navy-900 text-white">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider w-1/4">Nama Dokter</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider w-1/4">Spesialisasi</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider w-1/4">Hari Praktik</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider w-1/4">Jam Praktik</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($poliDetail['doctors'] as $doctor)
                            @php
                                $scheduleCount = count($doctor['schedules']);
                                $badgeCls = $doctor['badge_class'] ?? 'bg-blue-50 text-blue-700 border border-blue-200';
                            @endphp
                            @foreach ($doctor['schedules'] as $idx => $schedule)
                            <tr class="table-row transition-colors {{ $idx === $scheduleCount - 1 ? 'border-b-2 border-gray-300' : '' }}">
                                @if ($idx === 0)
                                <td class="px-5 py-4" rowspan="{{ $scheduleCount }}">
                                    <p class="font-semibold text-navy-900">{{ $doctor['name'] }}</p>
                                    @if(!empty($doctor['title']))
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $doctor['title'] }}</p>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-gray-600" rowspan="{{ $scheduleCount }}">
                                    {{ $doctor['specialist'] ?: 'Spesialis' }}
                                </td>
                                @endif
                                <td class="px-5 py-4 text-gray-600 font-medium">{{ $schedule['days'] }}</td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full {{ $badgeCls }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        {{ $schedule['hours'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ========== TAMPILAN MOBILE (CARD) ========== --}}
            <div class="block sm:hidden divide-y divide-gray-200">
                @foreach ($poliDetail['doctors'] as $doctor)
                    @php $badgeCls = $doctor['badge_class'] ?? 'bg-blue-50 text-blue-700 border border-blue-200'; @endphp
                    <div class="px-5 py-4 space-y-3">
                        {{-- Nama Dokter & Spesialisasi --}}
                        <div>
                            <p class="font-semibold text-navy-900 text-sm">{{ $doctor['name'] }}</p>
                            @if(!empty($doctor['title']))
                            <p class="text-xs text-gray-400 mt-0.5">{{ $doctor['title'] }}</p>
                            @endif
                            <p class="text-xs text-gray-600 mt-1">{{ $doctor['specialist'] ?: 'Spesialis' }}</p>
                        </div>
                        {{-- List Jadwal --}}
                        <div class="space-y-2">
                            @foreach ($doctor['schedules'] as $schedule)
                            <div class="flex items-center justify-between text-xs bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                                <span class="font-medium text-gray-700">{{ $schedule['days'] }}</span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full {{ $badgeCls }} text-xs font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    {{ $schedule['hours'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Footer note --}}
            <div class="px-6 py-3 border-t border-gray-100 bg-gray-50/60">
                <p class="text-xs text-gray-400">
                    Menampilkan <span class="font-semibold text-gray-600">{{ count($poliDetail['doctors']) }}</span> dokter terdaftar pada poliklinik ini.
                </p>
            </div>
        @else
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center gap-3 py-14 px-6 text-center">
                <div class="w-12 h-12 rounded-full bg-yellow-50 border border-yellow-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-700">Data Belum Tersedia</p>
                <p class="text-xs text-gray-400 max-w-xs">
                    Data jadwal dokter untuk poliklinik ini belum tersedia. Silakan hubungi pihak rumah sakit untuk informasi lebih lanjut.
                </p>
            </div>
        @endif
    </div>

</div>
</div>

@endsection