@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Register Mahasiswa Baru</h2>

    <form id="register-mahasiswa-form" method="POST" action="{{ route('dosen.mahasiswa.store') }}" novalidate>
        @csrf
        <div class="mb-3">
            <label for="nim">NIM</label>
            <input type="text" name="nim" class="form-control" required>
            <div class="error-message" style="display:none;"></div>
        </div>
        <div class="mb-3">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" name="full_name" class="form-control" required>
            <div class="error-message" style="display:none;"></div>
        </div>
        <div class="mb-3">
            <label for="tahun_masuk">Tahun Masuk</label>
            <input type="number" name="tahun_masuk" class="form-control" min="1900" max="2100" required>
            <div class="error-message" style="display:none;"></div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="{{ route('dosen.mycourses') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('register-mahasiswa-form').addEventListener('submit', function(event) {
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

    // Validate NIM
    let nimInput = form.querySelector('input[name="nim"]');
    if (!nimInput.value.trim()) {
        valid = false;
        nimInput.classList.add('is-invalid');
        nimInput.nextElementSibling.style.display = 'block';
        nimInput.nextElementSibling.textContent = 'NIM wajib diisi.';
    }

    // Validate full_name
    let nameInput = form.querySelector('input[name="full_name"]');
    if (!nameInput.value.trim()) {
        valid = false;
        nameInput.classList.add('is-invalid');
        nameInput.nextElementSibling.style.display = 'block';
        nameInput.nextElementSibling.textContent = 'Nama lengkap wajib diisi.';
    }

    // Validate tahun_masuk
    let tahunInput = form.querySelector('input[name="tahun_masuk"]');
    let tahunValue = parseInt(tahunInput.value, 10);
    if (!tahunInput.value.trim() || isNaN(tahunValue) || tahunValue < 1900 || tahunValue > 2100) {
        valid = false;
        tahunInput.classList.add('is-invalid');
        tahunInput.nextElementSibling.style.display = 'block';
        tahunInput.nextElementSibling.textContent = 'Tahun masuk harus antara 1900 dan 2100.';
    }

    if (valid) {
        form.submit();
    }
});
</script>
@endsection
