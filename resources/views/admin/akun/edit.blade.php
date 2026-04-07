<x-layouts::app :title="__('Edit User')">
    <x-slot:header>{{ __('Edit User') }}</x-slot:header>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            {{-- Header halaman --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Edit User</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Ubah data akun pengguna sistem rumah sakit.</p>
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

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.akun.update', $user->id) }}" class="divide-y divide-zinc-100 dark:divide-zinc-700">
                    @csrf
                    @method('PUT')

                    <div class="px-6 py-6 space-y-5">
                        <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Informasi Akun</p>

                        {{-- Nama Lengkap --}}
                        <div class="space-y-1.5">
                            <flux:label for="name">Nama Lengkap</flux:label>
                            <flux:input id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" required autofocus />
                            @error('name')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </div>

                        {{-- Email & Role --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <flux:label for="email">Email</flux:label>
                                <flux:input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="contoh@email.com" required />
                                @error('email')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <flux:label for="role">Role</flux:label>
                                <flux:select id="role" name="role" :value="old('role', $userRole->id ?? '')">
                                    <flux:select.option value="">-- Tidak ada role --</flux:select.option>
                                    @foreach($roles as $role)
                                        <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                                    @endforeach
                                </flux:select>
                                @error('role')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                        <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                        <flux:button type="submit" variant="primary" icon="check">Simpan Perubahan</flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>