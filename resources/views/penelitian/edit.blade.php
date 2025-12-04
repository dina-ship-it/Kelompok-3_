@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{ route('penelitian.update', $penelitian) }}" method="POST">
        @csrf
        @method('PUT')
        @include('penelitian._form')
    </form>
</div>
@endsection
