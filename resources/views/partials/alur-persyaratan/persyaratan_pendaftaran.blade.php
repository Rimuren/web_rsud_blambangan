{{-- PERSYARATAN PENDAFTARAN --}}
<div class="mb-12">

  {{-- Section Title --}}
  <div class="flex items-center gap-4 mb-5">
    <div class="w-11 h-11 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
      <svg class="w-5 h-5 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="3" width="18" height="18" rx="2"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
      </svg>
    </div>
    <h2 class="text-xl font-bold text-[#0f2d5e]">Persyaratan Pendaftaran</h2>
  </div>

  {{-- Two Cards --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Card: Pasien Umum --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
      {{-- Card Header --}}
      <div class="flex items-center gap-4 mb-8">
        <div class="w-11 h-11 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-[#1a1a1a]">Pasien Umum</h3>
      </div>

      {{-- Items --}}
      <div class="flex flex-col gap-5">
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">KTP / Kartu Identitas (Asli & Fotokopi)</span>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">Kartu Berobat (Jika sudah pernah berkunjung)</span>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">Formulir Pendaftaran Pasien Baru</span>
        </div>
      </div>
    </div>

    {{-- Card: Pasien BPJS --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
      {{-- Card Header --}}
      <div class="flex items-center gap-4 mb-8">
        <div class="w-11 h-11 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="2" y="5" width="20" height="14" rx="2"/>
            <path d="M2 10h20"/>
            <path d="M6 15h4"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-[#1a1a1a]">Pasien BPJS</h3>
      </div>

      {{-- Items --}}
      <div class="flex flex-col gap-5">
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">Kartu JKN / BPJS Kesehatan Digital/Fisik</span>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">Surat Rujukan dari Faskes Tingkat I</span>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">KTP & KK (Fotokopi)</span>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
          <span class="text-gray-600 text-sm leading-relaxed">Surat Kontrol (Untuk kunjungan ulang)</span>
        </div>
      </div>
    </div>
</div>
