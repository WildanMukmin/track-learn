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
        ]);

        Course::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('teacher.courses')->with('success', 'Kursus berhasil dibuat!');
    }
}
