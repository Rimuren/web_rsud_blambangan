@extends('layouts.app')

@section('title', 'Jam Operasional')

@section('content')
@can('jam_operasional.view')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Jam Operasional</h1>
                <p class="mt-2 text-zinc-500 dark:text-zinc-400">Atur hari layanan dan jam operasional portal RSUD dari panel admin.</p>
            </div>

            @can('jam_operasional.create')
            <flux:button as="a" href="{{ route('admin.jam-operasional.create') }}" variant="primary" size="lg" class="shadow-lg">
                <flux:icon name="plus" class="h-5 w-5" />
                Tambah Jadwal
            </flux:button>
            @endcan
        </div>

        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800 dark:border-rose-900/60 dark:bg-rose-950/40 dark:text-rose-200">
                {{ session('error') }}
            </div>
        @endif

        <flux:card class="overflow-hidden border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/60">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Hari</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Jam Operasional</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white dark:divide-zinc-800 dark:bg-zinc-900">
                        @forelse ($jam_operasionalList as $item)
                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4">
                                    <div class="inline-flex items-center gap-3">
                                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-700 dark:bg-sky-950/50 dark:text-sky-300">
                                            <flux:icon name="calendar-days" class="h-5 w-5" />
                                        </span>
                                        <div>
                                            <div class="font-semibold text-zinc-900 dark:text-white">{{ $item->hari_label }}</div>
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">Hari layanan</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-2 text-sm font-medium text-amber-800 dark:bg-amber-950/40 dark:text-amber-200">
                                        <flux:icon name="clock" class="h-4 w-4" />
                                        {{ $item->jam_operasional }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @can('jam_operasional.toggle_status')
                                    <form action="{{ route('admin.jam-operasional.toggle-status', $item) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="group inline-flex items-center gap-3 rounded-2xl border px-3 py-2 transition {{ $item->is_closed ? 'border-rose-200 bg-rose-50 hover:bg-rose-100 dark:border-rose-900/60 dark:bg-rose-950/40 dark:hover:bg-rose-950/60' : 'border-emerald-200 bg-emerald-50 hover:bg-emerald-100 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:hover:bg-emerald-950/60' }}"
                                            title="Klik untuk mengubah status">
                                            <span class="relative inline-flex h-6 w-11 items-center rounded-full transition {{ $item->is_closed ? 'bg-rose-500/80' : 'bg-emerald-500' }}">
                                                <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition {{ $item->is_closed ? 'translate-x-1' : 'translate-x-5' }}"></span>
                                            </span>

                                            <span class="inline-flex items-center gap-2 rounded-full px-2 py-1 text-sm font-medium {{ $item->is_closed ? 'text-rose-700 dark:text-rose-200' : 'text-emerald-700 dark:text-emerald-200' }}">
                                                <flux:icon name="{{ $item->is_closed ? 'x-circle' : 'check-circle' }}" class="h-4 w-4" />
                                                {{ $item->is_closed ? 'Tutup' : 'Buka' }}
                                            </span>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('jam_operasional.update')
                                        <flux:button as="a" href="{{ route('admin.jam-operasional.edit', $item) }}" variant="ghost" size="sm" class="rounded-xl p-2">
                                            <flux:icon name="pencil-square" class="h-5 w-5" />
                                        </flux:button>
                                        @endcan

                                        @can('jam_operasional.delete')
                                        <flux:modal.trigger name="delete-jam-operasional-{{ $item->id }}">
                                            <flux:button variant="danger" size="sm" class="rounded-xl p-2">
                                                <flux:icon name="trash" class="h-5 w-5" />
                                            </flux:button>
                                        </flux:modal.trigger>

                                        <flux:modal name="delete-jam-operasional-{{ $item->id }}" class="max-w-md">
                                            <div class="space-y-6">
                                                <div class="flex items-start gap-4">
                                                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-700 dark:bg-rose-950/50 dark:text-rose-300">
                                                        <flux:icon name="trash" class="h-6 w-6" />
                                                    </span>

                                                    <div class="space-y-2">
                                                        <flux:heading size="lg">Hapus jam operasional?</flux:heading>
                                                        <flux:subheading>
                                                            Data untuk <span class="font-semibold text-zinc-900 dark:text-white">{{ $item->hari_label }}</span> akan dihapus permanen dari daftar jam operasional.
                                                        </flux:subheading>
                                                    </div>
                                                </div>

                                                <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-700 dark:bg-zinc-800/70">
                                                    <div class="flex items-center justify-between gap-3">
                                                        <div>
                                                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500 dark:text-zinc-400">Hari</p>
                                                            <p class="mt-1 font-semibold text-zinc-900 dark:text-white">{{ $item->hari_label }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500 dark:text-zinc-400">Jam</p>
                                                            <p class="mt-1 font-semibold text-zinc-900 dark:text-white">{{ $item->jam_operasional }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('admin.jam-operasional.destroy', $item) }}" method="POST" class="flex justify-end gap-3">
                                                    @csrf
                                                    @method('DELETE')

                                                    <flux:modal.close>
                                                        <flux:button variant="ghost">Batal</flux:button>
                                                    </flux:modal.close>

                                                    <flux:button type="submit" variant="danger">
                                                        <flux:icon name="trash" class="h-4 w-4" />
                                                        Hapus
                                                    </flux:button>
                                                </form>
                                            </div>
                                        </flux:modal>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty 
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                            <flux:icon name="clock" class="h-7 w-7" />
                                        </span>
                                        <div>
                                            <p class="font-semibold text-zinc-900 dark:text-white">Belum ada data jam operasional</p>
                                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Tambahkan hari dan jam layanan agar informasi portal lebih lengkap.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($jam_operasionalList->hasPages())
                <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    {{ $jam_operasionalList->links() }}
                </div>
            @endif
        </flux:card>
    </div>
</div>
@endcan
@endsection
