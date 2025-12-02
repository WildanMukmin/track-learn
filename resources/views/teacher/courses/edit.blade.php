@extends('teacher.layouts.teacher')

@section('title', 'Edit Kursus')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- gunakan struktur sidebar/layout yang sama seperti index supaya konsisten -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col justify-between h-full">
        <div class="p-6 flex-1 overflow-y-auto">
            <div class="flex items-center mb-8">
                <i class="fas fa-graduation-cap text-3xl"></i>
                <span class="ml-2 text-2xl font-bold">TrackLearn</span>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="{{ route('teacher.courses') }}" class="flex items-center px-4 py-3 bg-blue-900 rounded-lg">
                    <i class="fas fa-book mr-3"></i> Kursus Saya
                </a>
                <a href="{{ route('teacher.courses.create') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-plus-circle mr-3"></i> Buat Kursus
                </a>

                <a href="{{ route('teacher.materials.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                <i class="fas fa-file-alt mr-3"></i> Materi
                </a>
                    
                <a href="{{ route('teacher.quizzes.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                <i class="fas fa-question-circle mr-3"></i> Kuis
                </a>

                <a href="{{ route('teacher.students.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                <i class="fas fa-users mr-3"></i> Siswa
                </a>
            </nav>
        </div>

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

    <!-- main -->
    <main class="flex-1 bg-gray-100 overflow-hidden flex flex-col">
        <header class="bg-white shadow-sm flex-shrink-0">
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Kursus</h1>
                    <p class="text-gray-600">Perbarui detail kursus Anda</p>
                </div>
                <div>
                    <a href="{{ route('teacher.courses') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Judul Kursus</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                               class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <textarea name="description" rows="5" required class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                            <input type="text" name="category" value="{{ old('category', $course->category) }}" class="w-full border-gray-300 rounded p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tingkat Kesulitan</label>
                            <select name="difficulty" class="w-full border-gray-300 rounded p-2">
                                <option value="">-- Pilih --</option>
                                <option value="pemula" {{ old('difficulty', $course->difficulty) == 'pemula' ? 'selected' : '' }}>Pemula</option>
                                <option value="menengah" {{ old('difficulty', $course->difficulty) == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                <option value="lanjutan" {{ old('difficulty', $course->difficulty) == 'lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Durasi / Perkiraan Waktu</label>
                        <input type="text" name="duration" value="{{ old('duration', $course->duration) }}" placeholder="Contoh: 5 jam, 10 modul" class="w-full border-gray-300 rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Thumbnail (opsional)</label>
                        @if($course->thumbnail)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="thumbnail" class="w-48 h-28 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="w-full text-gray-600">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('teacher.courses') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
