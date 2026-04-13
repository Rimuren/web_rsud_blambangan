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

  <div class="max-w-2xl mx-auto px-5 py-6">

    <!-- Search Box -->
    <div class="mb-6">
      <p class="text-sm font-bold text-blue-900 mb-2">Search Articles</p>
      <div class="relative">
        <input
          type="text"
          placeholder="Search"
          class="w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-200 pr-10"
        >
        <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
      </div>
    </div>

    <hr class="border-gray-100 mb-6">

    <!-- Latest News -->
    <div class="mb-6">
      <h2 class="text-sm font-bold text-blue-900 mb-3">Latest News</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

        <!-- News Item 1 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?w=120&h=80&fit=crop" alt="Vaccine research" class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-xs font-bold text-gray-800 leading-snug mb-0.5">New vaccine research shows promising results</p>
            <p class="text-[10px] text-gray-400 mb-1">2 HOURS AGO</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

        <!-- News Item 2 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=120&h=80&fit=crop" alt="Seasonal flu" class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-xs font-bold text-gray-800 leading-snug mb-0.5">Seasonal flu: What to expect this year</p>
            <p class="text-[10px] text-gray-400 mb-1">3 DAYS AGO</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

        <!-- News Item 3 -->
        <div class="flex items-start gap-3">
          <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=120&h=80&fit=crop" alt="MRI wing" class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
          <div>
            <p class="text-xs font-bold text-gray-800 leading-snug mb-0.5">New MRI wing opening this December</p>
            <p class="text-[10px] text-gray-400 mb-1">YESTERDAY</p>
            <a href="#" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">Read more <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

      </div>
    </div>

    <!-- Trending Topics -->
    <div class="mb-8">
      <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-2">Trending Topics</p>
      <div class="flex flex-wrap gap-2">
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Cardiology</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Immunology</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Child Health</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Diabetes</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Wellness</span>
        <span class="px-3 py-1 border border-teal-500 text-teal-600 text-xs rounded-full hover:bg-teal-50 cursor-pointer transition">Surgery</span>
      </div>
    </div>

    <!-- Hero Article Image -->
    <div class="mb-5 rounded-2xl overflow-hidden">
      <img
        src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800&h=420&fit=crop"
        alt="Doctors discussing heart health"
        class="w-full h-72 object-cover"
      >
    </div>

    <!-- Article Meta -->
    <div class="flex items-center gap-2 mb-3">
      <span class="text-teal-600 text-xs font-semibold">Kesehatan</span>
      <span class="text-gray-300 text-xs">•</span>
      <span class="text-gray-400 text-xs">May 12, 2024</span>
    </div>

    <!-- Article Title -->
    <h1 class="text-xl font-extrabold text-gray-900 mb-4 leading-tight">
      Hearth Health in 2024: New Standards
    </h1>

    <!-- Author -->
    <div class="flex items-center gap-2 mb-5">
      <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
        <i class="fa-regular fa-user text-gray-400 text-sm"></i>
      </div>
      <span class="text-sm font-medium text-gray-700">Admin</span>
    </div>

    <!-- Article Body -->
    <div class="text-sm text-gray-600 leading-relaxed space-y-4 mb-6">
      <p>
        Heart disease remains the leading cause of death globally, but the foundation for a healthy heart is often laid decades before symptoms appear. For those entering their 40s, this decade represents a critical window for intervention and preventive care.
      </p>

      <h2 class="text-sm font-bold text-teal-600 mt-5">The Importance of Screening</h2>

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
      <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full hover:bg-gray-200 cursor-pointer transition">#HeartHealth</span>
      <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full hover:bg-gray-200 cursor-pointer transition">#PreventiveMedicine</span>
      <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full hover:bg-gray-200 cursor-pointer transition">#Cardiology</span>
    </div>

    <!-- Recommended Articles -->
    <div class="mt-8">
      <div class="flex items-center gap-3 mb-4">
        <span class="w-5 h-0.5 bg-orange-500 rounded-full"></span>
        <h2 class="text-base font-bold text-blue-900">Recommended Articles</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- Rec Card 1 -->
        <div class="rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
          <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=200&fit=crop" alt="Gut-Brain Connection" class="w-full h-44 object-cover">
          <div class="p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-[10px] font-bold text-teal-600 tracking-widest uppercase">Nutrition</span>
              <span class="text-[10px] text-gray-400">5 min read</span>
            </div>
            <h3 class="text-sm font-bold text-gray-800 leading-snug mb-2">The Gut-Brain Connection: How Diet Impacts Mental Health</h3>
            <p class="text-xs text-gray-500 leading-relaxed mb-3">Recent studies suggest your digestive system does more than process food; it may control your mood...</p>
            <a href="#" class="text-blue-600 text-xs font-bold tracking-wide flex items-center gap-1 hover:text-blue-800 uppercase">Read More <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

        <!-- Rec Card 2 -->
        <div class="rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
          <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&h=200&fit=crop" alt="Sleep Hygiene" class="w-full h-44 object-cover">
          <div class="p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-[10px] font-bold text-teal-600 tracking-widest uppercase">Health Tips</span>
              <span class="text-[10px] text-gray-400">8 min read</span>
            </div>
            <h3 class="text-sm font-bold text-gray-800 leading-snug mb-2">Sleep Hygiene: 7 Steps to Better Restorative Sleep</h3>
            <p class="text-xs text-gray-500 leading-relaxed mb-3">Quality sleep is as important as exercise. Learn how to optimize your environment for deeper rest.</p>
            <a href="#" class="text-blue-600 text-xs font-bold tracking-wide flex items-center gap-1 hover:text-blue-800 uppercase">Read More <i class="fa-solid fa-arrow-right text-[9px]"></i></a>
          </div>
        </div>

      </div>
    </div>

  </div>

</body>
</html>

@endsection