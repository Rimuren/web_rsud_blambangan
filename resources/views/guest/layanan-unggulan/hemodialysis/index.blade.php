@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hemodialysis Center</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Nunito Sans', sans-serif; background: #fff; }
    .hero-bg { background-color: #dde8f0; }
    .underline-orange {
      display: block;
      width: 52px;
      height: 4px;
      background: #e05a1a;
      border-radius: 2px;
      margin: 8px auto 0;
    }
    .facility-card {
      background: #fff;
      border: 1px solid #e5edf4;
      border-radius: 14px;
      padding: 28px 18px 22px;
      text-align: center;
      flex: 1;
    }
    .icon-circle {
      width: 52px;
      height: 52px;
      background: #eaf1f7;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 18px;
    }
    .protocol-icon {
      width: 40px;
      height: 40px;
      background: #0d2d5e;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .alert-bar {
      background: #f0f5fa;
      border-radius: 12px;
      border: 1px solid #dce8f0;
    }
    footer { background: #fff; }
    .footer-col h4 { font-size: 13px; font-weight: 800; color: #0d2d5e; margin-bottom: 12px; }
    .footer-col ul li { font-size: 12px; color: #4b6080; margin-bottom: 6px; }
    .social-icon {
      width: 30px; height: 30px;
      border: 1.5px solid #b0c4d8;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #0d2d5e;
    }
  </style>
</head>
<body>

  <!-- ===== HERO ===== -->
  <section class="hero-bg px-8 py-14 md:px-16">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
      <!-- Left -->
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">Hemodialysis</h1>
        <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-5">Center</h1>
        <p class="text-gray-600 text-sm leading-relaxed max-w-sm mb-8">
          Providing world-class renal care with high-flux dialysis technology. Our center combines medical excellence with a patient-first approach to ensure your comfort and safety during every treatment session.
        </p>
        <div class="flex gap-3 flex-wrap">
          <button class="bg-[#0d2d5e] text-white text-sm font-bold px-6 py-3 rounded-lg hover:bg-[#0a2248] transition">Hubungi Kami</button>
          <button class="border border-[#0d2d5e] text-[#0d2d5e] text-sm font-bold px-6 py-3 rounded-lg bg-white hover:bg-[#f0f5fa] transition">Jadwal Dokter</button>
        </div>
      </div>
      <!-- Right: image card -->
      <div class="flex-1 flex justify-end">
        <div class="bg-white rounded-2xl shadow-sm flex items-center justify-center" style="width:320px;height:240px;">
          <!-- Hemodialysis drop icon -->
          <svg width="100" height="110" viewBox="0 0 100 110" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M50 8 C50 8 15 50 15 68 C15 87 30.5 100 50 100 C69.5 100 85 87 85 68 C85 50 50 8 50 8Z" stroke="#0d2d5e" stroke-width="4" fill="none"/>
            <line x1="50" y1="50" x2="50" y2="75" stroke="#0d2d5e" stroke-width="4.5" stroke-linecap="round"/>
            <line x1="37" y1="62" x2="63" y2="62" stroke="#0d2d5e" stroke-width="4.5" stroke-linecap="round"/>
            <line x1="37" y1="77" x2="63" y2="77" stroke="#0d2d5e" stroke-width="3.5" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FASILITAS HEMODIALISIS ===== -->
  <section class="px-8 py-16 md:px-16 bg-white">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-4">
        <h2 class="text-xl font-black text-[#0d2d5e]">Fasilitas Hemodialisis</h2>
        <span class="underline-orange mb-4"></span>
        <p class="text-gray-500 text-sm mt-6 max-w-lg mx-auto leading-relaxed">
          Kami memahami bahwa kenyamanan adalah kunci selama perawatan. Nikmati fasilitas premium kami yang dirancang khusus untuk kenyamanan Anda.
        </p>
      </div>

      <div class="flex flex-col md:flex-row gap-5 mt-10">
        <!-- Reclining Chairs -->
        <div class="facility-card">
          <div class="icon-circle">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
              <rect x="3" y="8" width="14" height="10" rx="3" stroke="#0d2d5e" stroke-width="1.8" fill="none"/>
              <path d="M17 12 L22 10 L22 18 L17 16" stroke="#0d2d5e" stroke-width="1.6" fill="none" stroke-linejoin="round"/>
              <line x1="7" y1="18" x2="6" y2="23" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round"/>
              <line x1="13" y1="18" x2="14" y2="23" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-sm mb-2">Reclining Chairs</h3>
          <p class="text-gray-500 text-xs leading-relaxed">Kursi medis ergonomis yang dapat disesuaikan untuk kenyamanan maksimal selama prosedur.</p>
        </div>
        <!-- Entertainment -->
        <div class="facility-card">
          <div class="icon-circle">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
              <rect x="3" y="5" width="20" height="14" rx="2.5" stroke="#0d2d5e" stroke-width="1.8" fill="none"/>
              <line x1="9" y1="21" x2="17" y2="21" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="13" y1="19" x2="13" y2="21" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-sm mb-2">Entertainment</h3>
          <p class="text-gray-500 text-xs leading-relaxed">Dilengkapi dengan TV layar datar dan koneksi Wi-Fi berkecepatan tinggi di setiap unit.</p>
        </div>
        <!-- Healthy Snacks -->
        <div class="facility-card">
          <div class="icon-circle">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
              <path d="M8 6 C8 6 6 10 8 13 C10 16 8 20 8 20" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round" fill="none"/>
              <path d="M13 4 L13 10 C13 12.2 14.8 14 17 14 C19.2 14 21 12.2 21 10 L21 4" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round" fill="none"/>
              <line x1="13" y1="14" x2="13" y2="22" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <line x1="9" y1="22" x2="19" y2="22" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <line x1="17" y1="4" x2="17" y2="10" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round" stroke-dasharray="0"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-sm mb-2">Healthy Snacks</h3>
          <p class="text-gray-500 text-xs leading-relaxed">Penyajian makanan ringan dan minuman sehat yang disesuaikan dengan diet pasien.</p>
        </div>
        <!-- Full AC Room -->
        <div class="facility-card">
          <div class="icon-circle">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
              <line x1="13" y1="3" x2="13" y2="23" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <line x1="3" y1="13" x2="23" y2="13" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <line x1="5.5" y1="5.5" x2="20.5" y2="20.5" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <line x1="20.5" y1="5.5" x2="5.5" y2="20.5" stroke="#0d2d5e" stroke-width="1.7" stroke-linecap="round"/>
              <circle cx="13" cy="13" r="3.5" stroke="#0d2d5e" stroke-width="1.7" fill="none"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-sm mb-2">Full AC Room</h3>
          <p class="text-gray-500 text-xs leading-relaxed">Ruangan dengan kontrol suhu optimal dan sistem filtrasi udara HEPA filter.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== PROTOKOL KESEHATAN & KESELAMATAN ===== -->
  <section class="px-8 py-14 md:px-16 bg-blue-800 bg-opacity-10">
    <div class="max-w-5xl mx-auto">
      <h2 class="text-xl font-black text-[#0d2d5e] mb-3">Protokol Kesehatan & Keselamatan</h2>
      <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-10">
        Keselamatan pasien adalah prioritas utama kami. Kami menerapkan standar internasional yang ketat untuk mencegah infeksi dan memastikan prosedur medis yang akurat.
      </p>

      <div class="space-y-8 max-w-lg">
        <!-- Item 1 -->
        <div class="flex gap-5 items-start">
          <div class="protocol-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <circle cx="10" cy="10" r="7" stroke="white" stroke-width="1.8" fill="none"/>
              <path d="M7 10 L9 12 L13 8" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Sterilisasi Berlapis</h4>
            <p class="text-gray-500 text-xs leading-relaxed">Pembersihan menyeluruh area tindakan dan sterilisasi alat medis secara rutin sesuai regulasi.</p>
          </div>
        </div>
        <!-- Item 2 -->
        <div class="flex gap-5 items-start">
          <div class="protocol-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <rect x="5" y="3" width="10" height="14" rx="2" stroke="white" stroke-width="1.6" fill="none"/>
              <line x1="7" y1="8" x2="13" y2="8" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
              <line x1="7" y1="11" x2="13" y2="11" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
              <line x1="7" y1="14" x2="10" y2="14" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </div>
          <div>
            <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Monitoring Berkala</h4>
            <p class="text-gray-500 text-xs leading-relaxed">Pemantauan tanda-tanda vital pasien secara real-time oleh perawat bersertifikat khusus hemodialisis.</p>
          </div>
        </div>
        <!-- Item 3 -->
        <div class="flex gap-5 items-start">
          <div class="protocol-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M10 3 L13 7 H17 L14 10 L15 14 L10 12 L5 14 L6 10 L3 7 H7 Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
          <div>
            <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Skrining Ketat</h4>
            <p class="text-gray-500 text-xs leading-relaxed">Prosedur skrining kesehatan menyeluruh bagi setiap pasien dan pengunjung unit dialysis.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ALERT BAR ===== -->
  <section class="px-8 py-6 md:px-16">
    <div class="max-w-5xl mx-auto">
        <div class="alert-bar flex items-center justify-center gap-3 px-6 py-4">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="flex-shrink-0">
                <circle cx="10" cy="10" r="8" stroke="#0d2d5e" stroke-width="1.6" fill="none"/>
                <line x1="10" y1="9" x2="10" y2="14" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
                <circle cx="10" cy="6.5" r="0.9" fill="#0d2d5e"/>
            </svg>
            <p class="text-[#0d2d5e] text-sm font-semibold">Layanan Gawat Darurat tersedia 24 Jam melalui Unit Gawat Darurat.</p>
        </div>
    </div>
</section>

</body>
</html>

@endsection