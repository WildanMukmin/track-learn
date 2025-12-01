<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Payment;
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
        $course = Course::findOrFail($courseId);

        // Cek apakah sudah klaim
        $exists = Certificate::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($exists) {
            return back()->with('info', 'Sertifikat sudah pernah diklaim.');
        }

        // Cek apakah sudah bayar
        $payment = Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('transaction_status', 'settlement')
            ->first();

        if (!$payment) {
            return redirect()->route('student.payment.create', $courseId)
                ->with('info', 'Silakan selesaikan pembayaran terlebih dahulu.');
        }

        // Jika sudah bayar, buat sertifikat (seharusnya sudah dibuat di callback)
        Certificate::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $courseId,
        ], [
            'payment_id' => $payment->id,
            'claimed_at' => now(),
        ]);

        return back()->with('success', 'Sertifikat berhasil diklaim!');
    }

    public function download($courseId)
    {
        $user = auth()->user();
        $course = Course::findOrFail($courseId);

        // Pastikan sertifikat sudah diklaim dan dibayar
        $certificate = Certificate::where('user_id', $user->id)
                                  ->where('course_id', $courseId)
                                  ->whereHas('payment', function($q) {
                                      $q->where('transaction_status', 'settlement');
                                  })
                                  ->firstOrFail();

        $pdf = Pdf::loadView('certificates.template', [
            'userName' => $user->name,
            'courseName' => $course->title,
            'date' => $certificate->created_at->format('d F Y'),
        ])->setPaper('A4', 'landscape');

        return $pdf->download("Sertifikat - {$user->name}.pdf");
    }

    public function list()
    {
        $certificates = Certificate::where('user_id', auth()->id())
            ->with(['course', 'payment'])
            ->whereHas('payment', function($q) {
                $q->where('transaction_status', 'settlement');
            })
            ->get();

        return view('student.courses.certificate', compact('certificates'));
    }

}
