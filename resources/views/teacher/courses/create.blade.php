@extends('teacher.layouts.teacher')

@section('title', 'Buat Kursus Baru')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col justify-between h-full">
        <div class="p-6 flex-1 overflow-y-auto">
            <div class="flex items-center mb-8">
                <i class="fas fa-graduation-cap text-3xl"></i>
                <span class="ml-2 text-2xl font-bold">TrackLearn</span>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="{{ route('teacher.courses') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-book mr-3"></i> Kursus Saya
                </a>
                <a href="{{ route('teacher.courses.create') }}"
                   class="flex items-center px-4 py-3 bg-blue-900 rounded-lg">
                    <i class="fas fa-plus-circle mr-3"></i> Buat Kursus
                </a>

                <a href="{{ route('teacher.materials.index') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
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

        <div class="p-6 border-t border-blue-700">
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
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100 overflow-hidden flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm flex-shrink-0">
            <div class="px-8 py-4">
                <h1 class="text-2xl font-bold text-gray-800">Buat Kursus Baru</h1>
                <p class="text-gray-600">Isi form di bawah untuk membuat kursus baru</p>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Buat Kursus Baru</h2>

                <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul Kursus -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Judul Kursus</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300" required>
                    </div>

                    <!-- Deskripsi Kursus -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Deskripsi Kursus</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300" required></textarea>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Thumbnail Kursus (opsional)</label>
                        <input type="file" name="thumbnail" class="w-full text-gray-600">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="category" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="teknologi">Teknologi</option>
                            <option value="bahasa">Bahasa</option>
                            <option value="sains">Sains</option>
                            <option value="bisnis">Bisnis</option>
                        </select>
                    </div>

                    <!-- Tingkat Kesulitan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Tingkat Kesulitan</label>
                        <select name="difficulty" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="pemula">Pemula</option>
                            <option value="menengah">Menengah</option>
                            <option value="lanjutan">Lanjutan</option>
                        </select>
                    </div>

                    <!-- Durasi Kursus -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Durasi / Perkiraan Waktu</label>
                        <input type="text" name="duration" placeholder="Contoh: 5 jam, 10 modul" class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-center mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i> Simpan Kursus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection