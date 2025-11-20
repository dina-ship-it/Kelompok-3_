@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Penelitian</h1>

    @if($errors->any())
      <div>
        <ul>
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('penelitian.store') }}">
        @csrf

        <!-- contoh: pilih dosen melalui select -->
        <div>
            <label for="dosen_id">Dosen</label>
            <select name="dosen_id" id="dosen_id" required>
                <!--
                    Ganti opsi di bawah dengan loop data dosen dari DB:
                    @foreach($dosens as $dosen)
                      <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                    @endforeach
                -->
                <option value="1">Dosen 1</option>
                <option value="2">Dosen 2</option>
            </select>
        </div>

        <div>
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required>
        </div>

        <div>
            <label for="bidang">Bidang</label>
            <input type="text" name="bidang" id="bidang" value="{{ old('bidang') }}">
        </div>

        <div>
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
        </div>

        <div>
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
        </div>

        <div>
            <label for="status">Status</label>
            <input type="text" name="status" id="status" value="{{ old('status') }}">
        </div>

        <div>
            <label for="peneliti">Peneliti</label>
            <input type="text" name="peneliti" id="peneliti" value="{{ old('peneliti') }}">
        </div>

        <div>
            <label for="tahun">Tahun</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun') }}">
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
