{{-- Pelayanan Instalasi Laboratorium Patologi Klinik & Patologi Anatomi --}}
<div class="flex flex-col sm:flex-row sm:items-center items-start gap-3 mt-6 mb-6">
    <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.282a2 2 0 01-1.806 0l-.628-.282a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547m0 0l-1.1 3.523A2 2 0 005.659 22h12.682a2 2 0 001.951-2.472l-1.1-3.523zM12 2v9m-4-7l8 0" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-[#0f2d5e]">7. Pelayanan Instalasi Laboratorium Patologi Klinik &amp; Patologi Anatomi</h1>
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
                'icon' => '<path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>',
                'content_type' => 'list',
                'items' => [
                    'Surat pengantar',
                    'Persyaratan teknis'
                ]
            ],
            [
                'no' => 2,
                'component' => 'Prosedur',
                'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>',
                'content_type' => 'prosedur',
                'flow_steps' => [
                    'Registrasi',
                    'Menunggu Panggilan',
                    'Pengambilan Sampel',
                    'Pemeriksaan',
                    'Pencatatan & Verifikasi',
                    'Penyerahan Hasil'
                ],
                'numbered_steps' => [
                    'Pasien/keluarga melakukan registrasi',
                    'Menunggu panggilan untuk pengambilan sampel',
                    'Pengambilan sampel oleh petugas sampling',
                    'Proses pemeriksaan sampel-analisa',
                    'Pencatatan hasil-verifikasi',
                    'Penyerahan hasil'
                ]
            ],
            [
                'no' => 3,
                'component' => 'Waktu Pelayanan',
                'icon' => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
                'content_type' => 'badge',
                'badge_text' => 'Hasil laboratorium selesai dalam waktu &lt; 120 menit',
                'badge_class' => 'bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0]'
            ],
            [
                'no' => 4,
                'component' => 'Biaya',
                'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v1m0 8v1M9.5 9.5A2.5 2.5 0 0112 8a2.5 2.5 0 010 5 2.5 2.5 0 000 5 2.5 2.5 0 002.5-1.5"/>',
                'content_type' => 'biaya',
                'biaya_items' => [
                    ['label' => 'Umum', 'value' => 'Peraturan Daerah Kabupaten Banyuwangi No. 3 Th 2025', 'value_class' => 'text-gray-700 font-medium'],
                    ['label' => 'JKN / KIS', 'value' => 'GRATIS', 'value_class' => 'font-bold text-green-600'],
                    ['label' => 'Asuransi lain', 'value' => 'Sesuai Perjanjian Kerjasama', 'value_class' => 'text-gray-700']
                ]
            ],
            [
                'no' => 5,
                'component' => 'Produk Layanan',
                'icon' => '<rect x="2" y="3" width="20" height="5" rx="1"/><rect x="2" y="10" width="20" height="5" rx="1"/><rect x="2" y="17" width="20" height="4" rx="1"/><circle cx="18" cy="5.5" r="0.5" fill="currentColor"/><circle cx="18" cy="12.5" r="0.5" fill="currentColor"/>',
                'content_type' => 'text',
                'text_value' => 'Pelayanan laboratorium'
            ],
            [
                'no' => 6,
                'component' => 'Pengelolaan Pengaduan',
                'icon' => '<path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>',
                'content_type' => 'tags',
                'tags' => [
                    ['text' => 'Email: rsudblambangan.bwi@gmail.com', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Facebook: rsudblambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'IG / Twitter: @rsudblambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Kotak saran', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Petugas informasi', 'class' => 'bg-[#fff3ed] border-[#fed7b6] text-[#e07a2f] font-semibold'],
                    ['text' => 'Telp / SMS / WA: 0811 3535 858', 'class' => 'bg-gray-100 border-gray-200 text-gray-600']
                ]
            ]
        ];
    @endphp

    {{-- Looping rows --}}
    @foreach ($rows as $row)
    <div class="grid grid-cols-1 lg:grid-cols-[60px_220px_1fr] px-4 sm:px-6 py-4 sm:py-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }} items-start gap-4 lg:gap-0">

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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                    @foreach ($row['biaya_items'] as $item)
                    <div class="flex items-center justify-between sm:flex-1">
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
<div class="bg-white rounded-2xl border border-gray-200 px-4 sm:px-6 py-4 sm:py-5 flex flex-col sm:flex-row items-start gap-3 sm:gap-4">
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
            Pelayanan instalasi laboratorium dilaksanakan dengan protokol kesehatan ketat untuk menjamin keamanan pasien dan petugas. Pastikan seluruh prosedur administrasi dan klinis diselesaikan sesuai ketentuan rumah sakit.
        </p>
    </div>
</div>