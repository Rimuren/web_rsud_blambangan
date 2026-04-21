@extends('layouts.app')

@section('title', 'Tambah Iklan')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    <div class="max-w-3xl mx-auto space-y-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Tambah Iklan</h1>
            <p class="mt-2 text-zinc-500 dark:text-zinc-400">Buat popup iklan baru untuk ditampilkan di halaman home.</p>
        </div>

        <div class="overflow-hidden rounded-3xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 bg-gradient-to-r from-amber-50 via-white to-sky-50 px-6 py-5 dark:border-zinc-800 dark:from-amber-950/20 dark:via-zinc-900 dark:to-sky-950/30">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-600 shadow-sm ring-1 ring-amber-100 dark:bg-zinc-800 dark:text-amber-300 dark:ring-zinc-700">
                        <flux:icon name="megaphone" class="h-6 w-6" />
                    </span>
                    <div>
                        <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Form Iklan Popup</h2>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Unggah banner iklan dan lengkapi keterangannya.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.iklan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="px-6 py-6">
                    @include('admin.iklan._form')
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-zinc-200 bg-zinc-50 px-6 py-4 dark:border-zinc-800 dark:bg-zinc-900/60">
                    <flux:button as="a" href="{{ route('admin.iklan.index') }}" variant="ghost">Batal</flux:button>
                    <flux:button type="submit" variant="primary">
                        <flux:icon name="check" class="h-5 w-5" />
                        Simpan
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
