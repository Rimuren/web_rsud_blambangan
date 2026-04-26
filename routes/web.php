<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboard,
    DokterController as AdminDokter,
    BangsalController as AdminBangsal,
    RoleController as AdminRole,
    IklanController as AdminIklan,
    JamOperasionalController as AdminJamOperasional,
    UserController as AdminUser,
    PhotoController as AdminPhoto,
    VideoController as AdminVideo,
    PoliklinikController as AdminPoliklinik,
};

use App\Http\Controllers\Guest\{
    DokterController as GuestDokter,
    HomeController as GuestHome,
    BangsalController as GuestBangsal,
    PhotoController as GuestPhoto,
    VideoController as GuestVideo,
};

use App\Http\Controllers\{
    ArtikelController,
    GuestArtikelController,
    KategoriArtikelController,
};

/*
|--------------------------------------------------------------------------
| Guest Routes (Public)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [GuestHome::class, 'index'])->name('guest.home');

// Profil
Route::get('/profil', function () {
    return view('guest.profil.index');
})->name('guest.profil.index');

// Daftar dokter
Route::get('/daftar-dokter', [GuestDokter::class, 'Index'])->name('guest.daftar-dokter.index');

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

// Route sementara (belum ada controller)
Route::get('/layanan-rawat-jalan/{slug}', function () {
    return abort(404);
})->name('guest.layanan-rawat-jalan.detail');

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

// Galeri
Route::prefix('galeri')->group(function () {
    Route::get('/foto', [GuestPhoto::class, 'guestIndex'])->name('guest.galeri.foto.index');
    Route::get('/video', [GuestVideo::class, 'guestIndex'])->name('guest.galeri.video.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Authenticated & Authorized)
|--------------------------------------------------------------------------
*/

Route::view('/admin', 'welcome')->name('home');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ARTIKEL
    |--------------------------------------------------------------------------
    */
    Route::controller(ArtikelController::class)->prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{artikel}/edit', 'edit')->name('edit');
        Route::put('/{artikel}', 'update')->name('update');
        Route::delete('/mass-destroy', 'massDestroy')->name('mass-destroy');
        Route::delete('/{artikel}', 'destroy')->name('destroy');
        Route::post('/upload-image', 'uploadImage')->name('upload-image');
    });

    // Kategori Artikel
    Route::controller(KategoriArtikelController::class)->prefix('artikel/kategori')->name('artikel.kategori.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{kategori}/edit', 'edit')->name('edit');
        Route::put('/{kategori}', 'update')->name('update');
        Route::delete('/{kategori}', 'destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | AKUN & ROLE
    |--------------------------------------------------------------------------
    */
    Route::controller(AdminUser::class)->prefix('akun')->name('akun.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');

        Route::get('/{user}/reset-password', 'resetPasswordForm')->name('reset-password.form');
        Route::patch('/{user}/reset-password', 'resetPassword')->name('reset-password');
    });

    Route::controller(AdminRole::class)->prefix('akun/role')->name('akun.role.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::put('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | DOKTER, POLIKLINIK
    |--------------------------------------------------------------------------
    */

    Route::prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/', [AdminDokter::class, 'index'])->name('index');

        // Poliklinik
        Route::prefix('poliklinik')->name('poliklinik.')->controller(AdminPoliklinik::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | DOKUMENTASI
    |--------------------------------------------------------------------------
    */
    Route::prefix('dokumentasi')->name('dokumentasi.')->group(function () {
        // FOTO
        Route::controller(AdminPhoto::class)->prefix('foto')->name('foto.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{photo}/edit', 'edit')->name('edit');
            Route::put('/{photo}', 'update')->name('update');
            Route::delete('/{photo}', 'destroy')->name('destroy');
        });

        // VIDEO
        Route::controller(AdminVideo::class)->prefix('video')->name('video.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{video}/edit', 'edit')->name('edit');
            Route::put('/{video}', 'update')->name('update');
            Route::delete('/{video}', 'destroy')->name('destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN RUANGAN (BANGSAL)
    |--------------------------------------------------------------------------
    */
    Route::get('manajemen-ruangan/bangsal', [AdminBangsal::class, 'index'])
        ->name('manajemen-ruangan.bangsal.index');

    /*
    |--------------------------------------------------------------------------
    | JAM OPERASIONAL 
    |--------------------------------------------------------------------------
    */
    Route::controller(AdminJamOperasional::class)->prefix('jam-operasional')->name('jam-operasional.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{jam_operasional}/edit', 'edit')->name('edit');
        Route::put('/{jam_operasional}', 'update')->name('update');
        Route::patch('/{jam_operasional}/toggle-status', 'toggleStatus')->name('toggle-status');
        Route::delete('/{jam_operasional}', 'destroy')->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | IKLAN
    |--------------------------------------------------------------------------
    */
    Route::controller(AdminIklan::class)->prefix('iklan')->name('iklan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{iklan}/edit', 'edit')->name('edit');
        Route::put('/{iklan}', 'update')->name('update');
        Route::patch('/{iklan}/toggle-status', 'toggleStatus')->name('toggle-status');
        Route::delete('/{iklan}', 'destroy')->name('destroy');
    });
}); // end admin group

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