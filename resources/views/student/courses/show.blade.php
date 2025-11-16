@extends('student.layouts.student')

@section('title', 'Detail Kursus')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4">

        <!-- Judul kursus -->
        <h1 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h1>

        <!-- Deskripsi kursus -->
        <p class="text-gray-600 mt-1">{{ $course->description }}</p>

        <!-- Pengajar -->
        <p class="text-gray-500 mt-2 text-sm">
            <strong>Pengajar:</strong> {{ $course->teacher->name ?? 'Tidak diketahui' }}
        </p>

        <!-- Status belajar -->
        <p class="text-sm text-gray-500 mt-1">
            <strong>Status Belajar:</strong>
            <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded">
                {{ ucfirst(str_replace('_',' ',$enrollment->status)) }}
            </span>
        </p>
    </div>
</header>
@endsection

@section('content')
<div class="container mx-auto px-8 py-6">

    <!-- Progress Belajar -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Progress Materi</h2>

        <!-- Bar progress -->
        <div class="w-full bg-gray-200 rounded-full h-5">
            <div class="bg-green-500 h-5 rounded-full" style="width: {{ $materialPercentage }}%;"></div>
        </div>

        <p class="mt-2 text-sm text-gray-600">
            {{ $completedMaterial }} dari {{ $totalMaterial }} materi selesai

    <!-- Daftar Materi -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Materi Pembelajaran</h2>

        @foreach($materials as $material)
            @php
                $completed = $progress
                    ->where('material_id', $material->id)
                    ->where('is_completed', true)
                    ->first();
            @endphp

            <div class="flex justify-between items-center border-b py-3">
                <div>
                    <!-- Judul materi -->
                    <h3 class="font-semibold text-gray-800">{{ $material->title }}</h3>

                    <!-- Deskripsi materi -->
                    <p class="text-gray-600 text-sm">{{ $material->description }}</p>
                </div>

                <!-- Status materi -->
                <span class="text-xs px-2 py-1 rounded 
                    {{ $completed ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                    {{ $completed ? 'Selesai' : 'Belum' }}
                </span>
            </div>
        @endforeach
    </div>

    <!-- Daftar Kuis -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Kuis Tersedia</h2>

        @forelse($quizzes as $quiz)
            <div class="border-b py-3">
                <!-- Judul kuis -->
                <h3 class="font-semibold text-gray-800">{{ $quiz->title }}</h3>

                <!-- Deskripsi kuis -->
                <p class="text-gray-600 text-sm">{{ $quiz->description ?? '-' }}</p>

                <!-- Tombol -->
                <a href="#" class="text-blue-600 text-sm mt-1 inline-block">
                    Kerjakan Kuis →
                </a>
            </div>
        @empty
            <p class="text-gray-600 text-sm">Belum ada kuis pada kursus ini.</p>
        @endforelse
    </div>

    <!-- Riwayat Kuis -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Kuis</h2>

        @forelse($quizAttempts as $attempt)
            <div class="border-b py-3">

                <!-- Judul kuis -->
                <strong class="text-gray-800">{{ $attempt->quiz->title }}</strong><br>

                <!-- Nilai -->
                <span class="text-sm text-gray-600">Nilai: {{ $attempt->score }}</span><br>

                <!-- Status -->
                <span class="text-xs px-2 py-1 rounded 
                    {{ $attempt->is_passed ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    {{ $attempt->is_passed ? 'Lulus' : 'Tidak Lulus' }}
                </span>
            </div>
        @empty
            <p class="text-gray-600 text-sm">Belum ada hasil kuis.</p>
        @endforelse
    </div>

</div>
@endsection
