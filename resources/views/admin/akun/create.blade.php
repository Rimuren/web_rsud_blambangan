<x-layouts::app :title="__('Tambah User')">
    <x-slot:header>{{ __('Tambah User') }}</x-slot:header>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            {{-- Header halaman --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Tambah User</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Isi formulir berikut untuk menambahkan user baru.</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                <form method="POST" action="{{ route('admin.akun.store') }}" class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @csrf

                    <div class="px-6 py-6 space-y-5">
                        {{-- Nama Lengkap --}}
                        <div class="space-y-1.5">
                            <flux:label for="name">Nama Lengkap</flux:label>
                            <flux:input id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required />
                            @error('name')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-1.5">
                            <flux:label for="email">Email</flux:label>
                            <flux:input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="contoh@email.com" required />
                            @error('email')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <flux:label for="password">Password</flux:label>
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

                        {{-- Role --}}
                        <div class="space-y-1.5">
                            <flux:label for="role">Role</flux:label>
                            <flux:select id="role" name="role">
                                <flux:select.option value="">-- Pilih Role --</flux:select.option>
                                @foreach($roles as $role)
                                    <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            @error('role')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                        <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                        <flux:button type="submit" variant="primary" icon="check">Simpan User</flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>