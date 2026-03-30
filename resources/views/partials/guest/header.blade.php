<!-- resources/views/partials/navbar.blade.php -->
<nav class="bg-white shadow-md sticky top-0 z-50 font-poppins">
    <div class="container mx-auto px-4 md:px-6 py-3">
        <!-- Header Navbar untuk Mobile & Desktop -->
        <div class="flex flex-wrap items-center justify-between">
            <!-- Logo / Brand -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('build/assets/nav.png') }}" alt="Logo RSUD Blambangan" class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover">
                <span class="font-bold text-gray-800 text-base md:text-lg">RSUD Blambangan</span>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Desktop Menu (hidden on mobile) -->
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
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden mt-4 border-t border-gray-100 overflow-y-auto max-h-[calc(100vh-80px)]">
            <div class="py-2 space-y-1">
                <!-- Menu Utama -->
                <a href="#" class="flex items-center py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <a href="#" class="flex items-center py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Dokter & Jadwal
                </a>
                <a href="#" class="flex items-center py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Info Kamar
                </a>
                <a href="#" class="flex items-center py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Artikel
                </a>

                <!-- Layanan Section -->
                <div class="mt-2">
                    <button id="mobile-layanan-btn" class="flex items-center justify-between w-full py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Layanan
                        </div>
                        <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="mobile-layanan-menu" class="hidden ml-7 mt-1 space-y-1">
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Layanan Rawat Inap</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Layanan Unggulan</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Layanan Rawat Jalan</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Layanan IGD</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Layanan MCU</a>
                    </div>
                </div>

                <!-- Informasi Section -->
                <div class="mt-2">
                    <button id="mobile-informasi-btn" class="flex items-center justify-between w-full py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi
                        </div>
                        <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="mobile-informasi-menu" class="hidden ml-7 mt-1 space-y-1">
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Alur dan Persyaratan</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Tarif</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Petunjuk Umum</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Indeks Kepuasan Masyarakat</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">SAKIP</a>
                    </div>
                </div>

                <!-- Galeri Section -->
                <div class="mt-2">
                    <button id="mobile-galeri-btn" class="flex items-center justify-between w-full py-3 px-2 text-gray-700 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Galeri
                        </div>
                        <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="mobile-galeri-menu" class="hidden ml-7 mt-1 space-y-1">
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Foto</a>
                        <a href="#" class="block py-2 px-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition pl-8">Video</a>
                    </div>
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
    
    /* Smooth scroll untuk mobile */
    @media (max-width: 768px) {
        #mobile-menu {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f1f5f9;
        }
        
        #mobile-menu::-webkit-scrollbar {
            width: 4px;
        }
        
        #mobile-menu::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        #mobile-menu::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 20px;
        }
    }
</style>

<script>
    // Mobile menu toggle dengan vanilla JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                // Tambahkan animasi smooth
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    }, 10);
                } else {
                    mobileMenu.style.maxHeight = '0';
                }
            });
        }
        
        // Toggle untuk submenu Layanan
        const layananBtn = document.getElementById('mobile-layanan-btn');
        const layananMenu = document.getElementById('mobile-layanan-menu');
        if (layananBtn && layananMenu) {
            layananBtn.addEventListener('click', function() {
                layananMenu.classList.toggle('hidden');
                const icon = this.querySelector('svg:last-child');
                icon.classList.toggle('rotate-180');
            });
        }
        
        // Toggle untuk submenu Informasi
        const informasiBtn = document.getElementById('mobile-informasi-btn');
        const informasiMenu = document.getElementById('mobile-informasi-menu');
        if (informasiBtn && informasiMenu) {
            informasiBtn.addEventListener('click', function() {
                informasiMenu.classList.toggle('hidden');
                const icon = this.querySelector('svg:last-child');
                icon.classList.toggle('rotate-180');
            });
        }
        
        // Toggle untuk submenu Galeri
        const galeriBtn = document.getElementById('mobile-galeri-btn');
        const galeriMenu = document.getElementById('mobile-galeri-menu');
        if (galeriBtn && galeriMenu) {
            galeriBtn.addEventListener('click', function() {
                galeriMenu.classList.toggle('hidden');
                const icon = this.querySelector('svg:last-child');
                icon.classList.toggle('rotate-180');
            });
        }
        
        // Tutup menu saat klik di luar (opsional)
        document.addEventListener('click', function(event) {
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                const isClickInsideMenu = mobileMenu.contains(event.target);
                const isClickOnButton = mobileMenuButton.contains(event.target);
                
                if (!isClickInsideMenu && !isClickOnButton) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.maxHeight = '0';
                }
            }
        });
    });
</script>