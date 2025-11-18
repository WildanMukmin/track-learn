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
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
use App\Http\Controllers\Teacher\MaterialController as TeacherMaterialController;




// Student Controllers
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\EnrollmentController as StudentEnrollmentController;
use App\Http\Controllers\Student\MaterialController as StudentMaterialController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\CertificateController as StudentCertificateController;

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

    Route::prefix('materials')->name('materials.')->group(function () {
        Route::get('/', [TeacherMaterialController::class, 'index'])->name('index');
        Route::get('/create', [TeacherMaterialController::class, 'create'])->name('create');
        Route::post('/', [TeacherMaterialController::class, 'store'])->name('store');       
        Route::get('/{id}', [TeacherMaterialController::class, 'show'])->name('show');

        Route::get('/{id}/edit', [TeacherMaterialController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TeacherMaterialController::class, 'update'])->name('update');
        });

        // Course Management
        Route::get('/courses', [TeacherCourseController::class, 'index'])->name('courses');
        Route::get('/courses/create', [TeacherCourseController::class, 'create'])->name('courses.create');
        Route::post('/courses/store', [TeacherCourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [TeacherCourseController::class, 'update'])->name('courses.update');

        // EDIT / UPDATE
        Route::get('/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [TeacherCourseController::class, 'update'])->name('courses.update');
        
        
        Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/', [App\Http\Controllers\Teacher\QuizController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Teacher\QuizController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Teacher\QuizController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Teacher\QuizController::class, 'show'])->name('show');
        Route::delete('/{id}', [App\Http\Controllers\Teacher\QuizController::class, 'destroy'])->name('destroy');
        
        // Edit / UPDATE
        Route::get('/{id}/edit', [TeacherQuizController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TeacherQuizController::class, 'update'])->name('update');


        });

        // =================== ROUTE SISWA ===================
        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/', [App\Http\Controllers\Teacher\StudentController::class, 'index'])->name('index');
            Route::get('/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'show'])->name('show');
            Route::delete('/{id}', [App\Http\Controllers\Teacher\StudentController::class, 'destroy'])->name('destroy');
        });



        
        // Add more teacher routes here
        // Route::resource('courses', TeacherCourseController::class);
        // Route::resource('courses.materials', MaterialController::class);
        // Route::resource('courses.quizzes', QuizController::class);
    });

    // 👨‍🎓 Student Routes
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'studentDashboard'])->name('dashboard');
        Route::get('/cari-kursus', [StudentCourseController::class, 'search'])->name('courses.search');
        Route::get('/my-courses', [StudentEnrollmentController::class, 'myCourses'])->name('my-courses');
        Route::post('/courses/{course}/enroll', [StudentEnrollmentController::class, 'store'])->name('courses.enroll');
        Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
        Route::get('courses/{course}/material/{material}', [StudentMaterialController::class, 'show'])->name('courses.material.show');
        Route::post('courses/{course}/material/{material}/complete', [StudentMaterialController::class, 'complete'])->name('courses.material.complete');
        Route::get('courses/{course}/quiz/{quiz}/start', [StudentQuizController::class, 'start'])->name('courses.quiz.start');
        Route::post('courses/{course}/quiz/{quiz}/submit', [StudentQuizController::class, 'submit'])->name('courses.quiz.submit');
        Route::get('/courses/{course}/certificate', [StudentCertificateController::class, 'show'])->name('course.certificate');


    });
});
