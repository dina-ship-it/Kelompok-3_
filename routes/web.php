<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;

/* --- TPK controllers --- */
use App\Http\Controllers\TPKController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HALAMAN AWAL
Route::get('/', function () {
    return view('welcome');
});

// LOGIN SELECTION & base login route (so auth middleware can redirect to route('login'))
Route::get('/login/pilih', [AuthController::class, 'pilihLogin'])->name('login.pilih');
Route::get('/login', [AuthController::class, 'pilihLogin'])->name('login');

// LOGIN ADMIN
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.post');

// LOGIN DOSEN
Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');
Route::post('/login/dosen', [AuthController::class, 'dosenLogin'])->name('login.dosen.post');

// LOGIN MAHASISWA
Route::get('/login/mahasiswa', [AuthController::class, 'showMahasiswaLoginForm'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [AuthController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GOOGLE OAUTH (compat + flows)
Route::get('/auth/google/redirect/{role?}', [GoogleController::class, 'redirect'])->name('login.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('login.google.callback');
Route::get('/auth/google/confirm-role', [GoogleController::class, 'confirmRole'])->name('login.google.confirm_role');
Route::post('/auth/google/confirm-role/continue', [GoogleController::class, 'confirmRoleContinue'])->name('login.google.confirm_role.continue');
Route::post('/auth/google/confirm-role/cancel', [GoogleController::class, 'confirmRoleCancel'])->name('login.google.confirm_role.cancel');

Route::get('/auth/google', function (\Illuminate\Http\Request $request) {
    $qs = $request->getQueryString();
    $url = route('login.google.redirect') . ($qs ? ('?' . $qs) : '');
    return redirect($url);
})->name('auth.google.compat');

/*
|--------------------------------------------------------------------------
| Protected routes (require authentication)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // DASHBOARD (Admin)
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | MAHASISWA
    |--------------------------------------------------------------------------
    | Dashboard + upload umum (sudah ada) + upload per-penelitian
    */
    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])
        ->name('mahasiswa.dashboard');

    // Upload dokumentasi umum (lama)
    Route::post('/mahasiswa/upload', [MahasiswaController::class, 'storeUpload'])
        ->name('mahasiswa.storeUpload');

    // === Tambahan: upload dokumentasi berdasarkan penelitian ===
    // Daftar penelitian untuk mahasiswa (kalau mau route khusus, tapi
    // biasanya ditampilkan di dalam dashboard() langsung)
    // Route::get('/mahasiswa/penelitian', [MahasiswaController::class, 'penelitianMahasiswa'])
    //     ->name('mahasiswa.penelitian');

    // Form upload dokumentasi untuk sebuah penelitian
    Route::get('/mahasiswa/dokumentasi/{penelitian}/create', [MahasiswaController::class, 'createDokumentasi'])
        ->name('mahasiswa.dokumentasi.create');

    // Simpan dokumentasi untuk sebuah penelitian
    Route::post('/mahasiswa/dokumentasi/{penelitian}', [MahasiswaController::class, 'storeDokumentasi'])
        ->name('mahasiswa.dokumentasi.store');


    /*
    |--------------------------------------------------------------------------
    | DOSEN
    |--------------------------------------------------------------------------
    */
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/dosen/penelitian', [PenelitianController::class, 'index'])->name('dosen.penelitian');
    Route::get('/dosen/pengabdian', [PengabdianController::class, 'index'])->name('dosen.pengabdian');
    Route::get('/dosen/export', [DosenController::class, 'export'])->name('dosen.export');

    // PRESTASI (link dari dashboard dosen → redirect ke TPK)
    Route::get('/dosen/prestasi', function () {
        return redirect()->route('tpk.index');
    })->name('dosen.prestasi');

    /*
    |--------------------------------------------------------------------------
    | EXPORT generic
    |--------------------------------------------------------------------------
    */
    Route::get('/penelitian/export', [PenelitianController::class, 'export'])->name('penelitian.export');
    Route::get('/penelitian/export.csv', [PenelitianController::class, 'exportCsv'])->name('penelitian.export.csv');
    Route::get('/pengabdian/export', [PengabdianController::class, 'export'])->name('pengabdian.export');
    Route::get('/pengabdian/export.csv', [PengabdianController::class, 'exportCsv'])->name('pengabdian.export.csv');

    /*
    |--------------------------------------------------------------------------
    | CRUD resources (non-TPK)
    |--------------------------------------------------------------------------
    */
    Route::resource('dosen', DosenController::class);
    Route::resource('penelitian', PenelitianController::class);
    Route::resource('pengabdian', PengabdianController::class);

    // Compat: named routes plural untuk view yang memakai pengabdians.*
    // (menggunakan same URLs / controller methods — hanya menambahkan nama)
    Route::get('/pengabdian/create', [PengabdianController::class, 'create'])
        ->name('pengabdians.create');

    Route::get('/pengabdian/{pengabdian}', [PengabdianController::class, 'show'])
        ->name('pengabdians.show');

    Route::get('/pengabdian/{pengabdian}/edit', [PengabdianController::class, 'edit'])
        ->name('pengabdians.edit');

    Route::post('/pengabdian', [PengabdianController::class, 'store'])
        ->name('pengabdians.store');

    Route::put('/pengabdian/{pengabdian}', [PengabdianController::class, 'update'])
        ->name('pengabdians.update');

    Route::delete('/pengabdian/{pengabdian}', [PengabdianController::class, 'destroy'])
        ->name('pengabdians.destroy');

    Route::resource('mahasiswa', MahasiswaController::class);

    /*
    |--------------------------------------------------------------------------
    | TPK (TPK / SAW) - routes (prefix /admin/tpk)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/tpk')->name('tpk.')->group(function () {

        // main compute / overview
        Route::get('/', [TPKController::class, 'index'])->name('index');

        // export CSV (controller method exportCsv)
        Route::get('/export', [TPKController::class, 'exportCsv'])->name('export');

        /*
         * Alternative (Alternatif) CRUD
         * names: tpk.alternatif.index, create, store, edit, update, destroy
         */
        Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');        // list
        Route::get('/alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create'); // form add
        Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');        // save new
        Route::get('/alternatif/{id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');  // edit form
        Route::put('/alternatif/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');  // save update
        Route::delete('/alternatif/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy'); // delete

        /*
         * Criteria management (kriteria)
         */
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Hitung bobot otomatis
        Route::get('/kriteria/hitung', [KriteriaController::class, 'hitungOtomatis'])->name('kriteria.hitung');
    });

    /*
    |--------------------------------------------------------------------------
    | Compatibility: Legacy 'prestasi.*' routes (redirect to TPK)
    |--------------------------------------------------------------------------
    */
    Route::get('/prestasi', function () { return redirect()->route('tpk.index'); })->name('prestasi.index');
    Route::get('/prestasi/create', function () { return redirect()->route('tpk.alternatif.create'); })->name('prestasi.create');
    Route::post('/prestasi', function () { return redirect()->route('tpk.alternatif.index'); })->name('prestasi.store');
    Route::get('/prestasi/{id}/edit', function ($id) { return redirect()->route('tpk.alternatif.edit', $id); })->name('prestasi.edit');
    Route::put('/prestasi/{id}', function ($id) { return redirect()->route('tpk.alternatif.index'); })->name('prestasi.update');
    Route::delete('/prestasi/{id}', function ($id) { return redirect()->route('tpk.alternatif.index'); })->name('prestasi.destroy');

});
