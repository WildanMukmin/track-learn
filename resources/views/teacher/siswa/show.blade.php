@extends('teacher.layouts.teacher')

@section('title', 'Detail Siswa')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">👤 Detail Siswa</h1>

        <div class="space-y-4">
            <div>
                <p class="text-gray-500 text-sm">Nama Lengkap</p>
                <p class="text-lg font-semibold text-gray-800">{{ $student->name }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Email</p>
                <p class="text-lg text-gray-800">{{ $student->email }}</p>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Tanggal Dibuat</p>
                <p class="text-lg text-gray-800">{{ $student->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('teacher.siswa.index') }}" 
               class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                ← Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
