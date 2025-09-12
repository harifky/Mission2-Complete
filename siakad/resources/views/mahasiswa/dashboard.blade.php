@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Mahasiswa</h2>
    <p>Halo, {{ auth()->user()->full_name }} ({{ auth()->user()->username }})</p>
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       class="btn btn-danger">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection
