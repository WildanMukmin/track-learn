@extends('student.layouts.student')

@section('title', 'Kuis: ' . $quiz->title)

@section('content')

<div class="container mx-auto px-8 py-6">

    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('student.courses.show', $courseId) }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg">

            <!-- Ikon back (Heroicons) -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />
            </svg>

            Kembali ke Kursus
        </a>
    </div>

    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $quiz->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>

    <!-- Form Kuis -->
    <form action="{{ route('student.courses.quiz.submit', [$courseId, $quiz->id]) }}" method="POST">
        @csrf

        <!-- List pertanyaan -->
        @foreach($quiz->questions as $index => $question)
            <div class="mb-6 bg-white p-5 rounded-lg shadow">
                
                <!-- Nomor soal -->
                <h3 class="font-semibold text-gray-800 mb-2">
                    {{ $index + 1 }}. {{ $question->question_text }}
                </h3>

                <!-- Pilihan -->
                <div class="space-y-2">
                    @foreach(['A','B','C','D'] as $option)
                        <label class="flex items-center gap-2">
                            <input type="radio" 
                                   name="answers[{{ $question->id }}]" 
                                   value="{{ $option }}"
                                   class="text-blue-600">
                            <span>{{ $question['option_' . strtolower($option)] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Tombol submit -->
        <button class="px-5 py-3 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
            Kumpulkan Jawaban
        </button>
    </form>

</div>

@endsection
