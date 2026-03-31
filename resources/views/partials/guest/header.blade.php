<!-- resources/views/partials/navbar.blade.php -->
<nav class="bg-white shadow-md sticky top-0 z-50 font-poppins">
    <div class="container mx-auto px-4 md:px-6 py-3 flex flex-wrap items-center justify-between">
   
    <!-- Logo / Brand -->
    <div class="flex items-center space-x-2">
        <img src="{{ asset('build/assets/nav.png') }}" alt="Logo RSUD Blambangan" class="w-8 h-8 rounded-full object-cover">
        <span class="font-bold text-gray-800 text-lg">RSUD Blambangan</span>
    </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-5 text-gray-700 font-medium">
            <!-- Profil -->
            <a href="#" class="hover:text-blue-700 transition">Profil</a>
            <!-- Dokter & Jadwal -->
            <a href="#" class="hover:text-blue-700 transition">Dokter & Jadwal</a>
            <!-- Info Kamar -->
            <a href="#" class="hover:text-blue-700 transition">Info Kamar</a>
            <!-- Artikel -->
            <a href="#" class="hover:text-blue-700 transition">Artikel</a>

            <!-- Layanan Dropdown -->
            <div class="relative group">
                <button class="hover:text-blue-700 transition flex items-center gap-1">
                    Layanan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute left-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
                    <div class="bg-white rounded-[15px] shadow-xl border border-gray-100 overflow-hidden">
                        <ul class="py-2 text-sm">
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Layanan Rawat Inap</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Layanan Unggulan</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Layanan Rawat Jalan</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Layanan IGD</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Layanan MCU</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Informasi Dropdown -->
            <div class="relative group">
                <button class="hover:text-blue-700 transition flex items-center gap-1">
                    Informasi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute left-0 pt-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
                    <div class="bg-white rounded-[15px] shadow-xl border border-gray-100 overflow-hidden">
                        <ul class="py-2 text-sm">
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Alur dan Persyaratan</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Tarif</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Petunjuk Umum</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Indeks Kepuasan Masyarakat</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">SAKIP</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Galeri Dropdown -->
            <div class="relative group">
                <button class="hover:text-blue-700 transition flex items-center gap-1">
                    Galeri
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute left-0 pt-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-20">
                    <div class="bg-white rounded-[15px] shadow-xl border border-gray-100 overflow-hidden">
                        <ul class="py-2 text-sm">
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Foto</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-blue-50 hover:text-blue-700 transition">Video</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <!-- Mobile Menu (hidden by default) -->
    <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobile-menu">
        <div class="px-4 py-2 space-y-1">
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-700">Profil</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-700">Dokter & Jadwal</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-700">Info Kamar</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-700">Artikel</a>

            <!-- Layanan mobile -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex justify-between w-full py-2 text-gray-700 hover:text-blue-700">
                    Layanan
                    <svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Layanan Rawat Inap</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Layanan Unggulan</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Layanan Rawat Jalan</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Layanan IGD</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Layanan MCU</a>
                </div>
            </div>

            <!-- Informasi mobile -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex justify-between w-full py-2 text-gray-700 hover:text-blue-700">
                    Informasi
                    <svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Alur dan Persyaratan</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Tarif</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Petunjuk Umum</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Indeks Kepuasan Masyarakat</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">SAKIP</a>
                </div>
            </div>

            <!-- Galeri mobile -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex justify-between w-full py-2 text-gray-700 hover:text-blue-700">
                    Galeri
                    <svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="pl-4 space-y-1">
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Foto</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-blue-700">Video</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Tambahkan font Poppins jika belum ada -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
    /* Ensure all text in navbar uses Poppins */
    nav, nav * {
        font-family: 'Poppins', sans-serif;
    }
</style>

<!-- Alpine.js untuk mobile toggle (opsional, bisa diganti dengan vanilla JS) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Vanilla JS for mobile menu toggle if not using Alpine
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>