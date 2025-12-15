@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Pengabdian</div>
        <div class="card-body">
            <form action="{{ route('pengabdians.update', $pengabdian) }}" method="POST">
                @method('PUT')
                @include('pengabdians._form')
            </form>
        </div>
    </div>
</div>
@endsection
