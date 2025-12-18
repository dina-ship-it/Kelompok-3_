@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Sedikit styling khusus tabel ini --}}
    <style>
        .table-penelitian thead th {
            vertical-align: middle;
            text-align: center;
            font-size: 0.85rem;
            white-space: nowrap;
        }
        .table-penelitian thead th .label-main {
            font-weight: 600;
            display: block;
        }
        .table-penelitian thead th .label-sub {
            font-size: 0.75rem;
            color: #6c757d;
            display: block;
            margin-top: -2px;
        }
        .table-penelitian tbody td {
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .table-penelitian tbody td.col-no,
        .table-penelitian tbody td.col-year,
        .table-penelitian tbody td.col-status {
            text-align: center;
            white-space: nowrap;
        }
        .table-penelitian tbody td.col-title {
            font-weight: 500;
        }
        .table-penelitian tbody td.col-actions {
            text-align: right;
            white-space: nowrap;
        }
    </style>

   {{-- Judul halaman + tombol --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Daftar Penelitian</h3>
        <small class="text-muted">
            Ringkasan data penelitian beserta ketua, anggota, dan mahasiswa dokumentasi.
        </small>
    </div>

    <div class="d-flex gap-2">
        {{-- Tombol Unduh Excel (TAMBAHAN) --}}
        <a href="{{ route('penelitian.export') }}" class="btn btn-success">
            Unduh Excel
        </a>

        {{-- Tombol lama (tidak diubah) --}}
        <a href="{{ route('penelitian.create') }}" class="btn btn-primary">
            + Tambah Penelitian
        </a>
    </div>
</div>


    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-penelitian mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;">
                                <span class="label-main">#</span>
                            </th>
                            <th>
                                <span class="label-main">Judul</span>
                                <span class="label-sub">Penelitian</span>
                            </th>
                            <th>
                                <span class="label-main">Bidang</span>
                            </th>
                            <th>
                                <span class="label-main">Ketua</span>
                                <span class="label-sub">Penelitian</span>
                            </th>
                            <th>
                                <span class="label-main">Anggota</span>
                                <span class="label-sub">Peneliti</span>
                            </th>
                            <th>
                                <span class="label-main">Mahasiswa</span>
                                <span class="label-sub">Dokumentasi</span>
                            </th>
                            <th style="width: 70px;">
                                <span class="label-main">Tahun</span>
                            </th>
                            <th style="width: 110px;">
                                <span class="label-main">Status</span>
                            </th>
                            <th style="width: 180px;">
                                <span class="label-main">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penelitians as $item)
                            <tr>
                                <td class="col-no">
                                    {{ $loop->iteration + ($penelitians->currentPage() - 1) * $penelitians->perPage() }}
                                </td>

                                <td class="col-title">
                                    {{ $item->judul }}
                                </td>

                                <td>
                                    {{ $item->bidang ?? '-' }}
                                </td>

                                {{-- Ketua: dosen jika ada, kalau tidak pakai nama manual --}}
                                <td>
                                    {{ optional($item->dosen)->nama ?? $item->ketua_manual ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->peneliti ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->mahasiswa_dok ?? '-' }}
                                </td>

                                <td class="col-year">
                                    {{ $item->tahun ?? '-' }}
                                </td>

                                <td class="col-status">
                                    {{ $item->status ?? '-' }}
                                </td>

                                <td class="col-actions">
                                    <a href="{{ route('penelitian.show', $item) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        Detail
                                    </a>
                                    <a href="{{ route('penelitian.edit', $item) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Ubah
                                    </a>
                                    <form action="{{ route('penelitian.destroy', $item) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data penelitian ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    Belum ada data penelitian yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($penelitians->hasPages())
            <div class="card-footer">
                {{ $penelitians->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
