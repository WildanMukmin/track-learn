<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Course;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('course')->get();
        return view('teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('teacher.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);

        Quiz::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
        ]);

        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dibuat!');
    }

    public function show($id)
    {
        $quiz = Quiz::with('course')->findOrFail($id);
        return view('teacher.quizzes.show', compact('quiz'));
    }

    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('teacher.quizzes.index')->with('success', 'Kuis berhasil dihapus!');
    }
}
