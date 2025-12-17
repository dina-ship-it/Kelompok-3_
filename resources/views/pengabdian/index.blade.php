@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h4>Daftar Pengabdian</h4>
        <a href="{{ route('pengabdians.create') }}" class="btn btn-primary">
            + Tambah Pengabdian
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Bidang</th>
                        <th>Ketua</th>
                        <th>Anggota</th>
                        <th>Mahasiswa</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pengabdians as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->bidang }}</td>
                        <td>{{ $p->ketua_pengabdian }}</td>
                        <td>{{ $p->anggota }}</td>
                        <td>{{ $p->mahasiswa_dokumentasi }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->status }}</td>
                        <td>
                            <a href="{{ route('pengabdians.edit', $p->id) }}"
                               class="btn btn-sm btn-warning">Ubah</a>

                            <form action="{{ route('pengabdians.destroy', $p->id) }}"
                                  method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus data?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            Belum ada data
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
