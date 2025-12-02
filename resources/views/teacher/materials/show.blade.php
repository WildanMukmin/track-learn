@extends('teacher.layouts.teacher')

@section('title', 'Materi Saya')

@section('content')
    <div class="flex h-full w-full overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white flex flex-col justify-between h-full shadow-lg">
            <div class="p-6 flex-1 overflow-y-auto">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <i class="fas fa-graduation-cap text-3xl"></i>
                    <span class="ml-2 text-2xl font-bold">TrackLearn</span>
                </div>

                <!-- Navigation -->
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
                        class="flex items-center px-4 py-3 bg-blue-900 rounded-lg shadow-md">
                        <i class="fas fa-file-alt mr-3"></i> Materi
                    </a>

                    <a href="{{ route('teacher.quizzes.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
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

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md flex-shrink-0">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $material->title }}</h1>
                        <p class="text-gray-600">Detail materi yang Anda buat</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.materials.index') }}"
                            class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition shadow-md">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <!-- Kursus -->
                    <div class="mb-4">
                        <p class="text-gray-600 text-sm">Mata Kuliah:</p>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $material->course->title ?? 'Tidak ada' }}</h3>
                    </div>

                    <hr class="my-4">

                    <!-- Konten Materi -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Isi Materi:</h4>
                        <p class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($material->content)) ?? 'Tidak ada konten.' !!}
                        </p>
                    </div>

                    <!-- File Materi -->
                    @if($material->file_path)
                        <div class="mb-6">
                            <h4 class="text-md font-semibold text-gray-700 mb-2">Download File Materi:</h4>
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                                class="inline-block px-5 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow">
                                <i class="fas fa-download mr-2"></i> Download File
                            </a>
                        </div>
                    @endif

                    <!-- Info Tambahan -->
                    <div class="mt-6 text-sm text-gray-500">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Dibuat pada: {{ $material->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection