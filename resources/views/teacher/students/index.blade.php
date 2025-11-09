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
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Siswa</h1>
                    <p class="text-gray-600">Lihat semua siswa yang terdaftar di kursus Anda</p>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-8">
            {{-- Pencarian & Filter --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex items-center w-full md:w-1/2">
                    <input type="text" id="searchStudent" placeholder="Cari nama atau email siswa..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <select id="filterCourse" class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kursus</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->title }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tabel Daftar Siswa --}}
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                @if($students->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left text-sm font-semibold">Nama</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold">Email</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold">Kursus</th>
                                <th class="py-3 px-4 text-center text-sm font-semibold">Progres</th>
                                <th class="py-3 px-4 text-center text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            @foreach($students as $student)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-800">{{ $student->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">{{ $student->email }}</td>
                                    <td class="py-3 px-4 text-gray-700">
                                        @if($student->enrolledCourses->count() > 0)
                                            {{ $student->enrolledCourses->pluck('title')->join(', ') }}
                                        @else
                                            Belum Terdaftar
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $student->progress ?? 0 }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-600">{{ $student->progress ?? 0 }}%</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('teacher.students.show', $student->id) }}" 
                                               class="text-blue-600 hover:text-blue-700" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <form action="{{ route('teacher.students.destroy', $student->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700" title="Hapus Siswa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-10 text-gray-500">
                        <i class="fas fa-user-graduate text-5xl mb-3 text-gray-300"></i>
                        <p>Belum ada siswa yang terdaftar.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

{{-- Script Filter & Pencarian --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
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
