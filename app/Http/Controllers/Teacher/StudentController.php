<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Ambil semua siswa
        $students = User::where('role', 'student')
            ->with('enrolledCourses') // relasi dari model User
            ->get()
            ->filter(function ($student) {
                return $student->enrolledCourses->isNotEmpty();
            })
            ->map(function ($student) {
                // Tambahkan field progress dummy (misalnya random sementara)
                $student->progress = rand(20, 100);
                return $student;
            });

        $courses = Course::all();

        return view('teacher.students.index', compact('students', 'courses'));
    }

    public function show($id)
    {
        $student = User::with('enrolledCourses')->findOrFail($id);
        return view('teacher.students.show', compact('student'));
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('teacher.students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
