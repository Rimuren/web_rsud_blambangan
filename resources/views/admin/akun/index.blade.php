<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    @can('view daftar-akun')
    <div class="p-4 md:p-6 lg:p-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen User</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola akses dan akun pengguna untuk panel sistem rumah sakit.</p>
            </div>
            <div>
                @can('create akun')
                <a href="{{ route('admin.akun.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah User
                    </flux:button>
                </a>
                @endcan
            </div>
        </div>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif

        <flux:card class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Profile</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($users as $user)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="size-10 rounded-full bg-zinc-200 dark:bg-zinc-700 bg-cover bg-center shadow-sm"
                                    style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff')">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $user->name }}</span><br>
                                <span class="text-xs text-zinc-500">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->roles->count())
                                @foreach($user->roles as $role)
                                <flux:badge color="blue" size="sm">{{ $role->name }}</flux:badge>
                                @endforeach
                                @else
                                <flux:badge color="gray" size="sm">Tidak ada role</flux:badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    @if($user->can_edit_reset)
                                    @can('edit akun')
                                    <a href="{{ route('admin.akun.edit', $user->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                    @endcan

                                    @can('reset password')
                                    <a href="{{ route('admin.akun.reset-password.form', $user->id) }}" title="Reset Password">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="key" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                    @endcan
                                    @endif

                                    @if($user->can_delete)
                                    @can('delete akun')
                                    <form action="{{ route('admin.akun.destroy', $user->id) }}" method="POST" class="inline-block delete-user-form">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                            <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </form>
                                    @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-zinc-500">
                                Belum ada user. Klik "Tambah User" untuk menambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} user
                </p>
                <div class="flex gap-2">
                    {{ $users->links() }}
                </div>
            </div>
        </flux:card>
    </div>

    @can('delete akun')
    <script>
        // Konfirmasi hapus user
        document.querySelectorAll('.delete-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
    @endcan
    @else
        <div class="p-4 text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</div>
    @endcan
</x-layouts::app>