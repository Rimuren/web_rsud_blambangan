<x-layouts::app :title="__('Manajemen Poliklinik')">
    <x-slot:header>
        {{ __('Manajemen Poliklinik') }}
    </x-slot:header>

    @can('poliklinik.view')
    <div class="p-4 md:p-6 lg:p-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Poliklinik</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola data poliklinik rumah sakit.</p>
            </div>
            <div>
                @can('poliklinik.create')
                <a href="{{ route('admin.dokter.poliklinik.create') }}">
                    <flux:button variant="primary" class="cursor-pointer">
                        <flux:icon name="plus" class="size-5 mr-2" />
                        Tambah Poliklinik
                    </flux:button>
                </a>
                @else
                <flux:button variant="outline" disabled>Tambah Poliklinik (Tidak Ada Izin)</flux:button>
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
                <table class="w-full">
                    <thead>
                        <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-left">Nama Poliklinik</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Kode BPJS</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Jumlah Dokter</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($polikliniks as $poli)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-white text-left">{{ $poli->nama }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $poli->kode_bpjs ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-center">{{ $poli->jumlah_dokter ?? 0 }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    @can('poliklinik.update')
                                    <a href="{{ route('admin.dokter.poliklinik.edit', $poli->id) }}" title="Edit">
                                        <flux:button size="sm" variant="ghost">
                                            <flux:icon name="pencil" class="size-4" />
                                        </flux:button>
                                    </a>
                                    @endcan

                                    @can('poliklinik.delete')
                                    <form action="{{ route('admin.dokter.poliklinik.destroy', $poli->id) }}" method="POST" onsubmit="return confirm('Hapus poliklinik ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" variant="ghost" class="text-red-600">
                                            <flux:icon name="trash" class="size-4" />
                                        </flux:button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-zinc-500">Belum ada data poliklinik.}}


                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($polikliniks->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/30">
                <p class="text-xs text-zinc-500">
                    Menampilkan {{ $polikliniks->firstItem() }} - {{ $polikliniks->lastItem() }} dari {{ $polikliniks->total() }} poliklinik
                </p>
                <div class="flex gap-2">
                    {{ $polikliniks->links() }}
                </div>
            </div>
            @endif
        </flux:card>
    </div>
    @else
    <div class="p-4 text-center text-red-500">Anda tidak memiliki izin untuk melihat halaman ini.</div>
    @endcan
</x-layouts::app>