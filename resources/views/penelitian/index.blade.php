{{-- resources/views/penelitian/index.blade.php --}}
@extends('layouts.app')
@section('title','Research List')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800">Research List</h2>
            <p class="text-sm text-gray-500 mt-1">Research and Community Service Information System</p>
        </div>

        <div class="flex items-center gap-3">
            <input id="search" type="search" placeholder="Search title, field, lecturer..." class="px-3 py-2 border rounded-lg shadow-sm" />

            {{-- Download Excel (requires maatwebsite/excel) --}}
            <a href="{{ route('penelitian.export') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                📥 Download Excel
            </a>

            {{-- Download CSV (fallback) --}}
            <a href="{{ route('penelitian.export.csv') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                📄 Download CSV
            </a>

            <a href="{{ route('penelitian.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                New
            </a>
        </div>
    </div>

    {{-- Card / Table --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-4 border-b">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">Showing <span class="font-medium">{{ $penelitians->count() }}</span> of <span class="font-medium">{{ $penelitians->total() }}</span> results</div>
                <div class="text-xs text-gray-400">Updated: {{ now()->format('d M Y') }}</div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="penelitian-table" class="min-w-full divide-y">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="p-4 w-12">#</th>
                        <th class="p-4">Title</th>
                        <th class="p-4 w-48">Field</th>
                        <th class="p-4 w-48">Lecturer</th>
                        <th class="p-4 w-32">Status</th>
                        <th class="p-4 w-36">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y">
                    @forelse($penelitians as $p)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-gray-600">
                            {{ $loop->iteration + ($penelitians->currentPage()-1)*$penelitians->perPage() }}
                        </td>

                        <td class="p-4">
                            <div class="font-medium text-gray-800">{{ \Illuminate\Support\Str::limit($p->judul, 80) }}</div>

                            {{-- Aman: parse tanggal dalam blok PHP --}}
                            @php
                                $mulai = '-';
                                $selesai = null;

                                try {
                                    if (!empty($p->tanggal_mulai)) {
                                        $mulai = \Illuminate\Support\Carbon::parse($p->tanggal_mulai)->format('d M Y');
                                    }
                                } catch (\Exception $e) {
                                    $mulai = $p->tanggal_mulai;
                                }

                                try {
                                    if (!empty($p->tanggal_selesai)) {
                                        $selesai = \Illuminate\Support\Carbon::parse($p->tanggal_selesai)->format('d M Y');
                                    }
                                } catch (\Exception $e) {
                                    $selesai = $p->tanggal_selesai;
                                }
                            @endphp

                            <div class="text-xs text-gray-400 mt-1">
                                {{ $mulai }}
                                @if($selesai)
                                    — {{ $selesai }}
                                @endif
                            </div>
                        </td>

                        <td class="p-4 text-sm text-gray-700">{{ $p->bidang }}</td>

                        <td class="p-4 text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-semibold text-sm">
                                    {{ optional($p->dosen)->name ? strtoupper(substr(optional($p->dosen)->name,0,1)) : '-' }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800 text-sm">{{ optional($p->dosen)->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-400">{{ optional($p->dosen)->nidn ?? '' }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="p-4">
                            @if($p->status == 'Aktif')
                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $p->status }}</span>
                            @elseif(in_array($p->status, ['Selesai','Finished']))
                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Finished</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">{{ $p->status }}</span>
                            @endif
                        </td>

                        <td class="p-4 text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('penelitian.edit', $p->id) }}" class="text-indigo-600 hover:underline">Edit</a>

                                <form action="{{ route('penelitian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this research?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Wipe</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-500">
                            No research found. <a href="{{ route('penelitian.create') }}" class="text-indigo-600 hover:underline">Add new research</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t bg-gray-50 flex items-center justify-between">
            <div class="text-sm text-gray-600">Page {{ $penelitians->currentPage() }} of {{ $penelitians->lastPage() }}</div>
            <div>
                {{ $penelitians->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search');
    const tableBody = document.querySelector('#penelitian-table tbody');

    if (!input || !tableBody) return;

    input.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        Array.from(tableBody.rows).forEach(row => {
            const title = row.cells[1]?.innerText.toLowerCase() || '';
            const field = row.cells[2]?.innerText.toLowerCase() || '';
            const lecturer = row.cells[3]?.innerText.toLowerCase() || '';
            row.style.display = (title.includes(q) || field.includes(q) || lecturer.includes(q)) ? '' : 'none';
        });
    });
});
</script>
@endpush

@endsection
