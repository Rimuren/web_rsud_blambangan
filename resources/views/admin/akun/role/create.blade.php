<x-layouts::app.sidebar :title="'Tambah Role'">
    <flux:main>
        @can('create role')
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                {{-- Header halaman --}}
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Tambah Role</h1>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Buat role baru beserta permission yang dimiliki.</p>
                </div>

                {{-- Form Card --}}
                <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <form action="{{ route('admin.akun.role.store') }}" method="POST" class="divide-y divide-zinc-100 dark:divide-zinc-700">
                        @csrf

                        <div class="px-6 py-6 space-y-5">
                            <p class="text-xs font-bold uppercase tracking-widest text-zinc-400">Informasi Role</p>

                            {{-- Nama Role --}}
                            <div class="space-y-1.5">
                                <flux:label for="name">Nama Role</flux:label>
                                <flux:input
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama role"
                                    required />
                                @error('name')
                                <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>

                            {{-- Permissions --}}
                            <div class="space-y-1.5">
                                <flux:label>Permissions</flux:label>
                                <div class="border border-zinc-200 dark:border-zinc-700 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 max-h-96 overflow-y-auto p-4">
                                    @foreach($groupedPermissions as $groupName => $perms)
                                    <div class="mb-4 last:mb-0">
                                        <h4 class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-2">{{ $groupName }}</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach($perms as $perm)
                                            <label class="flex items-center gap-2.5 px-3 py-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-700 cursor-pointer transition-colors">
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $perm->id }}"
                                                    class="rounded border-zinc-300 text-primary focus:ring-primary"
                                                    {{ in_array($perm->id, old('permissions', [])) ? 'checked' : '' }}>
                                                <span class="text-sm text-zinc-700 dark:text-zinc-300">{{ $perm->name }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="px-6 py-4 flex items-center justify-end gap-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-b-2xl">
                            <flux:button as="a" href="{{ route('admin.akun.role.index') }}" variant="ghost">Batal</flux:button>
                            <flux:button type="submit" variant="primary" icon="check">Simpan Role</flux:button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        @endcan
    </flux:main>
</x-layouts::app.sidebar>