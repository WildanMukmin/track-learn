@extends('teacher.layouts.teacher')

@section('title', 'Detail Kuis')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Kuis</h1>
        <a href="{{ route('teacher.quizzes.index') }}" 
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
           ← Kembali
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Judul Kuis:</h2>
            <p class="text-gray-900">{{ $quiz->title }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Kursus:</h2>
            <p class="text-gray-900">{{ $quiz->course->title ?? '-' }}</p>
        </div>

        @if($quiz->questions && count($quiz->questions) > 0)
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Pertanyaan:</h2>
            <div class="space-y-4">
                @foreach($quiz->questions as $index => $question)
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-medium text-gray-800">
                        {{ $index + 1 }}. {{ $question->text }}
                    </h3>
                    <ul class="mt-2 list-disc list-inside text-gray-700">
                        <li>A. {{ $question->option_a }}</li>
                        <li>B. {{ $question->option_b }}</li>
                        <li>C. {{ $question->option_c }}</li>
                        <li>D. {{ $question->option_d }}</li>
                    </ul>
                    <p class="mt-2 text-green-700 font-semibold">
                        Jawaban Benar: {{ strtoupper($question->correct_answer) }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-gray-500 italic">
            Tidak ada pertanyaan dalam kuis ini.
        </div>
        @endif
    </div>
</div>
@endsection
