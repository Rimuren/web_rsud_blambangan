@extends('layouts.guest.guest')
@section('title', 'Petunjuk Umum')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Petunjuk Umum RSUD Blambangan</title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
  </style>
</head>
<body class="bg-[#EAF4FB]">

  <section class="bg-[#EAF4FB] py-16 px-6 md:px-20">
    <div class="max-w-6xl mx-auto">

      <!-- Page Title -->
      <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E] leading-tight">
          Petunjuk Umum<br/>RSUD Blambangan
        </h1>
      </div>

      <!-- Tab Navigation -->
      <div class="flex flex-wrap gap-3 mb-12">
        <button onclick="switchTab('tata-tertib')" id="tab-tata-tertib"
          class="tab-btn bg-[#0D2D5E] text-white font-semibold px-6 py-3 rounded-xl text-sm transition-all duration-200">
          Tata Tertib
        </button>
        <button onclick="switchTab('kewajiban-hak')" id="tab-kewajiban-hak"
          class="tab-btn bg-white text-[#0D2D5E] font-semibold px-6 py-3 rounded-xl text-sm border border-gray-200 transition-all duration-200">
          Kewajiban &amp; Hak
        </button>
        <button onclick="switchTab('kontak-penting')" id="tab-kontak-penting"
          class="tab-btn bg-white text-[#0D2D5E] font-semibold px-6 py-3 rounded-xl text-sm border border-gray-200 transition-all duration-200">
          Kontak Penting
        </button>
        <button onclick="switchTab('tarif')" id="tab-tarif"
          class="tab-btn bg-white text-[#0D2D5E] font-semibold px-6 py-3 rounded-xl text-sm border border-gray-200 transition-all duration-200">
          Tarif
        </button>
        <button onclick="switchTab('indeks-kepuasan')" id="tab-indeks-kepuasan"
          class="tab-btn bg-white text-[#0D2D5E] font-semibold px-6 py-3 rounded-xl text-sm border border-gray-200 transition-all duration-200">
          Indeks Kepuasan
        </button>
        <button onclick="switchTab('sakip')" id="tab-sakip"
          class="tab-btn bg-white text-[#0D2D5E] font-semibold px-6 py-3 rounded-xl text-sm border border-gray-200 transition-all duration-200">
          Sakip
        </button>
      </div>

      <!-- TAB: TATA TERTIB -->
      <div id="content-tata-tertib" class="tab-content active">
        <div class="mb-8">
          <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Tata Tertib</h2>
          <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">RSUD Blambangan</h3>
          <p class="text-gray-500 mt-3 text-sm max-w-lg">
            Kenyamanan dan keselamatan pasien adalah prioritas kami. Mohon patuhi tata tertib berikut selama berada di lingkungan rumah sakit.
          </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="md:col-span-2 bg-white rounded-2xl p-8 border border-gray-100">
            <ul class="space-y-6 text-gray-800 text-sm leading-relaxed">
              <li class="flex gap-3">
                <span class="mt-[6px] w-2 h-2 rounded-full bg-gray-800 flex-shrink-0"></span>
                <span>Dilarang membawa anak kecil dibawah 5 tahun</span>
              </li>
              <li class="flex gap-3">
                <span class="mt-[6px] w-2 h-2 rounded-full bg-gray-800 flex-shrink-0"></span>
                <span>Bagi penunggu pasien harus menggunakan kartu penunggu yang dapat di peroleh dari Admisi rawat rawat inap gedung pusat diagnostik terpadu (GPDT)</span>
              </li>
              <li class="flex gap-3">
                <span class="mt-[6px] w-2 h-2 rounded-full bg-gray-800 flex-shrink-0"></span>
                <span>Bagi tamu rumah sakit harus menggunakan kartu tamu yang dapat di peroleh dari posko BANPOL dengan meninggalkan kartu idetitas</span>
              </li>
            </ul>
          </div>
          <div class="bg-[#0D2D5E] rounded-2xl p-7 text-white">
            <h4 class="text-lg font-bold mb-5 text-center">Jam Berkunjung Pasien</h4>
            <div class="space-y-4 text-sm">
              <div class="flex justify-between items-center border-b border-white/20 pb-4">
                <span class="font-semibold text-white/90">Senin – Jumat</span>
                <span class="font-semibold">16.00 – 18.00 WIB</span>
              </div>
              <div class="flex justify-between items-center border-b border-white/20 pb-4">
                <span class="font-semibold text-white/90">Sabtu – Minggu</span>
                <span class="font-semibold">10.00 – 12.00 WIB</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-white/90">Hari Libur</span>
                <span class="font-semibold">16.00 – 18.00 WIB</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB: KEWAJIBAN & HAK -->
      <div id="content-kewajiban-hak" class="tab-content">
        <div class="mb-8">
          <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Kewajiban &amp; Hak</h2>
          <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">RSUD Blambangan</h3>
        </div>
        <a href="https://drive.google.com/file/d/1z9qpuUEuCYzM7XkI24G3ukthf4eFSOEF/view" 
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
      Undang-Undang Republik Indonesia Nomor 44 Tahun 2009 Tentang Rumah Sakit
    </p>
  </div>
</a>
      </div>

      <!-- TAB: KONTAK PENTING -->
      <div id="content-kontak-penting" class="tab-content">
        <div class="mb-8">
          <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Kontak Penting</h2>
          <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">RSUD Blambangan</h3>
        </div>
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100">
          <table class="w-full text-sm">
            <thead>
              <tr class="bg-[#378ADD] text-white">
                <th class="text-center font-semibold px-6 py-4 w-2/5">Instalasi</th>
                <th class="text-center font-semibold px-6 py-4">Kontak</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr class="align-top">
                <td class="px-6 py-5 text-gray-800">Instalasi Promosi Kesehatan Rumah Sakit (PKRS)</td>
                <td class="px-6 py-5 text-gray-800">
                  <ul class="space-y-1">
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Telepon : (0333) 421118</li>
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Email : rsudblambangan@gmail.com</li>
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Website : www.rsudblambangan.co.id</li>
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Facebook : rsudblambangan</li>
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Instagram : @rsudblambangan</li>
                    <li class="flex gap-2"><span class="text-gray-400">•</span> Twitter : @rsudblambangan</li>
                  </ul>
                </td>
              </tr>
              <tr class="align-top">
                <td class="px-6 py-5 text-gray-800">Instalasi Gawat Darurat (IGD) 24 Jam</td>
                <td class="px-6 py-5 text-gray-800">(0333) 421118 EXT 118</td>
              </tr>
              <tr class="align-top">
                <td class="px-6 py-5 text-gray-800">Instalasi Rawat Jalan (Jam Kerja)</td>
                <td class="px-6 py-5 text-gray-800">(0333) 421118</td>
              </tr>
              <tr class="align-top">
                <td class="px-6 py-5 text-gray-800">Pengaduan Publik (Jam Kerja)</td>
                <td class="px-6 py-5 text-gray-800">081135355858</td>
              </tr>
              <tr class="align-top">
                <td class="px-6 py-5 text-gray-800">Hotsline BPJS</td>
                <td class="px-6 py-5 text-gray-800">-</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- TAB: TARIF -->
<div id="content-tarif" class="tab-content">
  <!-- Header utama dengan ikon rumah sakit (Heroicons building-office) -->
  <div class="flex items-center gap-3 mb-2">
    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
      <i class="fa-solid fa-hospital text-blue-900 text-base"></i>
    </div>
    <h1 class="text-3xl font-bold text-blue-900 leading-tight">Tarif Layanan Rumah Sakit</h1>
  </div>
  <p class="text-gray-400 text-l mb-5 ml-13 pl-0.5">Informasi resmi tarif kamar rawat inap dan tindakan medis terbaru tahun ini.</p>

  <hr class="border-gray-200 mb-6">

  {{-- Sub-heading --}}
  <div class="flex items-center gap-2 mb-3">
    <i class="fa-solid fa-bed-pulse text-blue-900 text-sm"></i>
    <h2 class="text-2xl font-semibold text-blue-900 tracking-wide">Jenis Kamar & Tarif</h2>
  </div>

  {{-- Tabel --}}
<div class="border border-gray-200 rounded-xl overflow-hidden mb-6 shadow-sm">

  {{-- Header Row --}}
  <div class="grid bg-gray-50 border-b border-gray-200" style="grid-template-columns: 70px 1fr auto;">
    <div class="px-5 py-3 text-sm font-semibold text-gray-500 tracking-wide">NO</div>
    <div class="px-5 py-3 text-sm font-semibold text-gray-500 tracking-wide">KOMPONEN</div>
    <div class="px-6 py-3 text-sm font-semibold text-gray-500 tracking-wide text-right">URAIAN (PER HARI)</div>
  </div>

  {{-- Data Rows --}}
  @php
    $rows = [
      [1, 'Kelas 3',   'Rp200.000'],
      [2, 'Kelas 2',   'Rp275.000'],
      [3, 'Kelas 1',   'Rp425.000'],
      [4, 'NICU',      'Rp580.000'],
      [5, 'ICU/ICCU',  'Rp660.000'],
      [6, 'VIP',       'Rp1.100.000'],
      [7, 'VVIP',      'Rp1.250.000'],
    ];
  @endphp

  @foreach($rows as $index => [$no, $label, $tarif])
    <div class="grid {{ !$loop->last ? 'border-b border-gray-100' : '' }} hover:bg-blue-50/60 transition duration-150 ease-out"
         style="grid-template-columns: 70px 1fr auto;">
      <div class="px-5 py-3.5 text-sm text-gray-500">{{ $no }}</div>
      <div class="px-5 py-3.5 text-base font-medium text-gray-800 flex items-center gap-3">
        @if(in_array($label, ['NICU', 'ICU/ICCU']))
          <i class="fa-solid fa-heart-pulse text-red-400 text-sm"></i>
        @elseif($label === 'VIP' || $label === 'VVIP')
          <i class="fa-solid fa-star text-amber-400 text-sm"></i>
        @else
          <i class="fa-solid fa-door-open text-blue-300 text-sm"></i>
        @endif
        <span>{{ $label }}</span>
      </div>
      <div class="px-6 py-3.5 text-base font-semibold text-blue-700 text-right tabular-nums">{{ $tarif }}</div>
    </div>
  @endforeach

</div>

  {{-- Catatan Penting --}}
<div class="rounded-xl border border-blue-100 bg-blue-50 p-5 flex gap-4 items-start shadow-sm">
  <div class="mt-0.5 flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
    <i class="fa-solid fa-circle-info text-blue-700 text-base"></i>
  </div>
  <div class="flex-1">
    <p class="text-sm font-bold text-blue-900 mb-2 tracking-wide">Catatan Penting</p>
    <ul class="space-y-2">
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Tarif dapat berubah sewaktu-waktu sesuai kebijakan manajemen rumah sakit.
      </li>
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Biaya kamar sudah termasuk jasa keperawatan namun belum termasuk biaya makan dan obat-obatan.
      </li>
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Untuk pasien asuransi/BPJS, tarif akan disesuaikan dengan paket manfaat penjamin.
      </li>
    </ul>
  </div>
</div>
</div>
      
      <!-- TAB: INDEKS KEPUASAN -->
<div id="content-indeks-kepuasan" class="tab-content">
  <div class="mb-8">
    <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Indeks Kepuasan</h2>
    <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">RSUD Blambangan</h3>
  </div>

  <!-- Card Laporan Terbaru -->
  <div class="bg-white rounded-xl border border-slate-200 p-6 flex gap-5 items-start mb-6">
    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
      <i class="fa-solid fa-file-pdf text-blue-900 text-xl"></i>
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-3 flex-wrap">
        <span class="text-xs font-medium bg-[#0D2D5E] text-white px-3 py-1 rounded-full">Terbaru</span>
        <span class="text-xs text-slate-400">PDF · 2.4 MB</span>
      </div>
      <h2 class="text-[15px] font-medium text-slate-800 leading-snug mb-2">
        Indeks Kepuasan Masyarakat Terhadap Pelayanan RSUD Blambangan Banyuwangi — Tribulan IV Tahun 2025
      </h2>
      <p class="text-sm text-slate-500 leading-relaxed mb-4">
        Hasil survei kepuasan periode Oktober–Desember 2025 mencakup indikator prosedur, waktu pelayanan, biaya, dan kualitas sarana prasarana.
      </p>
      <div class="flex flex-wrap gap-2">
        <a href="https://drive.google.com/file/d/1irWQZKL38NzzbkZaqo75UfPTzJwVcrBA/view" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#0D2D5E] text-white text-sm font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
          <i class="fa-solid fa-eye"></i> Lihat Laporan
        </a>
        <a href="https://drive.google.com/file/d/1irWQZKL38NzzbkZaqo75UfPTzJwVcrBA/view" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 border border-[#0D2D5E] text-[#0D2D5E] text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">
          <i class="fa-solid fa-download"></i> Unduh Laporan
        </a>
      </div>
    </div>
  </div>

  <!-- Card Arsip 2023 -->
  <div class="bg-white rounded-xl border border-slate-200 p-6 flex gap-5 items-start mb-6">
    <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 mt-1">
      <i class="fa-solid fa-folder-open text-slate-400 text-xl"></i>
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-3 flex-wrap">
        <span class="text-xs font-medium bg-blue-100 text-[#0D2D5E] border border-blue-200 px-3 py-1 rounded-full">Arsip 2023</span>
        <span class="text-xs text-slate-400">PDF · 4.1 MB</span>
      </div>
      <h2 class="text-[15px] font-medium text-slate-800 leading-snug mb-2">
        Indeks Kepuasan Masyarakat (IKM) — Semester I dan II Tahun 2023
      </h2>
      <p class="text-sm text-slate-500 leading-relaxed mb-4">
        Rekapitulasi tahunan indeks kepuasan masyarakat untuk periode Januari hingga Desember tahun anggaran 2023.
      </p>
      <div class="flex flex-wrap gap-2">
        <a href="https://drive.google.com/file/d/1f2Nc9Btv8M9wvgq7LUUfkG4j5P0jIDPp/view" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#0D2D5E] text-white text-sm font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
          <i class="fa-solid fa-eye"></i> Lihat Arsip PDF
        </a>
        <a href="https://drive.google.com/file/d/1f2Nc9Btv8M9wvgq7LUUfkG4j5P0jIDPp/view" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 border border-[#0D2D5E] text-[#0D2D5E] text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">
          <i class="fa-solid fa-download"></i> Unduh Arsip PDF
        </a>
      </div>
    </div>
  </div>

  <!-- Info Box -->
  <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 flex gap-3 items-start">
    <i class="fa-solid fa-circle-info text-[#0D2D5E] text-base mt-0.5"></i>
    <div>
      <p class="text-sm font-medium text-[#0D2D5E] mb-1">Informasi Tambahan</p>
      <p class="text-xs text-slate-500 leading-relaxed">
        Data Indeks Kepuasan Masyarakat (IKM) disusun berdasarkan Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi sebagai wujud transparansi dan komitmen RSUD Blambangan dalam meningkatkan mutu layanan kesehatan bagi seluruh masyarakat.
      </p>
    </div>
  </div>
</div>
      <!-- TAB: SAKIP -->
      <div id="content-sakip" class="tab-content">
        <div class="mb-8">
          <h2 class="text-3xl md:text-4xl font-extrabold text-[#0D2D5E]">Sakip</h2>
          <h3 class="text-3xl md:text-4xl font-extrabold text-[#E07B1A]">RSUD Blambangan</h3>
        </div>
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
  </section>

  <style>
  .tab-content { display: none; }
  .tab-content.active { display: block; }

  @keyframes fadeSlideIn {
    from {
      opacity: 0;
      transform: translateY(12px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .tab-content.active {
    animation: fadeSlideIn 0.25s ease forwards;
  }
</style>

<script>
  const tabs = ['tata-tertib', 'kewajiban-hak', 'kontak-penting', 'tarif', 'indeks-kepuasan', 'sakip'];

  function switchTab(active) {
    tabs.forEach(function(tab) {
      var btn = document.getElementById('tab-' + tab);
      var content = document.getElementById('content-' + tab);

      if (tab === active) {
        btn.classList.remove('bg-white', 'border', 'border-gray-200');
        btn.classList.add('bg-[#0D2D5E]', 'text-white');
        btn.classList.remove('text-[#0D2D5E]');

        // Reset animasi dulu sebelum tampilkan
        content.classList.remove('active');
        void content.offsetWidth; // trigger reflow agar animasi ulang dari awal
        content.classList.add('active');

      } else {
        btn.classList.remove('bg-[#0D2D5E]', 'text-white');
        btn.classList.add('bg-white', 'text-[#0D2D5E]', 'border', 'border-gray-200');
        content.classList.remove('active');
      }
    });
  }
</script>

</body>
</html>

@endsection