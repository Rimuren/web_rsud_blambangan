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
                fontFamily: { "display": ["Public Sans", "sans-serif"] },
                borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
            },
        },
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        color: #003366;
    }
    body { font-family: 'Public Sans', sans-serif; }
   
    html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-8 md:py-12 overflow-hidden">
    {{-- Search & Filter --}}
    <div class="mb-10 space-y-6">
        <div class="max-w-2xl mx-auto">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-10 -translate-y-1/2 text-primary">search</span>
                <input type="text" class="block w-full pl-12 pr-4 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-slate-700 dark:text-slate-200" placeholder="Cari nama dokter atau spesialisasi...">
            </div>
        </div>
        <div class="flex flex-wrap justify-center gap-2">
            @php $polies = ['Semua Poli', 'Penyakit Dalam', 'Anak', 'Jantung', 'Saraf', 'Mata']; @endphp
            <button class="px-5 py-2 rounded-full bg-primary text-white font-medium text-sm transition-colors">{{ $polies[0] }}</button>
            @foreach (array_slice($polies, 1) as $poli)
                <button class="px-5 py-2 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary/50 text-sm font-medium transition-colors">{{ $poli }}</button>
            @endforeach
        </div>
    </div>

    {{-- Data Dokter --}}
    @php
        $doctors = [
            [
                'name' => 'dr. Andi Pratama, Sp.PD',
                'specialty' => 'Spesialis Penyakit Dalam',
                'poly' => 'Poli Penyakit Dalam',
                'exp' => 12,
                'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD8lPEXhEsDsFvqFOuX466nkmty_dd1b6qy2_ETryZLmfVNTQsoabF-de_cw2Wa4xNIvc4RMpIalQu_CaA4ax-YFRhTmuo05N4BB-gSEgLAh3KBdMuPYul2bjyNyMF8anyVkbwnbcrVWfW_9lGJbeeWQvKVK6UaBSKMPqEiSVh2QB4PhWNED1exhMEAxJp-ar-RQz1C_2MFuFQx-e569ug46Bnp5P7z_QnYveLQ7FIup8rVNtJy--hRxYpz1jJFuNQepZ67YxyFCz4',
                'schedule' => ['Senin'=>'08:00-14:00', 'Selasa'=>'08:00-14:00', 'Rabu'=>'08:00-14:00', 'Kamis'=>'10:00-16:00', 'Jumat'=>'10:00-16:00', 'Sabtu'=>'Tutup'],
            ],
            [
                'name' => 'dr. Sinta Wijaya, Sp.A',
                'specialty' => 'Spesialis Anak & Tumbuh Kembang',
                'poly' => 'Poli Anak',
                'exp' => 8,
                'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAzteo6yJuFHb2hChvSmrGGCeHbxWqzl27T7pdFkbGHuWN1ZRetGOQRjlco9kusgpPhjWGGcSpWV7P-EqKPPFMAKg1difuVmGdEXa6aDdVgNyJ8wqdUwWOyvLJKkdekNGM_Tr-aZAA_GvGGyo_QhyXQ2GWHH6r1xM0xnV6eUpltrpuMeL-NmQg-YKMudkHKCwRaFAN-7WOcQNFSIxFGiWwqTf9NSJt19zPNot-XXyD88UbRaR0x0kMyyToFEiGH8DtSvpQEnKqXKIU',
                'schedule' => ['Senin'=>'09:00-15:00', 'Selasa'=>'Tutup', 'Rabu'=>'09:00-15:00', 'Kamis'=>'09:00-15:00', 'Jumat'=>'13:00-17:00', 'Sabtu'=>'08:00-12:00'],
            ],
            [
                'name' => 'dr. Budi Santoso, Sp.JP',
                'specialty' => 'Spesialis Jantung & Pembuluh Darah',
                'poly' => 'Poli Jantung',
                'exp' => 15,
                'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQFVlD0c3iubl3wS1NPth3yc7RFyy05e6pAAkax659QZkPUcnHd3vEoji0qgPTNuSfKjaZ40rAB9kBnYm-Dv3KEZE8btBFzihLu1M4SyeMITkWTxOVRM7e54zkKTIsm_e6JZ83dMhsbICWkDCwzuY6tk_MDTlsnWjPN4feW2hWV3qlaClB2Tni3KXAu8CdinY-CewEu7zAiZZj_UU-hm5l8c_4ULR5r8YYxmSM9kC6Ahfx9R8u34-NG4d9TOY_fkWPBK4YHw6KnS0',
                'schedule' => ['Senin'=>'16:00-20:00', 'Selasa'=>'16:00-20:00', 'Rabu'=>'16:00-20:00', 'Kamis'=>'16:00-20:00', 'Jumat'=>'16:00-18:00', 'Sabtu'=>'Tutup'],
            ]
        ];
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
                        <span class="text-accent-teal text-xs font-bold uppercase tracking-wider mb-1">{{ $doctor['poly'] }}</span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">{{ $doctor['name'] }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">{{ $doctor['specialty'] }}</p>
                        <div class="flex items-center gap-1 mt-3 text-slate-600 dark:text-slate-400">
                            <span class="material-symbols-outlined text-base">work_history</span>
                            <span class="text-sm">{{ $doctor['exp'] }} Tahun Pengalaman</span>
                        </div>
                        <div class="flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-base">verified</span>
                            <span class="text-sm">IDI Terverifikasi</span>
                        </div>
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

    {{-- Footer --}}
    <div class="mt-12 text-center text-slate-400 dark:text-slate-600 text-sm">
        <p>Menampilkan {{ count($doctors) }} dari 24 dokter spesialis aktif di Rumah Sakit.</p>
        <p class="mt-1 italic">Jadwal dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</p>
    </div>
</div>
@endsection