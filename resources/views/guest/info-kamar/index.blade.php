@extends('layouts.guest.guest')

@section('title', 'Info Kamar')

@section('content')


<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="layout-container flex h-full grow flex-col">
<div class="mx-auto flex w-full max-w-[1200px] flex-1 flex-col px-4 py-8 md:px-10">
<!-- Page Header -->
<div class="flex flex-wrap justify-between items-end gap-4 mb-8">
<div class="flex flex-col gap-2">
<div class="flex items-center gap-2 mb-1">
<span class="material-symbols-outlined text-medical-blue" style="font-variation-settings: 'FILL' 1">bed</span>
<span class="text-medical-blue font-bold tracking-wider uppercase text-xs">Informasi Real-time</span>
</div>
<h1 class="text-slate-900 dark:text-slate-100 text-4xl font-black leading-tight tracking-tight">Ketersediaan Kamar</h1>
<p class="text-slate-500 dark:text-slate-400 text-base max-w-xl">Informasi kapasitas tempat tidur rumah sakit yang diperbarui secara berkala untuk kemudahan akses pasien dan rujukan.</p>
</div>
<div class="flex items-center gap-3">
<p class="text-xs text-slate-400 italic">Terakhir diperbarui: Hari ini, 14:30 WIB</p>
<button class="flex items-center justify-center gap-2 rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
<span class="material-symbols-outlined text-sm">refresh</span>
<span>Perbarui Data</span>
</button>
</div>
</div>
<!-- Stats Overview -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Kapasitas</p>
<span class="material-symbols-outlined text-medical-blue">domain</span>
</div>
<p class="text-slate-900 dark:text-white text-3xl font-bold">450</p>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-medical-teal text-sm">trending_up</span>
<p class="text-medical-teal text-xs font-semibold">+2 Bed Baru</p>
</div>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Kamar Terisi</p>
<span class="material-symbols-outlined text-medical-blue">person_filled</span>
</div>
<p class="text-slate-900 dark:text-white text-3xl font-bold">312</p>
<div class="flex items-center gap-1">
<p class="text-slate-400 text-xs">Okupansi 69%</p>
</div>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-800 border border-primary/20 shadow-sm relative overflow-hidden">
<div class="absolute top-0 right-0 w-16 h-16 bg-primary/5 rounded-full -mr-8 -mt-8"></div>
<div class="flex justify-between items-start relative z-10">
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Tersedia</p>
<span class="material-symbols-outlined text-primary">check_circle</span>
</div>
<p class="text-primary text-3xl font-bold relative z-10">138</p>
<div class="flex items-center gap-1 relative z-10">
<p class="text-slate-400 text-xs">Siap Digunakan</p>
</div>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-medical-blue text-white shadow-lg">
<div class="flex justify-between items-start">
<p class="text-white/70 text-sm font-medium">Ruang Intensif</p>
<span class="material-symbols-outlined text-white/80">emergency</span>
</div>
<p class="text-white text-3xl font-bold">12</p>
<div class="flex items-center gap-1">
<p class="text-white/60 text-xs italic text-orange-300 font-semibold">Tersisa Sedikit</p>
</div>
</div>
</div>
<!-- Filter Section -->
<div class="mb-8">
<div class="flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-medical-blue text-lg">filter_alt</span>
<h2 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-tight">Kelas Ruangan</h2>
</div>
<div class="flex flex-wrap gap-2">
<button class="px-5 py-2.5 rounded-full bg-medical-blue text-white text-sm font-semibold transition-all">
                        Semua Kelas
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all flex items-center gap-2">
                        VIP / VVIP
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">
                        Kelas 1
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">
                        Kelas 2
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">
                        Kelas 3
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">
                        Intensif
                    </button>
<button class="px-5 py-2.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:border-primary hover:text-primary transition-all">
                        Isolasi
                    </button>
</div>
</div>
<!-- Table Section -->
<div class="mb-6">
<div class="flex items-center justify-between mb-4 px-1">
<h2 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-tight">Daftar Ruangan</h2>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
<input class="pl-9 pr-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-primary focus:border-primary outline-none min-w-[240px]" placeholder="Cari nama ruangan..." type="text"/>
</div>
</div>
<div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Ruangan</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Total Kapasitas</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Tersedia</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800">
<!-- VIP Rows -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-xl">king_bed</span>
</div>
<div class="font-semibold text-slate-900 dark:text-slate-200">Suite Anggrek 01</div>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded-md bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-bold uppercase tracking-wide">VVIP</span>
</td>
<td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">1</td>
<td class="px-6 py-4 text-center">
<span class="text-medical-teal font-bold text-lg">1</span>
</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Tersedia
                                    </span>
</td>
</tr>
<!-- Kelas 1 Rows -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-medical-blue/10 flex items-center justify-center">
<span class="material-symbols-outlined text-medical-blue text-xl">bedroom_parent</span>
</div>
<div class="font-semibold text-slate-900 dark:text-slate-200">Ruang Melati</div>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded-md bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold uppercase tracking-wide">Kelas 1</span>
</td>
<td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">24</td>
<td class="px-6 py-4 text-center">
<span class="text-medical-teal font-bold text-lg">8</span>
</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Tersedia
                                    </span>
</td>
</tr>
<!-- Intensif Rows -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
<span class="material-symbols-outlined text-red-600 text-xl">emergency</span>
</div>
<div class="font-semibold text-slate-900 dark:text-slate-200">ICU (Intensive Care)</div>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded-md bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-bold uppercase tracking-wide">Intensif</span>
</td>
<td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">10</td>
<td class="px-6 py-4 text-center">
<span class="text-red-600 font-bold text-lg">2</span>
</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Terbatas
                                    </span>
</td>
</tr>
<!-- Kelas 3 Rows -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
<span class="material-symbols-outlined text-slate-500 text-xl">hotel</span>
</div>
<div class="font-semibold text-slate-900 dark:text-slate-200">Bangsal Mawar (A-F)</div>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded-md bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wide">Kelas 3</span>
</td>
<td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">60</td>
<td class="px-6 py-4 text-center">
<span class="text-medical-teal font-bold text-lg">45</span>
</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Tersedia
                                    </span>
</td>
</tr>
<!-- Isolasi Rows -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
<span class="material-symbols-outlined text-orange-600 text-xl">masks</span>
</div>
<div class="font-semibold text-slate-900 dark:text-slate-200">Isolasi Pinere</div>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded-md bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-xs font-bold uppercase tracking-wide">Isolasi</span>
</td>
<td class="px-6 py-4 text-center text-slate-600 dark:text-slate-400 font-medium">15</td>
<td class="px-6 py-4 text-center">
<span class="text-slate-400 font-bold text-lg">0</span>
</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        Penuh
                                    </span>
</td>
</tr>
</tbody>
</table>
</div>
<div class="mt-4 flex items-center justify-between text-sm text-slate-500">
<p>Menampilkan 5 dari 18 unit ruangan</p>
<div class="flex gap-2">
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
<!-- Additional Info -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
<div class="p-5 rounded-xl bg-medical-blue/5 border border-medical-blue/10 flex gap-4">
<span class="material-symbols-outlined text-medical-blue shrink-0">info</span>
<div>
<h4 class="font-bold text-medical-blue text-sm mb-1">Catatan Penting</h4>
<p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Data ketersediaan kamar dapat berubah sewaktu-waktu sesuai dengan kondisi di lapangan. Pasien disarankan untuk melakukan konfirmasi ulang melalui Call Center sebelum melakukan pendaftaran rujukan.</p>
</div>
</div>
<div class="p-5 rounded-xl bg-primary/5 border border-primary/10 flex gap-4">
<span class="material-symbols-outlined text-primary shrink-0">call</span>
<div>
<h4 class="font-bold text-primary text-sm mb-1">Butuh Bantuan?</h4>
<p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed">Hubungi Admission Center di (021) 555-0123 atau melalui WhatsApp di 0812-3456-7890 untuk informasi pemesanan kamar dan syarat administrasi.</p>
</div>
</div>
</div>
</div>
</div>
</body></html>

@endsection