<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Course;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function generate($courseId)
    {
        $user = auth()->user();
        $course = Course::findOrFail($courseId);

        $pdf = Pdf::loadView('certificates.template', [
            'userName' => $user->name,
            'courseName' => $course->title, // ← perbaikan
            'date' => now()->format('d F Y'),
        ])->setPaper('A4', 'landscape');

        return $pdf->download("Sertifikat - {$user->name}.pdf");
    }

}
