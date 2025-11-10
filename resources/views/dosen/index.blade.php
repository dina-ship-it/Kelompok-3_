@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e0f7fa, #e3f2fd);
    }
    .card {
        background: #ffffffd9;
        backdrop-filter: blur(8px);
        border: none;
        border-radius: 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background: linear-gradient(135deg, #4b6cb7, #182848);
        color: #fff;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-header h4 {
        margin: 0;
        font-weight: bold;
    }
    .btn-tambah {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        border: none;
        border-radius: 10px;
        color: #fff;
        padding: 8px 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-tambah:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 176, 155, 0.3);
    }
    .btn-excel {
        background: linear-gradient(135deg, #1fae2b, #2bb673);
        border: none;
        border-radius: 10px;
        color: #fff;
        padding: 8px 12px;
        font-weight: 600;
        margin-right: 8px;
    }
    .btn-excel:hover {
        transform: scale(1.03);
        box-shadow: 0 5px 12px rgba(34, 139, 34, 0.18);
    }
    .table thead {
        background-color: #f1f5f9;
        font-weight: bold;
        color: #374151;
    }
    .table tbody tr:hover {
        background-color: #f8fafc;
        transition: 0.2s;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
    }
    .empty-state img {
        width: 160px;
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    /* Small responsive tweak */
    @media (max-width: 576px) {
        .card-header { flex-direction: column; gap: 0.75rem; align-items: flex-start; }
        .card-header .actions { display:flex; gap:0.5rem; }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4>📚 Data Dosen</h4>

                    {{-- TOMBOL: Unduh Excel + Tambah Dosen --}}
                    <div class="actions">
                        <a href="{{ route('dosen.export') }}" class="btn btn-excel">
                            <i class="bi bi-file-earmark-excel"></i> Unduh Excel
                        </a>

                        <a href="{{ route('dosen.create') }}" class="btn btn-tambah">
                            <i class="bi bi-plus-circle"></i> Tambah Dosen
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($dosen->isEmpty())
                        <div class="empty-state">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Empty Data">
                            <h5 class="fw-bold">Belum ada data dosen</h5>
                            <p>Yuk tambahkan data dosen pertama kamu dengan menekan tombol <b>"Tambah Dosen"</b> di atas! 🌟</p>
                        </div>
                    @else
                        <table class="table align-middle">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($dosen as $index => $dsn)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dsn->nidn }}</td>
                                    <td>{{ $dsn->nama }}</td>
                                    <td>{{ $dsn->email }}</td>
                                    <td>{{ $dsn->fakultas }}</td>
                                    <td>{{ $dsn->prodi }}</td>
                                    <td>
                                        <span class="badge {{ $dsn->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $dsn->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('dosen.edit', $dsn->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('dosen.destroy', $dsn->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Jika menggunakan pagination di controller, tampilkan links --}}
                        @if(method_exists($dosen, 'links'))
                        <div class="mt-3">
                            {{ $dosen->links() }}
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
