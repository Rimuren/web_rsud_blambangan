{{-- Pelayanan Ruang Isolasi --}}
<div class="flex items-center gap-3 mt-8 mb-6">
    <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <rect x="3" y="7" width="18" height="14" rx="2"/>
            <path d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
            <line x1="12" y1="11" x2="12" y2="17"/>
            <line x1="9" y1="14" x2="15" y2="14"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-[#0f2d5e]">5. Pelayanan Ruang Isolasi</h1>
</div>

{{-- MAIN TABLE CARD --}}
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden mb-6">
    {{-- Table Header --}}
    <div class="grid grid-cols-[60px_220px_1fr] bg-[#f1f5f9] px-6 py-3 border-b border-gray-200">
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">NO</span>
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">KOMPONEN</span>
        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">URAIAN</span>
    </div>

    @php
        $rows = [
            [
                'no' => 1,
                'component' => 'Persyaratan Pelayanan',
                'icon' => '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="9" y1="7" x2="15" y2="7"/><line x1="9" y1="11" x2="15" y2="11"/><line x1="9" y1="15" x2="13" y2="15"/>',
                'content_type' => 'list',
                'items' => [
                    'Kartu Identitas / KTP',
                    'Surat Persetujuan / Konfirmasi penggantian pembayaran jaminan Covid 19'
                ]
            ],
            [
                'no' => 2,
                'component' => 'Prosedur',
                'icon' => '<rect x="3" y="3" width="6" height="6" rx="1"/><rect x="15" y="3" width="6" height="6" rx="1"/><rect x="3" y="15" width="6" height="6" rx="1"/><rect x="15" y="15" width="6" height="6" rx="1"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="18" x2="15" y2="18"/><line x1="6" y1="9" x2="6" y2="15"/><line x1="18" y1="9" x2="18" y2="15"/>',
                'content_type' => 'prosedur',
                'flow_steps' => [
                    'UGD/POLI (PCR)',
                    'Pendaftaran Rawat Inap',
                    'Petugas Mengantar ke Rawat Inap (Sesuai Protocol)',
                    'Asuhan Medis & Keperawatan, Perencanaan Pasien Pulang',
                    'Serah Terima Petugas',
                    'Bagian Klaim Kemenkes',
                    'Pasien Pulang'
                ],
                'numbered_steps' => [
                    'Melakukan pendaftaran rawat inap',
                    'Petugas mengantar pasien ke ruang rawat inap (Sesuai Protokol)',
                    'Petugas rawat inap serah terima pasien dan orientasi ruangan',
                    'Asuhan medis dan keperawatan selama perawatan',
                    'Perencanaan Pulang pasien',
                    'Penyelesaian administrasi di bagian klaim kemenkes',
                    'Pasien pulang atau dirujuk'
                ]
            ],
            [
                'no' => 3,
                'component' => 'Waktu Pelayanan',
                'icon' => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
                'content_type' => 'badge',
                'badge_text' => 'Waktu sampai di ruang rawat inap 1 jam 30 menit',
                'badge_class' => 'bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0]'
            ],
            [
                'no' => 4,
                'component' => 'Biaya',
                'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v1m0 8v1M9.5 9.5A2.5 2.5 0 0112 8a2.5 2.5 0 010 5 2.5 2.5 0 000 5 2.5 2.5 0 002.5-1.5"/>',
                'content_type' => 'list',
                'items' => [
                    'KMK 5673 tahun 2021',
                    'KMK RI NOMOR HK.01.07/MENKES/1112/2022'
                ]
            ],
            [
                'no' => 5,
                'component' => 'Produk Layanan',
                'icon' => '<rect x="2" y="3" width="20" height="5" rx="1"/><rect x="2" y="10" width="20" height="5" rx="1"/><rect x="2" y="17" width="20" height="4" rx="1"/><circle cx="18" cy="5.5" r="0.5" fill="currentColor"/><circle cx="18" cy="12.5" r="0.5" fill="currentColor"/>',
                'content_type' => 'text',
                'text_value' => 'Pelayanan Instalasi Rawat Inap : Isolasi Covid 19'
            ],
            [
                'no' => 6,
                'component' => 'Pengelolaan Pengaduan',
                'icon' => '<path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>',
                'content_type' => 'tags',
                'tags' => [
                    ['text' => 'Email: rsudblambangan@gmail.com', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Facebook: rsudblambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'IG / Twitter: @rsudblambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Kotak saran', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Petugas informasi', 'class' => 'bg-[#fff3ed] border-[#fed7b6] text-[#e07a2f] font-semibold'],
                    ['text' => 'Telp / SMS: (0333) 421118', 'class' => 'bg-gray-100 border-gray-200 text-gray-600']
                ]
            ]
        ];
    @endphp

    {{-- Looping rows --}}
    @foreach ($rows as $row)
    <div class="grid grid-cols-[60px_220px_1fr] px-6 py-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }} items-start">
        {{-- Nomor --}}
        <span class="text-sm text-gray-400 font-medium pt-0.5">{{ $row['no'] }}</span>

        {{-- Komponen --}}
        <div class="flex items-start gap-2 pt-0.5">
            <svg class="w-4 h-4 text-[#1e3a5f] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                {!! $row['icon'] !!}
            </svg>
            <span class="text-sm font-semibold text-[#1a1a2e]">{{ $row['component'] }}</span>
        </div>

        {{-- Uraian --}}
        <div>
            @if ($row['content_type'] == 'list')
                <div class="flex flex-col gap-1.5">
                    @foreach ($row['items'] as $item)
                        <p class="text-sm text-gray-600">{{ $item }}</p>
                    @endforeach
                </div>

            @elseif ($row['content_type'] == 'prosedur')
                <div class="flex flex-col gap-5">
                    {{-- Flow diagram (kotak putih + panah SVG, flex-wrap) --}}
                    <div class="bg-[#fdf3ef] border border-[#f5d5c8] rounded-xl p-4">
                        <div class="flex items-center gap-2 flex-wrap">
                            @foreach ($row['flow_steps'] as $step)
                                <div class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-xs font-medium text-gray-700 shadow-sm leading-tight whitespace-nowrap">
                                    {{ $step }}
                                </div>
                                @if (!$loop->last)
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Numbered steps grid --}}
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        @foreach ($row['numbered_steps'] as $index => $step)
                        <div class="flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-[#e2eaf5] text-[#1e3a5f] text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">{{ $index + 1 }}</span>
                            <p class="text-sm text-gray-600 leading-snug">{{ $step }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            @elseif ($row['content_type'] == 'badge')
                <span class="inline-block {{ $row['badge_class'] }} text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $row['badge_text'] }}
                </span>

            @elseif ($row['content_type'] == 'text')
                <p class="text-sm text-gray-600">{{ $row['text_value'] }}</p>

            @elseif ($row['content_type'] == 'tags')
                <div class="flex flex-wrap gap-2">
                    @foreach ($row['tags'] as $tag)
                    <span class="inline-block {{ $tag['class'] }} text-xs px-3 py-1.5 rounded-full border">
                        {{ $tag['text'] }}
                    </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- INFORMASI TAMBAHAN --}}
<div class="bg-white rounded-2xl border border-gray-200 px-6 py-5 flex items-start gap-4">
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
            Pelayanan ruang isolasi dilaksanakan dengan protokol kesehatan ketat untuk menjamin keamanan pasien dan petugas. Pastikan seluruh prosedur administrasi dan klaim diselesaikan sesuai ketentuan Kemenkes.
        </p>
    </div>
</div>