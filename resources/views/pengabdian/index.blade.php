@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <!-- tetap gunakan route() untuk create karena itu tidak punya parameter -->
        <a href="{{ route('pengabdians.create') }}" class="btn btn-primary">Tambah Pengabdian</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Ketua</th>
                        <th>Status</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->judul ?? '-', 60) }}</td>
                        <td>{{ $item->ketua->nama ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                        <td>{{ $item->tahun ?? '-' }}</td>
                        <td>
                            @if(!empty($item->id))
                                <!-- Bangun URL manual supaya tidak bergantung pada route parameter naming -->
                                <a href="{{ url('/pengabdian/' . $item->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ url('/pengabdian/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ url('/pengabdian/' . $item->id) }}" method="POST"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>
</div>
@endsection
