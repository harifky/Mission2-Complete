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
