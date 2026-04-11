<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Video - RSUD Blambangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.guest.header')
    
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Galeri Video</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-video bg-gray-200 flex items-center justify-center">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Video Promosi RSUD</h3>
                        <p class="text-gray-600 text-sm">Video pengenalan fasilitas rumah sakit.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-video bg-gray-200 flex items-center justify-center text-gray-500">
                        Placeholder Video
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Pelatihan Kesehatan</h3>
                        <p class="text-gray-600 text-sm">Video edukasi kesehatan masyarakat.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">Lihat Lebih Banyak</a>
            </div>
        </div>
    </main>
    
    @include('partials.guest.footer')
</body>
</html>

