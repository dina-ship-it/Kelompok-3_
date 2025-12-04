@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{ route('penelitian.store') }}" method="POST">
        @csrf
        @include('penelitian._form')
    </form>
</div>
@endsection
