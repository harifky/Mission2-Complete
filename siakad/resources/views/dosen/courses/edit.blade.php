@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Mata Kuliah</h2>

    <form id="edit-course-form" method="POST" action="{{ route('dosen.courses.update', $course->id) }}" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Kode MK</label>
            <input type="text" class="form-control" value="{{ $course->kode_mk }}" disabled>
        </div>
        <div class="mb-3">
            <label>Nama MK</label>
            <input type="text" name="nama_mk" class="form-control" value="{{ $course->nama_mk }}" required>
            <div class="error-message" style="display:none;"></div>
        </div>
        <div class="mb-3">
            <label>SKS</label>
            <input type="number" name="sks" class="form-control" value="{{ $course->sks }}" min="1" max="6">
            <div class="error-message" style="display:none;"></div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dosen.mycourses') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('edit-course-form').addEventListener('submit', function(event) {
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

    // Validate nama_mk
    let namaMkInput = form.querySelector('input[name="nama_mk"]');
    if (!namaMkInput.value.trim()) {
        valid = false;
        namaMkInput.classList.add('is-invalid');
        namaMkInput.nextElementSibling.style.display = 'block';
        namaMkInput.nextElementSibling.textContent = 'Nama MK wajib diisi.';
    }

    // Validate sks (optional)
    let sksInput = form.querySelector('input[name="sks"]');
    if (sksInput.value) {
        let sksValue = parseInt(sksInput.value, 10);
        if (isNaN(sksValue) || sksValue < 1 || sksValue > 6) {
            valid = false;
            sksInput.classList.add('is-invalid');
            sksInput.nextElementSibling.style.display = 'block';
            sksInput.nextElementSibling.textContent = 'SKS harus antara 1 sampai 6.';
        }
    }

    if (valid) {
        form.submit();
    }
});
</script>
@endsection
