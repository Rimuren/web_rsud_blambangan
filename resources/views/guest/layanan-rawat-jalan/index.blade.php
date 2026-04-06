@extends('layouts.guest.guest')

@section('title', 'Layanan Rawat Jalan')

@section('content')


<!DOCTYPE html>
<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
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
<style type="text/tailwindcss">
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            color: #003366;
        }
        html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
<div class="relative flex h-auto w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<div class="px-2 sm:px-4 md:px-20 lg:px-40 flex flex-1 justify-center py-10">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1">
<div class="flex flex-col gap-4 p-4 mb-8">
<div class="flex flex-col gap-2">
<h1 class="text-secondary-blue dark:text-primary text-2xl md:text-4xl font-black leading-tight tracking-tight uppercase">
                                Layanan Rawat Jalan
                            </h1>
<div class="h-1.5 w-24 bg-primary rounded-full"></div>
<p class="text-slate-600 dark:text-slate-400 text-sm md:text-lg font-medium mt-2">
                                Daftar Lengkap Poliklinik Spesialis &amp; Sub-Spesialis Rumah Sakit
                            </p>
</div>
</div>
<div class="grid grid-cols-4 gap-2 md:gap-4 p-2 md:p-4">
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">medical_services</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">ANASTHESI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">child_care</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">ANAK</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">content_cut</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">BEDAH ONKOLOGI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">skeleton</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">BEDAH ORTOPEDHI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">psychology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">BEDAH SYARAF</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">health_and_safety</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">BEDAH UMUM</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">biotech</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">FNAB</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">dentistry</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">GIGI DAN MULUT</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">face_6</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">GIGI SPESIALIS ANAK</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">build_circle</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">GIGI SPESIALIS KONSERVASI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">masks</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">GIGI SPESIALIS PENYAKIT MULUT</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">restaurant</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">GIZI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">cardiology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">JANTUNG</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">mindfulness</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">JIWA</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">dermatology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">KULIT KELAMIN</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">visibility</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">MATA</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">pregnant_woman</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">OBGYN</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">pulmonology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">PARU</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">stethoscope</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">PENYAKIT DALAM</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">neurology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">PSIKOLOGI</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">physical_therapy</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">REHAB MEDIK</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">neurology</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">SARAF</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">air</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">TB DOTS</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">vaccines</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">TB RO</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">hearing</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">THT</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">medical_information</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">UMUM</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Umum</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">water_drop</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">UROLOGY</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">shield_with_heart</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">VCT</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">bolt</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">ESWL</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">baby_changing_station</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">FETOMATERNAL</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2 md:gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-2 md:p-6 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-default group">
<div class="flex items-center justify-center w-10 h-10 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
<span class="material-symbols-outlined !text-xl md:!text-3xl">syringe</span>
</div>
<div class="flex flex-col gap-0.5 md:gap-1">
<h2 class="text-secondary-blue dark:text-slate-100 text-[10px] md:text-sm font-extrabold leading-tight uppercase">BTKV</h2>
<p class="text-slate-500 dark:text-slate-400 text-[8px] md:text-xs font-medium">Spesialis</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</body></html>

@endsection