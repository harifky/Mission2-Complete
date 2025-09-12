<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mahasiswa\CourseController as MahasiswaCourseController;
use App\Http\Controllers\Dosen\DosenController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('dashboard');
    Route::get('/courses', [MahasiswaCourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/{id}/enroll', [MahasiswaCourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/my-courses', [MahasiswaCourseController::class, 'myCourses'])->name('courses.my');
    Route::get('/transkrip', [MahasiswaCourseController::class,'transkrip'])->name('courses.transkrip');
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
});
