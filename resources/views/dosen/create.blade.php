@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Tambah Dosen</h2>

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf
        @include('dosen.partials.form', ['button' => 'Simpan'])
    </form>
</div>
@endsection
