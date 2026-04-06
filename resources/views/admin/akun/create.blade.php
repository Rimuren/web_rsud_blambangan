<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    <div class="flex items-center justify-center min-h-screen bg-zinc-100 dark:bg-zinc-900 px-4">

        <div class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-xl dark:shadow-zinc-900/60 overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white tracking-tight">
                    Tambah User
                </h2>
                <flux:button
                    as="a"
                    href="#"
                    variant="ghost"
                    size="sm"
                    icon="x-mark"
                    class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200"
                />
            </div>

            {{-- Form --}}
            <form method="POST" action="#" class="px-6 py-6 space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="space-y-1.5">
                    <flux:label for="name" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                        Nama Lengkap
                    </flux:label>
                    <div class="relative">
                        <flux:input
                            id="name"
                            name="name"
                            type="text"
                            placeholder="Masukkan nama lengkap"
                            class="w-full pr-10"
                        />
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                            <flux:icon.user class="size-4" />
                        </span>
                    </div>
                </div>

                {{-- Email & Phone --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <flux:label for="email" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            Email
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                id="email"
                                name="email"
                                type="email"
                                placeholder="email@hospital.com"
                                class="w-full pr-10"
                            />
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                                <flux:icon.envelope class="size-4" />
                            </span>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <flux:label for="phone" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            Phone Number
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                id="phone"
                                name="phone"
                                type="tel"
                                placeholder="08123..."
                                class="w-full pr-10"
                            />
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                                <flux:icon.phone class="size-4" />
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Password & Confirm Password --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <flux:label for="password" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            Password
                        </flux:label>
                        <flux:input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="••••••••"
                            viewable
                            class="w-full"
                        />
                    </div>
                    <div class="space-y-1.5">
                        <flux:label for="password_confirmation" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            Confirm Password
                        </flux:label>
                        <flux:input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="••••••••"
                            viewable
                            class="w-full"
                        />
                    </div>
                </div>

                {{-- Role --}}
                <div class="space-y-1.5">
                    <flux:label for="role" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                        Role
                    </flux:label>
                    <flux:select
                        id="role"
                        name="role"
                        placeholder="Pilih Role"
                        class="w-full"
                    >
                        <flux:select.option value="admin">Admin</flux:select.option>
                        <flux:select.option value="dokter">Dokter</flux:select.option>
                        <flux:select.option value="perawat">Perawat</flux:select.option>
                        <flux:select.option value="kasir">Kasir</flux:select.option>
                        <flux:select.option value="apoteker">Apoteker</flux:select.option>
                    </flux:select>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-2">
                    <flux:button
                        as="a"
                        href="#"
                        variant="ghost"
                        class="text-zinc-600 dark:text-zinc-300 font-medium cursor-pointer"
                    >
                        Batal
                    </flux:button>
                    <flux:button
                        type="submit"
                        variant="primary"
                        class="bg-[#1B2F5B] hover:bg-[#16274e] dark:bg-blue-600 dark:hover:bg-blue-500 text-white font-semibold cursor-pointer"
                    >
                        Simpan
                    </flux:button>
                </div>

            </form>
        </div>

    </div>

</x-layouts::app>
