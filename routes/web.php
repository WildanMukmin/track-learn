<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

// Teacher Controllers
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\SiswaController as TeacherSiswaController;

// Student Controllers
use App\Http\Controllers\Student\CourseController as StudentCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌐 Public Routes
Route::get('/', [DashboardController::class, 'home'])->name('home');

// 👤 Guest Routes (Only accessible when not logged in)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});

// 🔒 Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 🧑‍💼 Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

        // User Management
        Route::resource('users', AdminUserController::class)->except(['show', 'create']);

        // Course Management
        Route::resource('courses', AdminCourseController::class);
    });

    // 👨‍🏫 Teacher Routes
    Route::middleware('role:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'teacherDashboard'])->name('dashboard');
        
        // Course Management
        Route::get('/courses', [TeacherCourseController::class, 'index'])->name('courses');
        Route::get('/courses/create', [TeacherCourseController::class, 'create'])->name('courses.create');
        Route::post('/courses/store', [TeacherCourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [TeacherCourseController::class, 'update'])->name('courses.update');

        // ✅ Kelola siswa dengan nama route yang konsisten
        Route::get('/siswa', [TeacherSiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id}', [TeacherSiswaController::class, 'show'])->name('siswa.show');
    });

    // 👨‍🎓 Student Routes
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'studentDashboard'])->name('dashboard');
        Route::get('/cari-kursus', [StudentCourseController::class, 'search'])->name('courses.search');

        // Tambahan route student bisa didefinisikan di sini
        // Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
        // Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
        // Route::get('/my-courses', [EnrollmentController::class, 'myCourses'])->name('my-courses');
        // Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
        // Route::post('/quizzes/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quizzes.submit');
    });
});
