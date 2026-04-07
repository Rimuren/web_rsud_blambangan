@extends('layouts.guest.guest')
@section('title', 'Alur & Persyaratan')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Alur dan Persyaratan Pelayanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #ffffff;
      color: #1e293b;
    }
  </style>
</head>
<body class="bg-white">

  <div class="max-w-4xl mx-auto px-6 py-12">

    <!-- PAGE TITLE -->
    <div class="mb-10">
      <h1 class="text-4xl font-black text-[#0a2a5e] leading-tight mb-3">
        Alur dan Persyaratan Pelayanan
      </h1>
      <p class="text-gray-500 text-base leading-relaxed max-w-lg">
        Panduan resmi prosedur pendaftaran dan tahapan pelayanan kesehatan bagi
        seluruh pasien rumah sakit.
      </p>
    </div>

    <!-- ALUR PELAYANAN PASIEN -->
    <div class="mb-12">

      <!-- Section Title -->
      <div class="flex items-center gap-3 mb-8">
        <!-- Stethoscope-like icon -->
        <svg class="w-6 h-6 text-[#0a2a5e]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18"/>
        </svg>
        <h2 class="text-xl font-bold text-[#0a2a5e]">Alur Pelayanan Pasien</h2>
      </div>

      <!-- Steps -->
      <div class="flex flex-col gap-0">

        <!-- Step 1 -->
        <div class="flex items-start gap-5">
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
              <!-- Registration/queue icon -->
              <svg class="w-6 h-6 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <circle cx="9" cy="7" r="1" fill="currentColor"/>
                <circle cx="12" cy="7" r="1" fill="currentColor"/>
                <circle cx="15" cy="7" r="1" fill="currentColor"/>
                <circle cx="9" cy="12" r="1" fill="currentColor"/>
                <circle cx="12" cy="12" r="1" fill="currentColor"/>
                <circle cx="15" cy="12" r="1" fill="currentColor"/>
                <circle cx="9" cy="17" r="1" fill="currentColor"/>
                <circle cx="12" cy="17" r="1" fill="currentColor"/>
                <circle cx="15" cy="17" r="1" fill="currentColor"/>
                <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/>
              </svg>
            </div>
            <!-- Vertical line -->
            <div class="w-px h-12 bg-gray-200 mt-1"></div>
          </div>
          <div class="pt-2 pb-10">
            <h3 class="font-bold text-[#1a1a1a] text-base mb-1">Pendaftaran &amp; Administrasi</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Lantai 1, Gedung Utama. Pengambilan nomor antrian dan verifikasi dokumen identitas.</p>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="flex items-start gap-5">
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
              <!-- First aid / medical bag icon -->
              <svg class="w-6 h-6 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="3" y="7" width="18" height="14" rx="2"/>
                <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
                <line x1="12" y1="11" x2="12" y2="17"/>
                <line x1="9" y1="14" x2="15" y2="14"/>
              </svg>
            </div>
            <!-- Vertical line -->
            <div class="w-px h-12 bg-gray-200 mt-1"></div>
          </div>
          <div class="pt-2 pb-10">
            <h3 class="font-bold text-[#1a1a1a] text-base mb-1">Triage &amp; Pemeriksaan Awal</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Instalasi Gawat Darurat atau Ruang Pra-Pemeriksaan. Pengecekan tanda vital (tensi, suhu, berat badan).</p>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="flex items-start gap-5">
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
              <!-- Stethoscope icon -->
              <svg class="w-6 h-6 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M4.5 6.5a4 4 0 004 4M4.5 6.5a4 4 0 00-4 4M4.5 6.5V4a1.5 1.5 0 013 0v2.5M8.5 10.5C8.5 14 11 16 14 16a4 4 0 004-4v-1"/>
                <circle cx="18" cy="17" r="2"/>
              </svg>
            </div>
            <!-- Vertical line -->
            <div class="w-px h-12 bg-gray-200 mt-1"></div>
          </div>
          <div class="pt-2 pb-10">
            <h3 class="font-bold text-[#1a1a1a] text-base mb-1">Pemeriksaan Dokter Spesialis</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Ruang Poliklinik sesuai spesialisasi. Konsultasi medis dan penentuan tindakan/diagnosa.</p>
          </div>
        </div>

        <!-- Step 4 (last – no line below) -->
        <div class="flex items-start gap-5">
          <div class="flex flex-col items-center">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 border border-gray-200">
              <!-- Payment/cashier icon -->
              <svg class="w-6 h-6 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 11h2M2 11h14M2 15h8"/>
                <path d="M7 4l5-1 5 1"/>
              </svg>
            </div>
          </div>
          <div class="pt-2">
            <h3 class="font-bold text-[#1a1a1a] text-base mb-1">Farmasi &amp; Pembayaran</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Lantai 1, Area Kasir &amp; Apotek. Pengambilan obat dan penyelesaian administrasi biaya.</p>
          </div>
        </div>

      </div>
    </div>

    <!-- PERSYARATAN PENDAFTARAN -->
    <div>

      <!-- Section Title -->
      <div class="flex items-center gap-3 mb-8">
        <!-- Checklist icon -->
        <svg class="w-6 h-6 text-[#0a2a5e]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <rect x="3" y="3" width="18" height="18" rx="2"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
        </svg>
        <h2 class="text-xl font-bold text-[#0a2a5e]">Persyaratan Pendaftaran</h2>
      </div>

      <!-- Two Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Card: Pasien Umum -->
        <div class="border border-gray-200 rounded-2xl p-7">
          <!-- Card Header -->
          <div class="flex items-center gap-3 mb-7">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
              <!-- Person icon -->
              <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
              </svg>
            </div>
            <h3 class="font-bold text-[#1a1a1a] text-base">Pasien Umum</h3>
          </div>

          <!-- Items -->
          <div class="flex flex-col gap-5">
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">KTP / Kartu Identitas (Asli &amp; Fotokopi)</span>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">Kartu Berobat (Jika sudah pernah berkunjung)</span>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">Formulir Pendaftaran Pasien Baru</span>
            </div>
          </div>
        </div>

        <!-- Card: Pasien BPJS -->
        <div class="border border-gray-200 rounded-2xl p-7">
          <!-- Card Header -->
          <div class="flex items-center gap-3 mb-7">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
              <!-- Card/ID icon -->
              <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <path d="M2 10h20"/>
                <path d="M6 15h4"/>
              </svg>
            </div>
            <h3 class="font-bold text-[#1a1a1a] text-base">Pasien BPJS</h3>
          </div>

          <!-- Items -->
          <div class="flex flex-col gap-5">
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">Kartu JKN / BPJS Kesehatan Digital/Fisik</span>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">Surat Rujukan dari Faskes Tingkat I</span>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">KTP &amp; KK (Fotokopi)</span>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
              </svg>
              <span class="text-gray-600 text-sm">Surat Kontrol (Untuk kunjungan ulang)</span>
            </div>
          </div>
        </div>


      </div>
  <!-- Icon box salmon/peach (tanpa flex-1) -->
  <div class="flex items-center gap-3">
  <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
    <!-- Icon from Heroicons: ClipboardDocumentListIcon (outline) -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#e07a5f]">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
    </svg>
  </div>
  <h1 class="text-xl font-bold text-[#0f2d5e]">1. Pelayanan Pendaftaran (Admission)</h1>
</div>

    <!-- MAIN TABLE CARD -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden mb-6">

      <!-- Table Header -->
      <div class="grid grid-cols-[60px_220px_1fr] bg-[#f1f5f9] px-6 py-3 border-b border-gray-200">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">NO</span>
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">KOMPONEN</span>
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">URAIAN</span>
      </div>

      <!-- ROW 1: Persyaratan Pelayanan -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 border-b border-gray-200 items-start">
        <span class="text-sm text-gray-400 font-medium pt-0.5">1</span>
        <div class="flex items-start gap-2 pt-0.5">
          <!-- document icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="5" y="2" width="14" height="20" rx="2"/>
            <line x1="9" y1="7" x2="15" y2="7"/>
            <line x1="9" y1="11" x2="15" y2="11"/>
            <line x1="9" y1="15" x2="13" y2="15"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Persyaratan Pelayanan</span>
        </div>
        <div class="flex flex-col gap-1.5">
          <p class="text-sm text-gray-600">Kartu identitas / KTP / KK</p>
          <p class="text-sm text-gray-600">Kartu asuransi Non JKN</p>
          <p class="text-sm text-gray-600">Surat rujukan</p>
          <p class="text-sm text-gray-600">Surat permintaan rawat inap</p>
        </div>
      </div>

      <!-- ROW 2: Prosedur -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 border-b border-gray-200 items-start">
        <span class="text-sm text-gray-400 font-medium pt-0.5">2</span>
        <div class="flex items-start gap-2 pt-0.5">
          <!-- flow/procedure icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="6" height="6" rx="1"/>
            <rect x="15" y="3" width="6" height="6" rx="1"/>
            <rect x="3" y="15" width="6" height="6" rx="1"/>
            <rect x="15" y="15" width="6" height="6" rx="1"/>
            <line x1="9" y1="6" x2="15" y2="6"/>
            <line x1="9" y1="18" x2="15" y2="18"/>
            <line x1="6" y1="9" x2="6" y2="15"/>
            <line x1="18" y1="9" x2="18" y2="15"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Prosedur</span>
        </div>
        <div class="flex flex-col gap-5">

          <!-- Flow diagram -->
          <div class="bg-[#fdf3ef] border border-[#f5d5c8] rounded-xl p-4">
            <div class="flex items-center gap-2 flex-wrap">
              <!-- Step box 1 -->
              <div class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm leading-tight">
                Penanggung<br/>jawab pasien
              </div>
              <!-- Arrow -->
              <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
              <!-- Step box 2 – highlighted -->
              <div class="bg-white border border-gray-300 rounded-lg px-3 py-2.5 text-xs font-semibold text-gray-800 shadow-sm">
                Admission
              </div>
              <!-- Arrow -->
              <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
              <!-- Step box 3 -->
              <div class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm leading-tight">
                Menandatangani<br/>General Consent
              </div>
              <!-- Arrow -->
              <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
              <!-- Step box 4 -->
              <div class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm leading-tight">
                Berkas rawat inap diberikan ke<br/>penanggung jawab pasien
              </div>
            </div>
          </div>

          <!-- Numbered steps grid -->
          <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div class="flex items-start gap-2.5">
              <span class="w-5 h-5 rounded-full bg-[#e2eaf5] text-[#1e3a5f] text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
              <p class="text-sm text-gray-600 leading-snug">Penanggung jawab pasien melakukan pendaftaran rawat inap</p>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="w-5 h-5 rounded-full bg-[#e2eaf5] text-[#1e3a5f] text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
              <p class="text-sm text-gray-600 leading-snug">Menerima penjelasan admission</p>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="w-5 h-5 rounded-full bg-[#e2eaf5] text-[#1e3a5f] text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
              <p class="text-sm text-gray-600 leading-snug">Menandatangani general consent</p>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="w-5 h-5 rounded-full bg-[#e2eaf5] text-[#1e3a5f] text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
              <p class="text-sm text-gray-600 leading-snug">Petugas membawa berkas RM ke klinik</p>
            </div>
          </div>

        </div>
      </div>

      <!-- ROW 3: Waktu Pelayanan -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 border-b border-gray-200 items-center">
        <span class="text-sm text-gray-400 font-medium">3</span>
        <div class="flex items-center gap-2">
          <!-- Clock icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <polyline points="12 7 12 12 15 15"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Waktu Pelayanan</span>
        </div>
        <div>
          <span class="inline-block bg-[#dcfce7] text-[#15803d] text-xs font-semibold px-3 py-1 rounded-full border border-[#bbf7d0]">
            Kurang dari 1 jam
          </span>
        </div>
      </div>

      <!-- ROW 4: Biaya -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 border-b border-gray-200 items-start">
        <span class="text-sm text-gray-400 font-medium pt-1">4</span>
        <div class="flex items-center gap-2 pt-1">
          <!-- Money/coin icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 7v1m0 8v1M9.5 9.5A2.5 2.5 0 0112 8a2.5 2.5 0 010 5 2.5 2.5 0 000 5 2.5 2.5 0 002.5-1.5"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Biaya</span>
        </div>
        <div class="flex flex-col gap-2">
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Umum</span>
            <span class="text-sm text-gray-700 font-medium text-right">Peraturan Daerah Kabupaten Banyuwangi No. 1 Th 2024</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">JKN/KIS</span>
            <span class="text-sm font-bold text-green-600">GRATIS</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Asuransi lain</span>
            <span class="text-sm text-gray-700">Sesuai Perjanjian Kerjasama</span>
          </div>
        </div>
      </div>

      <!-- ROW 5: Produk Layanan -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 border-b border-gray-200 items-center">
        <span class="text-sm text-gray-400 font-medium">5</span>
        <div class="flex items-center gap-2">
          <!-- Server/product icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="3" width="20" height="5" rx="1"/>
            <rect x="2" y="10" width="20" height="5" rx="1"/>
            <rect x="2" y="17" width="20" height="4" rx="1"/>
            <circle cx="18" cy="5.5" r="0.5" fill="currentColor"/>
            <circle cx="18" cy="12.5" r="0.5" fill="currentColor"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Produk Layanan</span>
        </div>
        <p class="text-sm text-gray-600">Pelayanan admission</p>
      </div>

      <!-- ROW 6: Pengelolaan Pengaduan -->
      <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 items-start">
        <span class="text-sm text-gray-400 font-medium pt-1">6</span>
        <div class="flex items-center gap-2 pt-1">
          <!-- Headset/support icon -->
          <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 18v-6a9 9 0 0118 0v6"/>
            <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>
          </svg>
          <span class="text-sm font-semibold text-[#1a1a2e]">Pengelolaan Pengaduan</span>
        </div>
        <div class="flex flex-wrap gap-2">
          <span class="inline-block bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Email:rsudblambangan@gmail.com</span>
          <span class="inline-block bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Facebook:rsudblambangan</span>
          <span class="inline-block bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">IG / Twitter:@rsudblambangan</span>
          <span class="inline-block bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Kotak saran</span>
          <span class="inline-block bg-[#fff3ed] border border-[#fed7b6] text-[#e07a2f] text-xs font-semibold px-3 py-1.5 rounded-full">Petugas informasi</span>
          <span class="inline-block bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Telp / SMS:(0333) 421118</span>
        </div>
      </div>

    </div><!-- end main card -->

    <!-- INFORMASI TAMBAHAN -->
    <div class="bg-white rounded-2xl border border-gray-200 px-6 py-5 flex items-start gap-4">
      <!-- Info circle icon -->
      <div class="flex-shrink-0 mt-0.5">
        <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="9"/>
          <line x1="12" y1="8" x2="12" y2="8.5" stroke-width="2.5" stroke-linecap="round"/>
          <line x1="12" y1="11" x2="12" y2="17" stroke-linecap="round"/>
        </svg>
      </div>
      <div>
        <p class="text-sm font-bold text-[#1a1a2e] mb-1">Informasi Tambahan</p>
        <p class="text-sm text-gray-500 leading-relaxed">
          Pastikan seluruh dokumen asli dibawa saat melakukan pendaftaran. Untuk pasien rujukan, pastikan surat rujukan masih dalam masa berlaku. Pendaftaran admission dapat diakses 24 jam untuk layanan gawat darurat.
        </p>
      </div>
    </div>

      </div>
    </div>

    

</body>
</html>

@endsection