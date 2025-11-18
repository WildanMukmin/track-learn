<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;

class MaterialController extends Controller
{
    public function show($courseId, $materialId)
    {
        $material = Material::findOrFail($materialId);
        $course = $material->course;

        // Pastikan materi memang milik course
        abort_if($course->id != $courseId, 404);

        // Daftar materi kursus
        $materials = Material::where('course_id', $course->id)
            ->orderBy('id', 'asc')
            ->get();

        // Ambil previous & next
        $currentIndex = $materials->search(fn($m) => $m->id == $materialId);
        $previous = $materials->get($currentIndex - 1);
        $next     = $materials->get($currentIndex + 1);

        // Ambil enrollment user
        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        // Ambil progress user untuk materi ini
        $progress = MaterialProgress::where('material_id', $material->id)
            ->where('enrollment_id', $enrollment->id)
            ->first();

        return view('student.courses.material', compact(
            'material', 'course', 'materials', 'previous', 'next', 'progress', 'enrollment'
        ));
    }


    public function complete($courseId, $materialId)
    {
        $material = Material::findOrFail($materialId);
        $course   = $material->course;

        // Pastikan materi memang milik course
        abort_if($course->id != $courseId, 404);

        // Ambil enrollment user
        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        // Simpan progress
        MaterialProgress::updateOrCreate(
            [
                'material_id'    => $materialId,
                'enrollment_id'  => $enrollment->id,
                'user_id'        => Auth::id(),
            ],
            [
                'is_completed' => true,
            ]
        );

        return back()->with('success', 'Materi telah ditandai selesai!');
    }
}
