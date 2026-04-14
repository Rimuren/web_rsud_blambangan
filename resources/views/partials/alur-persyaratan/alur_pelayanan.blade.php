{{-- ALUR PELAYANAN PASIEN --}}
<div class="mb-12">
    {{-- Section Title --}}
    <div class="flex items-center gap-3 mb-8">
        <svg class="w-6 h-6 text-[#0a2a5e]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
        </svg>
        <h2 class="text-xl font-bold text-[#0a2a5e]">Alur Pelayanan Pasien</h2>
    </div>

    {{-- Steps --}}
    @php
        $steps = [
            [
                'title' => 'Pendaftaran & Administrasi',
                'desc' => 'Lantai 1, Gedung Utama. Pengambilan nomor antrian dan verifikasi dokumen identitas.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"/>'
            ],
            [
                'title' => 'Triage & Pemeriksaan Awal',
                'desc' => 'Instalasi Gawat Darurat atau Ruang Pra-Pemeriksaan. Pengecekan tanda vital (tensi, suhu, berat badan).',
                'icon' => '<polyline stroke-linecap="round" stroke-linejoin="round" points="22 12 18 12 15 21 9 3 6 12 2 12"/>'
            ],
            [
                'title' => 'Pemeriksaan Dokter Spesialis',
                'desc' => 'Ruang Poliklinik sesuai spesialisasi. Konsultasi medis dan penentuan tindakan/diagnosa.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>'
            ],
            [
                'title' => 'Farmasi & Pembayaran',
                'desc' => 'Lantai 1, Area Kasir & Apotek. Pengambilan obat dan penyelesaian administrasi biaya.',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>'
            ]
        ];
    @endphp

    <div class="flex flex-col gap-0" role="list">
        @foreach ($steps as $index => $step)
            @php $isLast = ($index === count($steps) - 1); @endphp
            <div class="flex items-start gap-5" role="listitem">
                {{-- Icon & Garis --}}
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0 border border-blue-100">
                        <svg class="w-5 h-5 text-[#1e3a5f]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            {!! $step['icon'] !!}
                        </svg>
                    </div>
                    {{-- Garis vertikal --}}
                    @if (!$isLast)
                        <div class="w-px bg-blue-100 flex-1 min-h-[48px] mt-1"></div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="pt-2 {{ !$isLast ? 'pb-10' : '' }}">
                    <h3 class="font-bold text-[#1a1a1a] text-base mb-1">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div