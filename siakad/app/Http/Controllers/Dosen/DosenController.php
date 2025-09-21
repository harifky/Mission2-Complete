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

    public function addStudent($id)
    {
        $course = MataKuliah::findOrFail($id);

        if ($course->dosen->user_id !== Auth::id()) abort(403);

        $mahasiswas = Mahasiswa::with('user')->get();

        return view('dosen.courses.add-student', compact('course', 'mahasiswas'));
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

    public function createMahasiswa()
    {
        return view('dosen.mahasiswa.create');
    }

    public function storeMahasiswa(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'full_name' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer|min:1900|max:2100',
        ]);

        // Extract last 3 digits of nim
        $last3 = substr($data['nim'], -3);

        // Create user first with username and default password
        $user = \App\Models\User::create([
            'name' => $data['full_name'],
            'username' => 'mhs' . $last3,
            'password' => bcrypt($last3 . 'power'),
            'role' => 'mahasiswa',
        ]);

        // Create mahasiswa linked to user
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $data['nim'],
            'tahun_masuk' => $data['tahun_masuk'],
        ]);

        return redirect()->route('dosen.mycourses')->with('success', 'Mahasiswa berhasil didaftarkan');
    }
}
