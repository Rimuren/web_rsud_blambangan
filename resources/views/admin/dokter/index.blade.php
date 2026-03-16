<x-layouts::app :title="'Manajemen Dokter'">
    <x-slot:header>
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Dokter</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola dokter, spesialisasi dan jadwal praktik rumah sakit.</p>
            </div>
            <div>
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <!-- Filter and Search -->
        <flux:card class="p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <flux:icon name="funnel" class="size-5 text-zinc-400" />
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Filter Spesialis:</span>
                </div>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="primary" class="cursor-pointer">Semua</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Penyakit Dalam</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Anak</flux:button>
                    <flux:button size="sm" variant="outline" class="cursor-pointer">Orthopedi</flux:button>
                </div>
                <div class="ml-auto relative">
                    <input class="pl-10 pr-4 py-2 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-sm focus:ring-primary focus:border-primary w-64" placeholder="Cari dokter..." type="text"/>
                    <flux:icon name="magnifying-glass" class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-zinc-400" />
                </div>
            </div>
        </flux:card>

        <!-- Doctors Table -->
        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider w-16">Foto</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Dokter</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Spesialis</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                    <img alt="Dr. Andi" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjLbc_bAW8TuavUkG5aW4c8sS_spcLJ2jHaGhUaeTPySDOQSINcBxWhfEooo1czhl42KWS-bWyt8pRVnJh5hSnwm2bUhQoAD2kz9m9oa_DTiU19okh5Nst73Bgz-nSV2ZyWTCKz4P2qucZ8lxCGQKid6bmSfTgSy1g0mobt1hQax7qmAxptFNBEq-PH7P1w2XExjUjrfvZx0X1wG6oXIvqsI7Rg3XGKGk8NJwCIlzw9H7iQEzD87fAaOmxIzHeAdVYHLdRRrHbKcC6"/>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white line-clamp-1">Dr. Andi Wijaya, Sp.PD</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">DOC-001</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="blue" size="sm">Penyakit Dalam</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Senin-Kamis<br><span class="text-xs">08:00-14:00</span></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 hover:text-red-500">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="calendar" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                    <img alt="Dr. Maria" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8gRCCTvDcyVWllyn9UB7-4fAWh4NxlE6MV2_FNH4r5hO7zGUoSB8vj1-9LxQ6jdQdJCbKZ4TSiV0lhEt0Xw4L9hSIKoH2ON4X0wYMqNYndBTWmeN__vx_4-jvBKbxtO7GfYNbIodsXxu7tfTUV2RvOT7nPScszC8nrQjUSewjAyemaFFaIQUXsUV7wljU5Bpn8tfbiTYZHXpKfeF3wPeXCdiPCKB2IO4C8K_mPksGbCj67Yrueg0qOMz7sclffu6WIqLZ0WZ2vtj6"/>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white line-clamp-1">Dr. Maria Ulfa, Sp.A</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">DOC-002</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="emerald" size="sm">Anak</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Sel-Rab-Jum<br><span class="text-xs">13:00-17:00</span></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 hover:text-red-500">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="calendar" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-200 dark:bg-zinc-700">
                                    <img alt="Dr. Budi" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeYe93IjEVGGMV_m88iWPVfd69F_Ypq6NMkuw_EZ2Q1OPMZYr4H-mdiz-8QiLft-tCBURKtacLCwV98cvfswwGs8h1_2Js2nIcomPtzqha9FEn9A2mHbCoYhK75cftSgI5Aq2qd6c09qCfJRAgEpbU26chvh38wKzBPJVMH6rIcNKII0Rffe17X8DEHtjaYK6saa43nmq76JNHKkPMJj5yI5U1-ipfCo3NCu96dKaVwHaA4W_uWeklURntBwaDzkmwo9DEEzQG6uqe"/>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white line-clamp-1">Dr. Budi Santoso, Sp.OT</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">DOC-003</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <flux:badge color="orange" size="sm">Orthopedi</flux:badge>
                            </td>
                            <td class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400">Sabtu-Minggu<br><span class="text-xs">09:00-12:00</span></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="eye" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="pencil" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer text-red-600 hover:text-red-500">
                                        <flux:icon name="trash" class="size-4" />
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                        <flux:icon name="calendar" class="size-4" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">Menampilkan 1-3 dari 24 dokter</p>
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

