@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-6">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Judul Halaman --}}
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Administrator Dashboard</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-sm">
                    Logout
                </button>
            </form>
        </div>

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow p-6 text-center border-t-4 border-blue-500">
                <p class="text-4xl font-bold text-blue-600">45</p>
                <p class="text-gray-600">Total Dosen</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center border-t-4 border-yellow-500">
                <p class="text-4xl font-bold text-yellow-600">78</p>
                <p class="text-gray-600">Total Penelitian</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center border-t-4 border-red-500">
                <p class="text-4xl font-bold text-red-600">32</p>
                <p class="text-gray-600">Total Pengabdian</p>
            </div>
        </div>

        {{-- Menu Kelola --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $menus = [
                    [
                        'title' => 'Kelola Dosen',
                        'desc' => 'Tambah, edit, dan hapus data dosen',
                        'color' => 'blue',
                        'route' => route('dosen.index'),
                    ],
                    [
                        'title' => 'Kelola Penelitian',
                        'desc' => 'Monitor dan kelola data penelitian',
                        'color' => 'gray',
                        'route' => route('penelitian.index'),
                    ],
                    [
                        'title' => 'Kelola Pengabdian',
                        'desc' => 'Monitor dan kelola data pengabdian',
                        'color' => 'yellow',
                        'route' => route('pengabdian.index'),
                    ],
                    [
                        'title' => 'Kelola Prestasi',
                        'desc' => 'Monitor dan kelola data prestasi',
                        'color' => 'red',
                        'route' => route('prestasi.index'),
                    ],
                ];
            @endphp

            @foreach ($menus as $menu)
            <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition duration-300 border-t-4 border-{{ $menu['color'] }}-500">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $menu['title'] }}</h2>
                <p class="text-gray-500 mb-4">{{ $menu['desc'] }}</p>
                <a href="{{ $menu['route'] }}" class="block text-center bg-{{ $menu['color'] }}-500 text-white py-2 rounded-lg hover:bg-{{ $menu['color'] }}-600 transition">
                    Kelola
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
