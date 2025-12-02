@extends('teacher.layouts.teacher')


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
                <a href="{{ route('teacher.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="{{ route('teacher.courses') }}" class="flex items-center px-4 py-3 bg-blue-900 rounded-lg shadow-md">
                    <i class="fas fa-book mr-3"></i> Kursus Saya
                </a>
                <a href="{{ route('teacher.courses.create') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus-circle mr-3"></i> Buat Kursus
                </a>
                <a href="{{ route('teacher.materials.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-file-alt mr-3"></i> Materi
                </a>
                <a href="{{ route('teacher.quizzes.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-question-circle mr-3"></i> Kuis
                </a>
                <a href="{{ route('teacher.students.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
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
        <div class="flex justify-center items-center min-h-[calc(100vh-100px)]">
            <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-2xl">
                <!-- Detail Kursus -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="mr-3"><i class="fas fa-book"></i></span> Detail Kursus
                    </h2>
                    <div class="bg-blue-50 rounded-lg p-6 mb-2">
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Judul Kursus:</span>
                            <span class="ml-2 text-gray-800">{{ $course->title }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Deskripsi Kursus:</span>
                            <span class="ml-2 text-gray-800">{{ $course->description }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Kategori:</span>
                            <span class="ml-2 text-gray-800">{{ $course->category ? ucfirst($course->category) : '-' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Tingkat Kesulitan:</span>
                            <span class="ml-2 text-gray-800">{{ $course->difficulty ? ucfirst($course->difficulty) : '-' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Durasi / Perkiraan Waktu:</span>
                            <span class="ml-2 text-gray-800">{{ $course->duration ?? '-' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold text-gray-700">Tanggal Dibuat:</span>
                            <span class="ml-2 text-gray-800">{{ $course->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class="fas fa-user-graduate mr-2"></i>
                        {{ $course->students->count() }} siswa telah enroll
                    </div>
                </div>
                <div class="mb-6 flex gap-3">
                    <a href="{{ route('teacher.courses.edit', $course->id) }}" class="px-5 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit Kursus
                    </a>
                    <a href="{{ route('teacher.courses') }}" class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition shadow flex items-center text-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Daftar Siswa yang Enroll</h3>
                @if($course->students->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow-sm">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 bg-blue-50 text-left text-xs font-semibold text-blue-700">No</th>
                                    <th class="py-2 px-4 bg-blue-50 text-left text-xs font-semibold text-blue-700">Nama</th>
                                    <th class="py-2 px-4 bg-blue-50 text-left text-xs font-semibold text-blue-700">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->students as $i => $student)
                                <tr class="border-b">
                                    <td class="py-2 px-4 text-gray-700">{{ $i+1 }}</td>
                                    <td class="py-2 px-4 font-semibold text-gray-800">{{ $student->name }}</td>
                                    <td class="py-2 px-4 text-gray-500">{{ $student->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-users text-2xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-500 text-base">Belum ada siswa yang enroll.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
