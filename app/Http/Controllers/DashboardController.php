<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function adminDashboard()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'totalUsers' => User::count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'totalTeachers' => User::where('role', 'teacher')->count(),
            'totalCourses' => Course::count(),
            'totalEnrollments' => Enrollment::count(),
            'recentUsers' => User::latest()->take(5)->get(),
            'recentCourses' => Course::with('teacher')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Teacher Dashboard
     */
    public function teacherDashboard()
    {
        // Check if user is teacher
        if (Auth::user()->role !== 'teacher') {
            abort(403, 'Unauthorized action.');
        }

        $teacherId = Auth::id();

        $data = [
            'totalCourses' => Course::where('teacher_id', $teacherId)->count(),
            'totalStudents' => Enrollment::whereHas('course', function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->distinct('student_id')->count(),
            'courses' => Course::where('teacher_id', $teacherId)
                ->withCount('enrollments')
                ->latest()
                ->get(),
            'recentEnrollments' => Enrollment::with(['student', 'course'])
                ->whereHas('course', function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId);
                })
                ->latest()
                ->take(10)
                ->get(),
        ];

        return view('teacher.dashboard', $data);
    }

    /**
     * Student Dashboard
     */
    public function studentDashboard()
    {
        // Check if user is student
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized action.');
        }

        $studentId = Auth::id();

        $data = [
            'enrolledCourses' => Enrollment::where('student_id', $studentId)
                ->with(['course.teacher'])
                ->get(),
            'totalEnrolled' => Enrollment::where('student_id', $studentId)->count(),
            'completedCourses' => Enrollment::where('student_id', $studentId)
                ->whereIn('status', ['passed', 'certificate_issued'])
                ->count(),
            'inProgressCourses' => Enrollment::where('student_id', $studentId)
                ->whereIn('status', ['enrolled', 'in_progress', 'material_completed', 'quiz_attempted'])
                ->count(),
            'availableCourses' => Course::with('teacher')
                ->whereNotIn('id', function($query) use ($studentId) {
                    $query->select('course_id')
                        ->from('enrollments')
                        ->where('student_id', $studentId);
                })
                ->latest()
                ->take(6)
                ->get(),
        ];

        return view('student.dashboard', $data);
    }

    /**
     * Show homepage/welcome page
     */
    public function welcome()
    {
        $data = [
            'popularCourses' => Course::with('teacher')
                ->withCount('enrollments')
                ->orderBy('enrollments_count', 'desc')
                ->take(6)
                ->get(),
            'totalCourses' => Course::count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'totalTeachers' => User::where('role', 'teacher')->count(),
        ];

        return view('welcome', $data);
    }
}