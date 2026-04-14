@extends('layouts.guest.guest')

@section('title', 'Detail Artikel')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    html, body { overflow-x: hidden; width: 100%; max-width: 100%; }
</style>

{{-- Simulasi data artikel berdasarkan ID (nanti diganti dengan data dari database) --}}
@php
    $articles = [
        1 => [
            'title' => 'Kesehatan Jantung 2024: Standar Baru',
            'category' => 'Kesehatan',
            'date' => '12 Mei 2024',
            'author' => 'dr. Andi Pratama, Sp.JP',
            'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=1200&h=500&fit=crop',
            'content' => '
                <p>Penyakit jantung masih menjadi penyebab utama kematian di dunia, namun fondasi untuk jantung yang sehat sering kali dibangun puluhan tahun sebelum gejala muncul. Bagi mereka yang memasuki usia 40-an, dekade ini merupakan periode krusial untuk melakukan intervensi dan perawatan pencegahan.</p>
                <h2 class="text-xl font-bold text-teal-600 mt-6">Pentingnya Pemeriksaan Rutin</h2>
                <p>Pemeriksaan rutin untuk tekanan darah, kadar kolesterol, dan gula darah sangat penting. Alat diagnostik modern kini memungkinkan kita untuk melihat lebih dalam kesehatan arteri dari sebelumnya. Kami merekomendasikan profil lipid komprehensif yang tidak hanya melihat LDL dan HDL tetapi juga ukuran partikel dan penanda peradangan seperti CRP.</p>
                <p>Faktor gaya hidup tetap menjadi landasan. Namun, definisi "hidup sehat" telah berkembang. Kini diketahui bahwa latihan interval intensitas tinggi (HIIT) yang dipadukan dengan latihan kekuatan memberikan manfaat kardiovaskular yang lebih baik dibandingkan kardio intensitas stabil saja untuk kelompok usia ini.</p>
                <p>Konsultasikan dengan dokter Anda untuk menentukan rencana pencegahan yang paling sesuai dengan kondisi kesehatan Anda.</p>
            ',
            'tags' => ['#JantungSehat', '#KedokteranPencegahan', '#Kardiologi']
        ],
        2 => [
            'title' => 'Mengatasi Asma pada Anak',
            'category' => 'Kesehatan Anak',
            'date' => '5 Februari 2024',
            'author' => 'dr. Sinta Wijaya, Sp.A',
            'image' => 'https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=1200&h=500&fit=crop',
            'content' => '<p>Konten artikel tentang asma pada anak...</p>',
            'tags' => ['#AsmaAnak', '#KesehatanPernapasan']
        ],
        // tambahkan artikel lain sesuai kebutuhan
    ];

    // Jika ID tidak ditemukan, gunakan artikel default (misal ID 1)
    $articleId = $id ?? 1;
    $article = $articles[$articleId] ?? $articles[1];

    // Data Latest News (dinamis)
    $latestNews = [
        ['title' => 'Penelitian vaksin baru menunjukkan hasil menjanjikan', 'date' => '2 JAM LALU', 'img' => 'https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?w=120&h=80&fit=crop', 'id' => 7],
        ['title' => 'Flu musiman: Apa yang diharapkan tahun ini', 'date' => '3 HARI LALU', 'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=120&h=80&fit=crop', 'id' => 8],
        ['title' => 'Gedung MRI baru dibuka bulan Desember ini', 'date' => 'KEMARIN', 'img' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=120&h=80&fit=crop', 'id' => 9],
    ];

    // Trending Topics
    $trendingTopics = ['Kardiologi', 'Imunologi', 'Kesehatan Anak', 'Diabetes', 'Kebugaran', 'Bedah'];

    // Recommended Articles
    $recommended = [
        ['title' => 'Hubungan Usus-Otak: Bagaimana Pola Makan Mempengaruhi Kesehatan Mental', 'category' => 'Gizi', 'read_time' => '5 menit', 'summary' => 'Penelitian terbaru menunjukkan sistem pencernaan Anda lebih dari sekadar memproses makanan; mungkin dapat mengendalikan suasana hati Anda...', 'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=300&fit=crop', 'id' => 10],
        ['title' => 'Hygiene Tidur: 7 Langkah Menuju Istirahat yang Lebih Baik', 'category' => 'Tips Kesehatan', 'read_time' => '8 menit', 'summary' => 'Tidur berkualitas sama pentingnya dengan olahraga. Pelajari cara mengoptimalkan lingkungan Anda untuk istirahat lebih nyenyak.', 'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&h=300&fit=crop', 'id' => 11],
    ];
@endphp

<div class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-5 py-6 md:px-8">

        {{-- Search Box --}}
        <div class="mb-8">
            <p class="text-base font-bold text-blue-900 mb-3">Cari Artikel</p>
            <div class="relative">
                <input type="text" placeholder="Cari artikel..."
                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-5 py-4 text-base text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent pr-12 transition">
                <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
            </div>
        </div>

        <hr class="border-gray-100 mb-6">

        {{-- Latest News --}}
        <div class="mb-6">
            <h2 class="text-sm font-bold text-blue-900 mb-3">Berita Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach ($latestNews as $news)
                <div class="flex items-start gap-3">
                    <img src="{{ $news['img'] }}" alt="{{ $news['title'] }}" class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                    <div>
                        <p class="text-sm font-bold text-gray-800 leading-snug mb-0.5">{{ $news['title'] }}</p>
                        <p class="text-xs text-gray-400 mb-1">{{ $news['date'] }}</p>
                        <a href="{{ route('guest.artikel.detail', $news['id']) }}" class="text-blue-600 text-xs font-semibold flex items-center gap-1 hover:text-blue-800">
                            Baca selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Trending Topics --}}
        <div class="mb-8">
            <p class="text-xs font-bold text-gray-400 tracking-widest uppercase mb-2">Topik Populer</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($trendingTopics as $topic)
                <span class="px-3 py-1 border border-teal-500 text-teal-600 text-sm rounded-full hover:bg-teal-50 cursor-pointer transition">{{ $topic }}</span>
                @endforeach
            </div>
        </div>

        {{-- Hero Article Image --}}
        <div class="mb-6 rounded-2xl overflow-hidden">
            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-96 object-cover">
        </div>

        {{-- Article Meta --}}
        <div class="flex items-center gap-2 mb-3">
            <span class="text-teal-600 text-sm font-semibold">{{ $article['category'] }}</span>
            <span class="text-gray-300 text-xs">•</span>
            <span class="text-gray-400 text-sm">{{ $article['date'] }}</span>
        </div>

        {{-- Article Title --}}
        <h1 class="text-3xl font-extrabold text-gray-900 mb-4 leading-tight">
            {{ $article['title'] }}
        </h1>

        {{-- Author --}}
        <div class="flex items-center gap-2 mb-6">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                <i class="fa-regular fa-user text-gray-400 text-base"></i>
            </div>
            <span class="text-base font-medium text-gray-700">{{ $article['author'] }}</span>
        </div>

        {{-- Article Body --}}
        <div class="text-base text-gray-600 leading-relaxed space-y-5 mb-8">
            {!! $article['content'] !!}
        </div>

        {{-- Tags --}}
        <div class="flex flex-wrap gap-2 pb-6 border-b border-gray-100">
            @foreach ($article['tags'] as $tag)
            <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-gray-200 cursor-pointer transition">{{ $tag }}</span>
            @endforeach
        </div>

        {{-- Recommended Articles --}}
        <div class="mt-10">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-6 h-0.5 bg-orange-500 rounded-full"></span>
                <h2 class="text-xl font-bold text-blue-900">Artikel Rekomendasi</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($recommended as $rec)
                <div class="rounded-2xl overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
                    <img src="{{ $rec['img'] }}" alt="{{ $rec['title'] }}" class="w-full h-56 object-cover">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-teal-600 tracking-widest uppercase">{{ $rec['category'] }}</span>
                            <span class="text-xs text-gray-400">{{ $rec['read_time'] }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 leading-snug mb-2">{{ $rec['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed mb-3">{{ $rec['summary'] }}</p>
                        <a href="{{ route('guest.artikel.detail', $rec['id']) }}" class="text-blue-600 text-sm font-bold tracking-wide flex items-center gap-1 hover:text-blue-800 uppercase">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection