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

// 📁 Upload Dokumentasi Mahasiswa
Route::post('/mahasiswa/upload', [MahasiswaController::class, 'storeUpload'])->name('mahasiswa.storeUpload');

// ===============================
// 📊 DASHBOARD DOSEN
// ===============================
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');

// ===============================
// 📁 MENU UTAMA (klik dari dashboard dosen)
// ===============================
Route::get('/dosen/penelitian', [PenelitianController::class, 'index'])->name('dosen.penelitian');
Route::get('/dosen/pengabdian', [PengabdianController::class, 'index'])->name('dosen.pengabdian');
Route::get('/dosen/prestasi', [PrestasiController::class, 'index'])->name('dosen.prestasi');

// ===============================
// 👨‍🏫 CRUD DOSEN
// ===============================
Route::resource('dosen', DosenController::class);

// ===============================
// 📚 PENELITIAN
// ===============================
Route::resource('penelitian', PenelitianController::class);

// ===============================
// 🌍 PENGABDIAN
// ===============================
Route::resource('pengabdian', PengabdianController::class);

// ===============================
// 🏆 PRESTASI
// ===============================
Route::resource('prestasi', PrestasiController::class);

// ===============================
// 🎓 CRUD MAHASISWA
// ===============================
Route::resource('mahasiswa', MahasiswaController::class);

// ===============================
// 🧑‍💼 DASHBOARD ADMIN
// ===============================
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
