@extends('student.layouts.student')

@section('title', 'Pembayaran Sertifikat')

@section('header')
    <header class="bg-white shadow-sm">
        <div class="px-8 py-4">
            <h1 class="text-2xl font-bold text-gray-800">Pembayaran Sertifikat</h1>
            <p class="text-gray-600 mt-1">Selesaikan pembayaran untuk mendapatkan sertifikat</p>
        </div>
    </header>
@endsection

@section('content')
    <div class="container mx-auto px-6 py-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pembayaran</h2>

                <div class="mb-6">
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Kursus:</span>
                        <span class="font-semibold">{{ $course->title }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Item:</span>
                        <span class="font-semibold">Sertifikat Digital</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Harga:</span>
                        <span class="font-semibold text-blue-600">Rp
                            {{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-700 font-semibold">Total:</span>
                        <span class="font-bold text-lg text-blue-600">Rp
                            {{ number_format($payment->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button id="pay-button"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Bayar Sekarang
                </button>

                <a href="{{ route('student.courses.show', $course->id) }}"
                    class="block text-center mt-4 text-gray-600 hover:text-gray-800">
                    Kembali ke Kursus
                </a>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    console.log('Payment Success:', result);

                    // Kirim callback manual ke Laravel
                    fetch("{{ route('payment.callback.manual') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(result)
                    });

                    // Redirect ke finish
                    window.location.href = "{{ route('payment.finish') }}?order_id=" + result.order_id;
                },

                onPending: function (result) {
                    console.log('Payment Pending:', result);

                    window.location.href = "{{ route('payment.finish') }}?order_id=" + result.order_id;
                },
                onError: function (result) {
                    console.log('Payment Error:', result);
                    alert("Pembayaran gagal! Silakan coba lagi.");
                },
                onClose: function () {
                    console.log('Payment popup closed');
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
@endsection