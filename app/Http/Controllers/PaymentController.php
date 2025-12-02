<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;

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
            // Log untuk debugging
            Log::info('Midtrans Callback Received', $request->all());

            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;
            $paymentType = $notification->payment_type;
            $transactionId = $notification->transaction_id;

            Log::info("Processing payment for Order ID: {$orderId}, Status: {$transactionStatus}");

            // Cari payment
            $payment = Payment::where('order_id', $orderId)->first();

            if (!$payment) {
                Log::error("Payment not found for Order ID: {$orderId}");
                return response()->json(['status' => 'error', 'message' => 'Payment not found'], 404);
            }

            // Update status pembayaran berdasarkan transaction_status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    // Transaksi berhasil
                    $this->processSuccessPayment($payment, $paymentType, $transactionId);
                } else if ($fraudStatus == 'challenge') {
                    // Transaksi di-challenge, tunggu approval manual
                    $payment->update([
                        'transaction_status' => 'challenge',
                        'payment_type' => $paymentType,
                        'transaction_id' => $transactionId,
                    ]);
                    Log::info("Payment challenged for Order ID: {$orderId}");
                } else {
                    // Transaksi ditolak
                    $payment->update([
                        'transaction_status' => 'deny',
                        'payment_type' => $paymentType,
                        'transaction_id' => $transactionId,
                    ]);
                    Log::info("Payment denied for Order ID: {$orderId}");
                }
            } elseif ($transactionStatus == 'settlement') {
                // Transaksi berhasil (untuk payment method selain credit card)
                $this->processSuccessPayment($payment, $paymentType, $transactionId);
            } elseif ($transactionStatus == 'pending') {
                $payment->update([
                    'transaction_status' => 'pending',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);
                Log::info("Payment pending for Order ID: {$orderId}");
            } elseif ($transactionStatus == 'deny') {
                $payment->update([
                    'transaction_status' => 'deny',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);
                Log::info("Payment denied for Order ID: {$orderId}");
            } elseif ($transactionStatus == 'expire') {
                $payment->update([
                    'transaction_status' => 'expire',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);
                Log::info("Payment expired for Order ID: {$orderId}");
            } elseif ($transactionStatus == 'cancel') {
                $payment->update([
                    'transaction_status' => 'cancel',
                    'payment_type' => $paymentType,
                    'transaction_id' => $transactionId,
                ]);
                Log::info("Payment cancelled for Order ID: {$orderId}");
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function processSuccessPayment($payment, $paymentType, $transactionId)
    {
        $payment->update([
            'transaction_status' => 'settlement',
            'payment_type' => $paymentType,
            'transaction_id' => $transactionId,
            'paid_at' => now(),
        ]);

        // Buat sertifikat otomatis jika belum ada
        $certificate = Certificate::where('user_id', $payment->user_id)
            ->where('course_id', $payment->course_id)
            ->first();

        if (!$certificate) {
            Certificate::create([
                'user_id' => $payment->user_id,
                'course_id' => $payment->course_id,
                'payment_id' => $payment->id,
                'claimed_at' => now(),
            ]);
            Log::info("Certificate created for payment ID: {$payment->id}");
        }

        Log::info("Payment settled for Order ID: {$payment->order_id}");
    }

    public function checkStatus($orderId)
    {
        $payment = Payment::where('order_id', $orderId)->firstOrFail();

        return response()->json([
            'status' => $payment->transaction_status,
            'payment' => $payment,
        ]);
    }

    // Tambahkan method untuk handle finish redirect
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');

        if ($orderId) {
            $payment = Payment::where('order_id', $orderId)->first();

            if ($payment) {
                return redirect()->route('student.courses.show', $payment->course_id)
                    ->with('success', 'Pembayaran sedang diproses. Silakan cek status pembayaran Anda.');
            }
        }

        return redirect()->route('student.dashboard')
            ->with('info', 'Pembayaran sedang diproses.');
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
}