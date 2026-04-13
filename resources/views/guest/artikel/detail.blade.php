@extends('layouts.guest.guest')

@section('title', 'Detail Artikel')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heart Health in 2024 - Health Insights</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-white min-h-screen">

  <!-- Container diperlebar: dari max-w-2xl (672px) menjadi max-w-5xl (1024px) -->
  <div class="max-w-7xl mx-auto px-5 py-6 md:px-8">

    <!-- Search Box - Versi Lebih Besar & Lebar -->
<div class="mb-8">
  <p class="text-base font-bold text-blue-900 mb-3">Search Articles</p>
  <div class="relative">
    <input
      type="text"
      placeholder="Cari artikel..."
      class="w-full border border-gray-200 bg-gray-50 rounded-xl px-5 py-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent pr-12 transition"
    >
    <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
  </div>
</div>

    <hr class="border-gray-100 mb-6">

    <!-- Latest News - Grid lebih proporsional -->
    <div class="mb-6">
      <h2 class="text-sm font-bold text-blue-900 mb-3">Latest News</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- News Item 1 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?w=120&h=80&fit=crop" alt="Vaccine research" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-sm font-bold text-gray-800 leading-snug mb-0.5">New vaccine research shows promising results</p>
            <p class="text-xs text-gray-400 mb-1">2 HOURS AGO</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

        <!-- News Item 2 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=120&h=80&fit=crop" alt="Seasonal flu" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-sm font-bold text-gray-800 leading-snug mb-0.5">Seasonal flu: What to expect this year</p>
            <p class="text-xs text-gray-400 mb-1">3 DAYS AGO</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

        <!-- News Item 3 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=120&h=80&fit=crop" alt="MRI wing" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-sm font-bold text-gray-800 leading-snug mb-0.5">New MRI wing opening this December</p>
            <p class="text-xs text-gray-400 mb-1">YESTERDAY</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Trending Topics -->
    <div class="mb-8">
      <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-2">Trending Topics</p>
      <div class="flex flex-wrap gap-2">
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Cardiology</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Immunology</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Child Health</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Diabetes</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Wellness</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">Surgery</span>
      </div>
    </div>

    <!-- Hero Article Image -->
    <div class="mb-6 rounded-2xl overflow-hidden">
      <img
        src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=1200&h=500&fit=crop"
        alt="Doctors discussing heart health"
        class="w-full h-96 object-cover"
      >
    </div>

    <!-- Article Meta -->
    <div class="flex items-center gap-2 mb-3">
      <span class="text-teal-600 text-sm font-semibold">Kesehatan</span>
      <span class="text-gray-300 text-xs">•</span>
      <span class="text-gray-400 text-sm">May 12, 2024</span>
    </div>

    <!-- Article Title -->
    <h1 class="text-3xl font-extrabold text-gray-900 mb-4 leading-tight">
      Heart Health in 2024: New Standards
    </h1>

    <!-- Author -->
    <div class="flex items-center gap-2 mb-6">
      <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
        <i class="fa-regular fa-user text-gray-400 text-base"></i>
      </div>
      <span class="text-base font-medium text-gray-700">Admin</span>
    </div>

    <!-- Article Body - ukuran teks lebih besar -->
    <div class="text-base text-gray-600 leading-relaxed space-y-5 mb-8">
      <p>
        Heart disease remains the leading cause of death globally, but the foundation for a healthy heart is often laid decades before symptoms appear. For those entering their 40s, this decade represents a critical window for intervention and preventive care.
      </p>

      <h2 class="text-xl font-bold text-teal-600 mt-6">The Importance of Screening</h2>

      <p>
        Regular screenings for blood pressure, cholesterol levels, and blood sugar are essential. Modern diagnostic tools now allow us to look deeper into arterial health than ever before. We recommend a comprehensive lipid profile that goes beyond just LDL and HDL to look at particle size and inflammation markers like CRP.
      </p>
      <p>
        Lifestyle factors continue to be the cornerstone. However, the definition of "healthy living" has evolved. We now know that HIIT (High-Intensity Interval Training) coupled with strength training provides superior cardiovascular benefits compared to steady-state cardio alone for this age demographic.
      </p>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pulvinar luctus malesuada. Nullam quis mauris eget odio iaculis bibendum et vel mauris. Proin vulputate volutpat velit efficitur ullamcorper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec a quam nunc.
      </p>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap gap-2 pb-6 border-b border-gray-100">
      <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-gray-200 cursor-pointer transition">#HeartHealth</span>
      <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-gray-200 cursor-pointer transition">#PreventiveMedicine</span>
      <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-gray-200 cursor-pointer transition">#Cardiology</span>
    </div>

    <!-- Recommended Articles -->
    <div class="mt-10">
      <div class="flex items-center gap-3 mb-5">
        <span class="w-6 h-0.5 bg-orange-500 rounded-full"></span>
        <h2 class="text-xl font-bold text-blue-900">Recommended Articles</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Rec Card 1 -->
        <div class="rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
          <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=300&fit=crop" alt="Gut-Brain Connection" class="w-full h-56 object-cover">
          <div class="p-5">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-bold text-teal-600 tracking-widest uppercase">Nutrition</span>
              <span class="text-xs text-gray-400">5 min read</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 leading-snug mb-2">The Gut-Brain Connection: How Diet Impacts Mental Health</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-3">Recent studies suggest your digestive system does more than process food; it may control your mood...</p>
            <a href="#" class="text-blue-600 text-sm font-bold tracking-wide flex items-center gap-1 hover:text-blue-800 uppercase">Read More <i class="fa-solid fa-arrow-right text-xs"></i></a>
          </div>
        </div>

        <!-- Rec Card 2 -->
        <div class="rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
          <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&h=300&fit=crop" alt="Sleep Hygiene" class="w-full h-56 object-cover">
          <div class="p-5">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-bold text-teal-600 tracking-widest uppercase">Health Tips</span>
              <span class="text-xs text-gray-400">8 min read</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 leading-snug mb-2">Sleep Hygiene: 7 Steps to Better Restorative Sleep</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-3">Quality sleep is as important as exercise. Learn how to optimize your environment for deeper rest.</p>
            <a href="#" class="text-blue-600 text-sm font-bold tracking-wide flex items-center gap-1 hover:text-blue-800 uppercase">Read More <i class="fa-solid fa-arrow-right text-xs"></i></a>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>

@endsection