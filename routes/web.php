<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;
use App\Services\RsudApiService;

Route::view('/', 'welcome')->name('home');

Route::get('/guest/index', function () {
    return view('guest.index');
})->name('guest.index');;

Route::get('/dokter/spesialis', function() {
    return view('dokter.spesialis');
})->name('dokter.spesialis');;

Route::get('/kamar/index', function() {
    return view('kamar.index');
})->name('kamar.index');;

Route::get('/artikel/index', function() {
    return view('artikel.index');
})->name('artikel.index');;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::view('/admin/artikel/index','admin.artikel.index')->name('admin.artikel.index');

    Route::view('/admin/artikel/kategori/index','admin.artikel.kategori.index')->name('admin.artikel.kategori.index');

    Route::view('/admin/akun', 'admin.akun.index')->name('admin.akun.index');
    
    Route::view('/admin/akun/role', 'admin.akun.role.index')->name('admin.akun.role.index');

 // Route::view('/admin/dokter', 'admin.dokter.index')->name('admin.dokter.index');
    Route::get('/admin/dokter', [DokterController::class, 'index'])->name('admin.dokter.index');

    Route::view('/admin/dokumentasi/foto', 'admin.dokumentasi.foto.index')->name('admin.dokumentasi.foto');
    Route::view('/admin/dokumentasi/video', 'admin.dokumentasi.video.index')->name('admin.dokumentasi.video');

    // Route::get('/admin/artikel/create', function () 
    // { 
    //     return view('admin.artikel.create');
    // });
});



// Route::get('/test-api-dokter', function () {
//     $apiService = new RsudApiService();
//     $data = $apiService->get('doctors');

//     if ($data) {
//         return response()->json([
//             'status' => 'success',
//             'jumlah_data' => count($data),
//             'data_pertama' => $data[0] ?? null
//         ]);
//     } else {
//         return response()->json([
//             'status' => 'error',
//             'message' => 'Gagal mengambil data dari API'
//         ], 500);
//     }
// });

// Route::get('/debug-api-dokter', function () {
//     $api = new App\Services\RsudApiService();
//     $data = $api->get('doctors');
//     return response()->json($data);
// });

require __DIR__.'/settings.php';
