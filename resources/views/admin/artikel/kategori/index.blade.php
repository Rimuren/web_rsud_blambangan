<x-layouts::app :title="__('Manajemen Kategori Artikel')">
    <x-slot:header>
        {{ __('Manajemen Kategori Artikel') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Kategori Artikel</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola kategori untuk mengorganisir konten artikel rumah sakit Anda.</p>
            </div>
            <div>
                <flux:button variant="primary" class="cursor-pointer">
                    <flux:icon name="plus" class="size-5 mr-2" />
                    Tambah Kategori
                </flux:button>
                </a>
            </div>
            </div>

       <!-- Categories Table -->
<flux:card class="overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">
                        Nama Kategori
                    </th>

                    <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">

                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">

                    <!-- Nama kategori -->
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-zinc-900 dark:text-white line-clamp-1">
                            Kesehatan
                        </p>
                    </td>

                    <!-- Tombol aksi -->
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center items-center gap-3">

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
</flux:card>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">Menampilkan 1-4 dari 4 kategori</p>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="outline" class="cursor-pointer" disabled>
                        <flux:icon name="chevron-left" class="size-4" />
                    </flux:button>
                    <flux:button size="sm" variant="primary" class="cursor-pointer">1</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer" disabled>
                        <flux:icon name="chevron-right" class="size-4" />
                    </flux:button>
                </div>
        </flux:card>
    </div>
</x-layouts::app>
