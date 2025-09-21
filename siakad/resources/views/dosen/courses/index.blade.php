@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Mata Kuliah yang Diampu</h2>

    @if($courses->isEmpty())
    <p>Anda belum mengampu mata kuliah apapun.</p>
    @else

    <a href="{{ route('dosen.courses.create') }}" class="btn btn-success mb-3">+ Tambah Mata Kuliah</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Jumlah Mahasiswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->kode_mk }}</td>
                <td>{{ $course->nama_mk }}</td>
                <td>{{ $course->mahasiswas_count }}</td>
                <td>
                    <a href="{{ route('dosen.courses.students', $course->id) }}" class="btn btn-sm btn-info">Mahasiswa</a>
                    <a href="{{ route('dosen.courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dosen.courses.destroy', $course->id) }}"
                        method="POST"
                        class="form-destroy d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
    document.querySelectorAll('.form-destroy').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let row = this.closest('tr');
            let namaMK = row.querySelector('td:nth-child(2)').textContent;
            let jumlah = row.querySelector('td:nth-child(3)').textContent;

            if (confirm(`Yakin ingin hapus MK: ${namaMK} (Jumlah Mahasiswa: ${jumlah})?`)) {
                this.submit();
            }
        });
    });
});
</script>
@endsection
