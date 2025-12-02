@extends('teacher.layouts.teacher')

@section('title', 'Daftar Siswa')

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
                        class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-plus-circle mr-3"></i> Buat Kursus
                    </a>

                    <a href="{{ route('teacher.materials.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200">
                        <i class="fas fa-file-alt mr-3"></i> Materi
                    </a>

                    <a href="{{ route('teacher.quizzes.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                        <i class="fas fa-question-circle mr-3"></i> Kuis
                    </a>
                    <a href="{{ route('teacher.students.index') }}"
                        class="flex items-center px-4 py-3 bg-blue-900 rounded-lg transition">
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

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 overflow-hidden flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm flex-shrink-0">
                <div class="px-8 py-4 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Daftar Siswa</h1>
                        <p class="text-gray-600">Lihat semua siswa yang terdaftar di kursus Anda</p>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-8">
                <a href="{{ route('teacher.students.index') }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 mb-4 inline-block">
                    ← Kembali
                </a>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4">{{ $student->name }}</h2>
                    <p class="text-gray-700 mb-2"><strong>Email:</strong> {{ $student->email }}</p>

                    <h3 class="text-xl font-semibold mt-4 mb-2">Kursus yang Diikuti:</h3>
                    @if($student->enrolledCourses->count() > 0)
                        <ul class="list-disc ml-6 text-gray-800">
                            @foreach($student->enrolledCourses as $course)
                                <li>{{ $course->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">Belum mengikuti kursus apa pun.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>

    {{-- Script Filter & Pencarian --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchStudent');
            const filterCourse = document.getElementById('filterCourse');
            const studentRows = document.querySelectorAll('#studentTable tr');

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const courseFilter = filterCourse.value.toLowerCase();

                studentRows.forEach(row => {
                    const name = row.querySelector('td:nth-child(1) span')?.textContent.toLowerCase() || '';
                    const email = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const course = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';

                    const matchesSearch = name.includes(searchValue) || email.includes(searchValue);
                    const matchesCourse = !courseFilter || course.includes(courseFilter);

                    row.style.display = (matchesSearch && matchesCourse) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            filterCourse.addEventListener('change', filterTable);
        });
    </script>
@endsection