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

    // New method: show course selection form
    public function courseSelection()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $courses = MataKuliah::all();
        $enrolledCourseIds = $mahasiswa->mataKuliah()->pluck('mata_kuliah.id')->toArray();
        return view('mahasiswa.courses.selection', compact('courses', 'enrolledCourseIds'));
    }

    // New method: save selected courses
    public function saveCourseSelection(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $selectedCourseIds = $request->input('courses', []);

        if (empty($selectedCourseIds)) {
            return back()->with('error', 'Silakan pilih minimal satu mata kuliah.');
        }

        // Remove existing enrollments not in selected
        Enrollment::where('mahasiswa_id', $mahasiswa->id)
            ->whereNotIn('mata_kuliah_id', $selectedCourseIds)
            ->delete();

        // Add new enrollments
        foreach ($selectedCourseIds as $courseId) {
            Enrollment::firstOrCreate([
                'mahasiswa_id' => $mahasiswa->id,
                'mata_kuliah_id' => $courseId,
            ]);
        }

        return back()->with('success', 'Mata kuliah berhasil disimpan.');
    }

    // New method: unenroll from a course
    public function unenroll($id)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $enrollment = Enrollment::where('mahasiswa_id', $mahasiswa->id)
            ->where('mata_kuliah_id', $id)
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'Anda tidak terdaftar di mata kuliah ini.');
        }

        $enrollment->delete();

        return back()->with('success', 'Berhasil membatalkan mata kuliah.');
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

    public function arrayOfObjectsDemo()
    {
        $mahasiswas = \App\Models\Mahasiswa::withCourses()->get();

        $arrayOfObjects = $mahasiswas->map(function ($mahasiswa) {
            return (object) [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'tahun_masuk' => $mahasiswa->tahun_masuk,
                'courses' => $mahasiswa->mataKuliah->map(function ($course) {
                    return (object) [
                        'id' => $course->id,
                        'kode_mk' => $course->kode_mk,
                        'nama_mk' => $course->nama_mk,
                        'sks' => $course->sks,
                    ];
                })->toArray(),
            ];
        })->toArray();

        return response()->json($arrayOfObjects);
    }

    public function arrayOfObjectsView()
    {
        return view('mahasiswa.array_of_objects_demo');
    }
}
