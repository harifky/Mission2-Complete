@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Mata Kuliah Saya</h2>

    @if($courses->isEmpty())
        <p>Anda belum mengambil mata kuliah apapun.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>Dosen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->kode_mk }}</td>
                        <td>{{ $course->nama_mk }}</td>
                        <td>{{ $course->dosen->user->full_name }}</td>
                        <td>
                            <form method="POST" action="{{ route('mahasiswa.courses.unenroll', $course->id) }}" class="unenroll-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm unenroll-btn" data-course-name="{{ $course->nama_mk }}" data-course-sks="{{ $course->sks }}">
                                    Unenroll
                                </button>
                            </form>
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
    const unenrollForms = document.querySelectorAll('.unenroll-form');
    unenrollForms.forEach(form => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const button = form.querySelector('.unenroll-btn');
            const courseName = button.getAttribute('data-course-name');
            const courseSks = button.getAttribute('data-course-sks');
            const confirmed = confirm(`Apakah Anda yakin ingin membatalkan mata kuliah:\n\n${courseName} (${courseSks} SKS)?`);
            if (confirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
