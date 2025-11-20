@extends('layouts.app')
@section('title', 'Community Service Data')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 shadow rounded-lg">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Community Service Data</h1>

        <div class="flex items-center gap-3">
            <!-- DOWNLOAD EXCEL -->
            <a href="{{ route('pengabdian.export') }}"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
               Download Excel
            </a>

            <!-- ADD BUTTON -->
            <a href="{{ route('pengabdian.create') }}" 
               class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
               + Add Devotion
            </a>
        </div>
    </div>

    @if($pengabdian->isEmpty())
        <div class="p-6 bg-yellow-50 border border-yellow-200 rounded">
            No data found.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-orange-100">
                        <th class="border p-2 text-left">No</th>
                        <th class="border p-2 text-left">Activity Name</th>
                        <th class="border p-2 text-left">Type</th>
                        <th class="border p-2 text-left">Start Date</th>
                        <th class="border p-2 text-left">Location</th>
                        <th class="border p-2 text-left">Description</th>
                        <th class="border p-2 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pengabdian as $row)
                        <tr>
                            <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $row->nama_kegiatan ?? '-' }}</td>
                            <td class="border p-2">{{ $row->jenis_kegiatan ?? '-' }}</td>
                            <td class="border p-2">{{ $row->tanggal_mulai ?? '-' }}</td>
                            <td class="border p-2">{{ $row->lokasi ?? '-' }}</td>
                            <td class="border p-2">{{ $row->deskripsi ?? '-' }}</td>

                            <td class="border p-2 text-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('pengabdian.edit', $row) }}" 
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('pengabdian.destroy', $row) }}" 
                                      method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Wipe
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
