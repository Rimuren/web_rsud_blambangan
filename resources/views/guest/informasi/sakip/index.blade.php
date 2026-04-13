@extends('layouts.guest.guest')
@section('title', 'RSUD BLAMBANGAN-Informasi Sakip')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RSUD BLAMBANGAN-Informasi Sakip</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-btn.active {
      background-color: #0D2D5E;
      color: white;
      border-bottom: 2px solid #E07B1A;
    }
  </style>
</head>
<body class="bg-[#EAF4FB]">

  <section class="bg-[#EAF4FB] py-16 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">

      <!-- Page Title -->
      <div class="mb-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">SAKIP</h2>
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A] leading-tight">
          RSUD BLAMBANGAN</h1>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Card Dokumen -->
        <a href="https://drive.google.com/file/d/179bcdGZy171lR_tncDGEQXGILWPW6icc/view" 
           target="_blank" 
           rel="noopener noreferrer"
           class="block max-w-lg group">
          <div class="bg-white rounded-2xl p-6 border border-gray-100 flex items-center gap-5 
                      transition-all duration-200 group-hover:border-[#378ADD] group-hover:shadow-md cursor-pointer">
            <div class="flex-shrink-0 relative w-14 h-14">
              <div class="absolute top-1 left-3 w-10 h-[52px] bg-[#B5D4F0] rounded-lg border border-[#85B7EB]"></div>
              <div class="absolute top-0 left-0 w-10 h-[52px] bg-[#D4ECF7] rounded-lg border border-[#85B7EB] flex flex-col justify-center items-center gap-[5px] px-2">
                <div class="w-full h-[3px] bg-[#378ADD] rounded"></div>
                <div class="w-full h-[3px] bg-[#378ADD] rounded"></div>
                <div class="w-3/4 h-[3px] bg-[#378ADD] rounded"></div>
              </div>
            </div>
            <p class="text-gray-800 text-sm font-medium leading-snug group-hover:text-[#378ADD] transition-colors duration-200">
              RANCANGAN RENSTRA RSUD Blambangan
            </p>
          </div>
        </a>
      </div>

      <!-- TAB 2: INFORMASI LAIN (Contoh) -->
      <div id="tab-informasi-lain" class="tab-content">
        <div class="mb-8">
          <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Informasi Lain</h2>
          <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">Petunjuk & Regulasi</h3>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm">
          <p class="text-gray-600">Konten informasi lain dapat ditambahkan di sini, seperti peraturan rumah sakit, hak pasien, dll.</p>
        </div>
      </div>

    </div>
  </section>

  <script>
    // Fungsi untuk mengaktifkan tab
    document.addEventListener('DOMContentLoaded', function() {
      const tabBtns = document.querySelectorAll('.tab-btn');
      const tabContents = document.querySelectorAll('.tab-content');

      tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          const tabId = btn.getAttribute('data-tab');
          
          // Nonaktifkan semua tombol dan konten
          tabBtns.forEach(b => b.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));
          
          // Aktifkan tombol yang diklik
          btn.classList.add('active');
          
          // Aktifkan konten yang sesuai
          const activeContent = document.getElementById(`tab-${tabId}`);
          if (activeContent) {
            activeContent.classList.add('active');
          }
        });
      });
    });
  </script>
</body>
</html>

@endsection