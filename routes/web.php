<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;

// ==================================================
// HALAMAN AWAL
// ==================================================
Route::get('/', function () {
    return view('welcome');
});

// ==================================================
// PILIH LOGIN
// ==================================================
Route::get('/login/pilih', [AuthController::class, 'pilihLogin'])->name('login.pilih');

// ==================================================
// LOGIN ADMIN
// ==================================================
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.post');

// ==================================================
// LOGIN DOSEN
// ==================================================
Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');
Route::post('/login/dosen', [AuthController::class, 'dosenLogin'])->name('login.dosen.post');

// ==================================================
// LOGIN MAHASISWA
// ==================================================
Route::get('/login/mahasiswa', [AuthController::class, 'showMahasiswaLoginForm'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [AuthController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

// ==================================================
// DASHBOARD MAHASISWA
// ==================================================
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::post('/mahasiswa/upload', [MahasiswaController::class, 'storeUpload'])->name('mahasiswa.storeUpload');

// ==================================================
// DASHBOARD DOSEN
// ==================================================
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
Route::get('/dosen/penelitian', [PenelitianController::class, 'index'])->name('dosen.penelitian');
Route::get('/dosen/pengabdian', [PengabdianController::class, 'index'])->name('dosen.pengabdian');
Route::get('/dosen/prestasi', [PrestasiController::class, 'index'])->name('dosen.prestasi');
Route::get('/dosen/export', [DosenController::class, 'export'])->name('dosen.export');

// ==================================================
// CRUD RESOURCES + EXPORT
// ==================================================

// --- Dosen ---
Route::resource('dosen', DosenController::class);

// --- Penelitian EXPORT (HARUS DI ATAS RESOURCE) ---
Route::get('/penelitian/export', [PenelitianController::class, 'export'])
    ->name('penelitian.export');

Route::get('/penelitian/export.csv', [PenelitianController::class, 'exportCsv'])
    ->name('penelitian.export.csv');

// --- Penelitian CRUD ---
Route::resource('penelitian', PenelitianController::class);

// --- Pengabdian ---
Route::resource('pengabdian', PengabdianController::class);

// --- Prestasi ---
Route::resource('prestasi', PrestasiController::class);

// --- Mahasiswa ---
Route::resource('mahasiswa', MahasiswaController::class);

// ==================================================
// DASHBOARD ADMIN
// ==================================================
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// ==================================================
// LOGOUT
// ==================================================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================================================
// GOOGLE OAUTH (FINAL VERSION WITH ROLE)
// ==================================================

// Redirect ke Google (bisa kirim role: admin / dosen / mahasiswa)
Route::get('/auth/google/redirect/{role?}', [GoogleController::class, 'redirect'])
    ->name('login.google.redirect');

// Callback dari Google
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('login.google.callback');

// Halaman konfirmasi jika role account ≠ role intent
Route::get('/auth/google/confirm-role', [GoogleController::class, 'confirmRole'])
    ->name('login.google.confirm_role');

// Proses tombol Continue / Cancel
Route::post('/auth/google/confirm-role/continue', [GoogleController::class, 'confirmRoleContinue'])
    ->name('login.google.confirm_role.continue');

Route::post('/auth/google/confirm-role/cancel', [GoogleController::class, 'confirmRoleCancel'])
    ->name('login.google.confirm_role.cancel');

// Kompatibilitas link lama
Route::get('/auth/google', function (\Illuminate\Http\Request $request) {
    $qs = $request->getQueryString();
    $url = route('login.google.redirect') . ($qs ? ('?' . $qs) : '');
    return redirect($url);
})->name('auth.google.compat');
