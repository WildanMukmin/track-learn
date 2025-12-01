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
                    alert("Pembayaran berhasil!");
                    window.location.href = "{{ route('student.courses.show', $course->id) }}";
                },
                onPending: function (result) {
                    alert("Menunggu pembayaran!");
                    window.location.href = "{{ route('student.courses.show', $course->id) }}";
                },
                onError: function (result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function () {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
@endsection