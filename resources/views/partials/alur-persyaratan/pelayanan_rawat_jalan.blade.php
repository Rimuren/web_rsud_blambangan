{{-- Icon box salmon/peach --}}
<div class="flex items-center gap-3 mt-6 mb-6">
    <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#e07a5f]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
    </div>
    <h1 class="text-xl font-bold text-[#0f2d5e]">2. Pelayanan Instalasi Rawat Jalan</h1>
</div>

{{-- MAIN TABLE CARD --}}
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden mb-4">

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
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
                'content_type' => 'list',
                'items' => [
                    'Kartu identitas / KTP / KK',
                    'Kartu asuransi Non JKN',
                    'Surat rujukan (Bila ada)'
                ]
            ],
            [
                'no' => 2,
                'component' => 'Prosedur',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h8" />',
                'content_type' => 'prosedur',
                'flow_steps' => [
                    'Ambil Nomor Antrean',
                    'Menunggu Panggilan',
                    'Pemeriksaan Dokter Spesialis',
                    'Pengambilan Obat',
                    'Administrasi di Kasir/UPP',
                    'Pasien Pulang / Dirawat'
                ],
                'numbered_steps' => [
                    'Pengambilan Nomor Antrean oleh Pasien / Keluarga',
                    'Melakukan Pendaftaran & Verifikasi Berkas di loket pendaftaran',
                    'Menunggu Pemanggilan di Ruang Tunggu',
                    'Pemeriksaan oleh Dokter dan pemeriksaan penunjang (lab atau rontgen)',
                    'Pemberian Terapi atau Resep Obat',
                    'Pengambilan Obat & Administrasi',
                    'Pasien Pulang atau Dirawat'
                ]
            ],
            [
                'no' => 3,
                'component' => 'Waktu Pelayanan',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                'content_type' => 'badge',
                'badge_text' => '1 - 2 Jam (Sesuai Prosedur)',
                'badge_class' => 'bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0]'
            ],
            [
                'no' => 4,
                'component' => 'Biaya',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />',
                'content_type' => 'biaya',
                'biaya_items' => [
                    ['label' => 'Umum', 'value' => 'Perda Kab. Banyuwangi No. 1 Th 2024', 'value_class' => 'text-gray-700 font-medium'],
                    ['label' => 'JKN/KIS', 'value' => 'GRATIS', 'value_class' => 'font-bold text-green-600'],
                    ['label' => 'Asuransi lain', 'value' => 'Sesuai Perjanjian Kerjasama', 'value_class' => 'text-gray-700']
                ]
            ],
            [
                'no' => 5,
                'component' => 'Produk Layanan Poliklinik',
                'icon' => '<rect x="2" y="3" width="20" height="5" rx="1"/><rect x="2" y="10" width="20" height="5" rx="1"/><rect x="2" y="17" width="20" height="4" rx="1"/><circle cx="18" cy="5.5" r="0.5" fill="currentColor"/><circle cx="18" cy="12.5" r="0.5" fill="currentColor"/>',
                'content_type' => 'text',
                'text_value' => 'THT, Syaraf, Bedah Umum, Penyakit Dalam, Anak, Mata, Gigi & Mulut, Kulit & Kelamin, Kandungan.'
            ],
            [
                'no' => 6,
                'component' => 'Pengelolaan Pengaduan',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />',
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
                    {{-- Flow diagram (mirip admission: kotak putih, panah SVG, flex-wrap) --}}
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

            @elseif ($row['content_type'] == 'biaya')
                <div class="flex flex-col gap-2">
                    @foreach ($row['biaya_items'] as $item)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $item['label'] }}</span>
                        <span class="text-sm text-right {{ $item['value_class'] }}">{{ $item['value'] }}</span>
                    </div>
                    @endforeach
                </div>

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
            Memberikan pelayanan kesehatan profesional dan berkualitas bagi masyarakat Banyuwangi dan sekitarnya. Pastikan membawa dokumen lengkap saat kunjungan. Layanan darurat tersedia 24 jam.
        </p>
    </div>
</div>