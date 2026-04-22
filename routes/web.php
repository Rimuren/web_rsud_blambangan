<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminDashboardController,
    AdminDokterController,
    ArtikelController,
    GuestArtikelController,
    IklanController,
    GuestDokterController,
    GuestHomeController,
    JamOperasionalController,
    RoleController,
    UserController,
    KategoriArtikelController,
    PhotoController,
    VideoController
};

/*
|--------------------------------------------------------------------------
| Guest Routes (Public)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/',[GuestHomeController::class,'index'])->name('guest.home');

// Profil
Route::get('/profil', function () {
    return view('guest.profil.index');
})->name('guest.profil.index');

// Daftar dokter
Route::get('/daftar-dokter', [GuestDokterController::class, 'Index'])->name('guest.daftar-dokter.index');

Route::get('/dokter/spesialis', function () {
    return view('admin.dokter.spesialis.index');
})->name('admin.dokter.spesialis.index');

// Info kamar
Route::get('/info-kamar', function () {
    return view('guest.info-kamar.index');
})->name('guest.info-kamar.index');

Route::get('/kamar/index', function () {
    return view('kamar.index');
})->name('kamar.index');

// Artikel
Route::prefix('artikel')->name('guest.artikel.')->group(function () {
    Route::get('/', [GuestArtikelController::class, 'index'])->name('index');
    Route::get('/{slug}', [GuestArtikelController::class, 'show'])->name('detail');
});

// Layanan Rawat Inap
Route::get('/layanan-rawat-inap', function () {
    return view('guest.layanan-rawat-inap.index');
})->name('guest.layanan-rawat-inap.index');

// Layanan Unggulan
Route::get('/layanan-unggulan', function () {
    return view('guest.layanan-unggulan.index');
})->name('guest.layanan-unggulan.index');

Route::prefix('layanan-unggulan')->group(function () {
    Route::get('/cathlab', function () {
        return view('guest.layanan-unggulan.cathlab.index');
    })->name('guest.layanan-unggulan.cathlab.index');

    Route::get('/hemodialysis', function () {
        return view('guest.layanan-unggulan.hemodialysis.index');
    })->name('guest.layanan-unggulan.hemodialysis.index');

    Route::get('/oncology', function () {
        return view('guest.layanan-unggulan.oncology.index');
    })->name('guest.layanan-unggulan.oncology.index');

    Route::get('/dsa', function () {
        return view('guest.layanan-unggulan.dsa.index');
    })->name('guest.layanan-unggulan.dsa.index');
});

// Layanan Rawat Jalan
Route::get('/layanan-rawat-jalan', function () {
    return view('guest.layanan-rawat-jalan.index');
})->name('guest.layanan-rawat-jalan.index');

Route::get('/layanan-rawat-jalan/anasthesi', function () {
    return view('guest.layanan-rawat-jalan.anasthesi.index');
})->name('guest.layanan-rawat-jalan.anasthesi.index');

// Route Sementara
Route::get('/layanan-rawat-jalan/{slug}')->name('guest.layanan-rawat-jalan.detail');
// Route::get('/layanan-rawat-jalan/{slug}', [LayananRawatJalanController::class, 'detail'])->name('guest.layanan-rawat-jalan.detail');

// Layanan IGD
Route::get('/layanan-igd', function () {
    return view('guest.layanan-igd.index');
})->name('guest.layanan-igd.index');

// Informasi
Route::prefix('informasi')->group(function () {
    Route::get('/alur-persyaratan', function () {
        return view('guest.informasi.alur-persyaratan.index');
    })->name('guest.informasi.alur-persyaratan.index');

    Route::get('/tarif', function () {
        return view('guest.informasi.tarif.index');
    })->name('guest.informasi.tarif.index');

    Route::get('/ikm', function () {
        return view('guest.informasi.ikm.index');
    })->name('guest.informasi.ikm.index');

    Route::get('/petunjuk-umum', function () {
        return view('guest.informasi.petunjuk-umum.index');
    })->name('guest.informasi.petunjuk-umum.index');

    Route::get('/sakip', function () {
        return view('guest.informasi.sakip.index');
    })->name('guest.informasi.sakip.index');
    
});

Route::prefix('galeri')->group(function () {
    Route::get('/foto', [PhotoController::class, 'guestIndex'])->name('guest.galeri.foto.index');
    Route::get('/video', [VideoController::class, 'guestIndex'])->name('guest.galeri.video.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Authenticated & Authorized)
|--------------------------------------------------------------------------
*/
Route::view('/admin', 'welcome')->name('home');

Route::middleware(['auth', 'permission:admin-access'])->group(function () {
    
    // ROUTE DASHBOARD ADMIN
    Route::get('/admin/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // ROUTE ARTIKEL
    Route::controller(ArtikelController::class)->prefix('admin/artikel')->group(function () {
        Route::get('/', 'index')->name('admin.artikel.index');
        Route::get('/create', 'create')->name('admin.artikel.create');
        Route::post('/', 'store')->name('admin.artikel.store');
        Route::get('/{artikel}/edit', 'edit')->name('admin.artikel.edit');
        Route::put('/{artikel}', 'update')->name('admin.artikel.update');
        Route::delete('/mass-destroy', 'massDestroy')->name('admin.artikel.mass-destroy');
        Route::delete('/delete/{artikel}', 'destroy')->name('admin.artikel.destroy');
        Route::post('/upload-image', 'uploadImage')->name('admin.artikel.upload-image');
    });

    // ROUTE KATEGORI ARTIKEL
    Route::controller(KategoriArtikelController::class)->prefix('admin/artikel/kategori')->group(function () {
        Route::get('/', 'index')->name('admin.artikel.kategori.index');
        Route::get('/create', 'create')->name('admin.artikel.kategori.create');
        Route::post('/', 'store')->name('admin.artikel.kategori.store');
        Route::get('/{kategori}/edit', 'edit')->name('admin.artikel.kategori.edit');
        Route::put('/{kategori}', 'update')->name('admin.artikel.kategori.update');
        Route::delete('/{kategori}', 'destroy')->name('admin.artikel.kategori.destroy');
    });

    // ROUTE AKUN
    Route::controller(UserController::class)->prefix('admin/akun')->group(function () {
        Route::get('/', 'index')->name('admin.akun.index');
        Route::get('/create', 'create')->name('admin.akun.create');
        Route::post('/', 'store')->name('admin.akun.store');
        Route::get('/{user}/edit', 'edit')->name('admin.akun.edit');
        Route::put('/{user}', 'update')->name('admin.akun.update');
        Route::delete('/{user}', 'destroy')->name('admin.akun.destroy');
        Route::get('/{user}/reset-password', 'resetPasswordForm')->name('admin.akun.reset-password.form');
        Route::patch('/{user}/reset-password', 'resetPassword')->name('admin.akun.reset-password');
    });

    // ROUTE ROLE
    Route::controller(RoleController::class)->prefix('admin/akun/role')->group(function () {
        Route::get('/', 'index')->name('admin.akun.role.index');
        Route::get('/create', 'create')->name('admin.akun.role.create');
        Route::post('/', 'store')->name('admin.akun.role.store');
        Route::get('/{role}/edit', 'edit')->name('admin.akun.role.edit');
        Route::put('/{role}', 'update')->name('admin.akun.role.update');
        Route::delete('/{role}', 'destroy')->name('admin.akun.role.destroy');
    });

    // ROUTE DOKTER
    Route::controller(AdminDokterController::class)->prefix('admin/dokter')->group(function () {
        Route::get('/', 'index')->name('admin.dokter.index');
    });

    // ROUTE MANAJEMEN RUANGAN (BANGSAL)
    Route::view('/admin/manajemen-ruangan/bangsal', 'admin.manajemen-ruangan.bangsal.index')->name('admin.manajemen-ruangan.bangsal.index');

    // Rute untuk manajemen foto (CRUD)
Route::prefix('admin/dokumentasi/foto')->name('admin.dokumentasi.foto.')->group(function () {
    Route::get('/', [PhotoController::class, 'index'])->name('index');
    Route::get('/create', [PhotoController::class, 'create'])->name('create');
    Route::post('/', [PhotoController::class, 'store'])->name('store');
    Route::get('/{foto}/edit', [PhotoController::class, 'edit'])->name('edit');
    Route::put('/{foto}', [PhotoController::class, 'update'])->name('update');
    Route::delete('/{foto}', [PhotoController::class, 'destroy'])->name('destroy');
});

    

// Rute untuk manajemen video (CRUD)
  Route::prefix('admin/dokumentasi/video')->name('admin.dokumentasi.video.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::get('/create', [VideoController::class, 'create'])->name('create');
        Route::post('/', [VideoController::class, 'store'])->name('store');
        Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('edit');
        Route::put('/{video}', [VideoController::class, 'update'])->name('update');
        Route::delete('/{video}', [VideoController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/jam-operasional')->name('admin.jam-operasional.')->group(function () {
        Route::get('/', [JamOperasionalController::class, 'index'])->name('index');
        Route::get('/create', [JamOperasionalController::class, 'create'])->name('create');
        Route::post('/', [JamOperasionalController::class, 'store'])->name('store');
        Route::get('/{jamOperasional}/edit', [JamOperasionalController::class, 'edit'])->name('edit');
        Route::put('/{jamOperasional}', [JamOperasionalController::class, 'update'])->name('update');
        Route::patch('/{jamOperasional}/toggle-status', [JamOperasionalController::class, 'toggleStatus'])->name('toggle-status');
        Route::delete('/{jamOperasional}', [JamOperasionalController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/iklan')->name('admin.iklan.')->group(function () {
        Route::get('/', [IklanController::class, 'index'])->name('index');
        Route::get('/create', [IklanController::class, 'create'])->name('create');
        Route::post('/', [IklanController::class, 'store'])->name('store');
        Route::get('/{iklan}/edit', [IklanController::class, 'edit'])->name('edit');
        Route::put('/{iklan}', [IklanController::class, 'update'])->name('update');
        Route::patch('/{iklan}/toggle-status', [IklanController::class, 'toggleStatus'])->name('toggle-status');
        Route::delete('/{iklan}', [IklanController::class, 'destroy'])->name('destroy');
    });

    });


/*
|--------------------------------------------------------------------------
| Debug / Test Routes (Commented)
|--------------------------------------------------------------------------
*/
// Route::get('/test-api-dokter', function () {
//     $apiService = new RsudApiService();
//     $data = $apiService->get('doctors');
//
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
//
// Route::get('/debug-api-dokter', function () {
//     $api = new App\Services\RsudApiService();
//     $data = $api->get('doctors');
//     return response()->json($data);
// });

require __DIR__ . '/settings.php';
