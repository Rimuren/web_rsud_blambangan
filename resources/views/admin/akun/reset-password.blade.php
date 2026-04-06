<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    <div class="flex items-center justify-center min-h-screen bg-zinc-100 dark:bg-zinc-900 px-4">

        <div class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-xl dark:shadow-zinc-900/60 overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white tracking-tight">
                    Edit User Password
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
                @method('PUT')

                {{-- Nama Lengkap (readonly) --}}
                <div class="space-y-1.5">
                    <flux:label for="name" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                        Nama Lengkap
                    </flux:label>
                    <div class="relative">
                        <flux:input
                            id="name"
                            name="name"
                            type="text"
                            value="Dr. Sarah Johnson"
                            readonly
                            class="w-full pr-10 cursor-default text-zinc-500 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-700/50"
                        />
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400 dark:text-zinc-500">
                            <flux:icon.user class="size-4" />
                        </span>
                    </div>
                </div>

                {{-- Edit Password & Confirm Password --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <flux:label for="password" class="text-xs font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">
                            Edit Password
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