<x-layouts::app :title="__('Tambah User')">
    <x-slot:header>{{ __('Tambah User') }}</x-slot:header>

    <div class="flex items-center justify-center min-h-screen bg-zinc-100 dark:bg-zinc-900 px-4">
        <div class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b">
                <h2 class="text-xl font-bold">Tambah User</h2>
                <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost" size="sm" icon="x-mark" />
            </div>
            <form method="POST" action="{{ route('admin.akun.store') }}" class="px-6 py-6 space-y-5">
                @csrf
                <div class="space-y-1.5">
                    <flux:label>Nama Lengkap</flux:label>
                    <flux:input name="name" value="{{ old('name') }}" required />
                    @error('name') <flux:error>{{ $message }}</flux:error> @enderror
                </div>
                <div class="space-y-1.5">
                    <flux:label>Email</flux:label>
                    <flux:input name="email" type="email" value="{{ old('email') }}" required />
                    @error('email') <flux:error>{{ $message }}</flux:error> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <flux:label>Password</flux:label>
                        <flux:input name="password" type="password" required viewable />
                        @error('password') <flux:error>{{ $message }}</flux:error> @enderror
                    </div>
                    <div class="space-y-1.5">
                        <flux:label>Confirm Password</flux:label>
                        <flux:input name="password_confirmation" type="password" required viewable />
                    </div>
                </div>
                <div class="space-y-1.5">
                    <flux:label>Role</flux:label>
                    <flux:select name="role">
                        <flux:select.option value="">-- Pilih Role --</flux:select.option>
                        @foreach($roles as $role)
                        <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('role') <flux:error>{{ $message }}</flux:error> @enderror
                </div>
                <div class="flex items-center justify-end gap-3 pt-2">
                    <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
