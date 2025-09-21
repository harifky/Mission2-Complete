@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Mata Kuliah</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($courses->isEmpty())
    <p>Belum ada mata kuliah tersedia.</p>
    @else
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Dosen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->kode_mk }}</td>
                <td>{{ $course->nama_mk }}</td>
                <td>{{ $course->dosen->user->full_name }}</td>
                <td>
                    @if($course->mahasiswas->contains(auth()->user()->mahasiswa))
                    <button class="btn btn-sm btn-success" disabled>Sudah Enroll</button>
                    @else
                    <form method="POST" action="{{ route('mahasiswa.courses.enroll', $course->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Enroll</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua form enroll
        document.querySelectorAll('form[action*="enroll"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // stop submit default

                let row = this.closest('tr');
                let namaMK = row.querySelector('td:nth-child(2)').textContent;
                let dosen = row.querySelector('td:nth-child(3)').textContent;

                if (confirm(`Apakah kamu yakin ingin enroll ke MK: ${namaMK} (Dosen: ${dosen})?`)) {
                    row.style.backgroundColor = "#d4edda"; // hijau muda
                    this.submit();
                }

            });
        });
    });
</script>
@endsection