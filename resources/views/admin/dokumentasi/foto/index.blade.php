<x-layouts::app :title="'Manajemen Dokumentasi'">
    <x-slot:header>
        Manajemen Dokumentasi
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Galeri Foto Dokumentasi</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola semua foto dokumentasi rumah sakit dengan rapi dan mudah.</p>
            </div>
            <div>
                <a href="#">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Foto Baru
                    </flux:button>
                </a>
            </div>
        </div>

        <!-- Filter and Search -->
        <flux:card class="p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
<flux:icon name="photo" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Kategori Foto:</span>
                </div>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="primary" class="cursor-pointer">Semua</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Kegiatan</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Fasilitas</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Tim Medis</flux:button>
                </div>
                <div class="ml-auto relative">
                    <input class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64" placeholder="Cari foto..." type="text"/>
                    <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>
            </div>
        </flux:card>

        <!-- Photos Table/Grid Hybrid -->
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 p-6 md:p-8">
                    
                    <!-- Photo 1 -->
                    <div class="group bg-zinc-50 dark:bg-zinc-800/50 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 hover:border-blue-500 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square bg-gradient-to-br from-zinc-200 to-zinc-300 relative overflow-hidden">
                            <img src="https://picsum.photos/300/300?random=1" alt="Foto 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                <div class="flex gap-2">
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="eye" class="size-4" />
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="pencil" class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-2 mb-1">Kegiatan bakti sosial di desa</p>
                            <p class="text-xs text-zinc-500">15 Okt 2024</p>
                        </div>
                    </div>

                    <!-- Photo 2 -->
                    <div class="group bg-zinc-50 dark:bg-zinc-800/50 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 hover:border-emerald-500 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square bg-gradient-to-br from-emerald-200 to-emerald-300 relative overflow-hidden">
                            <img src="https://picsum.photos/300/300?random=2" alt="Foto 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                <div class="flex gap-2">
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="eye" class="size-4" />
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="pencil" class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-2 mb-1">Tim medis briefing</p>
                            <p class="text-xs text-zinc-500">12 Okt 2024</p>
                        </div>
                    </div>

                    <!-- Photo 3 - Placeholder -->
                    <div class="group bg-zinc-50 dark:bg-zinc-800/50 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 hover:border-amber-500 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square bg-gradient-to-br from-zinc-200 to-zinc-300 relative overflow-hidden flex items-center justify-center">
                            <flux:icon name="image" class="size-12 text-zinc-400" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                <div class="flex gap-2">
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="eye" class="size-4" />
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="pencil" class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-2 mb-1">Peralatan medis baru</p>
                            <p class="text-xs text-zinc-500">10 Okt 2024</p>
                        </div>
                    </div>

                    <!-- Photo 4 -->
                    <div class="group bg-zinc-50 dark:bg-zinc-800/50 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 hover:border-indigo-500 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square bg-gradient-to-br from-indigo-200 to-indigo-300 relative overflow-hidden">
                            <img src="https://picsum.photos/300/300?random=4" alt="Foto 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                <div class="flex gap-2">
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="eye" class="size-4" />
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="pencil" class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-2 mb-1">Fasilitas rawat inap VIP</p>
                            <p class="text-xs text-zinc-500">8 Okt 2024</p>
                        </div>
                    </div>

                    <!-- More photos... -->
                    @for ($i = 5; $i <= 12; $i++)
                    <div class="group bg-zinc-50 dark:bg-zinc-800/50 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 hover:border-blue-500 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="aspect-square bg-gradient-to-br from-zinc-200 to-zinc-300 relative overflow-hidden">
                            <img src="https://picsum.photos/300/300?random={{ $i }}" alt="Foto {{ $i }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                <div class="flex gap-2">
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="eye" class="size-4" />
                                    </button>
                                    <button class="bg-white p-2 rounded-full shadow-lg hover:scale-110">
                                        <flux:icon name="pencil" class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-2 mb-1">Foto kegiatan #{{ $i }}</p>
                            <p class="text-xs text-zinc-500">{{ now()->subDays(rand(1, 30))->format('d M Y') }}</p>
                        </div>
                    </div>
                    @endfor

                </div>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">Menampilkan 1-12 dari 24 foto</p>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="outline" class="cursor-pointer">
                        <flux:icon name="chevron-left" class="size-4" />
                    </flux:button>
                    <flux:button size="sm" variant="primary" class="cursor-pointer">1</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">2</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">
                        <flux:icon name="chevron-right" class="size-4" />
                    </flux:button>
                </div>
            </div>
        </flux:card>
    </div>
</x-layouts::app>
