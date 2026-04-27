{{-- Icon box salmon/peach --}}
<div class="flex flex-col sm:flex-row sm:items-center items-start gap-3 mt-6 mb-6">
    <div class="w-12 h-12 rounded-xl bg-[#fde8e0] flex items-center justify-center flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#e07a5f]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
        </svg>
    </div>
    <h1 class="text-xl font-bold text-[#0f2d5e]">3. Pelayanan Instalasi Gawat Darurat</h1>
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
        $rows_igd = [
            [
                'no' => 1,
                'component' => 'Persyaratan Pelayanan',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />',
                'content_type' => 'list',
                'items' => [
                    'Kartu identitas / KTP / KK',
                    'Kartu Asuransi Non JKN',
                    'Surat Pengantar IGD'
                ]
            ],
            [
                'no' => 2,
                'component' => 'Prosedur',
                'icon' => '<rect x="3" y="3" width="6" height="6" rx="1"/><rect x="15" y="3" width="6" height="6" rx="1"/><rect x="3" y="15" width="6" height="6" rx="1"/><rect x="15" y="15" width="6" height="6" rx="1"/><line x1="9" y1="6" x2="15" y2="6"/><line x1="9" y1="18" x2="15" y2="18"/><line x1="6" y1="9" x2="6" y2="15"/><line x1="18" y1="9" x2="18" y2="15"/>',
                'content_type' => 'prosedur',
                'flow_steps' => [
                    'Pasien Datang',
                    'Pendaftaran',
                    'Tindakan Medis',
                    'Pengambilan Obat',
                    'Administrasi Kasir',
                    'Pasien Pulang/Dirawat'
                ],
                'numbered_steps' => [
                    'Pasien Datang ke IGD',
                    'Pendaftaran oleh Keluarga/Pengantar',
                    'Tindakan Medis Sesuai Keluhan',
                    'Pemeriksaan Penunjang (Bila Diperlukan)',
                    'Pengambilan Obat',
                    'Penyelesaian Administrasi Kasir/UPP',
                    'Pemberian Terapi atau Resep Obat',
                    'Pasien Pulang/Dirawat/Dirujuk'
                ]
            ],
            [
                'no' => 3,
                'component' => 'Waktu Pelayanan',
                'icon' => '<circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/>',
                'content_type' => 'badge',
                'badge_text' => 'Kurang dari 5 menit (Respon)',
                'badge_class' => 'bg-[#dcfce7] text-[#15803d] border border-[#bbf7d0]'
            ],
            [
                'no' => 4,
                'component' => 'Biaya',
                'icon' => '<rect x="2" y="7" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>',
                'content_type' => 'biaya',
                'biaya_items' => [
                    ['label' => 'Umum', 'value' => 'Perda Kab. Banyuwangi No. 1 Th 2024', 'value_class' => 'text-gray-700 font-medium'],
                    ['label' => 'JKN/KIS', 'value' => 'GRATIS', 'value_class' => 'font-bold text-green-600'],
                    ['label' => 'Asuransi lain', 'value' => 'Sesuai Perjanjian Kerjasama', 'value_class' => 'text-gray-700']
                ]
            ],
            [
                'no' => 5,
                'component' => 'Produk Layanan',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>',
                'content_type' => 'text',
                'text_value' => 'Pelayanan gawat darurat'
            ],
            [
                'no' => 6,
                'component' => 'Pengelolaan Pengaduan',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 18v-6a9 9 0 0118 0v6"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/>',
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
    @foreach ($rows_igd as $row)
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
                    {{-- Flow diagram --}}
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
            Memberikan pelayanan kegawatdaruratan medis yang cepat, tepat, dan profesional selama 24 jam penuh.
            Pastikan keluarga segera mengurus administrasi setelah pasien mendapatkan penanganan awal.
        </p>
    </div>
</div>