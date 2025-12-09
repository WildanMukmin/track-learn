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

        abort_if($course->id != $courseId, 404);

        $materials = Material::where('course_id', $course->id)
            ->orderBy('id', 'asc')
            ->get();

        $currentIndex = $materials->search(fn($m) => $m->id == $materialId);
        $previous = $materials->get($currentIndex - 1);
        $next     = $materials->get($currentIndex + 1);

        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

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

        abort_if($course->id != $courseId, 404);

        $enrollment = Enrollment::where('course_id', $course->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

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
