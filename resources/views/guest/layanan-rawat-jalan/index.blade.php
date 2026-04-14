@extends('layouts.guest.guest')

@section('title', 'Layanan Rawat Jalan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#137fec",
                    "secondary-blue": "#003366",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101922",
                },
                fontFamily: { "display": ["Inter", "sans-serif"] },
                borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
            },
        },
    }
</script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        color: #003366;
    }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="px-4 md:px-10 lg:px-20 py-10">
        <div class="max-w-7xl mx-auto">
            {{-- Header --}}
            <div class="flex flex-col gap-2 mb-8">
                <h1 class="text-secondary-blue dark:text-primary text-2xl md:text-4xl font-black tracking-tight uppercase">
                    Layanan Rawat Jalan
                </h1>
                <div class="h-1.5 w-24 bg-primary rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-400 text-sm md:text-lg font-medium mt-2">
                    Daftar Lengkap Poliklinik Spesialis & Sub-Spesialis Rumah Sakit
                </p>
            </div>

            {{-- Data Poliklinik --}}
            @php
                $polies = [
                    ['name' => 'ANASTHESI', 'icon' => 'medical_services', 'type' => 'Spesialis', 'slug' => 'anasthesi'],
                    ['name' => 'ANAK', 'icon' => 'child_care', 'type' => 'Spesialis', 'slug' => 'anak'],
                    ['name' => 'BEDAH ONKOLOGI', 'icon' => 'content_cut', 'type' => 'Spesialis', 'slug' => 'bedah-onkologi'],
                    ['name' => 'BEDAH ORTOPEDI', 'icon' => 'skeleton', 'type' => 'Spesialis', 'slug' => 'bedah-ortopedi'],
                    ['name' => 'BEDAH SYARAF', 'icon' => 'psychology', 'type' => 'Spesialis', 'slug' => 'bedah-syaraf'],
                    ['name' => 'BEDAH UMUM', 'icon' => 'health_and_safety', 'type' => 'Spesialis', 'slug' => 'bedah-umum'],
                    ['name' => 'FNAB', 'icon' => 'biotech', 'type' => 'Spesialis', 'slug' => 'fnab'],
                    ['name' => 'GIGI DAN MULUT', 'icon' => 'dentistry', 'type' => 'Spesialis', 'slug' => 'gigi-mulut'],
                    ['name' => 'GIGI SPESIALIS ANAK', 'icon' => 'face_6', 'type' => 'Spesialis', 'slug' => 'gigi-anak'],
                    ['name' => 'GIGI SPESIALIS KONSERVASI', 'icon' => 'build_circle', 'type' => 'Spesialis', 'slug' => 'gigi-konservasi'],
                    ['name' => 'GIGI SPESIALIS PENYAKIT MULUT', 'icon' => 'masks', 'type' => 'Spesialis', 'slug' => 'gigi-mulut-spesialis'],
                    ['name' => 'GIZI', 'icon' => 'restaurant', 'type' => 'Spesialis', 'slug' => 'gizi'],
                    ['name' => 'JANTUNG', 'icon' => 'cardiology', 'type' => 'Spesialis', 'slug' => 'jantung'],
                    ['name' => 'JIWA', 'icon' => 'mindfulness', 'type' => 'Spesialis', 'slug' => 'jiwa'],
                    ['name' => 'KULIT KELAMIN', 'icon' => 'dermatology', 'type' => 'Spesialis', 'slug' => 'kulit-kelamin'],
                    ['name' => 'MATA', 'icon' => 'visibility', 'type' => 'Spesialis', 'slug' => 'mata'],
                    ['name' => 'OBGYN', 'icon' => 'pregnant_woman', 'type' => 'Spesialis', 'slug' => 'obgyn'],
                    ['name' => 'PARU', 'icon' => 'pulmonology', 'type' => 'Spesialis', 'slug' => 'paru'],
                    ['name' => 'PENYAKIT DALAM', 'icon' => 'stethoscope', 'type' => 'Spesialis', 'slug' => 'penyakit-dalam'],
                    ['name' => 'PSIKOLOGI', 'icon' => 'neurology', 'type' => 'Spesialis', 'slug' => 'psikologi'],
                    ['name' => 'REHAB MEDIK', 'icon' => 'physical_therapy', 'type' => 'Spesialis', 'slug' => 'rehab-medik'],
                    ['name' => 'SARAF', 'icon' => 'neurology', 'type' => 'Spesialis', 'slug' => 'saraf'],
                    ['name' => 'TB DOTS', 'icon' => 'air', 'type' => 'Spesialis', 'slug' => 'tb-dots'],
                    ['name' => 'TB RO', 'icon' => 'vaccines', 'type' => 'Spesialis', 'slug' => 'tb-ro'],
                    ['name' => 'THT', 'icon' => 'hearing', 'type' => 'Spesialis', 'slug' => 'tht'],
                    ['name' => 'UMUM', 'icon' => 'medical_information', 'type' => 'Umum', 'slug' => 'umum'],
                    ['name' => 'UROLOGY', 'icon' => 'water_drop', 'type' => 'Spesialis', 'slug' => 'urology'],
                    ['name' => 'VCT', 'icon' => 'shield_with_heart', 'type' => 'Spesialis', 'slug' => 'vct'],
                    ['name' => 'ESWL', 'icon' => 'bolt', 'type' => 'Spesialis', 'slug' => 'eswl'],
                    ['name' => 'FETOMATERNAL', 'icon' => 'baby_changing_station', 'type' => 'Spesialis', 'slug' => 'fetomaternal'],
                    ['name' => 'BTKV', 'icon' => 'syringe', 'type' => 'Spesialis', 'slug' => 'btkv'],
                ];
            @endphp

            {{-- Grid Poliklinik --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-5">
                @foreach ($polies as $poli)
                <a href="{{ route('guest.layanan-rawat-jalan.detail', $poli['slug']) }}" class="group flex flex-col items-center text-center gap-2 md:gap-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-3 md:p-5 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-pointer">
                    <div class="flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined !text-2xl md:!text-3xl">{{ $poli['icon'] }}</span>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <h3 class="text-secondary-blue dark:text-slate-100 text-[11px] md:text-sm font-extrabold leading-tight uppercase">{{ $poli['name'] }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-[9px] md:text-xs font-medium">{{ $poli['type'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection