@extends('layouts.app')

@section('title', 'Manajemen Iklan')

@section('content')

@can('iklan.view')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Manajemen Iklan</h1>
                <p class="mt-2 text-zinc-500 dark:text-zinc-400">Kelola popup iklan yang tampil di halaman utama portal RSUD.</p>
            </div>

            @can('iklan.create')
            <flux:button as="a" href="{{ route('admin.iklan.create') }}" variant="primary" size="lg" class="shadow-lg">
                <flux:icon name="plus" class="h-5 w-5" />
                Tambah Iklan
            </flux:button>
            @endcan
        </div>

        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        <flux:card class="overflow-hidden border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/60">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Iklan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Aksi Popup</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white dark:divide-zinc-800 dark:bg-zinc-900">
                        @forelse ($iklanList as $iklan)
                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/' . $iklan->gambar) }}" alt="{{ $iklan->nama }}" class="h-16 w-24 rounded-xl object-cover ring-1 ring-zinc-200 dark:ring-zinc-700" />
                                        <div>
                                            <div class="font-semibold text-zinc-900 dark:text-white">{{ $iklan->nama }}</div>
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $iklan->created_at->format('d M Y H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="max-w-md text-sm text-zinc-600 dark:text-zinc-300">{{ \Illuminate\Support\Str::limit($iklan->deskripsi ?: 'Tanpa deskripsi', 110) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($iklan->cta_label && $iklan->cta_url)
                                        <a href="{{ $iklan->cta_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-sm font-medium text-blue-700 dark:bg-blue-950/40 dark:text-blue-200">
                                            <flux:icon name="arrow-top-right-on-square" class="h-4 w-4" />
                                            {{ $iklan->cta_label }}
                                        </a>
                                    @else
                                        <span class="text-sm text-zinc-400 dark:text-zinc-500">Tanpa tombol aksi</span>
                                    @endif
                                </td>
                                @can('iklan.toggle_status')
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.iklan.toggle-status', $iklan) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="group inline-flex items-center gap-3 rounded-2xl border px-3 py-2 transition {{ $iklan->is_active ? 'border-emerald-200 bg-emerald-50 hover:bg-emerald-100 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:hover:bg-emerald-950/60' : 'border-zinc-200 bg-zinc-50 hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800/80 dark:hover:bg-zinc-800' }}">
                                            <span class="relative inline-flex h-6 w-11 items-center rounded-full transition {{ $iklan->is_active ? 'bg-emerald-500' : 'bg-zinc-400 dark:bg-zinc-600' }}">
                                                <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow transition {{ $iklan->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                            </span>
                                            <span class="text-sm font-medium {{ $iklan->is_active ? 'text-emerald-700 dark:text-emerald-200' : 'text-zinc-600 dark:text-zinc-300' }}">
                                                {{ $iklan->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                @endcan
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('iklan.update')
                                        <flux:button as="a" href="{{ route('admin.iklan.edit', $iklan) }}" variant="ghost" size="sm" class="rounded-xl p-2">
                                            <flux:icon name="pencil-square" class="h-5 w-5" />
                                        </flux:button>
                                        @endcan

                                        @can('iklan.delete')
                                        <form action="{{ route('admin.iklan.destroy', $iklan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus iklan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" variant="danger" size="sm" class="rounded-xl p-2">
                                                <flux:icon name="trash" class="h-5 w-5" />
                                            </flux:button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-14 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center gap-3">
                                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                            <flux:icon name="megaphone" class="h-7 w-7" />
                                        </span>
                                        <div>
                                            <p class="font-semibold text-zinc-900 dark:text-white">Belum ada iklan</p>
                                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Tambahkan iklan pertama untuk ditampilkan sebagai popup di home page.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($iklanList->hasPages())
                <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                    {{ $iklanList->links() }}
                </div>
            @endif
        </flux:card>
    </div>
</div>
@endcan
@endsection
