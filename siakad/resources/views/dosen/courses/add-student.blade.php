@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tambah Mahasiswa ke Mata Kuliah: {{ $course->nama_mk }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="add-student-form" method="POST" action="{{ route('dosen.courses.storeStudent', $course->id) }}" novalidate>
        @csrf
        <div class="mb-3">
            <label for="mahasiswa_id">Pilih Mahasiswa</label>
            <select name="mahasiswa_id" class="form-control" required>
                <option value="">-- pilih mahasiswa --</option>
                @foreach($mahasiswas as $mhs)
                    <option value="{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->user->full_name }}</option>
                @endforeach
            </select>
            <div class="error-message" style="display:none;"></div>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
        <a href="{{ route('dosen.courses.students',$course->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('add-student-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let form = this;
    let valid = true;

    // Clear previous errors
    form.querySelectorAll('.error-message').forEach(el => {
        el.style.display = 'none';
        el.textContent = '';
    });
    form.querySelectorAll('.form-control').forEach(el => {
        el.classList.remove('is-invalid');
    });

    // Validate mahasiswa_id
    let mahasiswaSelect = form.querySelector('select[name="mahasiswa_id"]');
    if (!mahasiswaSelect.value) {
        valid = false;
        mahasiswaSelect.classList.add('is-invalid');
        mahasiswaSelect.nextElementSibling.style.display = 'block';
        mahasiswaSelect.nextElementSibling.textContent = 'Silakan pilih mahasiswa.';
    }

    if (valid) {
        form.submit();
    }
});
</script>
@endsection
