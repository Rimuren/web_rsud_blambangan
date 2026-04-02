@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Catheterization Laboratory (Cath Lab)</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Nunito Sans', sans-serif; }
    .blue-underline {
      display: block;
      width: 48px;
      height: 4px;
      background: #e05a1a;
      border-radius: 2px;
      margin-top: 8px;
    }
    .hero-bg { background-color: #dde8f0; }
    .video-thumb {
      background: #e4ecf3;
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 210px;
    }
    .play-btn {
      width: 56px;
      height: 56px;
      background: #0d2d5e;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card-advantage {
      background: #f3f7fb;
      border-radius: 16px;
      padding: 28px 24px;
    }
    .section-tindakan {
      background: #e4ecf4;
      border-radius: 24px;
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
    <div class="max-w-2xl">
      <h1 class="text-4xl md:text-5xl font-black text-[#0d2d5e] leading-tight">
        Catheterization Laboratory
      </h1>
      <h1 class="text-4xl md:text-5xl font-black text-[#e05a1a] leading-tight mb-6">
        (Cath Lab)
      </h1>
      <p class="text-gray-600 text-base leading-relaxed max-w-sm">
        Advanced cardiovascular diagnostic and interventional services equipped with the latest imaging technology for life-saving heart procedures.
      </p>
    </div>
  </section>

  <!-- TENTANG CATH LAB -->
  <section class="px-8 py-14 md:px-24">
    <div class="max-w-5xl">
      <h2 class="text-xl font-black text-[#0d2d5e] mb-1">Tentang Cath Lab</h2>
      <span class="blue-underline mb-8"></span>

      <div class="flex flex-col md:flex-row gap-12 mt-8">
        <!-- Text -->
        <div class="flex-1 space-y-4 text-gray-600 text-sm leading-relaxed">
          <p>
            Cath Lab atau Laboratorium Kateterisasi adalah ruang prosedur di rumah sakit di mana spesialis jantung melakukan tes diagnostik dan prosedur invasif minimal untuk mendiagnosis dan mengobati penyakit kardiovaskular.
          </p>
          <p>
            Laboratorium kami beroperasi 24/7 untuk menangani keadaan darurat jantung seperti serangan jantung (STEMI), memastikan pasien menerima intervensi secepat mungkin untuk meminimalkan kerusakan otot jantung.
          </p>
        </div>

        <!-- Video Thumbnail -->
        <div class="flex-1">
          <div class="video-thumb border border-gray-200 shadow-sm">
            <div class="play-btn shadow-lg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="white"><polygon points="7,4 20,12 7,20"/></svg>
            </div>
          </div>
          <p class="text-center text-xs text-gray-400 mt-3">Watch: Inside Our Modern Cath Lab Facility</p>
        </div>
      </div>
    </div>
  </section>

  <!-- KEUNGGULAN KAMI -->
  <section class="px-8 py-12 md:px-24 bg-white">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-xl font-black text-[#0d2d5e] mb-2">Keunggulan Kami</h2>
      <p class="text-gray-500 text-sm mb-10">
        Mengapa fasilitas Cath Lab kami menjadi pilihan utama untuk kesehatan jantung Anda.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Card 1 -->
        <div class="card-advantage text-left">
          <div class="mb-4">
            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="38" height="38" rx="9" fill="#dce8f3"/>
              <rect x="11" y="9" width="16" height="20" rx="2.5" stroke="#0d2d5e" stroke-width="1.8" fill="none"/>
              <rect x="15" y="7" width="8" height="4.5" rx="2" stroke="#0d2d5e" stroke-width="1.5" fill="#f3f7fb"/>
              <line x1="14" y1="17" x2="24" y2="17" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
              <line x1="14" y1="20.5" x2="24" y2="20.5" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
              <line x1="14" y1="24" x2="20" y2="24" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-[15px] mb-2">Tim Ahli Berpengalaman</h3>
          <p class="text-gray-500 text-sm leading-relaxed">
            Ditangani oleh Dokter Spesialis Jantung & Pembuluh Darah (Intervensi) senior dengan jam terbang tinggi.
          </p>
        </div>

        <!-- Card 2 -->
        <div class="card-advantage text-left">
          <div class="mb-4">
            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="38" height="38" rx="9" fill="#dce8f3"/>
              <circle cx="19" cy="19" r="9" stroke="#0d2d5e" stroke-width="1.8" fill="none"/>
              <line x1="19" y1="13" x2="19" y2="19" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="19" y1="19" x2="23" y2="22" stroke="#0d2d5e" stroke-width="1.8" stroke-linecap="round"/>
              <line x1="19" y1="11" x2="19" y2="12.5" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </div>
          <h3 class="font-black text-[#0d2d5e] text-[15px] mb-2">Respon Cepat 24/7</h3>
          <p class="text-gray-500 text-sm leading-relaxed">
            Tim siaga setiap saat untuk prosedur darurat (Primary PCI) guna menyelamatkan nyawa pasien serangan jantung.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- JENIS TINDAKAN -->
  <section class="px-8 py-12 md:px-24">
    <div class="max-w-4xl mx-auto">
      <div class="section-tindakan px-10 py-12">
        <h2 class="text-xl font-black text-[#0d2d5e] mb-1">Jenis Tindakan</h2>
        <p class="text-gray-500 text-sm mb-10 max-w-xs leading-relaxed">
          Layanan intervensi komprehensif untuk berbagai masalah jantung dan pembuluh darah.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-9">

          <!-- Coronary Angiography -->
          <div class="flex gap-4 items-start">
            <div class="flex-shrink-0">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                <rect width="30" height="30" rx="6" fill="#c2d5e8"/>
                <rect x="7" y="9" width="16" height="12" rx="2" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                <polyline points="9,15 11,12 13,16 16,11 18,14 21,13" stroke="#0d2d5e" stroke-width="1.4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div>
              <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Coronary Angiography</h4>
              <p class="text-gray-500 text-xs leading-relaxed">Prosedur diagnostik untuk melihat penyempitan atau penyumbatan pada pembuluh darah koroner.</p>
            </div>
          </div>

          <!-- Angioplasty & Stenting -->
          <div class="flex gap-4 items-start">
            <div class="flex-shrink-0">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                <rect width="30" height="30" rx="6" fill="#c2d5e8"/>
                <line x1="8" y1="22" x2="22" y2="8" stroke="#0d2d5e" stroke-width="1.6" stroke-linecap="round"/>
                <line x1="6" y1="14" x2="14" y2="6" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <line x1="16" y1="24" x2="24" y2="16" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <circle cx="8" cy="8" r="2.8" stroke="#0d2d5e" stroke-width="1.4" fill="none"/>
                <circle cx="22" cy="22" r="2.8" stroke="#0d2d5e" stroke-width="1.4" fill="none"/>
              </svg>
            </div>
            <div>
              <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Angioplasty & Stenting</h4>
              <p class="text-gray-500 text-xs leading-relaxed">Pemasangan balon dan ring (stent) untuk membuka aliran darah yang tersumbat di jantung.</p>
            </div>
          </div>

          <!-- Pacemaker Insertion -->
          <div class="flex gap-4 items-start">
            <div class="flex-shrink-0">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                <rect width="30" height="30" rx="6" fill="#c2d5e8"/>
                <rect x="8" y="9" width="14" height="11" rx="3.5" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                <line x1="15" y1="12.5" x2="15" y2="16.5" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="13" y1="14.5" x2="17" y2="14.5" stroke="#0d2d5e" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="12" y1="20" x2="12" y2="23" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <line x1="18" y1="20" x2="18" y2="23" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
              </svg>
            </div>
            <div>
              <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Pacemaker Insertion</h4>
              <p class="text-gray-500 text-xs leading-relaxed">Pemasangan alat pacu jantung permanen atau sementara untuk gangguan irama jantung.</p>
            </div>
          </div>

          <!-- Peripheral Intervention -->
          <div class="flex gap-4 items-start">
            <div class="flex-shrink-0">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                <rect width="30" height="30" rx="6" fill="#c2d5e8"/>
                <ellipse cx="15" cy="15" rx="6" ry="7.5" stroke="#0d2d5e" stroke-width="1.5" fill="none"/>
                <line x1="15" y1="7.5" x2="15" y2="5" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <line x1="15" y1="22.5" x2="15" y2="25" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <line x1="9" y1="15" x2="6.5" y2="15" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <line x1="21" y1="15" x2="23.5" y2="15" stroke="#0d2d5e" stroke-width="1.4" stroke-linecap="round"/>
                <circle cx="15" cy="15" r="2" fill="#0d2d5e"/>
              </svg>
            </div>
            <div>
              <h4 class="font-black text-[#0d2d5e] text-sm mb-1">Peripheral Intervention</h4>
              <p class="text-gray-500 text-xs leading-relaxed">Tindakan intervensi pada pembuluh darah di luar jantung, seperti di kaki atau ginjal.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="px-8 pb-16 md:px-24">
    <div class="max-w-4xl mx-auto">
      <div class="section-cta px-10 py-14 text-center">
        <h2 class="text-2xl md:text-3xl font-black text-[#0d2d5e] mb-4 leading-snug max-w-lg mx-auto">
          Percayakan Kesehatan Jantung Anda pada Ahlinya
        </h2>
        <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto leading-relaxed">
          Dapatkan konsultasi dengan Dokter Spesialis Jantung kami untuk evaluasi mendalam mengenai kondisi kesehatan Anda.
        </p>
        <button class="btn-outline">Inquiry & FAQ</button>
      </div>
    </div>
  </section>

</body>
</html>

@endsection