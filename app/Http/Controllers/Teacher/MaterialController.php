<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MaterialController extends Controller
{
    // Daftar materi
    public function index()
    {
        $materials = Material::whereHas('course', function ($query) {
        $query->where('teacher_id', Auth::id());
        })->with('course')->latest()->get();

        return view('teacher.materials.index', compact('materials'));
    }

    // Detail materi
    public function show($id)
    {
        $material = Material::with('course')->findOrFail($id);
        return view('teacher.materials.show', compact('material'));
    }

    // Form tambah materi
    public function create()
    {
    $courses = Auth::user()->coursesTeaching ?? collect(); // aman untuk loop
    return view('teacher.materials.create', compact('courses'));
    }


    // Simpan materi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,pptx',
        ]);

        $material = new Material();
        $material->title = $request->title;
        $material->content = $request->content;
        $material->course_id = $request->course_id;

        if($request->hasFile('file_path')){
            $material->file_path = $request->file('file_path')->store('materials', 'public');
        }

        $material->save();

        return redirect()->route('teacher.materials.index')
                         ->with('success', 'Materi berhasil ditambahkan!');
    }

    // Form edit materi
public function edit($id)
{
    $material = Material::findOrFail($id);
    $courses = Auth::user()->coursesTeaching ?? collect();
    return view('teacher.materials.edit', compact('material', 'courses'));
}

// Update materi
public function update(Request $request, $id)
{
    $material = Material::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'course_id' => 'required|exists:courses,id',
        'file_path' => 'nullable|file|mimes:pdf,doc,docx,pptx',
    ]);

    $material->title = $request->title;
    $material->content = $request->content;
    $material->course_id = $request->course_id;

    if($request->hasFile('file_path')){
        $material->file_path = $request->file('file_path')->store('materials', 'public');
    }

    $material->save();

    return redirect()->route('teacher.materials.index')
                     ->with('success', 'Materi berhasil diperbarui!');
}

// Hapus materi
public function destroy($id)
{
    $material = Material::findOrFail($id);

    // Jika ada file, hapus file fisiknya
    if ($material->file_path) {
        \Storage::disk('public')->delete($material->file_path);
    }

    $material->delete();

    return redirect()->route('teacher.materials.index')
                     ->with('success', 'Materi berhasil dihapus!');
}


}

