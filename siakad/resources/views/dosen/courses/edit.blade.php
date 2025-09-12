@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Mata Kuliah</h2>

    <form method="POST" action="{{ route('dosen.courses.update', $course->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Kode MK</label>
            <input type="text" class="form-control" value="{{ $course->kode_mk }}" disabled>
        </div>
        <div class="mb-3">
            <label>Nama MK</label>
            <input type="text" name="nama_mk" class="form-control" value="{{ $course->nama_mk }}" required>
        </div>
        <div class="mb-3">
            <label>SKS</label>
            <input type="number" name="sks" class="form-control" value="{{ $course->sks }}" min="1" max="6">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dosen.mycourses') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
