@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Hospital Center of Excellence Icon Page</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "secondary": "#003366",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="px-6 lg:px-40 flex flex-1 justify-center py-10 lg:py-20">
                <div class="layout-content-container flex flex-col max-w-[1200px] flex-1">
                    <div class="flex flex-wrap justify-between items-end gap-6 p-4 mb-12">
                        <div class="flex min-w-[320px] flex-col gap-4 max-w-2xl text-left">
                            <h1 class="text-slate-900 dark:text-slate-50 text-5xl font-black leading-tight tracking-tight">
                                Centers of <span class="text-secondary">Excellence</span>
                            </h1>
                            <p class="text-slate-600 dark:text-slate-400 text-lg font-normal leading-relaxed">
                                Pioneering advanced medical technology and compassionate care across our flagship specialized services. We combine world-class expertise with state-of-the-art facilities.
                            </p>
                        </div>
                    </div>
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
    <div class="flex flex-col items-center text-center gap-6 p-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-center w-32 h-32 rounded-full bg-slate-50 dark:bg-slate-900 mb-2">
            <span class="material-symbols-outlined text-secondary text-9xl">biotech</span>
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="text-slate-900 dark:text-slate-50 text-2xl font-bold leading-tight">DSA</h3>
            <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal max-w-sm">
                Digital Subtraction Angiography: Advanced vascular imaging for precise diagnosis and minimally invasive intervention of blood vessel conditions.
            </p>
            <button class="mt-4 flex items-center justify-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                Learn More <span class="material-symbols-outlined !text-xl">arrow_forward</span>
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center text-center gap-6 p-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-center w-32 h-32 rounded-full bg-slate-50 dark:bg-slate-900 mb-2">
            <span class="material-symbols-outlined text-secondary text-9xl">cardiology</span>
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="text-slate-900 dark:text-slate-50 text-2xl font-bold leading-tight">Cath Lab</h3>
            <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal max-w-sm">
                State-of-the-art cardiovascular unit for emergency and elective heart procedures, performing life-saving angioplasty and stenting.
            </p>
            <button class="mt-4 flex items-center justify-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                Learn More <span class="material-symbols-outlined !text-xl">arrow_forward</span>
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center text-center gap-6 p-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-center w-32 h-32 rounded-full bg-slate-50 dark:bg-slate-900 mb-2">
            <span class="material-symbols-outlined text-secondary text-9xl">nephrology</span>
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="text-slate-900 dark:text-slate-50 text-2xl font-bold leading-tight">Hemodialysis Center</h3>
            <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal max-w-sm">
                Comprehensive renal replacement therapy with high-flux dialysis and expert monitoring in a comfortable, patient-centered environment.
            </p>
            <button class="mt-4 flex items-center justify-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                Learn More <span class="material-symbols-outlined !text-xl">arrow_forward</span>
            </button>
        </div>
    </div>
    <div class="flex flex-col items-center text-center gap-6 p-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-center w-32 h-32 rounded-full bg-slate-50 dark:bg-slate-900 mb-2">
            <span class="material-symbols-outlined text-secondary text-9xl">oncology</span>
        </div>
        <div class="flex flex-col gap-3">
            <h3 class="text-slate-900 dark:text-slate-50 text-2xl font-bold leading-tight">Oncology &amp; Chemotherapy</h3>
            <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal max-w-sm">
                Specialized surgical oncology and modern chemotherapy protocols delivered by a multidisciplinary team dedicated to your recovery.
            </p>
            <button class="mt-4 flex items-center justify-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                Learn More <span class="material-symbols-outlined !text-xl">arrow_forward</span>
            </button>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection