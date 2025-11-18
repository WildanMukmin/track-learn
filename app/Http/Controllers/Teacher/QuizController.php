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
    $quizzes = Quiz::with('course')
        ->withCount('questions')  // ← Tambahkan ini
        ->get();

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

    // Tambahkan variabel $quiz
    $quiz = Quiz::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
    ]);

    // ================================
    // Tambahan untuk menyimpan questions
    // ================================
    if ($request->has('questions') && is_array($request->questions)) {
        foreach ($request->questions as $q) {
            \App\Models\Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['question_text'] ?? null,  // <-- penting
                'option_a' => $q['option_a'] ?? null,
                'option_b' => $q['option_b'] ?? null,
                'option_c' => $q['option_c'] ?? null,
                'option_d' => $q['option_d'] ?? null,
                'correct_answer' => $q['correct_answer'] ?? null,
            ]);
        }
    }
    // ================================

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

    public function edit($id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);
    $courses = \App\Models\Course::all(); // atau filter khusus guru

    return view('teacher.quizzes.edit', compact('quiz', 'courses'));
}



    public function update(Request $request, $id)
    {
    $quiz = Quiz::findOrFail($id);

    $quiz->title = $request->title;
    $quiz->save();

    return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz berhasil diperbarui.');
    }

}
