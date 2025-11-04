<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TrackLearn</title>
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
    <!-- Sidebar -->
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
                        class="flex items-center px-4 py-3 bg-purple-900 rounded-lg">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Pengguna
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-book mr-3"></i>
                        Kelola Kursus
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-chart-bar mr-3"></i>
                        Laporan
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-cog mr-3"></i>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-6 border-t border-purple-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-purple-300">Administrator</p>
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
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                        <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-600">Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-8">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Pengguna</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</h3>
                                <p class="text-green-600 text-sm mt-2">
                                    <i class="fas fa-arrow-up"></i> +12% bulan ini
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-3xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Students -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Siswa</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalStudents }}</h3>
                                <p class="text-green-600 text-sm mt-2">
                                    <i class="fas fa-arrow-up"></i> +8% bulan ini
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-graduate text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Teachers -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Guru</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalTeachers }}</h3>
                                <p class="text-green-600 text-sm mt-2">
                                    <i class="fas fa-arrow-up"></i> +5% bulan ini
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-3xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Courses -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Kursus</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCourses }}</h3>
                                <p class="text-green-600 text-sm mt-2">
                                    <i class="fas fa-arrow-up"></i> +15% bulan ini
                                </p>
                            </div>
                            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book text-3xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Users -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Pengguna Terbaru</h3>
                            <a href="#" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">Lihat
                                Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentUsers as $user)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-purple-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($user->role == 'admin') bg-red-100 text-red-600
                                        @elseif($user->role == 'teacher') bg-blue-100 text-blue-600
                                        @else bg-green-100 text-green-600
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada pengguna</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Courses -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Kursus Terbaru</h3>
                            <a href="#" class="text-purple-600 hover:text-purple-700 text-sm font-semibold">Lihat
                                Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentCourses as $course)
                                <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-gray-800">{{ $course->title }}</h4>
                                        <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded text-xs font-semibold">
                                            Aktif
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($course->description, 80) }}</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-user mr-2"></i>
                                        <span>{{ $course->teacher->name }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada kursus</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Statistik Enrollments</h3>
                    <div class="h-64 flex items-center justify-center text-gray-500">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-6xl mb-4 text-gray-400"></i>
                            <p>Chart akan ditampilkan di sini</p>
                            <p class="text-sm">(Gunakan Chart.js atau library lain)</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>