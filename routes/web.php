<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriArtikelController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.home.index');
})->name('guest.home.index');;

Route::get('/info-kamar', function () {
    return view('guest.info-kamar.index');
})->name('guest.info-kamar.index');;

Route::get('/daftar-dokter', function () {
    return view('guest.daftar-dokter.index');
})->name('guest.daftar-dokter.index');;

Route::get('/layanan-rawat-inap', function () {
    return view('guest.layanan-rawat-inap.index');
})->name('guest.layanan-rawat-inap.index');

Route::get('/layanan-igd', function () {
    return view('guest.layanan-igd.index');
})->name('guest.layanan-igd.index');

Route::get('/layanan-rawat-jalan', function () {
    return view('guest.layanan-rawat-jalan.index');
})->name('guest.layanan-rawat-jalan.index');

Route::get('/layanan-unggulan', function () {
    return view('guest.layanan-unggulan.index');
})->name('guest.layanan-unggulan.index');;

Route::get('/layanan-unggulan/cathlab', function () {
    return view('guest.layanan-unggulan.cathlab.index');
})->name('guest.layanan-unggulan.cathlab.index');

Route::get('/layanan-unggulan/hemodialysis', function () {
    return view('guest.layanan-unggulan.hemodialysis.index');
})->name('guest.layanan-unggulan.hemodialysis.index');

Route::get('/layanan-unggulan/oncology', function () {
    return view('guest.layanan-unggulan.oncology.index');
})->name('guest.layanan-unggulan.oncology.index');

Route::get('/layanan-unggulan/dsa', function () {
    return view('guest.layanan-unggulan.dsa.index');
})->name('guest.layanan-unggulan.dsa.index');

Route::get('/dokter/spesialis', function() {
    return view('dokter.spesialis');
})->name('dokter.spesialis');;

Route::get('/kamar/index', function() {
    return view('kamar.index');
})->name('kamar.index');;

Route::get('/artikel/index', function() {
    return view('artikel.index');
})->name('artikel.index');;

Route::get('/guest/index', function () {
    return view('guest.index');
})->name('guest.index');

Route::view('/admin', 'welcome')->name('home');

Route::middleware(['auth', 'permission:admin-access'])->group(function () {


    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::view('/admin/artikel/index', 'admin.artikel.index')->name('admin.artikel.index');

    Route::get('/admin/artikel/kategori', [KategoriArtikelController::class, 'index'])->name('admin.artikel.kategori.index');
    Route::get('/admin/artikel/kategori/create', [KategoriArtikelController::class, 'create'])->name('admin.artikel.kategori.create');
    Route::post('/admin/artikel/kategori', [KategoriArtikelController::class, 'store'])->name('admin.artikel.kategori.store');
    Route::get('/admin/artikel/kategori/{kategori}/edit', [KategoriArtikelController::class, 'edit'])->name('admin.artikel.kategori.edit');
    Route::put('/admin/artikel/kategori/{kategori}', [KategoriArtikelController::class, 'update'])->name('admin.artikel.kategori.update');
    Route::delete('/admin/artikel/kategori/{kategori}', [KategoriArtikelController::class, 'destroy'])->name('admin.artikel.kategori.destroy');

    // ROUTE AKUN
    Route::get('/admin/akun', [UserController::class, 'index'])->name('admin.akun.index');
    Route::get('/admin/akun/create', [UserController::class, 'create'])->name('admin.akun.create');
    Route::post('/admin/akun', [UserController::class, 'store'])->name('admin.akun.store');
    Route::get('/admin/akun/{user}/edit', [UserController::class, 'edit'])->name('admin.akun.edit');
    Route::put('/admin/akun/{user}', [UserController::class, 'update'])->name('admin.akun.update');
    Route::delete('/admin/akun/{user}', [UserController::class, 'destroy'])->name('admin.akun.destroy');
    Route::get('/admin/akun/{user}/reset-password', [UserController::class, 'resetPasswordForm'])->name('admin.akun.reset-password.form');
    Route::patch('/admin/akun/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.akun.reset-password');

    // ROUTE ROLE
    Route::get('/admin/akun/role', [RoleController::class, 'index'])->name('admin.akun.role.index');
    Route::get('/admin/akun/role/create', [RoleController::class, 'create'])->name('admin.akun.role.create');
    Route::post('/admin/akun/role', [RoleController::class, 'store'])->name('admin.akun.role.store');
    Route::get('/admin/akun/role/{role}/edit', [RoleController::class, 'edit'])->name('admin.akun.role.edit');
    Route::put('/admin/akun/role/{role}', [RoleController::class, 'update'])->name('admin.akun.role.update');
    Route::delete('/admin/akun/role/{role}', [RoleController::class, 'destroy'])->name('admin.akun.role.destroy');

    // ROUTE DOKTER
    Route::get('/admin/dokter', [DokterController::class, 'index'])->name('admin.dokter.index');

    Route::view('/admin/dokumentasi/foto', 'admin.dokumentasi.foto.index')->name('admin.dokumentasi.foto');
    Route::view('/admin/dokumentasi/video', 'admin.dokumentasi.video.index')->name('admin.dokumentasi.video');

    Route::get('/admin/artikel/create', function () {return view('admin.artikel.create');})->name('admin.artikel.create');
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

require __DIR__ . '/settings.php';
