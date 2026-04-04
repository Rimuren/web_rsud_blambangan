@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Layanan Unggulan: DSA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .hero-bg { background-color: #dde8f0; }
    .blue-underline {
      display: block;
      width: 48px;
      height: 4px;
      background: #e05a1a;
      border-radius: 2px;
      margin-top: 8px;
    }
    .section-border-left {
      border-left: 4px solid #0d2d5e;
      padding-left: 14px;
    }
    .check-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      color: #374151;
      font-size: 14px;
      line-height: 1.6;
    }
    .check-item svg { flex-shrink: 0; margin-top: 2px; }
    .section-dokter {
      background: #e4ecf4;
      border-radius: 24px;
    }
    .doctor-card {
      background: #fff;
      border: 1px solid #e5edf4;
      border-radius: 16px;
      padding: 32px 24px 28px;
      text-align: center;
      flex: 1;
    }
    .avatar-circle {
      width: 80px;
      height: 80px;
      background: #dde8f0;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }
    .section-cta {
      background: #e4ecf4;
      border-radius: 24px;
    }
    .btn-outline {
      border: 1.5px solid #0d2d5e;
      color: #0d2d5e;
      border-radius: 999px;
      padding: 10px 28px;
      font-weight: 700;
      font-size: 14px;
      background: transparent;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
    }
    .btn-outline:hover {
      background: #0d2d5e;
      color: #fff;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- HERO SECTION -->
  <section class="hero-bg px-8 py-16 md:px-24">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10 items-center">
      <!-- Left -->
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">
          Layanan Unggulan:
        </h1>
        <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-6">
          DSA
        </h1>
        <p class="text-gray-600 text-base leading-relaxed max-w-lg">
          Digital Subtraction Angiography (DSA) adalah teknik pemeriksaan radiologi intervensi untuk mendapatkan gambaran pembuluh darah secara detail dan akurat untuk diagnosis serta terapi penyumbatan atau kelainan pembuluh darah.
        </p>
      </div>
      <!-- Right: Icon Card -->
      <div class="flex-shrink-0">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm flex items-center justify-center" style="width:150px;height:140px;">
          <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="14" y1="56" x2="50" y2="56" stroke="#0d2d5e" stroke-width="3.5" stroke-linecap="round"/>
            <line x1="32" y1="56" x2="32" y2="38" stroke="#0d2d5e" stroke-width="3.5" stroke-linecap="round"/>
            <line x1="24" y1="38" x2="40" y2="38" stroke="#0d2d5e" stroke-width="3" stroke-linecap="round"/>
            <rect x="28" y="12" width="14" height="26" rx="4" stroke="#0d2d5e" stroke-width="3" fill="none"/>
            <rect x="30" y="8" width="10" height="6" rx="2" stroke="#0d2d5e" stroke-width="2.5" fill="none"/>
            <circle cx="35" cy="38" r="4" stroke="#0d2d5e" stroke-width="2.5" fill="none"/>
            <line x1="30" y1="22" x2="42" y2="22" stroke="#0d2d5e" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- MANFAAT LAYANAN & PROSEDUR PEMERIKSAAN -->
  <section class="px-8 py-14 md:px-24">
    <div class="max-w-5xl mx-auto">
      <div class="flex flex-col md:flex-row gap-12">

        <!-- Manfaat Layanan -->
        <div class="flex-1">
          <h2 class="text-xl font-black text-[#0d2d5e] section-border-left mb-7">Manfaat Layanan</h2>
          <div class="space-y-5">
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Visualisasi pembuluh darah yang sangat tajam dan presisi.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Minim sayatan (minimally invasive) sehingga pemulihan lebih cepat.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Mampu mendeteksi kelainan pembuluh darah otak (stroke), jantung, dan perifer.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Akurasi tinggi dalam penentuan tindakan medis lanjutan.</span>
            </div>
          </div>
        </div>

        <!-- Prosedur Pemeriksaan -->
        <div class="flex-1">
          <h2 class="text-xl font-black text-[#0d2d5e] section-border-left mb-7">Prosedur Pemeriksaan</h2>
          <div class="space-y-5">
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Persiapan pasien dan puasa sesuai instruksi medis.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Penyuntikan zat kontras melalui kateter tipis.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Pengambilan gambar radiologi real-time oleh dokter spesialis.</span>
            </div>
            <div class="check-item">
              <svg width="20" height="20" viewBox="0 0 22 22" fill="none"><circle cx="11" cy="11" r="9.5" stroke="#374151" stroke-width="1.6" fill="none"/><path d="M7 11 L10 14 L15 8" stroke="#374151" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
              <span>Observasi pasca-tindakan di ruang pemulihan khusus.</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- TIM DOKTER SPESIALIS -->
  <section class="px-8 py-12 md:px-24">
    <div class="max-w-5xl mx-auto">
      <div class="section-dokter px-10 py-12">
        <h2 class="text-xl font-black text-[#0d2d5e] mb-1">Tim Dokter Spesialis</h2>
        <p class="text-gray-500 text-sm mb-10 max-w-xs leading-relaxed">
          Tim ahli kami yang berdedikasi untuk prosedur DSA.
        </p>

        <div class="flex flex-col md:flex-row gap-6">

          <!-- Doctor 1 -->
          <div class="doctor-card">
            <div class="avatar-circle">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                <circle cx="18" cy="13" r="7" stroke="#8aa5be" stroke-width="2" fill="none"/>
                <path d="M4 34 C4 26 10 22 18 22 C26 22 32 26 32 34" stroke="#8aa5be" stroke-width="2" stroke-linecap="round" fill="none"/>
              </svg>
            </div>
            <h3 class="font-black text-[#0d2d5e] text-base mb-1">dr. Adrian Perkasa,<br/>Sp.Rad(K)</h3>
            <p class="text-[#1a56db] font-bold text-sm mb-2">Spesialis Radiologi Intervensi</p>
            <p class="text-gray-500 text-sm">Konsultan Senior Serebrovaskular</p>
          </div>

          <!-- Doctor 2 -->
          <div class="doctor-card">
            <div class="avatar-circle">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                <circle cx="18" cy="13" r="7" stroke="#8aa5be" stroke-width="2" fill="none"/>
                <path d="M4 34 C4 26 10 22 18 22 C26 22 32 26 32 34" stroke="#8aa5be" stroke-width="2" stroke-linecap="round" fill="none"/>
              </svg>
            </div>
            <h3 class="font-black text-[#0d2d5e] text-base mb-1">dr. Sarah Wijaya, Sp.N(K)</h3>
            <p class="text-[#1a56db] font-bold text-sm mb-2">Spesialis Neurologi</p>
            <p class="text-gray-500 text-sm">Konsultan Neurointervensi</p>
          </div>

          <!-- Doctor 3 -->
          <div class="doctor-card">
            <div class="avatar-circle">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                <circle cx="18" cy="13" r="7" stroke="#8aa5be" stroke-width="2" fill="none"/>
                <path d="M4 34 C4 26 10 22 18 22 C26 22 32 26 32 34" stroke="#8aa5be" stroke-width="2" stroke-linecap="round" fill="none"/>
              </svg>
            </div>
            <h3 class="font-black text-[#0d2d5e] text-base mb-1">dr. Budi Hartono, Sp.JP(K)</h3>
            <p class="text-[#1a56db] font-bold text-sm mb-2">Spesialis Jantung & Pembuluh Darah</p>
            <p class="text-gray-500 text-sm">Konsultan Kardiologi Intervensi</p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="px-8 pb-16 md:px-24">
    <div class="max-w-5xl mx-auto">
      <div class="section-cta px-10 py-14 text-center">
        <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4 leading-snug max-w-lg mx-auto">
          Percayakan Kesehatan Anda pada Ahlinya
        </h2>
        <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto leading-relaxed">
          Dapatkan konsultasi dengan tim spesialis kami untuk evaluasi mendalam mengenai kondisi pembuluh darah Anda.
        </p>
        <button class="btn-outline">Inquiry & FAQ</button>
      </div>
    </div>
  </section>

</body>
</html>

@endsection