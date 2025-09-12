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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
