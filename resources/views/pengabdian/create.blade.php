@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Tambah Data Pengabdian</div>
        <div class="card-body">
            <!-- ganti pengabdian.store -> pengabdians.store -->
            <form action="{{ route('pengabdians.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Ketua Penelitian (Dosen)</label>
                    <select name="ketua_dosen_id" class="form-control">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosens as $d)
                            <option value="{{ $d->id }}" {{ old('ketua_dosen_id') == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- contoh field lain -->
                <div class="form-group mt-2">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
                </div>

                <div class="form-group mt-2">
                    <label>Tahun</label>
                    <input type="text" name="tahun" class="form-control" value="{{ old('tahun') }}">
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/pengabdian') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
