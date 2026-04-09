@extends('layouts.guest.guest')
@section('title', 'Alur & Persyaratan')

@section('content')

<head>
  <meta name="description" content="Lihat tarif resmi kamar rawat inap dan tindakan medis di rumah sakit kami.">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<section class="max-w-3xl mx-auto px-6 py-10">

  {{-- Header --}}
  <div class="flex items-center gap-3 mb-2">
    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
      <i class="fa-solid fa-hospital text-blue-900 text-base"></i>
    </div>
    <h1 class="text-3xl font-bold text-blue-900 leading-tight">Tarif Layanan Rumah Sakit</h1>
  </div>
  <p class="text-gray-400 text-l mb-5 ml-13 pl-0.5">Informasi resmi tarif kamar rawat inap dan tindakan medis terbaru tahun ini.</p>

  <hr class="border-gray-200 mb-6">

  {{-- Sub-heading --}}
  <div class="flex items-center gap-2 mb-3">
    <i class="fa-solid fa-bed-pulse text-blue-900 text-sm"></i>
    <h2 class="text-2xl font-semibold text-blue-900 tracking-wide">Jenis Kamar & Tarif</h2>
  </div>

  {{-- Tabel --}}
<div class="border border-gray-200 rounded-xl overflow-hidden mb-6 shadow-sm">

  {{-- Header Row --}}
  <div class="grid bg-gray-50 border-b border-gray-200" style="grid-template-columns: 70px 1fr auto;">
    <div class="px-5 py-3 text-sm font-semibold text-gray-500 tracking-wide">NO</div>
    <div class="px-5 py-3 text-sm font-semibold text-gray-500 tracking-wide">KOMPONEN</div>
    <div class="px-6 py-3 text-sm font-semibold text-gray-500 tracking-wide text-right">URAIAN (PER HARI)</div>
  </div>

  {{-- Data Rows --}}
  @php
    $rows = [
      [1, 'Kelas 3',   'Rp200.000'],
      [2, 'Kelas 2',   'Rp275.000'],
      [3, 'Kelas 1',   'Rp425.000'],
      [4, 'NICU',      'Rp580.000'],
      [5, 'ICU/ICCU',  'Rp660.000'],
      [6, 'VIP',       'Rp1.100.000'],
      [7, 'VVIP',      'Rp1.250.000'],
    ];
  @endphp

  @foreach($rows as $index => [$no, $label, $tarif])
    <div class="grid {{ !$loop->last ? 'border-b border-gray-100' : '' }} hover:bg-blue-50/60 transition duration-150 ease-out"
         style="grid-template-columns: 70px 1fr auto;">
      <div class="px-5 py-3.5 text-sm text-gray-500">{{ $no }}</div>
      <div class="px-5 py-3.5 text-base font-medium text-gray-800 flex items-center gap-3">
        @if(in_array($label, ['NICU', 'ICU/ICCU']))
          <i class="fa-solid fa-heart-pulse text-red-400 text-sm"></i>
        @elseif($label === 'VIP' || $label === 'VVIP')
          <i class="fa-solid fa-star text-amber-400 text-sm"></i>
        @else
          <i class="fa-solid fa-door-open text-blue-300 text-sm"></i>
        @endif
        <span>{{ $label }}</span>
      </div>
      <div class="px-6 py-3.5 text-base font-semibold text-blue-700 text-right tabular-nums">{{ $tarif }}</div>
    </div>
  @endforeach

</div>

  {{-- Catatan Penting --}}
<div class="rounded-xl border border-blue-100 bg-blue-50 p-5 flex gap-4 items-start shadow-sm">
  <div class="mt-0.5 flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
    <i class="fa-solid fa-circle-info text-blue-700 text-base"></i>
  </div>
  <div class="flex-1">
    <p class="text-sm font-bold text-blue-900 mb-2 tracking-wide">Catatan Penting</p>
    <ul class="space-y-2">
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Tarif dapat berubah sewaktu-waktu sesuai kebijakan manajemen rumah sakit.
      </li>
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Biaya kamar sudah termasuk jasa keperawatan namun belum termasuk biaya makan dan obat-obatan.
      </li>
      <li class="flex items-start gap-2 text-sm text-blue-800 leading-relaxed">
        <i class="fa-solid fa-circle text-blue-300 text-[6px] mt-2 flex-shrink-0"></i>
        Untuk pasien asuransi/BPJS, tarif akan disesuaikan dengan paket manfaat penjamin.
      </li>
    </ul>
  </div>
</div>

</section>

@endsection