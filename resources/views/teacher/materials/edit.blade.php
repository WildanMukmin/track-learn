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

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md flex-shrink-0">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit Materi</h1>
                        <p class="text-gray-600">Perbarui materi Anda</p>
                    </div>
                    <div>
                        <a href="{{ route('teacher.materials.index') }}"
                            class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition shadow-md">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content Form -->
            <div class="flex-1 overflow-y-auto p-8">
                @if ($errors->any())
                    <div class="mb-6 text-red-700 bg-red-100 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <form action="{{ route('teacher.materials.update', $material->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul Materi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="title">Judul Materi</label>
                            <input type="text" id="title" name="title"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ old('title', $material->title) }}" required>
                        </div>

                        <!-- Kursus -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="course_id">Kursus</label>
                            <select id="course_id" name="course_id"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="">Pilih kursus</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ (old('course_id', $material->course_id) == $course->id) ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Konten Materi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="content">Konten Materi</label>
                            <textarea id="content" name="content" rows="6"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content', $material->content) }}</textarea>
                        </div>

                        <!-- File Materi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2" for="file_path">Upload File Materi
                                (Opsional)</label>
                            <input type="file" id="file_path" name="file_path"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @if($material->file_path)
                                <p class="mt-2 text-sm text-gray-500">File saat ini:
                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                                        class="text-blue-700 hover:underline">
                                        {{ basename($material->file_path) }}
                                    </a>
                                </p>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-all shadow-md">
                                <i class="fas fa-save mr-2"></i> Perbarui Materi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection