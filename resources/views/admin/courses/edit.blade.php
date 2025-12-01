<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kursus - TrackLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-purple-800 text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-graduation-cap text-3xl"></i>
                    <span class="ml-2 text-2xl font-bold">TrackLearn</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                        class="flex items-center px-4 py-3 bg-purple-900 rounded-lg">
                        <i class="fas fa-book mr-3"></i>
                        Kelola Kursus
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 overflow-hidden flex flex-col">
            <header class="bg-white shadow-sm flex-shrink-0">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit Kursus</h1>
                        <p class="text-gray-600">Perbarui detail kursus</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.courses.index') }}"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>
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

                    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Judul Kursus</label>
                            <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                                class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                            <textarea name="description" rows="5" required
                                class="w-full border-gray-300 rounded p-2 focus:ring focus:ring-blue-300">{{ old('description', $course->description) }}</textarea>
                        </div>

                        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                                <input type="text" name="category" value="{{ old('category', $course->category) }}"
                                    class="w-full border-gray-300 rounded p-2">
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
                            <input type="text" name="duration" value="{{ old('duration', $course->duration) }}"
                                placeholder="Contoh: 5 jam, 10 modul" class="w-full border-gray-300 rounded p-2">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Thumbnail (opsional)</label>
                            @if($course->thumbnail)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="thumbnail"
                                        class="w-48 h-28 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" class="w-full text-gray-600">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.courses.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>