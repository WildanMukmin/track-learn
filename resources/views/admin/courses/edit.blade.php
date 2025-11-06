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
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <div class="flex items-center">
                        <a href="{{ route('admin.courses.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                            <i class="fas fa-arrow-left text-xl"></i>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Edit Kursus</h1>
                            <p class="text-gray-600">Ubah informasi kursus</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kursus</label>
                                <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="description" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('description', $course->description) }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Jelaskan secara detail tentang kursus ini</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Guru</label>
                                <select name="teacher_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    <option value="">Pilih Guru</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }} ({{ $teacher->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex space-x-3 pt-4">
                                <a href="{{ route('admin.courses.index') }}"
                                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 text-center rounded-lg hover:bg-gray-50 transition">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="flex-1 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>