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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Route-file final untuk aplikasi SIP2D.
| Pastikan GoogleController dan controller lain sudah ada.
*/

// HALAMAN AWAL
Route::get('/', function () {
    return view('welcome');
});

// PILIH LOGIN
Route::get('/login/pilih', [AuthController::class, 'pilihLogin'])->name('login.pilih');

// ADMIN LOGIN (form & post)
Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.post');

// DOSEN LOGIN
Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');
Route::post('/login/dosen', [AuthController::class, 'dosenLogin'])->name('login.dosen.post');

// MAHASISWA LOGIN
Route::get('/login/mahasiswa', [AuthController::class, 'showMahasiswaLoginForm'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [AuthController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

// DASHBOARD MAHASISWA
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::post('/mahasiswa/upload', [MahasiswaController::class, 'storeUpload'])->name('mahasiswa.storeUpload');

// DASHBOARD DOSEN & related
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
Route::get('/dosen/penelitian', [PenelitianController::class, 'index'])->name('dosen.penelitian');
Route::get('/dosen/pengabdian', [PengabdianController::class, 'index'])->name('dosen.pengabdian');
Route::get('/dosen/prestasi', [PrestasiController::class, 'index'])->name('dosen.prestasi');
Route::get('/dosen/export', [DosenController::class, 'export'])->name('dosen.export');

// CRUD resource routes
Route::resource('dosen', DosenController::class)->names([
    'index' => 'dosen.index',
    'create' => 'dosen.create',
    'store' => 'dosen.store',
    'show' => 'dosen.show',
    'edit' => 'dosen.edit',
    'update' => 'dosen.update',
    'destroy' => 'dosen.destroy'
]);

// PENELITIAN routes (tambah route CSV)
Route::get('/penelitian/export', [PenelitianController::class, 'export'])->name('penelitian.export');
Route::get('/penelitian/export.csv', [PenelitianController::class, 'exportCsv'])->name('penelitian.export.csv');

Route::resource('penelitian', PenelitianController::class)->names([
    'index' => 'penelitian.index',
    'create' => 'penelitian.create',
    'store' => 'penelitian.store',
    'show' => 'penelitian.show',
    'edit' => 'penelitian.edit',
    'update' => 'penelitian.update',
    'destroy' => 'penelitian.destroy'
]);

Route::resource('pengabdian', PengabdianController::class)->names([
    'index' => 'pengabdian.index',
    'create' => 'pengabdian.create',
    'store' => 'pengabdian.store',
    'show' => 'pengabdian.show',
    'edit' => 'pengabdian.edit',
    'update' => 'pengabdian.update',
    'destroy' => 'pengabdian.destroy'
]);

Route::resource('prestasi', PrestasiController::class)->names([
    'index' => 'prestasi.index',
    'create' => 'prestasi.create',
    'store' => 'prestasi.store',
    'show' => 'prestasi.show',
    'edit' => 'prestasi.edit',
    'update' => 'prestasi.update',
    'destroy' => 'prestasi.destroy'
]);

Route::resource('mahasiswa', MahasiswaController::class)->names([
    'index' => 'mahasiswa.index',
    'create' => 'mahasiswa.create',
    'store' => 'mahasiswa.store',
    'show' => 'mahasiswa.show',
    'edit' => 'mahasiswa.edit',
    'update' => 'mahasiswa.update',
    'destroy' => 'mahasiswa.destroy'
]);

// DASHBOARD ADMIN
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GOOGLE OAUTH (Socialite)
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('login.google.redirect');
Route::get('/auth/google/callback',  [GoogleController::class, 'callback'])->name('login.google.callback');

Route::get('/auth/google', function (\Illuminate\Http\Request $request) {
    $qs = $request->getQueryString();
    $url = route('login.google.redirect') . ($qs ? ('?' . $qs) : '');
    return redirect($url);
})->name('auth.google.compat');

// OPTIONAL: fallback route (letakkan fallback di paling bawah jika digunakan)
// Route::fallback(function() { return view('errors.404'); });
