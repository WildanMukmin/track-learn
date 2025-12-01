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
    $teacherId = auth()->id();

    // Course yang diajar oleh guru login
    $courses = Course::where('teacher_id', $teacherId)->get();

    // Ambil ID course yang diajar guru
    $teacherCourseIDs = $courses->pluck('id');

    // Ambil siswa yang enroll ke course guru login
    $students = User::where('role', 'student')
        ->whereHas('enrolledCourses', function ($query) use ($teacherCourseIDs) {
            $query->whereIn('courses.id', $teacherCourseIDs);
        })
        ->with(['enrolledCourses' => function ($query) use ($teacherCourseIDs) {
            $query->whereIn('courses.id', $teacherCourseIDs);
        }])
        ->get();

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
