<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - RSUD Blambangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('partials.guest.header')
    
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Profil RSUD Blambangan</h1>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    Halaman profil RSUD Blambangan. Informasi sejarah, visi misi, struktur organisasi, 
                    dan kepemimpinan rumah sakit akan ditampilkan di sini.
                </p>
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Visi & Misi</h2>
                        <p>Tempat untuk konten visi dan misi.</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold mb-4">Struktur Organisasi</h2>
                        <p>Diagram struktur organisasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('partials.guest.footer')
</body>
</html>

