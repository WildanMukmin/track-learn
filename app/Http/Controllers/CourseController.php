<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $courses = Course::with('teacher')
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->where(function ($sub) use ($query) {
                $sub->where('title', 'ILIKE', '%' . $query . '%')
                    ->orWhere('description', 'ILIKE', '%' . $query . '%');
            });
        })
        ->get();

        return view('student.cari-kursus', compact('courses', 'query'));
    }

}
