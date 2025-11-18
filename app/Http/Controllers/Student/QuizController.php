<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function start($courseId, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        // Pastikan quiz milik course 
        abort_if($quiz->course_id != $courseId, 404);

        // Ambil enrollment student
        $enrollment = Enrollment::where('course_id', $courseId)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        return view('student.courses.quiz.start', compact(
            'quiz', 'courseId', 'enrollment'
        ));
    }


    public function submit(Request $request, $courseId, $quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        abort_if($quiz->course_id != $courseId, 404);

        $enrollment = Enrollment::where('course_id', $courseId)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        $answers = $request->answers ?? [];
        $correct = 0;

        foreach ($quiz->questions as $question) {

            if (!isset($answers[$question->id])) {
                continue;
            }

            // Jawaban student: "A" / "B" / "C" / "D" → ubah ke huruf kecil
            $studentLetter = strtolower($answers[$question->id]); // hasil: a/b/c/d

            // Jawaban guru: sudah a/b/c/d
            $correctAnswer = strtolower($question->correct_answer);

            // Bandingkan
            if ($studentLetter === $correctAnswer) {
                $correct++;
            }
        }

        // Hitung nilai
        $score = round(($correct / max($quiz->questions->count(), 1)) * 100);

        // Simpan hasil attempt
        QuizAttempt::create([
            'quiz_id'       => $quiz->id,
            'enrollment_id' => $enrollment->id,
            'student_id'    => Auth::id(),
            'score'         => $score,
            'is_passed'     => $score >= 70,
        ]);

        return redirect()->route('student.courses.show', $courseId)
            ->with('success', 'Kuis selesai. Nilai Anda: ' . $score);
    }

}
