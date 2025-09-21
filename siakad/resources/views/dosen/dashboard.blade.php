@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Dosen</h2>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h4>Halo, {{ auth()->user()->full_name }} 👋</h4>
                    <p id="greeting" class="mb-2"></p>
                    <p id="clock" class="fw-bold fs-5"></p>
                    <a href="{{ route('dosen.mycourses') }}" class="btn btn-primary mt-2">Lihat Mata Kuliah Saya</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Statistik</h5>
                    <p>Total Mata Kuliah: <strong>{{ $courses->count() }}</strong></p>
                <p>Total Mahasiswa: <strong>{{ $courses->sum('mahasiswas_count') / 2 }}</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-1">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5>Cuaca Hari Ini</h5>
                    <p><strong>Cerah</strong></p>
                    <p>30°C</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5>Quote Hari Ini</h5>
                    <blockquote id="quote" class="fst-italic">"Mengajar adalah belajar dua kali."</blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/sync_async_example.js') }}"></script>
