@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Dosen</h2>
    <p>Halo, {{ auth()->user()->full_name }}!</p>

    <a href="{{ route('dosen.mycourses') }}" class="btn btn-primary mt-3">Lihat Mata Kuliah Saya</a>
</div>
@endsection
