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
                <flux:modal.trigger name="tambah-user">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah User
                    </flux:button>
                </flux:modal.trigger>
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

    {{-- Modal Tambah User --}}
    <flux:modal name="tambah-user" class="w-full max-w-md">
        <div class="p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <flux:heading size="lg" class="font-bold text-zinc-900 dark:text-white">
                    Tambah User
                </flux:heading>
                <flux:modal.close>
                    <flux:button variant="ghost" size="sm" class="cursor-pointer">
                        <flux:icon name="x-mark" class="size-5" />
                    </flux:button>
                </flux:modal.close>
            </div>

            {{-- Form --}}
            <form method="POST" action="#" class="space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                        Nama Lengkap
                    </flux:label>
                    <div class="relative">
                        <flux:input
                            name="name"
                            type="text"
                            placeholder="Masukkan nama lengkap"
                            class="pr-10"
                        />
                        <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-400">
                            <flux:icon name="user" class="size-5" />
                        </span>
                    </div>
                </div>

                {{-- Email & Phone --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                            Email
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                name="email"
                                type="email"
                                placeholder="email@hospital.com"
                                class="pr-10"
                            />
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-400">
                                <flux:icon name="envelope" class="size-5" />
                            </span>
                        </div>
                    </div>
                    <div>
                        <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                            Phone Number
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                name="phone"
                                type="tel"
                                placeholder="08123..."
                                class="pr-10"
                            />
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-400">
                                <flux:icon name="phone" class="size-5" />
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Password & Confirm Password --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                            Password
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                class="pr-10"
                            />
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-400">
                                <flux:icon name="lock-closed" class="size-5" />
                            </span>
                        </div>
                    </div>
                    <div>
                        <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                            Confirm Password
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                name="password_confirmation"
                                type="password"
                                placeholder="••••••••"
                                class="pr-10"
                            />
                            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-400">
                                <flux:icon name="shield-check" class="size-5" />
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Role --}}
                <div>
                    <flux:label class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1.5">
                        Role
                    </flux:label>
                    <flux:select name="role" placeholder="Pilih Role">
                        <flux:select.option value="administrator">Administrator</flux:select.option>
                        <flux:select.option value="senior_editor">Senior Editor</flux:select.option>
                        <flux:select.option value="writer">Writer</flux:select.option>
                    </flux:select>
                </div>

                {{-- Footer Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-2">
                    <flux:modal.close>
                        <flux:button type="button" variant="ghost" class="cursor-pointer font-semibold text-zinc-600 dark:text-zinc-400">
                            Batal
                        </flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="cursor-pointer px-6 font-bold">
                        Simpan
                    </flux:button>
                </div>
            </form>

        </div>
    </flux:modal>

</x-layouts::app>