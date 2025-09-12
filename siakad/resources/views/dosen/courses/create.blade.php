@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Buat Mata Kuliah Baru</h2>

    <form method="POST" action="{{ route('dosen.courses.store') }}">
        @csrf
        <div class="mb-3">
            <label>Kode MK</label>
            <input type="text" name="kode_mk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama MK</label>
            <input type="text" name="nama_mk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>SKS</label>
            <input type="number" name="sks" class="form-control" min="1" max="6">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dosen.mycourses') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
