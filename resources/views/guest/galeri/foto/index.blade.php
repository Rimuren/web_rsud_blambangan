<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto - RSUD Blambangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.guest.header')
    
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Galeri Foto</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('images/hero.png') }}" alt="Foto 1" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Aktivitas Rumah Sakit</h3>
                        <p class="text-gray-600 text-sm">Deskripsi foto...</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('images/nav.png') }}" alt="Foto 2" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Fasilitas Medis</h3>
                        <p class="text-gray-600 text-sm">Deskripsi foto...</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-500">
                        Placeholder Image
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Acara Sosial</h3>
                        <p class="text-gray-600 text-sm">Deskripsi foto...</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials.guest.footer')
</body>
</html>

