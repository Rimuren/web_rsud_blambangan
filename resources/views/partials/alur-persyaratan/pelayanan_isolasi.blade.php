<!-- ============================================================ -->
<!-- SECTION 5: Pelayanan Ruang Isolasi                          -->
<!-- Tempelkan kode ini ke dalam file blade utama                -->
<!-- ============================================================ -->

<!-- Section Header -->
<div class="flex items-center gap-4 mb-5">
  <div class="w-11 h-11 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
    <svg class="w-5 h-5 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <rect x="3" y="7" width="18" height="14" rx="2"/>
      <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
      <line x1="12" y1="11" x2="12" y2="17"/>
      <line x1="9" y1="14" x2="15" y2="14"/>
    </svg>
  </div>
  <h2 class="text-xl font-bold text-[#0f2d5e]">5. Pelayanan Ruang Isolasi</h2>
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
        <rect x="5" y="2" width="14" height="20" rx="2"/>
        <line x1="9" y1="7" x2="15" y2="7"/>
        <line x1="9" y1="11" x2="15" y2="11"/>
        <line x1="9" y1="15" x2="13" y2="15"/>
      </svg>
      <span class="text-sm font-semibold text-[#1a2e3b]">Persyaratan Pelayanan</span>
    </div>
    <div class="flex flex-col gap-1.5">
      <p class="text-sm text-gray-600">1. Kartu Identitas / KTP</p>
      <p class="text-sm text-gray-600">2. Surat Persetujuan/ Konfirmasi penggantian pembayaran jaminan Covid 19</p>
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

      <!-- Flow diagram: 2 col grid layout with arrows -->
      <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 flex flex-col gap-3">

        <!-- Row 1 -->
        <div class="flex items-center gap-2">
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
            UGD/POLI (PCR)
          </div>
          <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
            Pendaftaran Rawat Inap
          </div>
          <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </div>

        <!-- Row 2 -->
        <div class="flex items-center gap-2">
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center leading-snug">
            Petugas Mengantar ke Rawat Inap<br/>(Sesuai Protocol)
          </div>
          <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center leading-snug">
            Asuhan Medis &amp; Keperawatan, Perencanaan Pasien Pulang
          </div>
          <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
        </div>

        <!-- Row 3 -->
        <div class="flex items-center gap-2">
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
            Serah Terima Petugas
          </div>
          <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
          </svg>
          <div class="flex-1 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
            Bagian Klaim Kemenkes
          </div>
          <!-- spacer untuk alignment -->
          <div class="w-4 flex-shrink-0"></div>
        </div>

        <!-- Row 4: Pasien Pulang (kiri saja) -->
        <div class="flex items-center gap-2">
          <div class="w-[calc(50%-18px)] bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm text-center">
            Pasien Pulang
          </div>
        </div>

      </div>

      <!-- Label KETERANGAN -->
      <p class="text-xs font-bold text-[#1e6a7a] uppercase tracking-wider">Keterangan:</p>

      <!-- 7 Numbered steps 2 col -->
      <div class="grid grid-cols-2 gap-x-6 gap-y-4">
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
          <p class="text-sm text-gray-600 leading-snug">Melakukan pendaftaran rawat inap</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
          <p class="text-sm text-gray-600 leading-snug">Petugas mengantar pasien ke ruang rawat inap (Sesuai Protokol)</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
          <p class="text-sm text-gray-600 leading-snug">Petugas rawat inap serah terima pasien dan orientasi ruangan</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
          <p class="text-sm text-gray-600 leading-snug">Asuhan medis dan keperawatan selama perawatan</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">5</span>
          <p class="text-sm text-gray-600 leading-snug">Perencanaan Pulang pasien</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">6</span>
          <p class="text-sm text-gray-600 leading-snug">Penyelesaian administrasi di bagian klaim kemenkes</p>
        </div>
        <div class="flex items-start gap-2">
          <span class="w-5 h-5 rounded-full bg-[#dbeafe] text-[#1e40af] text-[11px] font-bold flex items-center justify-center flex-shrink-0 mt-0.5">7</span>
          <p class="text-sm text-gray-600 leading-snug">Pasien pulang atau dirujuk</p>
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
    <p class="text-sm text-gray-600">Waktu sampai di ruang rawat inap 1 jam 30 menit</p>
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
      <p class="text-sm text-gray-600">KMK 5673 tahun 2021</p>
      <p class="text-sm text-gray-600">KMK RI NOMOR HK.01.07/MENKES/1112/2022</p>
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
    <p class="text-sm text-gray-600">Pelayanan Instalasi Rawat Inap : Isolasi Covid 19</p>
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
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Email:rsudblambangan@gmail.com</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Facebook:rsudblambangan</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">IG / Twitter:@rsudblambangan</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Kotak saran</span>
      <span class="bg-orange-50 border border-orange-200 text-orange-500 text-xs font-semibold px-3 py-1.5 rounded-full">Petugas informasi</span>
      <span class="bg-gray-100 border border-gray-200 text-gray-600 text-xs px-3 py-1.5 rounded-full">Telp / SMS:(0333) 421118</span>
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
    <p class="text-sm text-gray-600 leading-relaxed">Pelayanan ruang isolasi dilaksanakan dengan protokol kesehatan ketat untuk menjamin keamanan pasien dan petugas. Pastikan seluruh prosedur administrasi dan klaim diselesaikan sesuai ketentuan Kemenkes.</p>
  </div>
</div>

<!-- END SECTION 5           -->
