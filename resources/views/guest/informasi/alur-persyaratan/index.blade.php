@extends('layouts.guest.guest')
@section('title', 'Alur & Persyaratan')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Alur dan Persyaratan Pelayanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; background: #ffffff; color: #1e293b; }
  </style>
</head>
<body class="bg-white">

<div class="max-w-4xl mx-auto px-6 py-12">

    {{-- PAGE TITLE --}}
    <div class="mb-10">
        <h1 class="text-4xl font-black text-[#0a2a5e] leading-tight mb-3">
            Alur dan Persyaratan Pelayanan
        </h1>
        <p class="text-gray-500 text-base leading-relaxed max-w-lg">
            Panduan resmi prosedur pendaftaran dan tahapan pelayanan kesehatan bagi seluruh pasien rumah sakit.
        </p>
    </div>

    {{-- ALUR PELAYANAN --}}
    @include('partials.alur-persyaratan.alur_pelayanan')

    {{-- PERSYARATAN PENDAFTARAN --}}
    @include('partials.alur-persyaratan.persyaratan_pendaftaran')

    {{-- PELAYANAN ADMISSION --}}
    @include('partials.alur-persyaratan.pelayanan_admission')

    {{-- PELAYANAN RAWAT JALAN --}}
    @include('partials.alur-persyaratan.pelayanan_rawat_jalan')

    {{-- PELAYANAN IGD --}}
    @include('partials.alur-persyaratan.pelayanan_igd')

    {{-- PELAYANAN RAWAT INAP --}}
    @include('partials.alur-persyaratan.pelayanan_rawat_inap')

    {{-- PELAYANAN ISOLASI --}}
    @include('partials.alur-persyaratan.pelayanan_isolasi')

    {{-- PELAYANAN RADIOLOGI --}}
    @include('partials.alur-persyaratan.pelayanan_radiologi')

    {{-- PELAYANAN LABORATORIUM --}}
    @include('partials.alur-persyaratan.pelayanan_laboratorium')

</div>

</body>
</html>
@endsection