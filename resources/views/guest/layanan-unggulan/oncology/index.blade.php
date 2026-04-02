@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Oncology & Chemotherapy - RSUD Blambangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Nunito Sans', sans-serif; background: #fff; margin: 0; }

    /* Hero */
    .hero-bg { background-color: #dde8f0; }

    /* Cards */
    .feature-card {
      background: #f3f7fb;
      border-radius: 18px;
      padding: 32px 24px 28px;
      flex: 1;
    }
    .icon-wrap {
      width: 48px; height: 48px;
      background: #e4edf5;
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 18px;
    }

    /* Support section */
    .support-bg {
      background: #e4ecf4;
      border-radius: 24px;
    }
    .support-card {
      background: #fff;
      border-radius: 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 22px 16px;
      gap: 10px;
      font-size: 13px;
      font-weight: 800;
      color: #0d2d5e;
    }

    /* CTA */
    .cta-bg { background: #dde8f0; }

    /* Footer */
    .footer-link { font-size: 12px; color: #4b6080; display: block; margin-bottom: 7px; }
    .footer-title { font-size: 13px; font-weight: 900; color: #0d2d5e; margin-bottom: 14px; }

    .check-item {
      display: flex; align-items: center; gap: 10px;
      font-size: 13px; color: #4b6080;
    }
  </style>
</head>
<body>

  <!-- ===== HERO ===== -->
  <section class="hero-bg px-8 py-16 md:px-20">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
      <!-- Left -->
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">Oncology &</h1>
        <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-6">Chemotherapy</h1>
        <p class="text-gray-600 text-sm leading-relaxed max-w-sm mb-8">
          Providing comprehensive, compassionate, and advanced cancer care through integrated surgical excellence and modern chemotherapy protocols.
        </p>
        <button class="border border-[#0d2d5e] text-[#0d2d5e] text-sm font-bold px-6 py-3 rounded-lg bg-white hover:bg-[#0d2d5e] hover:text-white hover:shadow-md transition-all duration-300">
    Jadwal Dokter
</button>
      </div>

      <!-- Right: Hero Image -->
      <div class="flex-shrink-0">
        <img src="https://images.unsplash.com/photo-1588776814546-9c8b1e5a7c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8b25jb2xvZ3l8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Oncology & Chemotherapy" class="w-full max-w-sm rounded-lg shadow-md"/>
  </section>

  <!-- ===== 3 FEATURE CARDS ===== -->
  <section class="px-8 py-16 md:px-20 bg-white">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-5">

      <!-- Card 1: Pendekatan Terpadu -->
      <div class="feature-card">
        <div class="icon-wrap">
          <!-- Network/multidiscipline icon -->
          <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
            <circle cx="13" cy="13" r="3" stroke="#0d2d5e" stroke-width="1.7" fill="none"/>
            <circle cx="4" cy="13" r="2" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
            <circle cx="22" cy="13" r="2" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
            <circle cx="13" cy="4" r="2" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
            <circle cx="13" cy="22" r="2" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
            <line x1="6" y1="13" x2="10" y2="13" stroke="#0d2d5e" stroke-width="1.4"/>
            <line x1="16" y1="13" x2="20" y2="13" stroke="#0d2d5e" stroke-width="1.4"/>
            <line x1="13" y1="6" x2="13" y2="10" stroke="#0d2d5e" stroke-width="1.4"/>
            <line x1="13" y1="16" x2="13" y2="20" stroke="#0d2d5e" stroke-width="1.4"/>
          </svg>
        </div>
        <h3 class="font-black text-[#0d2d5e] text-base mb-3">Pendekatan Terpadu</h3>
        <p class="text-gray-500 text-sm leading-relaxed">Kolaborasi multidisiplin antara ahli bedah, onkolog medis, radiolog, dan tim pendukung untuk rencana perawatan yang personal.</p>
      </div>

      <!-- Card 2: Fasilitas Kemoterapi -->
      <div class="feature-card">
        <div class="icon-wrap">
          <!-- IV bag / chemo icon -->
          <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
            <rect x="8" y="3" width="10" height="13" rx="3" stroke="#0d2d5e" stroke-width="1.7" fill="none"/>
            <line x1="13" y1="7" x2="13" y2="11" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="11" y1="9" x2="15" y2="9" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="13" y1="16" x2="13" y2="20" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="10" y1="20" x2="16" y2="20" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </div>
        <h3 class="font-black text-[#0d2d5e] text-base mb-3">Fasilitas Kemoterapi</h3>
        <p class="text-gray-500 text-sm leading-relaxed">Unit infus modern yang dirancang untuk kenyamanan maksimal pasien, dilengkapi dengan teknologi pemantauan terkini.</p>
      </div>

      <!-- Card 3: Tim Bedah Onkologi -->
      <div class="feature-card">
        <div class="icon-wrap">
          <!-- Scalpel/surgery icon -->
          <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
            <line x1="5" y1="21" x2="19" y2="7" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M19 7 L22 4 L22 7 L19 10 Z" stroke="#0d2d5e" stroke-width="1.5" stroke-linejoin="round" fill="none"/>
            <line x1="8" y1="19" x2="11" y2="16" stroke="#0d2d5e" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <h3 class="font-black text-[#0d2d5e] text-base mb-3">Tim Bedah Onkologi</h3>
        <p class="text-gray-500 text-sm leading-relaxed">Ahli bedah tersertifikasi internasional yang berpengalaman dalam prosedur minimal invasif dan kompleksitas tumor tinggi.</p>
      </div>

    </div>
  </section>

  
<!-- ===== DUKUNGAN PASIEN & KELUARGA ===== -->
<section class="px-8 py-10 md:px-20 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="support-bg px-10 py-12">
            <div class="flex flex-col md:flex-row gap-12 items-start">

                <!-- Left -->
                <div class="flex-1">
                    <h2 class="text-2xl font-black text-[#0d2d5e] leading-snug mb-5">
                        Dukungan Pasien &<br/>Keluarga
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-7 max-w-xs">
                        Kami memahami bahwa perjuangan melawan kanker melampaui perawatan medis. Layanan dukungan kami mencakup konseling psikologis, panduan nutrisi, dan kelompok pendukung.
                    </p>
                    <div class="space-y-3">
                        <div class="check-item flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-base">check_circle</span>
                            <span>Konsultasi Nutrisi Khusus Onkologi</span>
                        </div>
                        <div class="check-item flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-base">check_circle</span>
                            <span>Layanan Psikologi & Dukungan Emosional</span>
                        </div>
                        <div class="check-item flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-base">check_circle</span>
                            <span>Manajemen Nyeri (Pain Management)</span>
                        </div>
                    </div>
                </div>

                <!-- Right: 2x2 service cards -->
                <div class="flex-shrink-0">
                    <div class="grid grid-cols-2 gap-4" style="width:280px;">

                        <!-- Counseling -->
                        <div class="support-card flex flex-col items-center text-center gap-2 p-4 bg-white rounded-lg shadow-sm">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-3xl">psychology</span>
                            <span class="text-sm font-semibold text-[#0d2d5e]">Counseling</span>
                        </div>

                        <!-- Dietary Plan -->
                        <div class="support-card flex flex-col items-center text-center gap-2 p-4 bg-white rounded-lg shadow-sm">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-3xl">restaurant_menu</span>
                            <span class="text-sm font-semibold text-[#0d2d5e]">Dietary Plan</span>
                        </div>

                        <!-- Support Group -->
                        <div class="support-card flex flex-col items-center text-center gap-2 p-4 bg-white rounded-lg shadow-sm">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-3xl">group</span>
                            <span class="text-sm font-semibold text-[#0d2d5e]">Support Group</span>
                        </div>

                        <!-- Palliative Care -->
                        <div class="support-card flex flex-col items-center text-center gap-2 p-4 bg-white rounded-lg shadow-sm">
                            <span class="material-symbols-outlined text-[#0d2d5e] text-3xl">healing</span>
                            <span class="text-sm font-semibold text-[#0d2d5e]">Palliative Care</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

  <!-- ===== CTA SECTION ===== -->
  <section class="cta-bg px-8 py-16 md:px-20 mt-8">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4">
        Siap membantu perjalanan kesembuhan Anda
      </h2>
      <p class="text-gray-500 text-sm max-w-md mx-auto leading-relaxed">
        Tim spesialis kami siap memberikan konsultasi mendalam mengenai diagnosis dan pilihan terapi yang paling tepat untuk Anda.
      </p>
    </div>
  </section>

</body>
</html>

@endsection