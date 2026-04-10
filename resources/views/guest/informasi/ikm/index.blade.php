@extends('layouts.guest.guest')
@section('title', 'Informasi IKM')

@section('content')


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Indeks Kepuasan Masyarakat – RSUD Blambangan Banyuwangi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy: {
              DEFAULT: '#0d2d5e',
              light: '#e8edf5',
              mid: '#b4c2d8',
            }
          },
          borderRadius: {
            xl: '1rem',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-slate-100 min-h-screen py-10 px-4 font-sans">

  <div class="max-w-3xl mx-auto space-y-10">

    <!-- Hero -->
    <div class="bg-navy rounded-xl px-8 py-10 text-center">
      <h1 class="text-white text-xl font-medium tracking-widest uppercase mb-2">
        Indeks Kepuasan Masyarakat
      </h1>
      <p class="text-white/60 text-sm">
        Laporan Transparansi Kualitas Pelayanan Publik RSUD Blambangan Banyuwangi
      </p>
    </div>

    <!-- Card 1 – Terbaru -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex gap-5 items-start">
      <div class="w-12 h-12 rounded-lg bg-navy-light flex items-center justify-center flex-shrink-0 mt-1">
        <svg class="w-5 h-5 text-navy" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
          <polyline points="10 9 9 9 8 9"/>
        </svg>
      </div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-3">
          <span class="text-xs font-medium bg-navy text-white px-3 py-1 rounded-full">Terbaru</span>
          <span class="text-xs text-slate-400">PDF · 2.4 MB</span>
        </div>
        <h2 class="text-[15px] font-medium text-slate-800 leading-snug mb-2">
          Indeks Kepuasan Masyarakat Terhadap Pelayanan RSUD Blambangan Banyuwangi — Tribulan IV Tahun 2025
        </h2>
        <p class="text-sm text-slate-500 leading-relaxed mb-4">
          Hasil survei kepuasan periode Oktober–Desember 2025 mencakup indikator prosedur, waktu pelayanan, biaya, dan kualitas sarana prasarana.
        </p>
        <div class="flex flex-wrap gap-2">
          <a href="https://drive.google.com/file/d/1irWQZKL38NzzbkZaqo75UfPTzJwVcrBA/view"
             target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 bg-navy text-white text-sm font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
            Lihat Laporan
          </a>
          <a href="https://drive.google.com/file/d/1irWQZKL38NzzbkZaqo75UfPTzJwVcrBA/view"
             target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 border border-navy text-navy text-sm font-medium px-4 py-2 rounded-lg hover:bg-navy-light transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
              <polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Unduh Laporan
          </a>
        </div>
      </div>
    </div>

    <!-- Card 2 – Arsip 2023 -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 flex gap-5 items-start">
      <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 mt-1">
        <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
        </svg>
      </div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-3">
          <span class="text-xs font-medium bg-navy-light text-navy border border-navy-mid px-3 py-1 rounded-full">Arsip 2023</span>
          <span class="text-xs text-slate-400">PDF · 4.1 MB</span>
        </div>
        <h2 class="text-[15px] font-medium text-slate-800 leading-snug mb-2">
          Indeks Kepuasan Masyarakat (IKM) — Semester I dan II Tahun 2023
        </h2>
        <p class="text-sm text-slate-500 leading-relaxed mb-4">
          Rekapitulasi tahunan indeks kepuasan masyarakat untuk periode Januari hingga Desember tahun anggaran 2023.
        </p>
        <div class="flex flex-wrap gap-2">
          <a href="https://drive.google.com/file/d/1f2Nc9Btv8M9wvgq7LUUfkG4j5P0jIDPp/view"
             target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 bg-navy text-white text-sm font-medium px-4 py-2 rounded-lg hover:opacity-85 transition-opacity">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
            Lihat Arsip PDF
          </a>
          <a href="https://drive.google.com/file/d/1f2Nc9Btv8M9wvgq7LUUfkG4j5P0jIDPp/view"
             target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 border border-navy text-navy text-sm font-medium px-4 py-2 rounded-lg hover:bg-navy-light transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
              <polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Unduh Arsip PDF
          </a>
        </div>
      </div>
    </div>

    <!-- Info Box -->
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 flex gap-3 items-start">
      <svg class="w-5 h-5 text-navy flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <div>
        <p class="text-sm font-medium text-navy mb-1">Informasi Tambahan</p>
        <p class="text-xs text-slate-500 leading-relaxed">
          Data Indeks Kepuasan Masyarakat (IKM) disusun berdasarkan Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi sebagai wujud transparansi dan komitmen RSUD Blambangan dalam meningkatkan mutu layanan kesehatan bagi seluruh masyarakat.
        </p>
      </div>
    </div>

  </div>
</body>
</html>

@endsection