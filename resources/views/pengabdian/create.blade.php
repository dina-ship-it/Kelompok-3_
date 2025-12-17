@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Tambah Data Pengabdian</div>
        <div class="card-body">

            <form action="{{ route('pengabdians.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Judul Pengabdian</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Bidang Pengabdian</label>
                    <input type="text" name="bidang" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Ketua Pengabdian</label>
                    <input type="text"
                           name="ketua_pengabdian"
                           class="form-control"
                           placeholder="Contoh: Dr. Ahmad Fauzi, S.T., M.T"
                           required>
                </div>

                <div class="form-group mt-2">
                    <label>Anggota Pengabdian</label>
                    <textarea name="anggota" class="form-control" required></textarea>
                </div>

                <div class="form-group mt-2">
                    <label>Mahasiswa Dokumentasi</label>
                    <input type="text" name="mahasiswa_dokumentasi" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <div class="form-group mt-2">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Sedang Berjalan">Sedang Berjalan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pengabdians.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
