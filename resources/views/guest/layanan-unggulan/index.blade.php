@extends('layouts.guest.guest')

@section('title', 'Pusat Layanan Unggulan')

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
                    "secondary": "#e05a1a",
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
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
    }
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

<div class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
    <div class="px-6 lg:px-40 py-10 lg:py-20">
        <div class="max-w-[1200px] mx-auto">
            {{-- Header --}}
            <div class="flex flex-wrap justify-between items-end gap-6 p-4 mb-8">
                <div class="flex flex-col gap-4 max-w-2xl text-left">
                    <h1 class="text-slate-900 dark:text-slate-50 text-4xl md:text-5xl font-black leading-tight tracking-tight">
                        Pusat <span class="text-secondary">Layanan Unggulan</span>
                    </h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base md:text-lg leading-relaxed">
                        Kami menghadirkan teknologi medis terkini dan perawatan penuh perhatian di berbagai layanan spesialis unggulan.
                    </p>
                </div>
            </div>

            {{-- Grid Layanan Unggulan --}}
            @php
                $services = [
                    [
                        'name' => 'DSA',
                        'img' => 'images/icon-dsa.png',
                        'desc' => 'Pemeriksaan pembuluh darah dengan gambar tajam untuk mendiagnosis dan menangani penyempitan atau kelainan pembuluh darah secara minimal invasif.',
                        'link' => route('guest.layanan-unggulan.dsa.index')
                    ],
                    [
                        'name' => 'Cath Lab',
                        'img' => 'images/icon-cathlab.png',
                        'desc' => 'Unit jantung canggih untuk tindakan darurat maupun terencana, seperti memasang ring jantung (stent) dan membuka pembuluh darah yang tersumbat.',
                        'link' => route('guest.layanan-unggulan.cathlab.index')
                    ],
                    [
                        'name' => 'Hemodialisis',
                        'img' => 'images/icon-hemo.png',
                        'desc' => 'Terapi cuci darah berkualitas dengan teknologi modern, didukung tim profesional yang selalu memantau kenyamanan dan keselamatan Anda.',
                        'link' => route('guest.layanan-unggulan.hemodialysis.index')
                    ],
                    [
                        'name' => 'Onkologi & Kemoterapi',
                        'img' => 'images/icon-onco.png',
                        'desc' => 'Penanganan kanker secara komprehensif, mulai dari tindakan bedah onkologi hingga kemoterapi modern, didukung tim multidisiplin yang peduli.',
                        'link' => route('guest.layanan-unggulan.oncology.index')
                    ]
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
                @foreach ($services as $service)
                <div class="flex flex-col items-center text-center gap-5 p-8 md:p-10 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center w-28 h-28 md:w-32 md:h-32 rounded-full bg-slate-50 dark:bg-slate-900 overflow-hidden">
                        <img src="{{ asset($service['img']) }}" alt="{{ $service['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-slate-900 dark:text-slate-50 text-xl md:text-2xl font-bold">{{ $service['name'] }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base max-w-sm">{{ $service['desc'] }}</p>
                        <a href="{{ $service['link'] }}" class="mt-2 inline-flex items-center justify-center gap-2 text-primary font-bold hover:gap-3 transition-all">
                            Selengkapnya <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection