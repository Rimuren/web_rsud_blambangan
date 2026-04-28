{{-- Pelayanan Instalasi Radiologi --}}
<div class="flex flex-col sm:flex-row sm:items-center items-start gap-3 mt-6 mb-6">
    <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6 text-[#e07a5f]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.282a2 2 0 01-1.806 0l-.628-.282a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547m0 0l1.224 7.342a2 2 0 001.987 1.669h10.322a2 2 0 001.987-1.669l1.224-7.342zM15 7h.01M19 10h.01M5 10h.01M9 7h.01M12 12h.01"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-[#0f2d5e]">6. Pelayanan Instalasi Radiologi</h1>
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
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                'content_type' => 'persyaratan_radiologi',
                'items' => [
                    'Surat pengantar',
                    'Persyaratan teknis :'
                ],
                'sub_items' => [
                    [
                        'title' => 'a. X-Ray dengan kontras :',
                        'list' => [
                            'Puasa 8 jam sebelum pemeriksaan',
                            'Membawa hasil laboratorium (BUN, SC)',
                            'Urus-urus dengan minum garam inggris'
                        ]
                    ],
                    [
                        'title' => 'b. CT Scan kepala, leher, thorak, ekstremitas atas dan bawah dengan dan tanpa kontras :',
                        'list' => [
                            'Membawa hasil laboratorium (BUN, SC)',
                            'Langsung dikerjakan'
                        ]
                    ],
                    [
                        'title' => 'c. CT Scan abdomen dengan dan tanpa kontras :',
                        'list' => [
                            'Puasa minimal 8 jam sebelum pemeriksaan',
                            'Melampirkan hasil laboratorium (BUN, SC)',
                            'Dijadwalkan (minimal 1 hari sebelum pemeriksaan)'
                        ]
                    ],
                    [
                        'title' => 'd. USG abdomen atas dan bawah :',
                        'list' => [
                            'Puasa minimal 6-8 jam sebelum pemeriksaan kecuali USG Ginjal dan ginekologi tidak perlu puasa, hanya minum dan tahan kencing.'
                        ]
                    ]
                ]
            ],
            [
                'no' => 2,
                'component' => 'Prosedur',
                'icon' => '<rect x="3" y="3" width="6" height="6" rx="1"/><rect x="15" y="3" width="6" height="6" rx="1"/><rect x="3" y="15" width="6" height="6" rx="1"/><rect x="15" y="15" width="6" height="6" rx="1"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="18" x2="15" y2="18"/><line x1="6" y1="9" x2="6" y2="15"/><line x1="18" y1="9" x2="18" y2="15"/>',
                'content_type' => 'prosedur',
                'flow_steps' => [
                    'Registrasi',
                    'Menunggu Panggilan',
                    'Pemeriksaan',
                    'Pembacaan',
                    'Penyerahan Hasil'
                ],
                'numbered_steps' => [
                    'Pasien/ keluarga melakukan registrasi',
                    'Menunggu panggilan sesuai dengan ruang pemeriksaan',
                    'Dilakukan pemeriksaan sesuai dengan surat pengantar',
                    'Dilakukan pembacaan – ekspertisi',
                    'Penyerahan hasil – kembali ke unit pengirim'
                ]
            ],
            [
                'no' => 3,
                'component' => 'Waktu Pelayanan',
                'icon' => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
                'content_type' => 'badge',
                'badge_text' => 'Rata-rata 3 jam (disesuaikan dengan jenis pemeriksaan)',
                'badge_class' => 'bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0]'
            ],
            [
                'no' => 4,
                'component' => 'Biaya',
                'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v1m0 8v1M9.5 9.5A2.5 2.5 0 0112 8a2.5 2.5 0 010 5 2.5 2.5 0 000 5 2.5 2.5 0 002.5-1.5"/>',
                'content_type' => 'list',
                'items' => [
                    'Umum: Sesuai Perda yang berlaku',
                    'JKN / KIS : GRATIS',
                    'Asuransi lain: Sesuai MOU / PKS'
                ]
            ],
            [
                'no' => 5,
                'component' => 'Produk Layanan',
                'icon' => '<rect x="2" y="3" width="20" height="5" rx="1"/><rect x="2" y="10" width="20" height="5" rx="1"/><rect x="2" y="17" width="20" height="4" rx="1"/><circle cx="18" cy="5.5" r="0.5" fill="currentColor"/><circle cx="18" cy="12.5" r="0.5" fill="currentColor"/>',
                'content_type' => 'text',
                'text_value' => 'Pelayanan radiologi'
            ],
            [
                'no' => 6,
                'component' => 'Pengelolaan Pengaduan',
                'icon' => '<path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>',
                'content_type' => 'tags',
                'tags' => [
                    ['text' => 'Email: rsudblambangan.bwi@gmail.com', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Facebook: Rsud Blambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'IG / Twitter: @rsudblambangan', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Kotak saran', 'class' => 'bg-gray-100 border-gray-200 text-gray-600'],
                    ['text' => 'Petugas informasi', 'class' => 'bg-[#fff3ed] border-[#fed7b6] text-[#e07a2f] font-semibold'],
                    ['text' => 'Telp / SMS: 0811 3535 858', 'class' => 'bg-gray-100 border-gray-200 text-gray-600']
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
            @if ($row['content_type'] == 'persyaratan_radiologi')
                <div class="flex flex-col gap-1.5">
                    @foreach ($row['items'] as $item)
                        <p class="text-sm text-gray-600">{{ $item }}</p>
                    @endforeach
                    <div class="pl-4 flex flex-col gap-3 mt-1">
                        @foreach ($row['sub_items'] as $sub)
                            <div>
                                <p class="text-sm font-semibold text-[#1a2e3b] mb-1">{{ $sub['title'] }}</p>
                                <ul class="list-disc pl-5 flex flex-col gap-1">
                                    @foreach ($sub['list'] as $li)
                                        <li class="text-sm text-gray-600">{{ $li }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
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

            @elseif ($row['content_type'] == 'list')
                <div class="flex flex-col gap-1.5">
                    @foreach ($row['items'] as $item)
                        <p class="text-sm text-gray-600">{!! str_replace('GRATIS', '<span class="font-bold text-green-600">GRATIS</span>', $item) !!}</p>
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
            Pelayanan instalasi radiologi dilaksanakan dengan protokol kesehatan ketat untuk menjamin keamanan pasien dan petugas. Pastikan seluruh prosedur administrasi dan klinis diselesaikan sesuai ketentuan rumah sakit.
        </p>
    </div>
</div>