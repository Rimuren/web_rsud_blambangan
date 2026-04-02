<x-layouts::app.sidebar :title="'Tambah Role'">
    <flux:main>
        <div class="p-6">
            <flux:card class="space-y-6">
                <div class="flex justify-between items-center">
                    <flux:heading size="lg">Tambah Role</flux:heading>
                    <flux:button as="a" href="{{ route('admin.akun.role.index') }}" variant="ghost" icon="arrow-left">
                        Kembali
                    </flux:button>
                </div>

                <form action="{{ route('admin.akun.role.store') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <flux:input
                            label="Nama Role"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required />

                        <flux:field>
                            <flux:label>Permissions</flux:label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-800/50 max-h-64 overflow-y-auto">
                                @foreach($permissions as $perm)
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $perm->id }}"
                                        class="rounded border-zinc-300 text-primary focus:ring-primary"
                                        {{ in_array($perm->id, old('permissions', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $perm->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </flux:field>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                        <flux:button as="a" href="{{ route('admin.akun.role.index') }}" variant="ghost">Batal</flux:button>
                    </div>
                </form>
            </flux:card>
        </div>
    </flux:main>
</x-layouts::app.sidebar>