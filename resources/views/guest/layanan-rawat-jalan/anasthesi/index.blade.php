@extends('layouts.guest.guest')

@section('title', 'Layanan Rawat Jalan')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anasthesi Klinik</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'blue-950': '#0c1a3a',
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
  </style>
</head>
<body class="bg-white text-gray-800">

  <div class="max-w-5xl mx-auto px-6 py-10 space-y-10">

    <!-- HEADER SECTION -->
    <div class="flex items-start gap-6">
      <!-- Icon Container -->
      <div class="w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center flex-shrink-0">
        <!-- Syringe / anesthesia icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-800">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 1-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
        </svg>
      </div>

      <!-- Title & Info -->
      <div>
        <!-- Breadcrumb -->
        <p class="text-sm text-gray-500 mb-1">
          Layanan Rawat Jalan &rsaquo; <span class="font-semibold text-gray-600">Anastesi Klinik</span>
        </p>

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-blue-900 tracking-tight uppercase">Anasthesi Klinik</h1>

        <!-- Underline Accent -->
        <div class="w-16 h-1 bg-blue-500 mt-2 rounded-full"></div>

        <!-- Subtitle -->
        <p class="mt-3 text-base text-gray-600 max-w-md leading-relaxed">
          Memberikan layanan anestesi yang aman, profesional, dan terpercaya untuk mendukung setiap tindakan medis.
        </p>
      </div>
    </div>

    <!-- TENTANG LAYANAN -->
    <div class="space-y-4">
      <!-- Section Title -->
      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-blue-800">
          <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>
        <h2 class="text-lg font-semibold uppercase text-blue-900 tracking-wide">Tentang Layanan</h2>
      </div>

      <!-- Content Box -->
      <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm space-y-4">
        <p class="text-gray-600 leading-relaxed">
          Dokter anestesi adalah dokter spesialis yang bertanggung jawab dalam proses pembiusan sebelum pasien menjalani operasi atau prosedur medis lainnya. Dokter spesialis ini juga memiliki keahlian dalam manajemen penanganan nyeri dan perawatan pasien.
        </p>
      </div>
    </div>

   

    <!-- JADWAL DOKTER -->
    <div class="space-y-4">
      <!-- Section Title -->
      <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-blue-800">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
        </svg>
        <h2 class="text-lg font-semibold uppercase text-blue-900 tracking-wide">Jadwal Dokter Anestesi</h2>
      </div>

      <!-- Note -->
      <p class="text-xs text-gray-400 italic">* Jadwal dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.</p>

      <!-- Doctor Schedule Table -->
      <div class="bg-gray-50 border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Table Header -->
        <div class="grid grid-cols-4 bg-blue-900 text-white text-xs font-semibold uppercase tracking-wide">
          <div class="px-4 py-3">Nama Dokter</div>
          <div class="px-4 py-3">Spesialisasi</div>
          <div class="px-4 py-3">Hari Praktik</div>
          <div class="px-4 py-3">Jam Praktik</div>
        </div>

        <!-- Row 1 -->
        <div class="grid grid-cols-4 border-b border-gray-200 hover:bg-blue-50 transition-colors">
          <div class="px-4 py-3">
            <p class="text-sm font-semibold text-blue-900">dr. Ahmad Fauzi, Sp.An</p>
            <p class="text-xs text-gray-400 mt-0.5">KIC</p>
          </div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Anestesiologi &amp; Terapi Intensif</div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Senin, Rabu, Jumat</div>
          <div class="px-4 py-3 flex items-center">
            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
              08.00 – 13.00 WIB
            </span>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-4 border-b border-gray-200 bg-white hover:bg-blue-50 transition-colors">
          <div class="px-4 py-3">
            <p class="text-sm font-semibold text-blue-900">dr. Siti Rahayu, Sp.An</p>
            <p class="text-xs text-gray-400 mt-0.5">M.Kes</p>
          </div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Anestesiologi &amp; Manajemen Nyeri</div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Selasa, Kamis</div>
          <div class="px-4 py-3 flex items-center">
            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
              09.00 – 14.00 WIB
            </span>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="grid grid-cols-4 border-b border-gray-200 hover:bg-blue-50 transition-colors">
          <div class="px-4 py-3">
            <p class="text-sm font-semibold text-blue-900">dr. Budi Santoso, Sp.An</p>
            <p class="text-xs text-gray-400 mt-0.5">KAKV</p>
          </div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Anestesi Kardiovaskular</div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Senin, Kamis, Sabtu</div>
          <div class="px-4 py-3 flex items-center">
            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
              10.00 – 15.00 WIB
            </span>
          </div>
        </div>

        <!-- Row 4 -->
        <div class="grid grid-cols-4 hover:bg-blue-50 transition-colors">
          <div class="px-4 py-3">
            <p class="text-sm font-semibold text-blue-900">dr. Dewi Lestari, Sp.An</p>
            <p class="text-xs text-gray-400 mt-0.5">Pediatri</p>
          </div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Anestesi Pediatri</div>
          <div class="px-4 py-3 text-sm text-gray-600 flex items-center">Rabu, Jumat, Sabtu</div>
          <div class="px-4 py-3 flex items-center">
            <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
              13.00 – 18.00 WIB
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>

@endsection