<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mahasiswa\CourseController as MahasiswaCourseController;
use App\Http\Controllers\Dosen\DosenController;

Route::get('/latihan', function () {
    return view('latihan');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', function () {
        $courses = \App\Models\MataKuliah::all(['id', 'kode_mk', 'nama_mk', 'sks']);
        return view('mahasiswa.dashboard', ['courses' => $courses]);
    })->name('dashboard');
    Route::get('/courses', [MahasiswaCourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/{id}/enroll', [MahasiswaCourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/my-courses', [MahasiswaCourseController::class, 'myCourses'])->name('courses.my');
    Route::get('/transkrip', [MahasiswaCourseController::class,'transkrip'])->name('courses.transkrip');
    Route::get('/array-of-objects-demo', [MahasiswaCourseController::class, 'arrayOfObjectsDemo'])->name('arrayOfObjectsDemo');
    Route::get('/array-of-objects-view', [MahasiswaCourseController::class, 'arrayOfObjectsView'])->name('arrayOfObjectsView');

    // New routes for course selection page and form submission
    Route::get('/course-selection', [MahasiswaCourseController::class, 'courseSelection'])->name('courses.selection');
    Route::post('/course-selection', [MahasiswaCourseController::class, 'saveCourseSelection'])->name('courses.selection.save');

    // New route for unenroll (delete enrollment)
    Route::delete('/courses/{id}/unenroll', [MahasiswaCourseController::class, 'unenroll'])->name('courses.unenroll');
});

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-courses', [DosenController::class, 'myCourses'])->name('mycourses');
    Route::get('/courses/{id}/students', [DosenController::class, 'enrolledStudents'])->name('courses.students');

    // CRUD Mata Kuliah
    Route::get('/courses/create', [DosenController::class, 'create'])->name('courses.create');
    Route::post('/courses', [DosenController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/edit', [DosenController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{id}', [DosenController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [DosenController::class, 'destroy'])->name('courses.destroy');

    // CRUD Mahasiswa
    Route::get('/courses/{id}/add-student', [DosenController::class, 'addStudent'])->name('courses.addStudent');
    Route::post('/courses/{id}/add-student', [DosenController::class, 'storeStudent'])->name('courses.storeStudent');

    Route::post('/enrollments/{id}/update-nilai', [DosenController::class, 'updateNilai'])->name('enrollments.updateNilai');

    // Mahasiswa registration routes
    Route::get('/mahasiswa/create', [DosenController::class, 'createMahasiswa'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [DosenController::class, 'storeMahasiswa'])->name('mahasiswa.store');
});
