<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $dosen = Auth::user()->dosen;

        // ambil semua mata kuliah dengan jumlah mahasiswa
        $courses = $dosen->mataKuliah()->withCount('mahasiswas')->get();

        return view('dosen.dashboard', compact('courses'));
    }

    public function myCourses()
    {
        $dosen = Auth::user()->dosen;
        $courses = $dosen->mataKuliah()->withCount('mahasiswas')->get();
        return view('dosen.courses.index', compact('courses'));
    }

    public function enrolledStudents($id)
    {
        $course = MataKuliah::with('mahasiswas.user')->findOrFail($id);

        // pastikan hanya dosen pemilik mata kuliah yg bisa akses
        if ($course->dosen->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak melihat data ini');
        }

        return view('dosen.courses.students', compact('course'));
    }

    public function updateNilai(Request $request, $id)
    {
        $data = $request->validate([
            'nilai' => 'nullable|string|max:2'
        ]);

        $enrollment = Enrollment::findOrFail($id);

        // pastikan dosen yang sedang login adalah pengampu MK
        if ($enrollment->mataKuliah->dosen->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengubah nilai ini');
        }

        $enrollment->update(['nilai' => $data['nilai']]);

        return back()->with('success', 'Nilai berhasil diperbarui');
    }

    public function create()
    {
        return view('dosen.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_mk' => 'required|string|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'nullable|integer|min:1|max:6'
        ]);

        $dosen = Auth::user()->dosen;

        MataKuliah::create([
            'kode_mk' => $data['kode_mk'],
            'nama_mk' => $data['nama_mk'],
            'sks' => $data['sks'],
            'dosen_id' => $dosen->id,
        ]);

        return redirect()->route('dosen.mycourses')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        return view('dosen.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        $data = $request->validate([
            'nama_mk' => 'required|string|max:255',
            'sks' => 'nullable|integer|min:1|max:6'
        ]);

        $course->update($data);

        return redirect()->route('dosen.mycourses')->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        $course->delete();

        return redirect()->route('dosen.mycourses')->with('success', 'Mata kuliah berhasil dihapus');
    }

    public function addStudent($id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        $mahasiswas = Mahasiswa::with('user')->get();

        return view('dosen.courses.add-student', compact('course', 'mahasiswas'));
    }

    public function storeStudent(Request $request, $id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id'
        ]);

        $exists = Enrollment::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('mata_kuliah_id', $id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa sudah terdaftar di mata kuliah ini.');
        }

        Enrollment::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'mata_kuliah_id' => $id,
            'enroll_date' => now()
        ]);

        return redirect()->route('dosen.courses.students', $id)->with('success', 'Mahasiswa berhasil ditambahkan');
    }
}
