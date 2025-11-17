@extends('layouts.app')
@section('title', 'Tambah Penelitian')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Penelitian</h1>

    <form action="{{ route('penelitian.store') }}" method="POST" class="space-y-3">
        @csrf

        {{-- FIX: tambahkan dosen_id --}}
        <input type="hidden" name="dosen_id" value="{{ auth()->id() }}">

        <input type="text" name="judul" placeholder="Judul Penelitian" class="w-full border p-2 rounded" required>
        <input type="text" name="bidang" placeholder="Bidang" class="w-full border p-2 rounded" required>
        <input type="date" name="tanggal_mulai" class="w-full border p-2 rounded" required>
        <input type="date" name="tanggal_selesai" class="w-full border p-2 rounded">
        
        <select name="status" class="w-full border p-2 rounded">
            <option value="Aktif">Aktif</option>
            <option value="Selesai">Selesai</option>
            <option value="Dibatalkan">Dibatalkan</option>
        </select>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
