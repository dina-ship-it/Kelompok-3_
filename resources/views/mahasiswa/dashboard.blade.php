@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @php
        // kalau controller belum kirim, biar nggak error
        $penelitians = $penelitians ?? collect();
    @endphp

    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">SIP3D - Dashboard Mahasiswa</h3>
            <small class="text-muted">
                Upload dokumentasi foto dan video kegiatan penelitian serta pengabdian masyarakat.
            </small>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
            Kembali
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kartu statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#e9f9ef;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-image" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ $fotoCount ?? 0 }}</h3>
                    <small class="text-muted">Foto Dokumentasi</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#f3e9ff;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-camera-video" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ $videoCount ?? 0 }}</h3>
                    <small class="text-muted">Video Dokumentasi</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;background:#e9f1ff;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-file-earmark-text" style="font-size:2rem;"></i>
                    </div>
                    <h3 class="mb-0">{{ ($fotoCount ?? 0) + ($videoCount ?? 0) }}</h3>
                    <small class="text-muted">Total Dokumentasi</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Penelitian yang ditugaskan --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h4 class="mb-0">Penelitian yang Ditugaskan</h4>
            <small class="text-muted">
                Daftar penelitian di mana Anda menjadi penanggung jawab dokumentasi.
            </small>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        @if($penelitians->isEmpty())
            <div class="card-body">
                <div class="alert alert-info mb-0">
                    Belum ada penelitian yang menugaskan Anda sebagai mahasiswa dokumentasi.
                </div>
            </div>
        @else
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Judul Penelitian</th>
                                <th style="width:180px;">Ketua Penelitian (Dosen)</th>
                                <th style="width:150px;">Bidang</th>
                                <th style="width:80px;">Tahun</th>
                                <th style="width:110px;">Status</th>
                                <th class="text-end" style="width:170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penelitians as $penelitian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">
                                        {{ $penelitian->judul }}
                                    </td>
                                    <td>
                                        {{ optional($penelitian->dosen)->nama ?? $penelitian->ketua_manual ?? '-' }}
                                    </td>
                                    <td>{{ $penelitian->bidang ?? '-' }}</td>
                                    <td class="text-center">{{ $penelitian->tahun ?? '-' }}</td>
                                    <td class="text-center">{{ $penelitian->status ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('mahasiswa.dokumentasi.create', $penelitian->id) }}"
                                           class="btn btn-sm btn-primary">
                                            Upload Dokumentasi
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
