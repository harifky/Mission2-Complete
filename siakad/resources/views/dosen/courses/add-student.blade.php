@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Mahasiswa ke Mata Kuliah: {{ $course->nama_mk }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dosen.courses.storeStudent', $course->id) }}">
        @csrf
        <div class="mb-3">
            <label for="mahasiswa_id">Pilih Mahasiswa</label>
            <select name="mahasiswa_id" class="form-control" required>
                <option value="">-- pilih mahasiswa --</option>
                @foreach($mahasiswas as $mhs)
                    <option value="{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->user->full_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
        <a href="{{ route('dosen.courses.students',$course->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
