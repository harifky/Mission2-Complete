@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Mahasiswa</h2>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Selamat Datang, {{ auth()->user()->full_name }}</h5>
                    <p class="card-text">Username: {{ auth()->user()->username }}</p>
                    <h6 id="greeting" class="mb-2"></h6>
                    <p id="clock" class="fs-5"></p>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="btn btn-danger">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Menu Cepat</h5>
                    <div class="list-group">
                        <a href="{{ route('mahasiswa.courses.index') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-book"></i> Daftar Mata Kuliah
                        </a>
                        <a href="{{ route('mahasiswa.courses.selection') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-pencil-square"></i> Pilih Mata Kuliah
                        </a>
                        <a href="{{ route('mahasiswa.courses.my') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-journal-check"></i> Mata Kuliah Saya
                        </a>
                        <a href="{{ route('mahasiswa.courses.transkrip') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-file-earmark-text"></i> Transkrip
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Greeting otomatis
    const greetingEl = document.getElementById('greeting');
    const clockEl = document.getElementById('clock');

    function updateGreeting() {
        let hour = new Date().getHours();
        let greet = "Selamat Malam";
        if (hour >= 5 && hour < 12) greet = "Selamat Pagi";
        else if (hour >= 12 && hour < 15) greet = "Selamat Siang";
        else if (hour >= 15 && hour < 18) greet = "Selamat Sore";
        greetingEl.textContent = greet;
    }

    function updateClock() {
        let now = new Date();
        clockEl.textContent = now.toLocaleTimeString();
    }

    updateGreeting();
    updateClock();
    setInterval(() => {
        updateClock();
    }, 1000);
});
</script>
