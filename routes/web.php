<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\GoogleController;

// ===============================
// 🌐 HALAMAN AWAL
// ===============================
Route::get('/', function () {
    return view('welcome');
});

// ===============================
// 👤 PILIH LOGIN
// ===============================
Route::get('/login/pilih', [AuthController::class, 'pilihLogin'])->name('login.pilih');

// ===============================
// 👨‍💼 ADMIN LOGIN
// ===============================
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.post');

// ===============================
// 👨‍🏫 DOSEN LOGIN
// ===============================
Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');
Route::post('/login/dosen', [AuthController::class, 'dosenLogin'])->name('login.dosen.post');

// ===============================
// 🎓 MAHASISWA LOGIN
// ===============================
Route::get('/login/mahasiswa', [AuthController::class, 'showMahasiswaLoginForm'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [AuthController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

// ===============================
// 🏠 DASHBOARD MAHASISWA
// ===============================
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::post('/mahasiswa/upload', [MahasiswaController::class, 'storeUpload'])->name('mahasiswa.storeUpload');

// ===============================
// 📊 DASHBOARD DOSEN
// ===============================
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
Route::get('/dosen/penelitian', [PenelitianController::class, 'index'])->name('dosen.penelitian');
Route::get('/dosen/pengabdian', [PengabdianController::class, 'index'])->name('dosen.pengabdian');
Route::get('/dosen/prestasi', [PrestasiController::class, 'index'])->name('dosen.prestasi');

// ===============================
// 👨‍🏫 CRUD DOSEN
// ===============================
Route::resource('dosen', DosenController::class)->names([
    'index' => 'dosen.index',
    'create' => 'dosen.create',
    'store' => 'dosen.store',
    'show' => 'dosen.show',
    'edit' => 'dosen.edit',
    'update' => 'dosen.update',
    'destroy' => 'dosen.destroy'
]);

// ===============================
// 📚 PENELITIAN
// ===============================
Route::resource('penelitian', PenelitianController::class)->names([
    'index' => 'penelitian.index',
    'create' => 'penelitian.create',
    'store' => 'penelitian.store',
    'show' => 'penelitian.show',
    'edit' => 'penelitian.edit',
    'update' => 'penelitian.update',
    'destroy' => 'penelitian.destroy'
]);

// ===============================
// 🌍 PENGABDIAN
// ===============================
Route::resource('pengabdian', PengabdianController::class)->names([
    'index' => 'pengabdian.index',
    'create' => 'pengabdian.create',
    'store' => 'pengabdian.store',
    'show' => 'pengabdian.show',
    'edit' => 'pengabdian.edit',
    'update' => 'pengabdian.update',
    'destroy' => 'pengabdian.destroy'
]);

// ===============================
// 🏆 PRESTASI
// ===============================
Route::resource('prestasi', PrestasiController::class)->names([
    'index' => 'prestasi.index',
    'create' => 'prestasi.create',
    'store' => 'prestasi.store',
    'show' => 'prestasi.show',
    'edit' => 'prestasi.edit',
    'update' => 'prestasi.update',
    'destroy' => 'prestasi.destroy'
]);

// ===============================
// 🎓 CRUD MAHASISWA
// ===============================
Route::resource('mahasiswa', MahasiswaController::class)->names([
    'index' => 'mahasiswa.index',
    'create' => 'mahasiswa.create',
    'store' => 'mahasiswa.store',
    'show' => 'mahasiswa.show',
    'edit' => 'mahasiswa.edit',
    'update' => 'mahasiswa.update',
    'destroy' => 'mahasiswa.destroy'
]);

// ===============================
// 🧑‍💼 DASHBOARD ADMIN
// ===============================
// 🚫 Tanpa middleware auth
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ===============================
// 🚪 LOGOUT
// ===============================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// 🔑 LOGIN GOOGLE
// ===============================
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('login.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('login.google.callback');
