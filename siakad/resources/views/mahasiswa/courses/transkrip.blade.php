@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Transkrip Nilai</h2>

    @if($courses->isEmpty())
        <p>Anda belum mengambil mata kuliah apapun.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>Dosen</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    @php
                        $enrollment = $course->enrollments->first();
                    @endphp
                    <tr>
                        <td>{{ $course->kode_mk }}</td>
                        <td>{{ $course->nama_mk }}</td>
                        <td>{{ $course->dosen->user->full_name }}</td>
                        <td>{{ $enrollment->nilai ?? '-' }}</td>
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
    let nilaiCells = document.querySelectorAll('table tbody tr td:nth-child(4)');
    let total = 0, count = 0;

    nilaiCells.forEach(cell => {
        if (cell.textContent.trim() !== '-' && !isNaN(cell.textContent)) {
            total += parseFloat(cell.textContent);
            count++;
        }
    });

    if (count > 0) {
        let rata = (total / count).toFixed(2);

        // Tambahkan row baru di bawah tabel
        let tbody = document.querySelector('table tbody');
        let tr = document.createElement('tr');
        tr.innerHTML = `<td colspan="3"><b>Rata-rata Nilai</b></td><td><b>${rata}</b></td>`;
        tbody.appendChild(tr);
    }
});
</script>
@endsection
