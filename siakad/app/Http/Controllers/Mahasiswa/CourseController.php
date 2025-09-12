<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = MataKuliah::with('dosen.user')->get();
        return view('mahasiswa.courses.index', compact('courses'));
    }

    public function enroll(Request $request, $id)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // check existing
        $exists = Enrollment::where('mahasiswa_id', $mahasiswa->id)
            ->where('mata_kuliah_id', $id)
            ->exists();
        if ($exists) {
            return back()->with('error', 'Sudah terdaftar di mata kuliah ini');
        }

        Enrollment::create([
            'mahasiswa_id' => $mahasiswa->id,
            'mata_kuliah_id' => $id
        ]);

        return back()->with('success', 'Berhasil enroll');
    }

    public function myCourses()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $courses = $mahasiswa->mataKuliah()
            ->with(['dosen.user', 'enrollments' => function ($q) use ($mahasiswa) {
                $q->where('mahasiswa_id', $mahasiswa->id);
            }])
            ->get();

        return view('mahasiswa.courses.my', compact('courses'));
    }

    public function transkrip()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $courses = $mahasiswa->mataKuliah()
            ->with(['dosen.user', 'enrollments' => function ($q) use ($mahasiswa) {
                $q->where('mahasiswa_id', $mahasiswa->id);
            }])
            ->get();

        return view('mahasiswa.courses.transkrip', compact('courses'));
    }
}
