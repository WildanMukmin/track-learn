<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Course;
use App\Models\Certificate;

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

    public function claim($courseId)
    {
        $user = auth()->user();

        // cek apakah sudah klaim
        $exists = Certificate::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($exists) {
            return back()->with('info', 'Sertifikat sudah pernah diklaim.');
        }

        Certificate::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'claimed_at' => now(),
        ]);

        return back()->with('success', 'Sertifikat berhasil diklaim!');
    }


    public function download($courseId)
    {
        $user = auth()->user();
        $course = Course::findOrFail($courseId);

        // Pastikan sertifikat sudah diklaim
        $certificate = Certificate::where('user_id', $user->id)
                                  ->where('course_id', $courseId)
                                  ->firstOrFail();

        $pdf = Pdf::loadView('certificates.template', [
            'userName' => $user->name,
            'courseName' => $course->title,
            'date' => $certificate->claimed_at->format('d F Y'),
        ])->setPaper('A4', 'landscape');

        return $pdf->download("Sertifikat - {$user->name}.pdf");
    }

    public function list()
    {
        $certificates = Certificate::where('user_id', auth()->id())
            ->with('course')
            ->get();

        return view('student.courses.certificate', compact('certificates'));
    }

}
