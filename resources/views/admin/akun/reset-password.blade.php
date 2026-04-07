<x-layouts::app :title="__('Reset Password User')">
    <x-slot:header>{{ __('Reset Password User') }}</x-slot:header>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            {{-- Header halaman --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Reset Password</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Atur ulang password akun pengguna.</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">

                {{-- Profile Header --}}
                <div class="flex items-center gap-4 px-6 py-5 border-b border-zinc-100 dark:border-zinc-700">
                    <div class="size-12 rounded-full bg-cover bg-center bg-zinc-200 shadow-sm"
                        style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff')">
                    </div>
                    <div>
                        <p class="text-base font-semibold text-zinc-900 dark:text-white">{{ $user->name }}</p>
                        <p class="text-xs text-zinc-500">{{ $user->email }}</p>
                    </div>
                    <flux:badge color="blue" size="sm">{{ $userRole->name ?? 'No Role' }}</flux:badge>
                </div>

                <form method="POST" action="{{ route('admin.akun.reset-password', $user->id) }}" class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @csrf
                    @method('PATCH')

                    <div class="px-6 py-6 space-y-5">
                        <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Ubah Password</p>

                        {{-- Password --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <flux:label for="password">Password Baru</flux:label>
                                <flux:input id="password" name="password" type="password" placeholder="••••••••" required viewable />
                                @error('password')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <flux:label for="password_confirmation">Konfirmasi Password</flux:label>
                                <flux:input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required viewable />
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                        <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                        <flux:button type="submit" variant="primary" icon="check">Simpan Password</flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>