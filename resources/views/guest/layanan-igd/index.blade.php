@extends('layouts.guest.guest')

@section('title', 'Layanan IGD')

@section('content')


<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Hospital Emergency Department Page</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "secondary-dark": "#003366",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
<!-- Main Content Container -->
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<!-- Hero Section with Split Design -->
<div class="flex flex-1 justify-center items-center py-12 px-6 md:px-20 lg:px-40">
<div class="layout-content-container flex flex-col max-w-[1280px] flex-1">
<div class="@container">
<div class="flex flex-col gap-8 lg:gap-16 @[864px]:flex-row-reverse items-center">
<!-- Image Section (Right Side) -->
<div class="w-full lg:w-1/2 aspect-video lg:aspect-square bg-center bg-no-repeat bg-cover rounded-xl shadow-2xl border-4 border-white dark:border-slate-800" data-alt="Modern high-tech emergency room with medical equipment" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD7_LGc_Lc1_MvkhEJUv1dafmhD1t9R6tm0w7bH_QvCZr08WxwAquVP65n9SddKJ5J9dfJ16gdXNPEWPxVoVvAKvmK0xMSUbsQA3wKR2kip5pdYy_h2zEStlId8Z1qI5GqJ6Vh1Fxkm9iIcV23spEZhyMhtau-6iUVWz1PNIvAie6uMFMkmXynKFZbFYyvBhN7wBHA3nXzetZgRoeU2nw9mJl7pngfLWvuxiAyj8C6LAgdv1jprgrXzmq_K0ccfXptqiiOx3yWle-px");'>
</div>
<!-- Text Content Section (Left Side) -->
<div class="flex flex-col gap-8 w-full lg:w-1/2 lg:justify-center">
<div class="flex flex-col gap-4 text-left">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 w-fit mb-2">
<span class="material-symbols-outlined text-sm">emergency</span>
<span class="text-xs font-bold uppercase tracking-wider">Layanan 24 Jam</span>
</div>
<h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-tight @[480px]:text-6xl">
                                        Instalasi Gawat Darurat
                                    </h1>
<p class="text-slate-600 dark:text-slate-400 text-lg font-normal leading-relaxed max-w-xl">
                                        Unit pelayanan 24 Jam di rumah sakit untuk penanganan awal cepat dan tepat bagi pasien dengan kondisi medis akut yang mengancam nyawa atau berisiko kecacatan permanen.
                                    </p>
</div>
<!-- Action Buttons -->
<div class="flex flex-wrap gap-4">
<button class="flex min-w-[200px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-14 px-6 bg-red-600 hover:bg-red-700 text-white text-lg font-bold transition-all shadow-lg hover:shadow-red-500/20">
<span class="material-symbols-outlined">call</span>
<span class="truncate">Hubungi Darurat</span>
</button>
<button class="flex min-w-[180px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-14 px-6 bg-secondary-dark hover:bg-slate-800 text-white text-lg font-bold transition-all shadow-lg">
<span class="material-symbols-outlined">location_on</span>
<span class="truncate">Lihat Lokasi</span>
</button>
</div>
<!-- Feature Cards Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
<!-- Card 1 -->
<div class="flex gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-5 backdrop-blur-sm transition-hover hover:border-primary/50">
<div class="text-secondary-dark dark:text-primary flex items-center justify-center w-12 h-12 rounded-lg bg-primary/10">
<span class="material-symbols-outlined text-3xl">medical_services</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="text-slate-900 dark:text-white text-base font-bold leading-tight">Respon Cepat</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm leading-normal">Penanganan medis darurat tanpa antri</p>
</div>
</div>
<!-- Card 2 -->
<div class="flex gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-5 backdrop-blur-sm transition-hover hover:border-primary/50">
<div class="text-secondary-dark dark:text-primary flex items-center justify-center w-12 h-12 rounded-lg bg-primary/10">
<span class="material-symbols-outlined text-3xl">ambulance</span>
</div>
<div class="flex flex-col gap-1">
<h3 class="text-slate-900 dark:text-white text-base font-bold leading-tight">Ambulans 24/7</h3>
<p class="text-slate-500 dark:text-slate-400 text-sm leading-normal">Armada lengkap dengan peralatan ICU</p>
</div>
</div>
</div>
<div class="flex pt-4">
<button class="flex items-center gap-2 text-slate-600 dark:text-slate-400 font-semibold hover:text-primary transition-colors group">
<span>Informasi Prosedur IGD</span>
<span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</button>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Subtle background elements -->
<div class="fixed top-0 right-0 -z-10 w-1/3 h-screen bg-gradient-to-l from-primary/5 to-transparent pointer-events-none"></div>
<div class="fixed bottom-0 left-0 -z-10 w-64 h-64 bg-secondary-dark/5 blur-3xl rounded-full pointer-events-none"></div>
</div>
</div>
</body></html>

@endsection