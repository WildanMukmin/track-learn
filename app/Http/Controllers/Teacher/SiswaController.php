<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua user dengan role student
        $students = User::where('role', 'student')->get();

        // Kirim data ke view
        return view('teacher.siswa.index', compact('students'));
    }

    /**
     * Menampilkan detail satu siswa berdasarkan ID.
     */
    public function show($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);

        return view('teacher.siswa.show', compact('student'));
    }
}