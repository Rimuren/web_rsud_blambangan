<x-layouts::app :title="__('Edit User')">
    <x-slot:header>{{ __('Edit User') }}</x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black">Edit User</h2>
                <p class="text-zinc-500 mt-2">Ubah data akun pengguna sistem rumah sakit.</p>
            </div>
            <div>
                <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="outline" class="cursor-pointer">
                    <flux:icon name="arrow-left" class="size-4 mr-2" /> Kembali
                </flux:button>
            </div>
        </div>

        <flux:card class="overflow-hidden">
            <div class="flex items-center gap-4 px-6 py-5 border-b">
                <div class="size-12 rounded-full bg-cover bg-center bg-zinc-200 shadow-sm" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff')"></div>
                <div>
                    <p class="text-base font-semibold">{{ $user->name }}</p>
                    <p class="text-xs text-zinc-500">{{ $user->email }}</p>
                </div>
                <flux:badge color="blue" size="sm">{{ $userRole->name ?? 'No Role' }}</flux:badge>
            </div>

            <form method="POST" action="{{ route('admin.akun.update', $user->id) }}" class="divide-y">
                @csrf
                @method('PUT')
                <div class="px-6 py-6 space-y-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Informasi Akun</p>
                    <div class="space-y-1.5">
                        <flux:label>Nama Lengkap</flux:label>
                        <flux:input name="name" value="{{ old('name', $user->name) }}" required autofocus />
                        @error('name') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <flux:label>Email</flux:label>
                            <flux:input name="email" type="email" value="{{ old('email', $user->email) }}" required />
                            @error('email') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                        <div class="space-y-1.5">
                            <flux:label>Role</flux:label>
                            <flux:select name="role" :value="old('role', $userRole->id ?? '')">
                                <flux:select.option value="">-- Tidak ada role --</flux:select.option>
                                @foreach($roles as $role)
                                <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            @error('role') <flux:error>{{ $message }}</flux:error> @enderror
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-zinc-50/50 flex items-center justify-end gap-3">
                    <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::app>