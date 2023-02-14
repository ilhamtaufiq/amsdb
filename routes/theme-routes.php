<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NphdController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PelaksanaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TinjaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;

Route::get('/', [DashboardController::class, 'index'])->name('/');
// Route::get('/app/nphd/print', [NphdController::class, 'print'])->name('nphd.print');

Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'registerUser')->name('register');
});
Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'loginUser')->name('login');
});

route::post('/tmp-upload', [FileUploadController::class, 'tmpUpload'])->name('tmpUpload');
route::delete('/tmp-delete', [FileUploadController::class, 'tmpDelete'])->name('tmpDelete');

route::post('/permission', [RoleController::class, 'storePermission'])->name('permission.store');
route::get('/permission', [RoleController::class, 'createPermission'])->name('permission.index');

Route::post('logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

/**
 * =======================
 *      LTR ROUTERS
 * =======================
 */
$prefixRouters = [
    'app',
];
/**
 * ==============================
 *
 *       @Router -  Kegiatan
 * ==============================
 */
foreach ($prefixRouters as $prefixRouter) {
    Route::prefix($prefixRouter)->middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
        Route::get('kegiatan/data', [KegiatanController::class, 'data']);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('pekerjaan', PekerjaanController::class);
        Route::resource('profile', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('upload', FileUploadController::class);
        Route::resource('kontrak', KontrakController::class);
        Route::resource('pelaksana', PelaksanaController::class);
        Route::resource('nphd', NphdController::class);
        Route::resource('output', OutputController::class);
        Route::resource('tinja', TinjaController::class);

        Route::get('kecamatan', [WilayahController::class, 'index'])->name('kecamatan');
    });
}

Route::prefix('/data')->group(function () {
    Route::get('desa', [DesaController::class, 'data']);
});

foreach ($prefixRouters as $prefixRouter) {
    Route::prefix($prefixRouter)->group(function () {
        Route::get('/sss', function () {
            return view('welcome', ['title' => 'this is ome ', 'breadcrumb' => 'This Breadcrumb']);
        });

        /**
         * ==============================
         *
         *       @Router -  Dashboard
         * ==============================
         */
        Route::prefix('dashboard')->group(function () {
            Route::get('/am', function () {
                return view('pages.dashboard.am', ['title' => 'Satu Data - Air Minum dan Sanitasi', 'breadcrumb' => 'Air Minum dan Saniitasi']);
            })->name('am');
            Route::get('/san', function () {
                return view('pages.dashboard.san', ['title' => 'Satu Data - Air Minum dan Sanitasi', 'breadcrumb' => 'Air Minum dan Saniitasi']);
            })->name('san');
        });
    });
}
