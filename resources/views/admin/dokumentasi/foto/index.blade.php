@extends('layouts.app')

@section('title', 'Manajemen Dokumentasi Foto')

@section('content')
<div class="p-4 md:p-6 lg:p-8">
    {{-- Header Section --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight">Manajemen Dokumentasi</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Kelola galeri foto dan video rumah sakit untuk konten dokumentasi.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium text-sm shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            <flux:icon name="plus" class="w-4 h-4" />
            Tambah Foto
        </button>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-zinc-200 dark:border-zinc-800 mb-8">
        <div class="-mb-px flex space-x-8">
            <a href="#" class="pb-4 text-sm font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 whitespace-nowrap flex items-center gap-2">
                <flux:icon name="image" class="w-4 h-4" />
                Foto
            </a>
            <a href="#" class="pb-4 text-sm font-medium text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300 border-b-2 border-transparent hover:border-zinc-300 dark:hover:border-zinc-600 whitespace-nowrap flex items-center gap-2 transition-colors">
                <flux:icon name="video" class="w-4 h-4" />
                Video
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <flux:card class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider w-48">Foto</th>
                        <th class="px-6 py-4 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Informasi & Deskripsi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJ2IWRIx0N5PQA5cZAwMCWjVU3jIew60stVqkP5rV2KewE7_wU2M3sh7KuAeerPnf6FL5aAz7Mmqn1RbQSLtg4m4xnYwhOl6XTUvJUrDvhYd97x1z7c0YA7kwPrLpIofo6CP4aAvRwwGEwf5sK1PykVop4mbwtGAyOVJ5xfZ9SxAKGJK1Q6wBpvwu8-Pe2ad-m8SfRf8lQ61GCTiYUBmE3KEjSznBgKHVGz2LNglWSZ5DQRywt2qD5Zg-24BKXjukZdYC4XRWBK9hC" 
                                     alt="Thumbnail" 
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-200"/>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-base">Gedung Utama Tampak Depan</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    facade-main-2024.jpg
                                    <flux:icon name="image" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Foto udara terbaru gedung utama rumah sakit setelah renovasi fasad selesai pada Januari 2024.
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-2">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Lihat">
                                    <flux:icon name="eye" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCo2kfBTc7jFsEMDAwfHYRP7fA0YrFIRGcB80REOrvdIWYlGsIbGUCfXJ96VhqofKODKcPxra_Py2EVniPeVvW8HvfdfixshVp7k_q4W2Ssbn7s770rslpQAzXrfyhOfr22aLDD1PDec8WixuLgKk211p3lZR10jS33cL1LRdRyA3QTyvoSvVPsxaFbj2KRcnjFC9jcUu1zCH6OzM5NZI9qTbMm2BIF_dTv7qGDCUvHdSe_EE2N7OJLRc-nyxX0l8HUDfw0K0d3UKHN" 
                                     alt="Thumbnail" 
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-200"/>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-base">Ruang Operasi Hybrid</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    hybrid-theater-01.png
                                    <flux:icon name="image" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Dokumentasi peralatan canggih di ruang operasi hybrid untuk keperluan brosur layanan spesialis.
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-2">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Lihat">
                                    <flux:icon name="eye" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <div class="w-36 aspect-video rounded-lg bg-zinc-100 dark:bg-zinc-700 relative overflow-hidden group">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6n6_HvQ2SQlKOOzHkSTQp_Oq3QqgGW0ncPAp4HRlDJ-f7d_sfZiB-mf6Ta06k6iWk6Mxnt6cbDQKm9Vy2BA_eJ13-3wGDSuVGq3gxuCkGMphLvtY9JnHcCnbf9DX52FmYmrI7tHOkTZ52y3SGDKF0Gpv2eJkJOE6Ug34XmL8uXU4CZZcEXCbZY75yPRuajUPrTuX5QnEMIBedFgXxtzfcgxO9PhJlpFJ3LNwrujYSBp4XRWtw6AzhSbV5GYRBiRpYhU0X_od996sC" 
                                     alt="Thumbnail" 
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-200"/>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <h3 class="font-bold text-zinc-900 dark:text-white text-base">Tim Perawat ICU</h3>
                                <div class="flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400">
                                    icu-team-group.jpg
                                    <flux:icon name="image" variant="micro" class="w-3 h-3" />
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                Foto profil tim medis yang bertugas di unit perawatan intensif untuk profil departemen.
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-2">
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Lihat">
                                    <flux:icon name="eye" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400" title="Edit">
                                    <flux:icon name="pencil" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100" />
                                </button>
                                <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-400" title="Hapus">
                                    <flux:icon name="trash" class="w-5 h-5 text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-300" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </flux:card>
</div>
@stop

