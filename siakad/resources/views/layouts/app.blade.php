<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>SIAKAD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
              <li class="nav-item"><a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('mahasiswa.courses.index') }}">Daftar MK</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('mahasiswa.courses.my') }}">MK Saya</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('mahasiswa.courses.transkrip') }}">Transkrip</a></li>
            @elseif(auth()->user()->role === 'dosen')
              <li class="nav-item"><a class="nav-link" href="{{ route('dosen.dashboard') }}">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('dosen.mycourses') }}">MK yang Diampu</a></li>
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
</body>
</html>
