@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📚 Data Dosen</h2>

    <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">➕ Tambah Dosen</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>Jabatan</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosens as $i => $dosen)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $dosen->nidn }}</td>
                    <td>{{ $dosen->nama }}</td>
                    <td>{{ $dosen->email }}</td>
                    <td>{{ $dosen->fakultas }}</td>
                    <td>{{ $dosen->prodi }}</td>
                    <td>{{ $dosen->jabatan }}</td>
                    <td>{{ $dosen->tahun }}</td>
                    <td>{{ $dosen->status }}</td>
                    <td>
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
