@extends('layouts.guest.guest')

@section('title', 'Daftar Artikel')

@section('content')
{{-- Hapus DOCTYPE, html, head, body karena sudah disediakan layout --}}
<div class="min-h-screen py-10 px-7 bg-[#e8f0f7]">
    <div class="max-w-6xl mx-auto">
        {{-- Hero Header --}}
<div class="mb-10">
    <span class="inline-block bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full mb-3 tracking-wide uppercase">Medical Journal</span>
    <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight mb-3">
        Health Insights & <span class="text-orange-500">Expert<br>Advice</span>
    </h1>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <p class="text-gray-600 text-base max-w-md leading-relaxed">
            Stay updated with the latest breakthroughs in medicine, wellness tips from our specialized doctors, and comprehensive guides for a healthier life.
        </p>
        <div class="flex items-center gap-1.5 text-gray-500 text-sm whitespace-nowrap">
            <i class="fa-regular fa-circle-check text-gray-500 text-base"></i>
            All articles are peer-reviewed by our medical board
        </div>
    </div>
</div>

        {{-- Category Filter Tabs --}}
        <div class="flex flex-wrap gap-2 mb-8">
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold bg-blue-900 text-white transition">
                <i class="fa-solid fa-border-all text-xs"></i> All Articles
            </button>
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-heart-pulse text-xs text-gray-400"></i> Health Tips
            </button>
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-newspaper text-xs text-gray-400"></i> Medical News
            </button>
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-utensils text-xs text-gray-400"></i> Nutrition
            </button>
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-shield-virus text-xs text-gray-400"></i> Disease Prevention
            </button>
            <button class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                <i class="fa-solid fa-brain text-xs text-gray-400"></i> Mental Health
            </button>
        </div>

        {{-- Search Box --}}
        <div class="bg-white rounded-2xl border border-gray-200 px-5 py-4 mb-8">
            <p class="text-sm font-bold text-blue-900 mb-3">Search Articles</p>
            <div class="relative">
                <input type="text" placeholder="Search"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-200 pr-10">
                <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            </div>
        </div>

        {{-- Article Cards Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    {{-- Card 1 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400&h=280&fit=crop" alt="Heart Health" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">Heart Health in 2024: New Standards</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Discover the latest protocols for cardiovascular wellness and how preventative screening is evolving with new technology...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Jan 12, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Dr. Sarah Smith</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
    {{-- Card 2 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=400&h=280&fit=crop" alt="Childhood Asthma" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">Managing Childhood Asthma</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Our specialists share critical tips on identifying triggers and maintaining active lifestyles for children with respiratory needs...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Feb 05, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Dr. James Lee</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
    {{-- Card 3 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=280&fit=crop" alt="Plant-Based Diet" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">The Power of Plant-Based Diets</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Explore how nutritional shifts can significantly improve metabolic markers and long-term vitality according to recent studies...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Mar 10, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Jane Doe, RD</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
    {{-- Card 4 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=400&h=280&fit=crop" alt="Pediatric Innovation" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">Modern Pediatric Innovation</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">New medical technologies are changing how we care for the next generation, from telemedicine to genomic insights...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Mar 22, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Dr. Robert Chen</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
    {{-- Card 5 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&h=280&fit=crop" alt="Yoga Stress" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">Yoga for Chronic Stress Relief</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">Discover gentle evidence-based yoga sequences that help regulate the nervous system and reduce cortisol levels naturally...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Apr 02, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Wellness Team</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
    {{-- Card 6 --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow flex flex-col h-full">
        <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?w=400&h=280&fit=crop" alt="Hypertension" class="w-full h-56 object-cover">
        <div class="p-5 flex flex-col flex-grow">
            <h3 class="text-base font-bold text-gray-800 mb-2 leading-snug">Understanding Hypertension</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">A comprehensive guide to the "silent killer" including daily monitoring tips and lifestyle modifications that work...</p>
            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                <span class="flex items-center gap-1"><i class="fa-regular fa-calendar text-xs"></i> Apr 15, 2024</span>
                <span class="flex items-center gap-1"><i class="fa-regular fa-user-circle text-xs"></i> Dr. Elena Rodriguez</span>
            </div>
            <a href="#" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 mt-auto">Read more <i class="fa-solid fa-arrow-right text-xs"></i></a>
        </div>
    </div>
</div>

        {{-- Pagination --}}
        <div class="flex items-center justify-center gap-1 mt-6 pb-6">
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-white hover:text-gray-600 text-sm transition border border-transparent hover:border-gray-200">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-700 text-white text-sm font-semibold">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">4</button>
            <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">...</span>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-500 hover:bg-white text-sm font-medium transition border border-transparent hover:border-gray-200">12</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-white hover:text-gray-600 text-sm transition border border-transparent hover:border-gray-200">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</div>
@endsection