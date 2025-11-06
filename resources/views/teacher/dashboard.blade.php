<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - TrackLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-graduation-cap text-3xl"></i>
                    <span class="ml-2 text-2xl font-bold">TrackLearn</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('teacher.dashboard') }}"
                        class="flex items-center px-4 py-3 bg-blue-900 rounded-lg">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('teacher.courses') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-book mr-3"></i>
                        Kursus Saya
                    </a>

                    <a href="{{ route('teacher.courses.create') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-plus-circle mr-3"></i>
                        Buat Kursus
                    </a>
                    {{-- <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-file-alt mr-3"></i>
                        Materi
                    </a> --}}
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-question-circle mr-3"></i>
                        Kuis
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-users mr-3"></i>
                        Siswa
                    </a>
                </nav>
            </div>

            <!-- User Info -->
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
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard Guru</h1>
                        <p class="text-gray-600">Kelola kursus dan pantau progres siswa Anda</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        {{-- <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button> --}}
                        <a href="{{ route('teacher.courses.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-plus mr-2"></i>Buat Kursus
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Courses -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Kursus</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCourses }}</h3>
                                <p class="text-blue-600 text-sm mt-2">Kursus Aktif</p>
                            </div>
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book text-3xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Students -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Siswa</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalStudents }}</h3>
                                <p class="text-green-600 text-sm mt-2">Siswa Terdaftar</p>
                            </div>
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-graduate text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completion Rate -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Tingkat Kelulusan</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">85%</h3>
                                <p class="text-purple-600 text-sm mt-2">Rata-rata Kelas</p>
                            </div>
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-3xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Courses -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Kursus Saya</h3>
                        <a href="{{ route('teacher.courses') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Lihat Semua</a>
                    </div>

                    @if($courses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($courses as $course)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-book text-blue-600 text-xl"></i>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">
                                            Aktif
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-gray-800 mb-2">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 80) }}</p>

                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-users mr-2"></i>
                                            <span>{{ $course->enrollments_count }} Siswa</span>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('teacher.courses.edit', $course->id) }}"
                                            class="flex-1 px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700 transition text-sm">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <a href="#"
                                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 mb-4">Anda belum memiliki kursus</p>
                            <a href="#"
                                class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-plus mr-2"></i>Buat Kursus Pertama
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Recent Enrollments -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Pendaftaran Terbaru</h3>
                        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Lihat Semua</a>
                    </div>

                    @if($recentEnrollments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Siswa</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Kursus</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Tanggal</th>
                                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentEnrollments as $enrollment)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center mr-3">
                                                        <i class="fas fa-user text-blue-600 text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-800 text-sm">
                                                            {{ $enrollment->student->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                <p class="text-sm text-gray-800">{{ $enrollment->course->title }}</p>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($enrollment->status == 'passed' || $enrollment->status == 'certificate_issued') bg-green-100 text-green-600
                                                    @elseif($enrollment->status == 'in_progress' || $enrollment->status == 'material_completed') bg-blue-100 text-blue-600
                                                    @elseif($enrollment->status == 'quiz_attempted') bg-yellow-100 text-yellow-600
                                                    @else bg-gray-100 text-gray-600
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-sm text-gray-600">
                                                {{ $enrollment->created_at->diffForHumans() }}
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <a href="#" class="text-blue-600 hover:text-blue-700">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Belum ada siswa yang mendaftar</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>

</html>