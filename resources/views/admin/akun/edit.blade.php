<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Edit User</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Ubah data akun pengguna sistem rumah sakit.</p>
            </div>
            <div>
                <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="outline" class="cursor-pointer">
                    <flux:icon name="arrow-left" class="size-4 mr-2" />
                    Kembali
                </flux:button>
            </div>
        </div>

        <flux:card class="overflow-hidden">

            {{-- Card Header: User Info --}}
            <div class="flex items-center gap-4 px-6 py-5 border-b border-zinc-200 dark:border-zinc-700">
                <div class="size-12 rounded-full bg-cover bg-center bg-zinc-200 dark:bg-zinc-700 shadow-sm flex-shrink-0"
                     style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCo2rMGO1HVulBtMtSqK_lVuTdXDo66qSaptb0zhONmAxDlfKNvr-XJYhg4BFtlfGmx7PUE-6O3MrNiBD0mZtnRRIvHGwtDBJ6u4MiKl7Bc6bNTTQsjycV0d8eUzBkm5ftJQaY2YhkeqsQ8bD7yLvwmSJ9bo7R7YLbPZmdXHmKUVSMRARnQZKNwnGN4B97ukS4zQMz0B03FRCEN66bvTrm2a4-b9fAOgAlAm2J5D2Xy07c2HB05tgUDPDKItqngpTkHh8Jgc-VMAhQE')">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-base font-semibold text-zinc-900 dark:text-white">Dr. Sarah Johnson</p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">ID: USR-0041 &nbsp;·&nbsp; Bergabung 12 Jan 2023</p>
                </div>
                <flux:badge color="blue" size="sm">Senior Editor</flux:badge>
            </div>

            {{-- Form --}}
            <form method="POST" action="#" class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @csrf
                @method('PUT')

                {{-- Section: Informasi Akun --}}
                <div class="px-6 py-6 space-y-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                        Informasi Akun
                    </p>

                    {{-- Nama Lengkap --}}
                    <div class="space-y-1.5">
                        <flux:label for="name" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            {{ __('Nama Lengkap') }}
                        </flux:label>
                        <div class="relative">
                            <flux:input
                                id="name"
                                name="name"
                                type="text"
                                value="Dr. Sarah Johnson"
                                required
                                autofocus
                                class="w-full pr-10"
                            />
                            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                                <flux:icon.user class="size-4" />
                            </span>
                        </div>
                        @error('name') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>

                    {{-- Email & Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <flux:label for="email" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                                {{ __('Email') }}
                            </flux:label>
                            <div class="relative">
                                <flux:input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="sarah@hospital.com"
                                    required
                                    class="w-full pr-10"
                                />
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                                    <flux:icon.envelope class="size-4" />
                                </span>
                            </div>
                            @error('email') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="phone" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                                {{ __('Phone Number') }}
                            </flux:label>
                            <div class="relative">
                                <flux:input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    value="081298765432"
                                    class="w-full pr-10"
                                />
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                                    <flux:icon.phone class="size-4" />
                                </span>
                            </div>
                            @error('phone') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="space-y-1.5">
                        <flux:label for="role" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            {{ __('Role') }}
                        </flux:label>
                        <flux:select
                            id="role"
                            name="role"
                            value="dokter"
                            required
                            class="w-full"
                        >
                            <flux:select.option value="admin">{{ __('Admin') }}</flux:select.option>
                            <flux:select.option value="dokter">{{ __('Dokter') }}</flux:select.option>
                            <flux:select.option value="perawat">{{ __('Perawat') }}</flux:select.option>
                            <flux:select.option value="kasir">{{ __('Kasir') }}</flux:select.option>
                            <flux:select.option value="apoteker">{{ __('Apoteker') }}</flux:select.option>
                        </flux:select>
                        @error('role') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                </div>

                {{-- Section: Ubah Password --}}
                <div class="px-6 py-6 space-y-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                        Ubah Password
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <flux:label for="password" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                                {{ __('Password Baru') }}
                            </flux:label>
                            <flux:input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                viewable
                                class="w-full"
                            />
                            <p class="text-xs text-zinc-400 dark:text-zinc-500">
                                Kosongkan jika tidak ingin mengubah
                            </p>
                            @error('password') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <flux:label for="password_confirmation" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                                {{ __('Konfirmasi Password') }}
                            </flux:label>
                            <flux:input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="••••••••"
                                viewable
                                class="w-full"
                            />
                            @error('password_confirmation') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="px-6 py-4 bg-zinc-50/50 dark:bg-zinc-800/30 flex items-center justify-end gap-3">
                    <flux:button
                        as="a"
                        href="#"
                        variant="ghost"
                        class="text-zinc-600 dark:text-zinc-300 font-medium cursor-pointer"
                    >
                        {{ __('Batal') }}
                    </flux:button>
                    <flux:button
                        type="submit"
                        variant="primary"
                        class="bg-[#1B2F5B] hover:bg-[#16274e] dark:bg-blue-600 dark:hover:bg-blue-500 text-white font-semibold cursor-pointer"
                    >
                        <flux:icon name="check" class="size-4 mr-1.5" />
                        {{ __('Simpan Perubahan') }}
                    </flux:button>
                </div>

            </form>
        </flux:card>

    </div>
</x-layouts::app>