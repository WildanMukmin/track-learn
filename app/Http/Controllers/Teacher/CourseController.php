<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        // Ambil kursus milik guru + hitung jumlah siswa yang enroll
        $courses = Course::withCount('students')
            ->where('teacher_id', $teacherId)
            ->get();

        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('teacher.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil dibuat.');
    }

    public function show($id)
    {
        // Ambil kursus + data siswa yang enroll
        $course = Course::with('students')
            ->where('id', $id)
            ->where('teacher_id', Auth::id()) // memastikan guru hanya melihat kursusnya sendiri
            ->firstOrFail();

        return view('teacher.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('teacher.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $course->update($request->only(['title', 'description']));

        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil diperbarui.');
    }
}
