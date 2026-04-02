<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen User</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola akses dan akun pengguna untuk panel sistem rumah sakit.</p>
            </div>
            <div>
                <flux:button variant="primary" class="cursor-pointer">
                    <flux:icon name="plus" class="size-5 mr-2" />
                    Tambah User
                </flux:button>
            </div>
        </div>

        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Profile</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="size-10 rounded-full bg-zinc-200 dark:bg-zinc-700 bg-cover bg-center shadow-sm" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCo2rMGO1HVulBtMtSqK_lVuTdXDo66qSaptb0zhONmAxDlfKNvr-XJYhg4BFtlfGmx7PUE-6O3MrNiBD0mZtnRRIvHGwtDBJ6u4MiKl7Bc6bNTTQsjycV0d8eUzBkm5ftJQaY2YhkeqsQ8bD7yLvwmSJ9bo7R7YLbPZmdXHmKUVSMRARnQZKNwnGN4B97ukS4zQMz0B03FRCEN66bvTrm2a4-b9fAOgAlAm2J5D2Xy07c2HB05tgUDPDKItqngpTkHh8Jgc-VMAhQE')"></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-zinc-900 dark:text-white">Dr. Sarah Johnson</span>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="blue" size="sm">Senior Editor</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Edit">
                                        <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Reset Password">
                                        <flux:icon name="key" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                        <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="size-10 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-zinc-500 dark:text-zinc-400 text-lg">person</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-zinc-900 dark:text-white">Ahmad Hidayat</span>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="emerald" size="sm">Administrator</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Edit">
                                        <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Reset Password">
                                        <flux:icon name="key" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                        <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="size-10 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-zinc-500 dark:text-zinc-400 text-lg">person</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-zinc-900 dark:text-white">Maria Ulfa</span>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="amber" size="sm">Writer</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Edit">
                                        <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer group" title="Reset Password">
                                        <flux:icon name="key" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                        <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">Menampilkan 3 dari 3 user</p>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="outline" class="cursor-not-allowed">
                        Sebelumnya
                    </flux:button>
                    <flux:button size="sm" variant="outline">
                        Selanjutnya
                    </flux:button>
                </div>
            </div>
        </flux:card>
    </div>
</x-layouts::app>

