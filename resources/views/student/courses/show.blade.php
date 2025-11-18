@extends('student.layouts.student')

@section('title', 'Detail Kursus')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4">

        <!-- Judul kursus -->
        <h1 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h1>

        <!-- Meta pengajar / rating / tanggal -->
        <div class="flex items-center gap-4 text-sm text-gray-600 mt-2">

            <div class="flex items-center gap-2">
                {{ $course->teacher->name ?? 'Tidak diketahui' }}
            </div>

            <span class="ml-4">
                Bergabung sejak {{ $enrollment->created_at->format('d F Y') }}
            </span>
        </div>

    </div>
</header>
@endsection


@section('content')
<div class="container mx-auto px-8 py-6">

    <!-- Progress Belajar Utama -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <div class="flex justify-between">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Progress Kursus</h2>
            <span class="text-blue-600 font-semibold">{{ $materialPercentage }}% Selesai</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $materialPercentage }}%;"></div>
        </div>
    </div>


    <!-- Modul & Daftar Materi -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Modul Pembelajaran</h2>

        @php
            $locked = false;
        @endphp

        @foreach($materials as $material)

            @php
                $isDone = $progress->where('material_id', $material->id)
                                   ->where('is_completed', true)
                                   ->first();

                $currentLocked = $locked;

                if(!$isDone) $locked = true;
            @endphp

            <div
                class="flex justify-between items-center p-4 border rounded-lg mb-3
                {{ $currentLocked ? 'bg-gray-100 opacity-60 cursor-not-allowed' : 'bg-white' }}">

                <!-- Judul & Deskripsi Materi -->
                <div>
                    <h3 class="font-semibold text-gray-800">{{ $material->title }}</h3>
                    <p class="text-gray-600 text-sm">{{ $material->description }}</p>
                </div>

                <!-- Tombol Belajar / Terkunci -->
                @if($currentLocked)
                    <span class="text-gray-500 text-sm">Terkunci</span>
                @else
                    <a href="{{ route('student.courses.material.show', [$course->id, $material->id]) }}"
                       class="text-blue-600 text-sm">Belajar →</a>
                @endif

                <!-- Status -->
                <span class="px-2 py-1 rounded text-xs ml-4
                    {{ $isDone ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                    {{ $isDone ? 'Selesai' : 'Belum' }}
                </span>
            </div>

        @endforeach
    </div>



    <!-- Kuis -->
    <div class="bg-white p-5 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Kuis</h2>

        @php 
            $allMaterialDone = ($completedMaterial == $totalMaterial);
            $quizLocked = !$allMaterialDone;
        @endphp

        @forelse($quizzes as $quiz)
            @php
                $attempt = $quizAttempts->where('quiz_id', $quiz->id)->first();
                $passed = $attempt && $attempt->is_passed;
            @endphp

            <div class="flex justify-between items-center p-4 border rounded-lg mb-3
                {{ $quizLocked ? 'bg-gray-100 opacity-60 cursor-not-allowed' : 'bg-white' }}">

                <!-- Judul & Deskripsi Kuis -->
                <div>
                    <h3 class="font-semibold">{{ $quiz->title }}</h3>
                    <p class="text-gray-600 text-sm">{{ $quiz->description ?? '-' }}</p>
                </div>

                <!-- Tombol Kerjakan / Terkunci -->
                @if($quizLocked)
                    <span class="text-gray-500 text-sm">Terkunci</span>
                @else
                    <a href="{{ route('student.courses.quiz.start', [$course->id, $quiz->id]) }}"
                       class="text-blue-600 text-sm">Kerjakan →</a>
                @endif

                <!-- Status -->
                <span class="px-2 py-1 rounded text-xs ml-4
                    {{ $passed ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                    {{ $passed ? 'Lulus' : ($attempt ? 'Tidak Lulus' : 'Belum') }}
                </span>
            </div>

        @empty
            <p class="text-gray-600 text-sm">Belum ada kuis tersedia.</p>
        @endforelse
    </div>



    <!-- Sertifikat -->
    @php
        $totalQuiz = count($quizzes);
        $passedQuiz = $quizAttempts->where('is_passed', true)->count();

        $certificateReady = $completedMaterial == $totalMaterial && $passedQuiz == $totalQuiz;

        $certificateProgress = intval(
            (($completedMaterial / max($totalMaterial,1)) * 50) +
            (($passedQuiz / max($totalQuiz,1)) * 50)
        );
    @endphp

    <div class="bg-white p-5 rounded-lg shadow mb-10 w-80">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Sertifikat</h2>

        <!-- Progress Sertifikat -->
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $certificateProgress }}%;"></div>
        </div>

        <p class="text-sm text-gray-600 mt-2">
            {{ 100 - $certificateProgress }}% lagi hingga sertifikat
        </p>

        <!-- Tombol Sertifikat -->
        @if($certificateReady)
            <a href="{{ route('student.course.certificate', $course->id) }}"
               class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded shadow text-sm">
               Download Sertifikat
            </a>
        @else
            <button class="mt-3 bg-gray-400 text-white px-4 py-2 rounded text-sm cursor-not-allowed">
                Selesaikan semua materi & kuis
            </button>
        @endif
    </div>

</div>
@endsection
