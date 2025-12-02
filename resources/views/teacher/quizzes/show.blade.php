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
            <div class="absolute bottom-0 w-64 p-6 border-t border-blue-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-blue-300">Guru</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition text-sm">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-y-auto">
            <!-- Header -->
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
                                            {{ $index + 1 }}. {{ $question->question_text }}

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
        </main>
    </div>
@endsection