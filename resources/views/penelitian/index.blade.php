@extends('layouts.app')

@section('title', 'Data Penelitian | SIP3D')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-10 px-6">

    <!-- ✨ Header -->
    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-indigo-700 mb-3">📖 Data Penelitian</h1>
        <p class="text-gray-600 text-lg">Daftar penelitian dosen Politeknik Negeri Tanah Laut</p>
    </div>

    <!-- 🔍 Search & Tambah -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 max-w-6xl mx-auto gap-4">
        <div class="relative w-full md:w-1/3">
            <input type="text" placeholder="🔎 Cari judul penelitian..." 
                   class="w-full rounded-full border border-gray-300 pl-12 pr-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm bg-white/80 backdrop-blur-sm">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-3 text-gray-400"></i>
        </div>

        <a href="{{ route('penelitian.create') }}" 
           class="bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white px-6 py-2.5 rounded-full shadow-lg transition-all duration-300 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah Penelitian
        </a>
    </div>

    <!-- 🌿 Grid Penelitian -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @forelse($penelitian as $p)
        <div class="bg-white/90 backdrop-blur-md border border-gray-100 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 p-6 relative overflow-hidden group">
            
            <!-- 💡 Background gradient kecil -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 to-blue-400"></div>

            <!-- 📘 Judul -->
            <h2 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition">
                {{ $p->judul }}
            </h2>

            <!-- 🧭 Bidang -->
            <p class="text-sm text-gray-500 mb-4">
                <i class="fa-solid fa-tags text-indigo-500"></i> {{ $p->bidang }}
            </p>

            <!-- 📅 Tanggal -->
            <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                <span><i class="fa-solid fa-calendar-days text-indigo-500"></i> {{ $p->tanggal_mulai }}</span>
                <span><i class="fa-solid fa-hourglass-end text-indigo-500"></i> {{ $p->tanggal_selesai }}</span>
            </div>

            <!-- 🏷️ Status -->
            <div class="mb-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                    {{ $p->status == 'Selesai' ? 'bg-green-100 text-green-700' : 
                       ($p->status == 'Berjalan' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                    {{ $p->status }}
                </span>
            </div>

            <!-- ⚙️ Aksi -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('penelitian.edit', $p->id) }}" 
                   class="bg-yellow-400 hover:bg-yellow-500 text-white p-2 rounded-full transition shadow">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <form action="{{ route('penelitian.destroy', $p->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition shadow">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20 text-gray-500">
            <i class="fa-solid fa-flask text-6xl text-indigo-400 mb-4"></i>
            <p class="text-lg font-medium">Belum ada data penelitian yang terdaftar</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
