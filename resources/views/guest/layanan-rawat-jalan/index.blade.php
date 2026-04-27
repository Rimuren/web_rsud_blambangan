@extends('layouts.guest.guest')

@section('title', 'Layanan Rawat Jalan')

@section('content')
{{-- CSS & Konfigurasi Tailwind --}}
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

            {{-- Daftar Poliklinik --}}
            @if($polies->isEmpty())
                <div class="text-center py-10 text-slate-500">
                    Belum ada data poliklinik.
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-5">
                    @foreach ($polies as $poli)
                    <a href="{{ route('guest.layanan-rawat-jalan.detail', $poli['slug']) }}" 
                       class="group flex flex-col items-center text-center gap-2 md:gap-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-3 md:p-5 shadow-sm hover:shadow-md hover:border-primary/50 transition-all cursor-pointer">
                        <div class="flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-secondary-blue/10 group-hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined !text-2xl md:!text-3xl">{{ $poli['icon'] }}</span>
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <h3 class="text-secondary-blue dark:text-slate-100 text-[11px] md:text-sm font-bold leading-tight uppercase">
                                {{ $poli['name'] }}
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 text-[9px] md:text-xs font-medium">
                                {{ $poli['type'] }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection