<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function destroy(Course $course)
    {
        // Pastikan hanya guru pemilik yang bisa menghapus kursus
        if ($course->teacher_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus kursus ini.');
        }
        $course->delete();
        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil dihapus.');
    }
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

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => Auth::id(),
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'duration' => $request->duration,
        ];

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        Course::create($data);

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

        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil diperbarui.');
    }
}
