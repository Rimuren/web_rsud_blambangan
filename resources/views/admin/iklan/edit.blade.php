@extends('layouts.app')

@section('title', 'Edit Iklan')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-3xl mx-auto space-y-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Edit Iklan</h1>
            <p class="mt-2 text-zinc-500 dark:text-zinc-400">Perbarui gambar, nama, dan deskripsi popup iklan.</p>
        </div>

        <div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 bg-gradient-to-r from-sky-50 via-white to-amber-50 px-6 py-5 dark:border-zinc-800 dark:from-sky-950/30 dark:via-zinc-900 dark:to-amber-950/20">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-sky-600 shadow-sm ring-1 ring-sky-100 dark:bg-zinc-800 dark:text-sky-300 dark:ring-zinc-700">
                        <flux:icon name="pencil-square" class="h-6 w-6" />
                    </span>
                    <div>
                        <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Edit Iklan Popup</h2>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Simpan perubahan agar popup tampil sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.iklan.update', $iklan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="px-6 py-6">
                    @include('admin.iklan._form')
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-zinc-200 bg-zinc-50 px-6 py-4 dark:border-zinc-800 dark:bg-zinc-900/60">
                    <flux:button as="a" href="{{ route('admin.iklan.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">
                        <flux:icon name="check" class="h-5 w-5" />
                        Update
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
