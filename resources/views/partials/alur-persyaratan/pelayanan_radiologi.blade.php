<!-- ============================================================ -->
<!-- SECTION 6: Pelayanan Instalasi Radiologi                    -->
<!-- Tempelkan kode ini ke dalam file blade utama                -->
<!-- Style seragam dengan Section 5                              -->
<!-- ============================================================ -->

<!-- Section Header -->
<div class="flex items-center gap-4 mb-5">
  <div class="w-11 h-11 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
    <svg class="w-5 h-5 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.282a2 2 0 01-1.806 0l-.628-.282a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547m0 0l1.224 7.342a2 2 0 001.987 1.669h10.322a2 2 0 001.987-1.669l1.224-7.342zM15 7h.01M19 10h.01M5 10h.01M9 7h.01M12 12h.01"/>
    </svg>
  </div>
  <h2 class="text-xl font-bold text-[#0f2d5e]">6. Pelayanan Instalasi Radiologi</h2>
</div>

<!-- Main Table Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">

  <!-- Table Header -->
  <div class="grid grid-cols-[48px_200px_1fr] bg-gray-50 border-b border-gray-200 px-5 py-3">
    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">NO</span>
    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">KOMPONEN</span>
    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">URAIAN</span>
  </div>

  <!-- ROW 1: Persyaratan Pelayanan -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 border-b border-gray-100 items-start">
    <span class="text-sm text-gray-400 pt-0.5">1</span>
    <div class="flex items-start gap-2 pt-0.5">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Persyaratan Pelayanan</span>
    </div>
    <div class="flex flex-col gap-1.5">
      <p class="text-sm text-gray-600">1. Surat pengantar</p>
      <p class="text-sm text-gray-600">2. Persyaratan teknis :</p>
      <div class="pl-4 flex flex-col gap-3 mt-1">

        <div>
          <p class="text-sm font-semibold text-[#1a2e3b] mb-1">a. X-Ray dengan kontras :</p>
          <ul class="list-disc pl-5 flex flex-col gap-1">
            <li class="text-sm text-gray-600">Puasa 8 jam sebelum pemeriksaan</li>
            <li class="text-sm text-gray-600">Membawa hasil laboratorium (BUN, SC)</li>
            <li class="text-sm text-gray-600">Urus-urus dengan minum garam inggris</li>
          </ul>
        </div>

        <div>
          <p class="text-sm font-semibold text-[#1a2e3b] mb-1">b. CT Scan kepala, leher, thorak, ekstremitas atas dan bawah dengan dan tanpa kontras :</p>
          <ul class="list-disc pl-5 flex flex-col gap-1">
            <li class="text-sm text-gray-600">Membawa hasil laboratorium (BUN, SC)</li>
            <li class="text-sm text-gray-600">Langsung dikerjakan</li>
          </ul>
        </div>

        <div>
          <p class="text-sm font-semibold text-[#1a2e3b] mb-1">c. CT Scan abdomen dengan dan tanpa kontras :</p>
          <ul class="list-disc pl-5 flex flex-col gap-1">
            <li class="text-sm text-gray-600">Puasa minimal 8 jam sebelum pemeriksaan</li>
            <li class="text-sm text-gray-600">Melampirkan hasil laboratorium (BUN, SC)</li>
            <li class="text-sm text-gray-600">Dijadwalkan (minimal 1 hari sebelum pemeriksaan)</li>
          </ul>
        </div>

        <div>
          <p class="text-sm font-semibold text-[#1a2e3b] mb-1">d. USG abdomen atas dan bawah :</p>
          <ul class="list-disc pl-5 flex flex-col gap-1">
            <li class="text-sm text-gray-600">Puasa minimal 6-8 jam sebelum pemeriksaan kecuali USG Ginjal dan ginekologi tidak perlu puasa, hanya minum dan tahan kencing.</li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- ROW 2: Prosedur -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 border-b border-gray-100 items-start">
    <span class="text-sm text-gray-400 pt-0.5">2</span>
    <div class="flex items-start gap-2 pt-0.5">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7" rx="1"/>
        <rect x="14" y="3" width="7" height="7" rx="1"/>
        <rect x="3" y="14" width="7" height="7" rx="1"/>
        <rect x="14" y="14" width="7" height="7" rx="1"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Prosedur</span>
    </div>
    <div class="flex flex-col gap-4">

      <!-- Flow diagram -->
      <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 flex items-center gap-2 flex-wrap">
        <div class="flex-1 min-w-[80px] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
          Registrasi
        </div>
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <div class="flex-1 min-w-[80px] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
          Menunggu Panggilan
        </div>
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <div class="flex-1 min-w-[80px] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
          Pemeriksaan
        </div>
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <div class="flex-1 min-w-[80px] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
          Pembacaan
        </div>
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <div class="flex-1 min-w-[80px] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
          Penyerahan Hasil
        </div>
      </div>

      <!-- Label KETERANGAN -->
      <p class="text-xs font-bold text-[#1e6a7a] uppercase tracking-wider">Keterangan:</p>

      <!-- Numbered steps 2 col -->
      <div class="grid grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
          <p class="text-sm text-gray-600 leading-snug">Pasien/ keluarga melakukan registrasi</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
          <p class="text-sm text-gray-600 leading-snug">Menunggu panggilan sesuai dengan ruang pemeriksaan</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
          <p class="text-sm text-gray-600 leading-snug">Dilakukan pemeriksaan sesuai dengan surat pengantar</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
          <p class="text-sm text-gray-600 leading-snug">Dilakukan pembacaan – ekspertisi</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">5</span>
          <p class="text-sm text-gray-600 leading-snug">Penyerahan hasil – kembali ke unit pengirim</p>
        </div>
      </div>

    </div>
  </div>

  <!-- ROW 3: Waktu Pelayanan -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 border-b border-gray-100 items-center">
    <span class="text-sm text-gray-400">3</span>
    <div class="flex items-center gap-2">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="9"/>
        <polyline points="12 7 12 12 15 15"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Waktu Pelayanan</span>
    </div>
    <p class="text-sm text-gray-600">Rata-rata 3 jam (disesuaikan dengan jenis pemeriksaan)</p>
  </div>

  <!-- ROW 4: Biaya -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 border-b border-gray-100 items-start">
    <span class="text-sm text-gray-400 pt-1">4</span>
    <div class="flex items-center gap-2 pt-1">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="2" y="6" width="20" height="14" rx="2"/>
        <path d="M2 10h20"/>
        <circle cx="12" cy="15" r="2"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Biaya</span>
    </div>
    <div class="flex flex-col gap-1.5">
      <p class="text-sm text-gray-600">1. Umum: Sesuai Perda yang berlaku</p>
      <p class="text-sm text-gray-600">2. JKN / KIS : <span class="font-bold text-[#0f2d5e]">GRATIS</span></p>
      <p class="text-sm text-gray-600">3. Asuransi lain: Sesuai MOU / PKS</p>
    </div>
  </div>

  <!-- ROW 5: Produk Layanan -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 border-b border-gray-100 items-center">
    <span class="text-sm text-gray-400">5</span>
    <div class="flex items-center gap-2">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="2" y="3" width="20" height="5" rx="1"/>
        <rect x="2" y="10" width="20" height="5" rx="1"/>
        <rect x="2" y="17" width="20" height="4" rx="1"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Produk Layanan</span>
    </div>
    <p class="text-sm text-gray-600">Pelayanan radiologi</p>
  </div>

  <!-- ROW 6: Pengelolaan Pengaduan -->
  <div class="grid grid-cols-[48px_200px_1fr] px-5 py-5 items-start">
    <span class="text-sm text-gray-400 pt-1">6</span>
    <div class="flex items-center gap-2 pt-1">
      <svg class="w-4 h-4 text-[#1e6a7a] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M3 18v-6a9 9 0 0118 0v6"/>
        <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Pengelolaan Pengaduan</span>
    </div>
    <div class="flex flex-wrap gap-2">
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Email: rsudblambangan.bwi@gmail.com</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Facebook: Rsud Blambangan</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">IG / Twitter: @rsudblambangan</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Kotak saran</span>
      <span class="bg-orange-50 border border-orange-200 text-orange-500 text-xs font-semibold px-3 py-1.5 rounded-full">Petugas informasi</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Telp / SMS: 0811 3535 858</span>
    </div>
  </div>

</div><!-- end table card -->

<!-- Informasi Tambahan -->
<div class="bg-orange-50 border border-orange-100 rounded-xl px-5 py-4 flex items-start gap-3 mb-6">
  <svg class="w-5 h-5 text-[#1e6a7a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="9"/>
    <line x1="12" y1="8" x2="12" y2="8" stroke-width="2.5" stroke-linecap="round"/>
    <line x1="12" y1="11" x2="12" y2="17" stroke-linecap="round"/>
  </svg>
  <div>
    <p class="text-sm font-bold text-[#1a2e3b] mb-1">Informasi Tambahan</p>
    <p class="text-sm text-gray-600 leading-relaxed">Pelayanan instalasi radiologi dilaksanakan dengan protokol kesehatan ketat untuk menjamin keamanan pasien dan petugas. Pastikan seluruh prosedur administrasi dan klinis diselesaikan sesuai ketentuan rumah sakit.</p>
  </div>
</div>