@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-indigo-50 flex items-center justify-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white/70 backdrop-blur-lg shadow-2xl rounded-3xl border border-indigo-100 p-8 transition-transform hover:scale-[1.01] duration-300">
        
        <h2 class="text-center text-3xl font-extrabold text-indigo-700 mb-8">
            ✨ Tambah Data Dosen ✨
        </h2>

        <form action="{{ route('dosen.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">NIDN</label>
                    <input type="text" name="nidn" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan NIDN dosen" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan nama lengkap dosen" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan email aktif" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Fakultas</label>
                    <input type="text" name="fakultas" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan fakultas">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Program Studi</label>
                    <input type="text" name="program_studi" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan program studi">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Jabatan Akademik</label>
                    <input type="text" name="jabatan" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan jabatan akademik">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Tahun Masuk</label>
                    <input type="number" name="tahun_masuk" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400" placeholder="Contoh: 2020">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Status</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-400">
                        <option value="">Pilih status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('dosen.index') }}" class="px-5 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-200">
                    ← Kembali
                </a>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 text-white font-semibold shadow-md hover:bg-indigo-700 transition-all duration-200">
                    💾 Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
