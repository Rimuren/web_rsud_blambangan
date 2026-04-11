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