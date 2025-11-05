@extends('student.layouts.student')

@section('title', 'Dashboard')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Siswa</h1>
            <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}! Lanjutkan belajar Anda.</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('student.courses.search') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-search mr-2"></i>Cari Kursus
            </a>
        </div>
    </div>
</header>
@endsection

@section('content')
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Enrolled -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Kursus Terdaftar</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEnrolled }}</h3>
                                <p class="text-blue-600 text-sm mt-2">Total Kursus</p>
                            </div>
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book text-3xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Sedang Berjalan</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $inProgressCourses }}</h3>
                                <p class="text-yellow-600 text-sm mt-2">Kursus Aktif</p>
                            </div>
                            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-spinner text-3xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Selesai</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $completedCourses }}</h3>
                                <p class="text-green-600 text-sm mt-2">Kursus Lulus</p>
                            </div>
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-3xl text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My Courses with Progress Tracking -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Kursus Saya</h3>
                        <a href="#" class="text-green-600 hover:text-green-700 text-sm font-semibold">Lihat Semua</a>
                    </div>

                    @if($enrolledCourses->count() > 0)
                        <div class="space-y-4">
                            @foreach($enrolledCourses as $enrollment)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-800 mb-2">{{ $enrollment->course->title }}</h4>
                                            <p class="text-sm text-gray-600 mb-3">
                                                {{ Str::limit($enrollment->course->description, 100) }}
                                            </p>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-user mr-2"></i>
                                                <span>{{ $enrollment->course->teacher->name }}</span>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold ml-4
                                                                    @if($enrollment->status == 'passed' || $enrollment->status == 'certificate_issued') bg-green-100 text-green-600
                                                                    @elseif($enrollment->status == 'in_progress' || $enrollment->status == 'material_completed') bg-blue-100 text-blue-600
                                                                    @elseif($enrollment->status == 'quiz_attempted') bg-yellow-100 text-yellow-600
                                                                    @else bg-gray-100 text-gray-600
                                                                    @endif">
                                            {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                                        </span>
                                    </div>

                                    <!-- Progress Tracking -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-semibold text-gray-700">Progress Belajar</span>
                                            <span class="text-sm font-semibold text-green-600">
                                                @php
                                                    $statusProgress = [
                                                        'enrolled' => 10,
                                                        'in_progress' => 30,
                                                        'material_completed' => 60,
                                                        'quiz_attempted' => 80,
                                                        'passed' => 90,
                                                        'certificate_issued' => 100
                                                    ];
                                                    $progress = $statusProgress[$enrollment->status] ?? 0;
                                                @endphp
                                                {{ $progress }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="progress-bar bg-green-600 h-2 rounded-full"
                                                style="width: {{ $progress }}%"></div>
                                        </div>

                                        <!-- Progress Steps -->
                                        <div class="flex justify-between mt-4 text-xs">
                                            <div
                                                class="flex flex-col items-center {{ in_array($enrollment->status, ['enrolled', 'in_progress', 'material_completed', 'quiz_attempted', 'passed', 'certificate_issued']) ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-check-circle text-lg mb-1"></i>
                                                <span>Enrolled</span>
                                            </div>
                                            <div
                                                class="flex flex-col items-center {{ in_array($enrollment->status, ['in_progress', 'material_completed', 'quiz_attempted', 'passed', 'certificate_issued']) ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-book-open text-lg mb-1"></i>
                                                <span>Belajar</span>
                                            </div>
                                            <div
                                                class="flex flex-col items-center {{ in_array($enrollment->status, ['material_completed', 'quiz_attempted', 'passed', 'certificate_issued']) ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-tasks text-lg mb-1"></i>
                                                <span>Materi</span>
                                            </div>
                                            <div
                                                class="flex flex-col items-center {{ in_array($enrollment->status, ['quiz_attempted', 'passed', 'certificate_issued']) ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-question-circle text-lg mb-1"></i>
                                                <span>Kuis</span>
                                            </div>
                                            <div
                                                class="flex flex-col items-center {{ in_array($enrollment->status, ['passed', 'certificate_issued']) ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-trophy text-lg mb-1"></i>
                                                <span>Lulus</span>
                                            </div>
                                            <div
                                                class="flex flex-col items-center {{ $enrollment->status == 'certificate_issued' ? 'text-green-600' : 'text-gray-400' }}">
                                                <i class="fas fa-certificate text-lg mb-1"></i>
                                                <span>Sertifikat</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="#"
                                            class="flex-1 px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition text-sm">
                                            <i class="fas fa-play mr-2"></i>Lanjutkan Belajar
                                        </a>
                                        @if($enrollment->status == 'certificate_issued')
                                            <a href="#"
                                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-sm">
                                                <i class="fas fa-download mr-1"></i>Sertifikat
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 mb-4">Anda belum mendaftar kursus apapun</p>
                            <a href="#"
                                class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                <i class="fas fa-search mr-2"></i>Cari Kursus Menarik
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Available Courses -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Kursus Yang Tersedia</h3>
                        <a href="#" class="text-green-600 hover:text-green-700 text-sm font-semibold">Lihat Semua</a>
                    </div>

                    @if($availableCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($availableCourses as $course)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition card-hover">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                        <i class="fas fa-book text-green-600 text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-800 mb-2">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 80) }}</p>

                                    <div class="flex items-center text-sm text-gray-500 mb-4">
                                        <i class="fas fa-user mr-2"></i>
                                        <span>{{ $course->teacher->name }}</span>
                                    </div>

                                    <button
                                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm">
                                        <i class="fas fa-plus mr-2"></i>Daftar Kursus
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Tidak ada kursus yang tersedia saat ini</p>
                    @endif
                </div>
@endsection