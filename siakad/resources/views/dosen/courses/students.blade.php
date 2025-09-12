@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Mahasiswa di Mata Kuliah: {{ $course->nama_mk }}</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($course->mahasiswas->isEmpty())
    <p>Belum ada mahasiswa yang mengambil mata kuliah ini.</p>
    @else

    <a href="{{ route('dosen.courses.addStudent', $course->id) }}" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tahun Masuk</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->mahasiswas as $mhs)
            @php
            $enrollment = $mhs->enrollments->where('mata_kuliah_id', $course->id)->first();
            @endphp
            <tr>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->user->full_name }}</td>
                <td>{{ $mhs->tahun_masuk }}</td>
                <td>{{ $enrollment->nilai ?? '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('dosen.enrollments.updateNilai', $enrollment->id) }}" class="d-flex">
                        @csrf
                        <input type="text" name="nilai" value="{{ $enrollment->nilai }}" class="form-control form-control-sm me-2" style="width:70px;">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <a href="{{ route('dosen.mycourses') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection