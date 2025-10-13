@extends('layouts.app')

@section('title', 'SIP2D - Dashboard Dosen')

@section('content')
<div class="bg-white rounded-2xl shadow p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">SIP2D - Dashboard Dosen</h1>
        <div class="flex items-center space-x-3">
            <i class="fa-solid fa-user-circle text-indigo-600 text-xl"></i>
            <span class="font-medium text-gray-700">Dosen</span>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang</h2>
        <p class="text-gray-600">Kelola penelitian, pengabdian, dan prestasi Anda dengan mudah</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white border rounded-xl shadow-sm p-6 text-center hover:shadow-md transition">
            <div class="flex justify-center mb-2">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                    <i class="fa-solid fa-flask text-2xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $data['penelitian'] }}</h3>
            <p class="text-gray-500">Penelitian Aktif</p>
        </div>

        <div class="bg-white border rounded-xl shadow-sm p-6 text-center hover:shadow-md transition">
            <div class="flex justify-center mb-2">
                <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
                    <i class="fa-solid fa-hands-holding-circle text-2xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $data['pengabdian'] }}</h3>
            <p class="text-gray-500">Pengabdian Aktif</p>
        </div>

        <div class="bg-white border rounded-xl shadow-sm p-6 text-center hover:shadow-md transition">
            <div class="flex justify-center mb-2">
                <div class="bg-yellow-100 text-yellow-500 p-3 rounded-full">
                    <i class="fa-solid fa-trophy text-2xl"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $data['prestasi'] }}</h3>
            <p class="text-gray-500">Total Prestasi</p>
        </div>
    </div>

    <!-- Menu & Aktivitas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Menu Utama -->
        <div class="md:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Menu Utama</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Penelitian -->
<div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
    <div class="flex items-center mb-2">
        <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
            <i class="fa-solid fa-flask"></i>
        </div>
        <h4 class="ml-3 font-semibold text-gray-700">Penelitian</h4>
    </div>
    <p class="text-gray-500 text-sm mb-3">Kelola data penelitian Anda</p>
    <a href="{{ route('dosen.penelitian') }}" 
       class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-1 rounded-lg text-sm transition">
       Kelola
    </a>
</div>

<!-- Pengabdian -->
<div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
    <div class="flex items-center mb-2">
        <div class="bg-orange-100 text-orange-500 p-3 rounded-full">
            <i class="fa-solid fa-handshake-angle"></i>
        </div>
        <h4 class="ml-3 font-semibold text-gray-700">Pengabdian</h4>
    </div>
    <p class="text-gray-500 text-sm mb-3">Kelola data pengabdian masyarakat</p>
    <a href="{{ route('dosen.pengabdian') }}" 
       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-1 rounded-lg text-sm transition">
       Kelola
    </a>
</div>

<!-- Prestasi -->
<div class="bg-white border rounded-xl shadow-sm p-5 hover:shadow-md transition">
    <div class="flex items-center mb-2">
        <div class="bg-yellow-100 text-yellow-500 p-3 rounded-full">
            <i class="fa-solid fa-trophy"></i>
        </div>
        <h4 class="ml-3 font-semibold text-gray-700">Prestasi</h4>
    </div>
    <p class="text-gray-500 text-sm mb-3">Kelola data prestasi dan penghargaan</p>
    <a href="{{ route('dosen.prestasi') }}" 
       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded-lg text-sm transition">
       Kelola
    </a>
</div>
