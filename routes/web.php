<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::get('/guest/index', function () {
    return view('guest.index');
})->name('guest.index');;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::view(
            '/admin/artikel/index',
            'admin.artikel.index'
        )->name('admin.artikel.index');

        Route::view(
            '/admin/artikel/kategori/index',
            'admin.artikel.kategori.index'
        )->name('admin.artikel.kategori.index');

        Route::get('/admin/artikel/create', function () {
        return view('admin.artikel.create');
    })->name('admin.artikel.create');

});

require __DIR__.'/settings.php';
