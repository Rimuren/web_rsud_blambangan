@extends('layouts.guest.guest')

@section('title', 'Galeri Foto')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Photo Gallery</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #ffffff; }
  </style>
</head>
<body class="bg-white text-gray-900">

  <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-7 py-12">

    <!-- Section Header -->
    <div class="flex items-center gap-2 mb-8 pb-4 border-b border-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
        <circle cx="8.5" cy="8.5" r="1.5"/>
        <polyline points="21 15 16 10 5 21"/>
      </svg>
      <h1 class="text-xl font-bold tracking-widest uppercase text-gray-900" style="letter-spacing: 0.1em;">Photo Gallery</h1>
    </div>

    <!-- Gallery Grid - Ukuran card lebih besar di desktop -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-6 md:gap-8 lg:gap-10">
      
      <!-- Card 1 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=800&auto=format&fit=crop" alt="Advanced Surgery Center" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">Advanced Surgery Center</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">Equipped with robotic-assisted technology.</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1587351021759-3772687fe598?w=800&auto=format&fit=crop" alt="Premium Recovery Suites" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">Premium Recovery Suites</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">Designed for comfort and rapid healing.</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&auto=format&fit=crop" alt="24/7 Trauma Care" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">24/7 Trauma Care</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">Swift response and life-saving interventions.</p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=800&auto=format&fit=crop" alt="Main Atrium" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">Main Atrium</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">A welcoming environment for patients and families.</p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?w=800&auto=format&fit=crop" alt="Radiology & Diagnostics" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">Radiology & Diagnostics</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">High-resolution MRI and CT scanning units.</p>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
        <img src="https://images.unsplash.com/photo-1576765608622-067973a79f53?w=800&auto=format&fit=crop" alt="Pediatric Care Center" class="w-full h-56 sm:h-64 lg:h-72 object-cover">
        <div class="p-4 md:p-5">
          <p class="text-sm md:text-base font-semibold text-gray-900">Pediatric Care Center</p>
          <p class="text-xs md:text-sm text-gray-500 mt-1">Specialized medical care for children.</p>
        </div>
      </div>

    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-center gap-1 mt-12">
      <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 text-sm">&#8249;</button>
      <button class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white text-sm font-medium">1</button>
      <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm">2</button>
      <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm">3</button>
      <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm">4</button>
      <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">...</span>
      <button class="w-8 h-8 flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 text-sm">12</button>
      <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 text-sm">&#8250;</button>
    </div>

  </div>

</body>
</html>

@endsection