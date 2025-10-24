@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-3xl font-extrabold text-gray-800">
                SIP3D - Dashboard Mahasiswa
            </h1>

            {{-- Tombol Kembali sejajar dengan judul --}}
            <button type="button"
                onclick="history.back()"
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-sm transition">
                Kembali
            </button>
        </div>

        <p class="text-gray-500 text-lg mb-12">
            Upload dokumentasi foto dan video penelitian serta pengabdian masyarakat
        </p>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-14">
            <div class="bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <div class="flex flex-col items-center">
                    <div class="bg-green-100 text-green-600 p-5 rounded-full mb-3">
                        <i class="fa-solid fa-image text-4xl"></i>
                    </div>
                    <p class="text-4xl font-bold">0</p>
                    <p class="text-gray-500 text-lg mt-2">Foto Dokumentasi</p>
                </div>
            </div>

            <div class="bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <div class="flex flex-col items-center">
                    <div class="bg-purple-100 text-purple-600 p-5 rounded-full mb-3">
                        <i class="fa-solid fa-video text-4xl"></i>
                    </div>
                    <p class="text-4xl font-bold">0</p>
                    <p class="text-gray-500 text-lg mt-2">Video Dokumentasi</p>
                </div>
            </div>

            <div class="bg-white p-10 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <div class="flex flex-col items-center">
                    <div class="bg-blue-100 text-blue-600 p-5 rounded-full mb-3">
                        <i class="fa-solid fa-file text-4xl"></i>
                    </div>
                    <p class="text-4xl font-bold">0</p>
                    <p class="text-gray-500 text-lg mt-2">Total Dokumentasi</p>
                </div>
            </div>
        </div>

        <!-- Upload Section -->
        <div class="bg-white p-12 rounded-2xl shadow-lg hover:shadow-2xl transition max-w-3xl mx-auto">
            <div class="flex flex-col items-center text-center">
                <div class="bg-blue-100 text-blue-600 p-5 rounded-full mb-5">
                    <i class="fa-solid fa-cloud-arrow-up text-4xl"></i>
                </div>
                <h2 class="text-2xl font-semibold mb-4">Upload Dokumentasi</h2>
                <p class="text-gray-500 mb-8 text-lg">
                    Upload foto dan video dokumentasi kegiatan penelitian dan pengabdian masyarakat
                </p>

                <form action="#" method="POST" enctype="multipart/form-data" class="w-full">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-lg font-medium mb-2">Judul Dokumentasi</label>
                        <input type="text" name="judul"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                            placeholder="Masukkan judul dokumentasi...">
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-lg font-medium mb-2">Upload File</label>
                        <input type="file" name="file"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-lg cursor-pointer focus:ring-2 focus:ring-indigo-400 outline-none">
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg px-8 py-3 rounded-xl w-full transition">
                        Upload Sekarang
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
