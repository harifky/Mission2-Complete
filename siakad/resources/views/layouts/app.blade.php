<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIAKAD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(auth()->user()->role === 'mahasiswa')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('mahasiswa.dashboard') || request()->routeIs('mahasiswa.courses.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-journal-bookmark"></i> Mata Kuliah
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ request()->routeIs('mahasiswa.courses.index') ? 'active' : '' }}" href="{{ route('mahasiswa.courses.index') }}">Daftar MK</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('mahasiswa.courses.selection') ? 'active' : '' }}" href="{{ route('mahasiswa.courses.selection') }}">Pilih MK</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('mahasiswa.courses.my') ? 'active' : '' }}" href="{{ route('mahasiswa.courses.my') }}">MK Saya</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('mahasiswa.courses.transkrip') ? 'active' : '' }}" href="{{ route('mahasiswa.courses.transkrip') }}">Transkrip</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                        @elseif(auth()->user()->role === 'dosen')
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}" href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('dosen.mycourses') || request()->routeIs('dosen.courses.*') ? 'active' : '' }}" href="{{ route('dosen.mycourses') }}">MK yang Diampu</a></li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="border:none;cursor:pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Tambahkan Bootstrap JS dan yield untuk scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>