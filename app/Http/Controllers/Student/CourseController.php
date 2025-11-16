<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\MaterialProgress;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $courses = Course::with('teacher')
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->where(function ($sub) use ($query) {
                $sub->where('title', 'ILIKE', '%' . $query . '%')
                    ->orWhere('description', 'ILIKE', '%' . $query . '%');
            });
        })
        ->get();

        return view('student.courses.cari-kursus', compact('courses', 'query'));
    }

    public function show(Course $course)
    {
        // Ambil data enrollment siswa
        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        // Ambil semua materi
        $materials = $course->materials;

        // Ambil progress materi (sudah/belum selesai)
        $progress = MaterialProgress::where('enrollment_id', $enrollment->id)->get();
        
        // ambil daftar kuis kursus
        $quizzes = $course->quizzes; 

        // Ambil status kuis siswa
        $quizAttempts = $enrollment->quizAttempts()->get();

        // Hitung progress belajar (persentase materi selesai)
        $totalMaterial = $materials->count();
        $completedMaterial = $progress->where('is_completed', true)->count();
        $materialPercentage = $totalMaterial > 0 
            ? round(($completedMaterial / $totalMaterial) * 100) 
            : 0;

        return view('student.courses.show', compact(
            'course',
            'enrollment',
            'materials',
            'progress',
            'quizAttempts',
            'materialPercentage',
            'totalMaterial',
            'completedMaterial',
            'quizzes'
        ));
    }

}
