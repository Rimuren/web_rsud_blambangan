<x-layouts::app :title="__('Reset Password User')">
    <x-slot:header>{{ __('Reset Password User') }}</x-slot:header>
    <div class="flex items-center justify-center min-h-screen bg-zinc-100 dark:bg-zinc-900 px-4">
        <div class="w-full max-w-lg bg-white dark:bg-zinc-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b">
                <h2 class="text-xl font-bold">Reset Password</h2>
                <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost" size="sm" icon="x-mark" />
            </div>
            <form method="POST" action="{{ route('admin.akun.reset-password', $user->id) }}" class="px-6 py-6 space-y-5">
                @csrf @method('PATCH')
                <div class="space-y-1.5">
                    <flux:label>Nama Lengkap</flux:label>
                    <flux:input type="text" value="{{ $user->name }}" readonly class="bg-zinc-50" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:label>Password Baru</flux:label>
                        <flux:input name="password" type="password" required viewable />
                    </div>
                    <div>
                        <flux:label>Konfirmasi</flux:label>
                        <flux:input name="password_confirmation" type="password" required viewable />
                    </div>
                </div>
                <div class="flex justify-end gap-3">
                    <flux:button as="a" href="{{ route('admin.akun.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>