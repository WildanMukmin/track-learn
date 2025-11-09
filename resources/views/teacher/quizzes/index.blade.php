@extends('teacher.layouts.teacher')

@section('title', 'Daftar Kuis')

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
                   class="flex items-center px-4 py-3 bg-blue-900 rounded-lg transition">
                    <i class="fas fa-question-circle mr-3"></i> Kuis
                </a>
                <a href="{{ route('teacher.students.index') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
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
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Kuis</h1>
                    <p class="text-gray-600">Kelola semua kuis yang telah Anda buat</p>
                </div>
                <div>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Buat Kuis
                    </a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 text-green-600 bg-green-100 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($quizzes->count() > 0)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left text-sm font-semibold">Judul</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold">Jumlah Soal</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-3 px-4 font-medium text-gray-800">{{ $quiz->title }}</td>
                                        <td class="py-3 px-4 text-center text-gray-700">{{ $quiz->questions_count ?? 0 }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="flex justify-center space-x-3">
                                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}" 
                                                   class="text-blue-600 hover:text-blue-700" title="Lihat Kuis">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('teacher.quizzes.destroy', $quiz->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Yakin ingin menghapus kuis ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-700" title="Hapus Kuis">
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
                </div>
            @else
                <div class="flex flex-col items-center justify-center min-h-[calc(100vh-300px)]">
                    <i class="fas fa-question-circle text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg mb-4">Belum ada kuis yang dibuat.</p>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i> Buat Kuis
                    </a>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
