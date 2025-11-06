<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Constructor untuk memeriksa role guru
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:teacher'); // pastikan ada middleware role:teacher
    }

    // Menampilkan halaman kursus saya
    public function index()
    {
        // Ambil semua kursus yang dimiliki guru ini
        $courses = Course::where('teacher_id', Auth::id())->get();

        return view('teacher.courses.index', compact('courses'));
    }

     public function create()
    {
        return view('teacher.courses.create');
    }

    // Simpan kursus ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'difficulty' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
         $data['thumbnail'] = $path;
        }

        Course::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil dibuat!');
    }

    public function edit($id)
{
    $course = Course::findOrFail($id); // Ambil data kursus berdasarkan ID
    return view('teacher.courses.edit', compact('course'));
}

public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'nullable|string',
        'difficulty' => 'nullable|string',
        'duration' => 'nullable|string',
        'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // Update data kursus
    $course->update($validated);

    // Jika ada thumbnail baru, simpan
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
        $course->thumbnail = $path;
        $course->save();
    }

    return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil diperbarui!');
}

}
