@extends('teacher.layouts.teacher')

@section('title', 'Edit Kuis')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kuis</h1>

    <form action="{{ route('teacher.quizzes.update', $quiz->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow max-h-[80vh] overflow-y-auto">
        @csrf
        @method('PUT')

        {{-- Pilih Kursus --}}
        <div class="mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Pilih Kursus</label>
            <select name="course_id" class="w-full border rounded-lg p-2" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $quiz->course_id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Judul Kuis --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Judul Kuis</label>
            <input type="text" name="title" class="w-full border rounded-lg p-2" 
                   value="{{ $quiz->title }}" required>
        </div>

        {{-- Pertanyaan --}}
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Pertanyaan</h2>
                <button type="button" id="add-question" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                    + Tambah Pertanyaan
                </button>
            </div>

            <div id="questions-container" class="space-y-6">
                @foreach($quiz->questions as $i => $q)
                <div class="question-item border border-gray-300 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold text-gray-700">Pertanyaan {{ $i + 1 }}</h3>
                        <button type="button" class="remove-question text-red-600 hover:underline">
                            Hapus
                        </button>
                    </div>

                    <label class="block font-medium mb-1">Teks Pertanyaan</label>
                    <input type="text" 
                           name="questions[{{ $i }}][question_text]" 
                           class="w-full border rounded-lg p-2 mb-3"
                           value="{{ $q->question_text }}" required>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium">Opsi A</label>
                            <input type="text" name="questions[{{ $i }}][option_a]"
                                   class="w-full border rounded-lg p-2"
                                   value="{{ $q->option_a }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Opsi B</label>
                            <input type="text" name="questions[{{ $i }}][option_b]"
                                   class="w-full border rounded-lg p-2"
                                   value="{{ $q->option_b }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Opsi C</label>
                            <input type="text" name="questions[{{ $i }}][option_c]"
                                   class="w-full border rounded-lg p-2"
                                   value="{{ $q->option_c }}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Opsi D</label>
                            <input type="text" name="questions[{{ $i }}][option_d]"
                                   class="w-full border rounded-lg p-2"
                                   value="{{ $q->option_d }}" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="block font-medium mb-1">Jawaban Benar</label>
                        <select name="questions[{{ $i }}][correct_answer]" class="border rounded-lg p-2 w-1/3" required>
                            <option value="a" {{ $q->correct_answer === 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ $q->correct_answer === 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ $q->correct_answer === 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ $q->correct_answer === 'd' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Update Kuis
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionIndex = {{ count($quiz->questions) }};
        const container = document.getElementById('questions-container');

        document.getElementById('add-question').addEventListener('click', function () {
            const template = `
            <div class="question-item border border-gray-300 rounded-lg p-4">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-gray-700">Pertanyaan Baru</h3>
                    <button type="button" class="remove-question text-red-600 hover:underline">Hapus</button>
                </div>

                <label class="block font-medium mb-1">Teks Pertanyaan</label>
                <input type="text" name="questions[${questionIndex}][question_text]" class="w-full border rounded-lg p-2 mb-3" required>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium">Opsi A</label>
                        <input type="text" name="questions[${questionIndex}][option_a]" class="w-full border rounded-lg p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Opsi B</label>
                        <input type="text" name="questions[${questionIndex}][option_b]" class="w-full border rounded-lg p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Opsi C</label>
                        <input type="text" name="questions[${questionIndex}][option_c]" class="w-full border rounded-lg p-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Opsi D</label>
                        <input type="text" name="questions[${questionIndex}][option_d]" class="w-full border rounded-lg p-2" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block font-medium mb-1">Jawaban Benar</label>
                    <select name="questions[${questionIndex}][correct_answer]" class="border rounded-lg p-2 w-1/3" required>
                        <option value="">-- Pilih --</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
            </div>`;

            container.insertAdjacentHTML('beforeend', template);
            questionIndex++;
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-question')) {
                e.target.closest('.question-item').remove();
            }
        });
    });
</script>

@endsection
