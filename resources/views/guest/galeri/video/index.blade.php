@extends('layouts.guest.guest')

@section('title', 'Video')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Video Gallery</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Section Header -->
    <div class="mb-8">
      <div class="flex items-center gap-2 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="7" width="15" height="10" rx="2" ry="2"/>
          <polygon points="22 7 17 10.5 17 13.5 22 17 22 7"/>
          <line x1="1" y1="3" x2="5" y2="7"/>
          <line x1="16" y1="3" x2="12" y2="7"/>
        </svg>
        <h1 class="text-base font-bold tracking-widest uppercase text-gray-900" style="letter-spacing: 0.12em;">Video Gallery</h1>
      </div>
      <hr class="border-t border-gray-200" />
    </div>

    <!-- Video Grid - 3 kolom untuk desktop, 2 kolom tablet, 1 kolom mobile -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      
      <!-- Card 1 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="flex flex-col gap-3">
        <div class="relative rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop" alt="Patient Testimonials" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/20"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800 ml-0.5" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="5 3 19 12 5 21 5 3"/>
              </svg>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 px-3 py-2">
            <p class="text-white text-xs font-medium" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Patient Testimonials &amp; Success Stories</p>
          </div>
        </div>
        <div>
          <h2 class="text-blue-700 font-bold text-base mb-1">Excellence in Care</h2>
          <p class="text-gray-500 text-sm leading-relaxed">Hear directly from our patients about their experiences and recovery journeys.</p>
        </div>
      </div>

    </div>

    <!-- Pagination -->
    <div class="flex flex-wrap items-center justify-center gap-1 mt-12">
      <button class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
      </button>
      <button class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-600 text-white text-sm font-semibold">1</button>
      <button class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">2</button>
      <button class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">3</button>
      <button class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">4</button>
      <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">...</span>
      <button class="w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm transition">12</button>
      <button class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </button>
    </div>

  </div>

</body>
</html>

@endsection