<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Menampilkan daftar kursus yang sudah di-enroll oleh mahasiswa
     */
    public function myCourses()
    {
        $student = Auth::user();

        // Pastikan user sudah login
        if (!$student) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua kursus yang sudah di-enroll user ini
        $enrollments = Enrollment::with('course.teacher')
            ->where('student_id', $student->id)
            ->get();

        // Kalau belum pernah enroll
        if ($enrollments->isEmpty()) {
            return view('student.courses.my-courses', [
                'enrollments' => $enrollments,
                'message' => 'Kamu belum mendaftar kursus apapun.',
            ]);
        }

        return view('student.courses.my-courses', compact('enrollments'));
        
    }
    public function store($courseId)
    {
        $student = Auth::user();

        // Cek apakah kursus ada
        $course = Course::findOrFail($courseId);

        // Cek apakah sudah pernah enroll
        $alreadyEnrolled = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('student.my-courses')
                ->with('info', 'Kamu sudah terdaftar di kursus ini.');
        }

        // Simpan data enrollment baru
        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => 'enrolled',
        ]);

        return redirect()->route('student.my-courses')
            ->with('success', 'Berhasil mendaftar ke kursus "' . $course->title . '".');
    }
}
