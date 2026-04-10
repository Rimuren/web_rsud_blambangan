<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - RSUD Blambangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.guest.header')
    
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Artikel Kesehatan</h1>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Daftar artikel kesehatan, tips hidup sehat, dan berita terkini dari RSUD Blambangan.
                </p>
                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <article class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-3">Judul Artikel 1</h3>
                        <p class="text-gray-600 mb-4">Ringkasan artikel pertama...</p>
                        <a href="#" class="text-blue-600 hover:underline font-medium">Baca Selengkapnya →</a>
                    </article>
                    <article class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-3">Judul Artikel 2</h3>
                        <p class="text-gray-600 mb-4">Ringkasan artikel kedua...</p>
                        <a href="#" class="text-blue-600 hover:underline font-medium">Baca Selengkapnya →</a>
                    </article>
                </div>
                <div class="text-center mt-12">
                    <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">Lihat Semua Artikel</a>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials.guest.footer')
</body>
</html>

