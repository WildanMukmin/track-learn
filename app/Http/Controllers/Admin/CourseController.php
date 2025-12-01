<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index()
    {
        $courses = Course::with(['teacher', 'enrollments', 'materials'])
            ->withCount(['enrollments', 'materials'])
            ->latest()
            ->paginate(12);

        $teachers = User::where('role', 'teacher')->get();
        
        $totalCourses = Course::count();
        $activeCourses = Course::count(); // Bisa ditambahkan logic untuk status aktif
        $totalEnrollments = Enrollment::count();
        $activeTeachers = User::where('role', 'teacher')
            ->whereHas('coursesTeaching')
            ->count();

        return view('admin.courses.index', compact(
            'courses',
            'teachers',
            'totalCourses',
            'activeCourses',
            'totalEnrollments',
            'activeTeachers'
        ));
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'teacher_id' => ['required', 'exists:users,id'],
        ], [
            'title.required' => 'Judul kursus wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'teacher_id.required' => 'Guru wajib dipilih',
            'teacher_id.exists' => 'Guru tidak ditemukan',
        ]);

        // Verify the selected user is a teacher
        $teacher = User::find($validated['teacher_id']);
        if ($teacher->role !== 'teacher') {
            return redirect()->back()
                ->withErrors(['teacher_id' => 'Pengguna yang dipilih bukan guru'])
                ->withInput();
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil ditambahkan!');
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {
        $course->load(['teacher', 'materials', 'quizzes.questions', 'enrollments.student']);
        
        $statistics = [
            'total_students' => $course->enrollments()->count(),
            'completed_students' => $course->enrollments()
                ->whereIn('status', ['passed', 'certificate_issued'])
                ->count(),
            'in_progress_students' => $course->enrollments()
                ->whereIn('status', ['enrolled', 'in_progress', 'material_completed', 'quiz_attempted'])
                ->count(),
            'total_materials' => $course->materials()->count(),
            'total_quizzes' => $course->quizzes()->count(),
        ];

        return view('admin.courses.show', compact('course', 'statistics'));
    }

    /**
     * Show the form for editing course
     */
    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')->get();
        
        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified course
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->only(['title', 'description', 'category', 'difficulty', 'duration']);
        if ($request->hasFile('thumbnail')) {
            // hapus thumbnail lama jika ada
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil diperbarui!');
    }
    /**
     * Remove the specified course
     */
    public function destroy(Course $course)
    {
        // Delete course (cascade will handle enrollments, materials, etc.)
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus!');
    }
}