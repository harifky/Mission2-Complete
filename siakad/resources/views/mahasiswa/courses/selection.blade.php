@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Course Selection</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="course-selection-form" method="POST" action="{{ route('mahasiswa.courses.selection.save') }}">
        @csrf
        <div id="course-list-container">
            @foreach($courses as $course)
                <div>
                    <input type="checkbox" id="course-{{ $course->id }}" name="courses[]" value="{{ $course->id }}" data-sks="{{ $course->sks }}"
                    @if(in_array($course->id, $enrolledCourseIds)) checked @endif>
                    <label for="course-{{ $course->id }}">{{ $course->kode_mk }} - {{ $course->nama_mk }} ({{ $course->sks }} SKS)</label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <strong>Total SKS: </strong><span id="total-sks">0</span>
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit</button>
        <div id="form-error" class="text-danger mt-2" style="display:none;"></div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const courseListContainer = document.getElementById('course-list-container');
    const totalSksEl = document.getElementById('total-sks');
    const formErrorEl = document.getElementById('form-error');
    const courseSelectionForm = document.getElementById('course-selection-form');

    // Calculate total SKS of selected courses
    function calculateTotalSks() {
        const checkedBoxes = courseListContainer.querySelectorAll('input[name="courses[]"]:checked');
        let total = 0;
        checkedBoxes.forEach(cb => {
            total += parseInt(cb.getAttribute('data-sks')) || 0;
        });
        totalSksEl.textContent = total;
    }

    // Validate form on submit
    function validateForm() {
        const checkedBoxes = courseListContainer.querySelectorAll('input[name="courses[]"]:checked');
        if (checkedBoxes.length === 0) {
            formErrorEl.textContent = 'Silakan pilih minimal satu mata kuliah.';
            formErrorEl.style.display = 'block';
            courseListContainer.style.border = '1px solid red';
            courseListContainer.style.padding = '10px';
            return false;
        }
        formErrorEl.style.display = 'none';
        courseListContainer.style.border = '';
        courseListContainer.style.padding = '';
        return true;
    }

    // Handle form submit
    courseSelectionForm.addEventListener('submit', (event) => {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Update total SKS when checkboxes change
    courseListContainer.addEventListener('change', (event) => {
        if (event.target.name === 'courses[]') {
            calculateTotalSks();
        }
    });

    // Initial calculation
    calculateTotalSks();
});
</script>
@endsection
