@extends('layouts.app')
@section('title', 'Add Community Service')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 shadow rounded-lg">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add Community Service</h1>

        <a href="{{ route('pengabdian.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            ← Back to List
        </a>
    </div>

    {{-- tampilkan error validasi kalau ada --}}
    @if ($errors->any())
        <div class="mb-4 p-4 border border-red-200 bg-red-50 rounded">
            <p class="font-semibold text-red-700 mb-2">Please fix the errors below:</p>
            <ul class="list-disc list-inside text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengabdian.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Activity Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Activity Name
            </label>
            <input type="text" name="nama_kegiatan"
                   value="{{ old('nama_kegiatan') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        {{-- Type --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Type
            </label>
            <input type="text" name="jenis_kegiatan"
                   value="{{ old('jenis_kegiatan') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        {{-- Start Date --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Start Date
            </label>
            <input type="date" name="tanggal_mulai"
                   value="{{ old('tanggal_mulai') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        {{-- Location --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Location
            </label>
            <input type="text" name="lokasi"
                   value="{{ old('lokasi') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Description
            </label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Submit --}}
        <div class="pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
                Save
            </button>
        </div>
    </form>

</div>
@endsection
