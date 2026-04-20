@extends('layouts.guest.guest')

@section('title', 'Layanan IGD')

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
                    "secondary-dark": "#003366",
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
    }
    html, body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }
    
    /* Fade up animation styles */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1), transform 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        will-change: opacity, transform;
    }
    
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Optional staggered delays for specific elements */
    .feature-card.fade-up.visible:nth-child(1) {
        transition-delay: 0.05s;
    }
    .feature-card.fade-up.visible:nth-child(2) {
        transition-delay: 0.15s;
    }
    .action-btn.fade-up.visible:nth-child(1) {
        transition-delay: 0.1s;
    }
    .action-btn.fade-up.visible:nth-child(2) {
        transition-delay: 0.2s;
    }
</style>

<div class="relative min-h-screen w-full overflow-x-hidden bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
    <div class="flex flex-col">
        {{-- Hero Section --}}
        <div class="flex justify-center items-center py-12 px-6 md:px-10 lg:px-20">
            <div class="max-w-[1280px] w-full">
                <div class="flex flex-col gap-8 lg:gap-16 lg:flex-row-reverse items-center">
                    {{-- Image Section --}}
                    <div class="w-full lg:w-1/2 aspect-video lg:aspect-square rounded-xl shadow-2xl border-4 border-white dark:border-slate-800 overflow-hidden bg-slate-200 dark:bg-slate-800 fade-up">
                        <img src="{{ asset('images/igd.png') }}" alt="Instalasi Gawat Darurat RSUD Blambangan" class="w-full h-full object-cover">
                    </div>

                    {{-- Text Content Section --}}
                    <div class="flex flex-col gap-6 w-full lg:w-1/2">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 w-fit mb-4 fade-up">
                                <span class="material-symbols-outlined text-sm">emergency</span>
                                <span class="text-xs font-bold uppercase tracking-wider">Layanan 24 Jam</span>
                            </div>
                            <h1 class="text-slate-900 dark:text-white text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight fade-up">
                                Instalasi Gawat Darurat
                            </h1>
                            <p class="text-slate-600 dark:text-slate-400 text-base md:text-lg font-normal leading-relaxed max-w-xl mt-4 fade-up">
                                Unit pelayanan 24 Jam di rumah sakit untuk penanganan awal cepat dan tepat bagi pasien dengan kondisi medis akut yang mengancam nyawa atau berisiko kecacatan permanen.
                            </p>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-wrap gap-4">
                            <button class="action-btn flex items-center justify-center gap-2 rounded-lg h-12 md:h-14 px-5 md:px-6 bg-red-600 hover:bg-red-700 text-white text-base md:text-[18px] font-bold transition-all shadow-lg hover:shadow-red-500/20 fade-up">
                                <span class="material-symbols-outlined">call</span>
                                <span>Hubungi Darurat: (0333) 421118</span>
                            </button>
                            <a href="https://maps.app.goo.gl/j3swHn3mBP7bAVUK9" target="_blank" rel="noopener noreferrer" class="action-btn flex items-center justify-center gap-2 rounded-lg h-12 md:h-14 px-5 md:px-6 bg-secondary-dark hover:bg-slate-800 text-white text-base md:text-lg font-bold transition-all shadow-lg fade-up">
                                <span class="material-symbols-outlined">location_on</span>
                                <span>Lihat Lokasi</span>
                            </a>
                        </div>

                        {{-- Feature Cards --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                            <div class="feature-card flex gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-4 md:p-5 transition-all hover:border-primary/50 fade-up">
                                <div class="text-secondary-dark dark:text-primary flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-lg bg-primary/10 shrink-0">
                                    <span class="material-symbols-outlined text-2xl md:text-3xl">medical_services</span>
                                </div>
                                <div>
                                    <h3 class="text-slate-900 dark:text-white text-sm md:text-base font-bold">Respon Cepat</h3>
                                    <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm">Penanganan medis darurat tanpa antri</p>
                                </div>
                            </div>
                            <div class="feature-card flex gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 p-4 md:p-5 transition-all hover:border-primary/50 fade-up">
                                <div class="text-secondary-dark dark:text-primary flex items-center justify-center w-10 h-10 md:w-12 md:h-12 rounded-lg bg-primary/10 shrink-0">
                                    <span class="material-symbols-outlined text-2xl md:text-3xl">ambulance</span>
                                </div>
                                <div>
                                    <h3 class="text-slate-900 dark:text-white text-sm md:text-base font-bold">Ambulans 24/7</h3>
                                    <p class="text-slate-500 dark:text-slate-400 text-xs md:text-sm">Armada lengkap dengan peralatan ICU</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Subtle background elements --}}
    <div class="fixed top-0 right-0 -z-10 w-1/3 h-screen bg-gradient-to-l from-primary/5 to-transparent pointer-events-none"></div>
    <div class="fixed bottom-0 left-0 -z-10 w-64 h-64 bg-secondary-dark/5 blur-3xl rounded-full pointer-events-none"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with fade-up class
        const fadeElements = document.querySelectorAll('.fade-up');
        
        if (fadeElements.length) {
            // Create intersection observer for fade animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add visible class to trigger animation
                        entry.target.classList.add('visible');
                        // Stop observing after animation triggered
                        observer.unobserve(entry.target);
                    }
                });
            }, { 
                threshold: 0.15,  // Trigger when 15% of element is visible
                rootMargin: "0px 0px -20px 0px"  // Slight offset for smoother trigger
            });
            
            // Observe each fade element
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        }
        
        // Optional: Add a small delay to the image to create a cascading effect
        const imageElement = document.querySelector('.aspect-video.fade-up');
        if (imageElement && !imageElement.classList.contains('visible')) {
            // Ensure image gets observed as well
        }
    });
</script>
@endsection