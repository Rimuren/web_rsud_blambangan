@extends('layouts.guest.guest')

@section('title', 'Info Kamar')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#ec5b13",
                    "medical-blue": "#003366",
                    "medical-teal": "#0d9488",
                    "background-light": "#f8f6f6",
                    "background-dark": "#221610",
                },
                fontFamily: {
                    "display": ["Public Sans"]
                },
                borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
            },
        },
    }
</script>
<style>
    html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
</style>

<div class="mx-auto w-full max-w-[1200px] flex-1 flex flex-col px-4 py-6 md:px-10 md:py-8">
    {{-- Page Header --}}
    <div class="flex flex-wrap justify-between items-end gap-4 mb-6 md:mb-8">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-medical-blue" style="font-variation-settings: 'FILL' 1">bed</span>
                <span class="text-medical-blue font-bold tracking-wider uppercase text-xs">Informasi Real-time</span>
            </div>
            <h1 class="text-slate-900 dark:text-slate-100 text-3xl md:text-4xl font-black leading-tight tracking-tight">Ketersediaan Kamar</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm md:text-base max-w-xl">Informasi kapasitas tempat tidur rumah sakit yang diperbarui secara berkala untuk kemudahan akses pasien dan rujukan.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
            <p class="text-xs text-slate-400 italic">Terakhir diperbarui: Hari ini, 14:30 WIB</p>
            <button class="flex items-center justify-center gap-2 rounded-xl h-10 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-sm">refresh</span>
                <span>Perbarui Data</span>
            </button>
        </div>
    </div>

    {{-- Stats Overview --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 md:mb-10">
        <div class="flex flex-col gap-2 rounded-xl p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Kapasitas</p>
                <span class="material-symbols-outlined text-medical-blue">domain</span>
            </div>
            <p class="text-slate-900 dark:text-white text-2xl md:text-3xl font-bold">450</p>
            <div class="flex items-center gap-1">
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Kamar Terisi</p>
                <span class="material-symbols-outlined text-medical-blue">person_filled</span>
            </div>
            <p class="text-slate-900 dark:text-white text-2xl md:text-3xl font-bold">312</p>
            <p class="text-slate-400 text-xs">Okupansi 69%</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 bg-white dark:bg-slate-800 border border-primary/20 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 bg-primary/5 rounded-full -mr-8 -mt-8"></div>
            <div class="flex justify-between items-start relative z-10">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Tersedia</p>
                <span class="material-symbols-outlined text-primary">check_circle</span>
            </div>
            <p class="text-primary text-2xl md:text-3xl font-bold relative z-10">138</p>
            <p class="text-slate-400 text-xs relative z-10">Siap Digunakan</p>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 bg-medical-blue text-white shadow-lg">
            <div class="flex justify-between items-start">
                <p class="text-white/70 text-sm font-medium">Ruang Intensif</p>
                <span class="material-symbols-outlined text-white/80">emergency</span>
            </div>
            <p class="text-white text-2xl md:text-3xl font-bold">12</p>
            <p class="text-white/70 text-xs italic font-semibold">Tersisa Sedikit</p>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="mb-6 md:mb-8">
        <div class="flex items-center gap-2 mb-3">
            <span class="material-symbols-outlined text-medical-blue text-lg">filter_alt</span>
            <h2 class="text-slate-900 dark:text-white text-lg md:text-xl font-bold tracking-tight">Kelas Ruangan</h2>
        </div>
        <div class="flex flex-wrap gap-2">
            @php
                $filters = ['Semua Kelas', 'VIP / VVIP', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Intensif', 'Isolasi'];
            @endphp
            <button class="px-4 py-2 rounded-full bg-medical-blue text-white text-sm font-semibold transition-all">{{ $filters[0] }}</button>
            @foreach (array_slice($filters, 1) as $filter)
                <button class="px-4 py-2 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">{{ $filter }}</button>
            @endforeach
        </div>
    </div>

    {{-- Data Kamar: Tabel untuk desktop, Card untuk mobile --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
            <h2 class="text-slate-900 dark:text-white text-lg md:text-xl font-bold tracking-tight">Daftar Ruangan</h2>
            <div class="relative w-full sm:w-auto">
                <span class="material-symbols-outlined absolute left-3 top-[85%] -translate-y-1/2 text-slate-400 text-sm">search</span>
                <input class="pl-9 pr-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-primary focus:border-primary outline-none w-full sm:min-w-[240px]" placeholder="Cari nama ruangan..." type="text">
            </div>
        </div>

        @php
            $rooms = [
                ['name' => 'Suite Anggrek 01', 'class' => 'VVIP', 'class_badge' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300', 'total' => 1, 'available' => 1, 'status' => 'Tersedia', 'status_badge' => 'bg-emerald-100 text-emerald-800', 'icon' => 'king_bed', 'icon_bg' => 'bg-primary/10', 'icon_color' => 'text-primary'],
                ['name' => 'Ruang Melati', 'class' => 'Kelas 1', 'class_badge' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300', 'total' => 24, 'available' => 8, 'status' => 'Tersedia', 'status_badge' => 'bg-emerald-100 text-emerald-800', 'icon' => 'bedroom_parent', 'icon_bg' => 'bg-medical-blue/10', 'icon_color' => 'text-medical-blue'],
                ['name' => 'ICU (Intensive Care)', 'class' => 'Intensif', 'class_badge' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300', 'total' => 10, 'available' => 2, 'status' => 'Terbatas', 'status_badge' => 'bg-amber-100 text-amber-800', 'icon' => 'emergency', 'icon_bg' => 'bg-red-100', 'icon_color' => 'text-red-600'],
                ['name' => 'Bangsal Mawar (A-F)', 'class' => 'Kelas 3', 'class_badge' => 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300', 'total' => 60, 'available' => 45, 'status' => 'Tersedia', 'status_badge' => 'bg-emerald-100 text-emerald-800', 'icon' => 'hotel', 'icon_bg' => 'bg-slate-100 dark:bg-slate-800', 'icon_color' => 'text-slate-500'],
                ['name' => 'Isolasi Pinere', 'class' => 'Isolasi', 'class_badge' => 'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300', 'total' => 15, 'available' => 0, 'status' => 'Penuh', 'status_badge' => 'bg-slate-100 text-slate-800', 'icon' => 'masks', 'icon_bg' => 'bg-orange-100', 'icon_color' => 'text-orange-600'],
            ];
        @endphp

        {{-- Tampilan Tabel (Desktop) --}}
        <div class="hidden md:block overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Ruangan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Total</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Tersedia</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($rooms as $room)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg {{ $room['icon_bg'] }} flex items-center justify-center">
                                        <span class="material-symbols-outlined {{ $room['icon_color'] }} text-xl">{{ $room['icon'] }}</span>
                                    </div>
                                    <div class="font-semibold text-slate-900 dark:text-slate-200">{{ $room['name'] }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md {{ $room['class_badge'] }} text-xs font-bold uppercase tracking-wide">{{ $room['class'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">{{ $room['total'] }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-lg {{ $room['available'] == 0 ? 'text-slate-400' : ($room['class'] == 'Intensif' ? 'text-red-600' : 'text-medical-teal') }}">{{ $room['available'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $room['status_badge'] }}">
                                    {{ $room['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tampilan Card (Mobile) --}}
        <div class="md:hidden flex flex-col gap-3">
            @foreach ($rooms as $room)
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg {{ $room['icon_bg'] }} flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined {{ $room['icon_color'] }} text-xl">{{ $room['icon'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-slate-900 dark:text-slate-200 text-base">{{ $room['name'] }}</h3>
                                <span class="px-2 py-0.5 rounded-md {{ $room['class_badge'] }} text-xs font-bold uppercase tracking-wide">{{ $room['class'] }}</span>
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Kapasitas</p>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $room['total'] }} bed</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Tersedia</p>
                                    <p class="font-bold text-xl {{ $room['available'] == 0 ? 'text-slate-400' : ($room['class'] == 'Intensif' ? 'text-red-600' : 'text-medical-teal') }}">{{ $room['available'] }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $room['status_badge'] }}">
                                        {{ $room['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-slate-500">
            <p>Menampilkan 5 dari 18 unit ruangan</p>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-primary bg-primary text-white font-bold transition-colors">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white hover:bg-slate-50 transition-colors">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white hover:bg-slate-50 transition-colors">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Additional Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
        <div class="p-4 rounded-xl bg-medical-blue/5 border border-medical-blue/10 flex gap-3">
            <span class="material-symbols-outlined text-medical-blue shrink-0">info</span>
            <div>
                <h4 class="font-bold text-medical-blue text-sm mb-1">Catatan Penting</h4>
                <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Data ketersediaan kamar dapat berubah sewaktu-waktu sesuai dengan kondisi di lapangan. Pasien disarankan untuk melakukan konfirmasi ulang melalui Call Center sebelum melakukan pendaftaran rujukan.</p>
            </div>
        </div>
        <div class="p-4 rounded-xl bg-primary/5 border border-primary/10 flex gap-3">
            <span class="material-symbols-outlined text-primary shrink-0">call</span>
            <div>
                <h4 class="font-bold text-primary text-sm mb-1">Butuh Bantuan?</h4>
                <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Hubungi Admission Center di (021) 555-0123 atau melalui WhatsApp di 0812-3456-7890 untuk informasi pemesanan kamar dan syarat administrasi.</p>
            </div>
        </div>
    </div>
</div>
@endsection