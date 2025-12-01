@extends('teacher.layouts.teacher')

@section('title', 'Daftar Kuis')

@section('content')
<div class="flex h-screen overflow-hidden bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col justify-between h-full shadow-lg">
        <div class="p-6 flex-1 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center mb-8">
                <i class="fas fa-graduation-cap text-3xl"></i>
                <span class="ml-2 text-2xl font-bold">TrackLearn</span>
            </div>

            <!-- Navigasi -->
            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>

                <a href="{{ route('teacher.courses') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-book mr-3"></i> Kursus Saya
                </a>

                <a href="{{ route('teacher.courses.create') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus-circle mr-3"></i> Buat Kursus
                </a>
                
                <a href="{{ route('teacher.materials.index') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-file-alt mr-3"></i> Materi
                </a>

                <a href="{{ route('teacher.quizzes.index') }}"
                   class="flex items-center px-4 py-3 bg-blue-900 rounded-lg shadow-md">
                    <i class="fas fa-question-circle mr-3"></i> Kuis
                </a>

                <a href="{{ route('teacher.students.index') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-users mr-3"></i> Siswa
                </a>
            </nav>
        </div>

        <!-- Footer Sidebar -->
        <div class="p-6 border-t border-blue-700 bg-blue-900">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center shadow">
                    <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-300">Guru</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition text-sm shadow">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-hidden">
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
    </main>
</div>
@endsection
