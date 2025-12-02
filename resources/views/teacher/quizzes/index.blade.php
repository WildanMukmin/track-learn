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
    <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-md flex-shrink-0">
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Kuis</h1>
                    <p class="text-gray-600">Kelola semua kuis yang telah Anda buat</p>
                </div>
                <a href="{{ route('teacher.quizzes.create') }}"
                   class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-all shadow-md">
                    <i class="fas fa-plus mr-2"></i> Buat Kuis
                </a>
            </div>
        </header>

        <!-- Konten -->
        <div class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($quizzes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($quizzes as $quiz)
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-lg font-bold text-gray-800">{{ $quiz->title }}</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full shadow-sm">
                                        {{ $quiz->questions_count }} Soal
                                    </span>
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full shadow-sm">
                                        {{ $quiz->attempts_count ?? 0 }} Mengikuti
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">
                                Dibuat pada {{ $quiz->created_at->format('d M Y') }}
                            </p>

                            <div class="flex justify-between items-center">
                                <!-- Tombol EDIT -->
                                <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}"
                                   class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow">
                                   <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <!-- Tombol LIHAT -->
                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}"
                                   class="px-4 py-2 bg-blue-100 text-blue-700 border border-blue-300 rounded-lg
                                    hover:bg-blue-200 hover:border-blue-400 transition shadow flex items-center font-semibold">
                                   <i class="fas fa-eye mr-1"></i> Lihat
                                </a>


                                <!-- Tombol HAPUS -->
                                <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kuis ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center min-h-[calc(100vh-250px)]">
                    <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mb-4 shadow">
                        <i class="fas fa-question-circle text-4xl text-gray-600"></i>
                    </div>
                    <p class="text-gray-500 text-lg mb-4">Belum ada kuis yang dibuat.</p>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow">
                        <i class="fas fa-plus mr-2"></i> Buat Kuis
                    </a>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
