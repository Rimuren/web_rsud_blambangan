<x-layouts::app :title="__('Manajemen Artikel')">
    <x-slot:header>
        {{ __('Manajemen Artikel') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">

        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Artikel</h2>
<p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola semua konten artikel kesehatan dan berita rumah sakit Anda.</p>
            </div>
            <div>
                <a href="{{ route('admin.artikel.create') }}">
    <flux:button variant="primary" class="cursor-pointer">
        <flux:icon name="plus" class="size-5 mr-2" />
        Tambah Artikel Baru
    </flux:button>
</a>
            </div>
        </div>

        <flux:card class="p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Filter Kategori:</span>
                </div>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="primary"class="cursor-pointer">Semua</flux:button>
                    <flux:button size="sm" variant="outline"class="cursor-pointer">Kesehatan</flux:button>
                    <flux:button size="sm" variant="outline"class="cursor-pointer">Tips</flux:button>
                    <flux:button size="sm" variant="outline"class="cursor-pointer">Berita RS</flux:button>
                </div>
                <div class="ml-auto relative">
                    <input class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64" placeholder="Cari artikel..." type="text"/>
                    <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>
            </div>
        </flux:card>

        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Judul Artikel</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Penulis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">Prosedur Penanganan Pasien Darurat Selama Pandemi</p>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="blue" size="sm">Kesehatan</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Dr. Sarah Johnson</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-semibold text-emerald-600">Published</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">24 Okt 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button href="{{ route('admin.artikel.create') }}" size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                       
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">10 Tips Menjaga Pola Makan Sehat di Kantor</p>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="amber" size="sm">Tips</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Rizky Ramadhan</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-zinc-400"></span>
                                    <span class="text-xs font-semibold text-zinc-500">Draft</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">22 Okt 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>

                        
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">Peresmian Gedung Baru Pelayanan Jantung Terpadu</p>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="indigo" size="sm">Berita RS</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Humas RS</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-semibold text-emerald-600">Published</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">20 Okt 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">Mengenal Gejala Awal Diabetes Melitus</p>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="blue" size="sm">Kesehatan</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Dr. Sarah Johnson</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-semibold text-emerald-600">Published</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">18 Okt 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">Panduan Donor Darah untuk Pemula</p>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="amber" size="sm">Tips</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Anita Wijaya</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-zinc-400"></span>
                                    <span class="text-xs font-semibold text-zinc-500">Draft</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-500">15 Okt 2023</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">Menampilkan 1-5 dari 124 artikel</p>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="outline" class="cursor-pointer">
                        <flux:icon name="chevron-left" class="size-4" />
                    </flux:button>
                    <flux:button size="sm" variant="primary" class="cursor-pointer">1</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">2</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">3</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">
                        <flux:icon name="chevron-right" class="size-4" />
                    </flux:button>
                </div>
            </div>
        </flux:card>
    </div>
</x-layouts::app>

