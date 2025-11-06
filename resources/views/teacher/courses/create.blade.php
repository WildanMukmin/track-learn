@extends('teacher.layouts.teacher')

@section('title', 'Buat Kursus Baru')

@section('content')
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
@endsection
