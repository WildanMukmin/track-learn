<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createPayment(Request $request, $courseId)
    {
        $user = auth()->user();
        $course = Course::findOrFail($courseId);

        // Cek apakah sudah ada payment yang pending atau success
        $existingPayment = Payment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->whereIn('transaction_status', ['pending', 'settlement'])
            ->first();

        if ($existingPayment) {
            if ($existingPayment->transaction_status === 'settlement') {
                return redirect()->back()->with('info', 'Anda sudah melakukan pembayaran untuk sertifikat ini.');
            }
            
            // Jika pending, gunakan snap token yang sudah ada
            return view('student.payment.checkout', [
                'snapToken' => $existingPayment->snap_token,
                'course' => $course,
                'payment' => $existingPayment,
            ]);
        }

        // Buat order ID unik
        $orderId = 'CERT-' . $courseId . '-' . $user->id . '-' . time();

        // Harga sertifikat (bisa diatur sesuai kebutuhan)
        $certificatePrice = 25000; // Rp 25.000

        // Buat payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'order_id' => $orderId,
            'amount' => $certificatePrice,
            'transaction_status' => 'pending',
        ]);

        // Siapkan parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $certificatePrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'CERT-' . $courseId,
                    'price' => $certificatePrice,
                    'quantity' => 1,
                    'name' => 'Sertifikat - ' . $course->title,
                ]
            ],
        ];

        try {
            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            
            // Update payment dengan snap token
            $payment->update(['snap_token' => $snapToken]);

            return view('student.payment.checkout', [
                'snapToken' => $snapToken,
                'course' => $course,
                'payment' => $payment,
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $transactionId = $notification->transaction_id;

            // Cari payment
            $payment = Payment::where('order_id', $orderId)->firstOrFail();

            // Update status pembayaran
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $payment->update([
                    'transaction_status' => 'settlement',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);

                // Buat sertifikat otomatis
                Certificate::create([
                    'user_id' => $payment->user_id,
                    'course_id' => $payment->course_id,
                    'payment_id' => $payment->id,
                    'claimed_at' => now(),
                ]);

            } elseif ($transactionStatus == 'pending') {
                $payment->update([
                    'transaction_status' => 'pending',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);

            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $payment->update([
                    'transaction_status' => $transactionStatus,
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function manualCallback(Request $request)
    {
        $data = $request->all();

        $paymentId = $data['order_id'] ?? null;

        if ($paymentId) {
            Payment::where('id', 5)
                ->update([
                    'transaction_status' => $data['transaction_status'] ?? 'settlement',
                    'payment_type' => $data['payment_type'] ?? null,
                    'transaction_id' => $data['transaction_id'] ?? null,
                ]);
        }

        return redirect()->route('student.certificate.list')->with('success', 'Pembayaran berhasil!');
    }

    public function checkStatus($orderId)
    {
        $payment = Payment::where('order_id', $orderId)->firstOrFail();
        
        return response()->json([
            'status' => $payment->transaction_status,
            'payment' => $payment,
        ]);
    }
}