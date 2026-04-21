<x-layouts::app :title="__('Manajemen Spesialis')">
    <x-slot:header>
        {{ __('Manajemen Spesialis') }}
    </x-slot:header>

    @can('view daftar-spesialis')
    <div class="p-4 md:p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Spesialis</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola spesialisasi dokter di RSUD Blambangan.</p>
            </div>
            <div>
                <a href="#">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Spesialis
                    </flux:button>
                </a>
            </div>
        </div>

        {{-- Flash Messages --}}
        {{-- 
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">Success message</div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">Error message</div>
        @endif
        --}}

        {{-- Tabel Spesialis --}}
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Spesialis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Kebidanan dan Kandungan (Obgyn)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">obgyn</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Anak (Pediatri)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">pediatri</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Penyakit Dalam (Pen.)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">penyakit-dalam</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Bedah Umum</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">bedah-umum</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Jantung dan Pembuluh Darah (Kardiologi)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">kardiologi</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Paru (Pulmonologi)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">pulmonologi</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Urologi</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">urologi</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-zinc-900 dark:text-white">Mata (Oftalmologi)</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">oftalmologi</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="#" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </flux:card>
    </div>
    @endcan
</x-layouts::app>