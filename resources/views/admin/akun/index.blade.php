<x-layouts::app :title="__('Manajemen User')">
    <x-slot:header>
        {{ __('Manajemen User') }}
    </x-slot:header>

    <div class="p-4 md:p-6 lg:p-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen User</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola akses dan akun pengguna untuk panel sistem rumah sakit.</p>
            </div>
            <div>
                <a href="{{ route('admin.akun.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah User
                    </flux:button>
                </a>
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
                                <!-- Profile photo bisa diaktifkan nanti jika ada kolom profile_photo -->
                                <div class="size-10 rounded-full bg-zinc-200 dark:bg-zinc-700 bg-cover bg-center shadow-sm"
                                    style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff')">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $user->name }}</span><br>
                                <span class="text-xs text-zinc-500">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @foreach($user->roles as $role)
                                <flux:badge color="blue" size="sm">{{ $role->name }}</flux:badge>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('admin.akun.edit', $user->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="pencil" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </a>
                                    <button type="button"
                                        class="reset-password-btn"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        title="Reset Password">
                                        <flux:button size="sm" variant="ghost" class="cursor-pointer group">
                                            <flux:icon name="key" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </button>
                                    <form action="{{ route('admin.akun.destroy', $user->id) }}" method="POST" class="inline-block delete-user-form">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="cursor-pointer text-red-600 group" title="Hapus">
                                            <flux:icon name="trash" class="size-4 group-hover:scale-110 transition-transform" />
                                        </flux:button>
                                    </form>
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

    <!-- Modal Reset Password -->
    <div id="resetPasswordModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Reset Password</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Masukkan password baru untuk user <strong id="resetUserName"></strong></p>
                                <input type="password" id="newPassword" class="mt-2 w-full border rounded px-3 py-2" placeholder="Password baru">
                                <input type="password" id="confirmPassword" class="mt-2 w-full border rounded px-3 py-2" placeholder="Konfirmasi password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmReset" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Reset</button>
                    <button type="button" id="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Konfirmasi hapus user
        document.querySelectorAll('.delete-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                    e.preventDefault();
                }
            });
        });

        // Reset password modal
        const modal = document.getElementById('resetPasswordModal');
        const resetNameSpan = document.getElementById('resetUserName');
        let currentUserId = null;

        document.querySelectorAll('.reset-password-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                currentUserId = this.dataset.id;
                resetNameSpan.textContent = this.dataset.name;
                modal.classList.remove('hidden');
            });
        });

        document.getElementById('closeModal')?.addEventListener('click', () => modal.classList.add('hidden'));
        document.getElementById('confirmReset')?.addEventListener('click', async () => {
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;
            if (newPass !== confirmPass) {
                alert('Password dan konfirmasi tidak cocok');
                return;
            }
            if (newPass.length < 8) {
                alert('Password minimal 8 karakter');
                return;
            }
            try {
                const response = await fetch(`/admin/akun/${currentUserId}/reset-password`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        password: newPass,
                        password_confirmation: confirmPass
                    })
                });
                const result = await response.json();
                if (result.status) {
                    alert('Password berhasil direset');
                    modal.classList.add('hidden');
                    document.getElementById('newPassword').value = '';
                    document.getElementById('confirmPassword').value = '';
                } else {
                    alert(result.message || 'Gagal mereset password');
                }
            } catch (error) {
                alert('Terjadi kesalahan');
            }
        });
    </script>
</x-layouts::app>