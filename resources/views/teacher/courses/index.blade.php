@extends('teacher.layouts.teacher')

@section('title', 'Kursus Saya')

@section('content')
<div class="flex h-screen overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100"> {{-- Tambahkan gradien latar belakang untuk kesan modern --}}
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white flex flex-col justify-between h-full shadow-2xl transform transition-transform duration-300 ease-in-out hover:scale-105"> {{-- Tambahkan gradien, shadow, dan efek hover pada sidebar --}}
        <div class="p-6 flex-1 overflow-y-auto">
            <div class="flex items-center mb-8 animate-pulse"> {{-- Tambahkan animasi pulse pada logo --}}
                <i class="fas fa-graduation-cap text-3xl text-yellow-300"></i> {{-- Ubah warna ikon untuk kontras --}}
                <span class="ml-2 text-2xl font-bold bg-gradient-to-r from-yellow-300 to-white bg-clip-text text-transparent">TrackLearn</span> {{-- Tambahkan gradien teks --}}
            </div>

            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200 transform hover:translate-x-2 hover:shadow-lg">
                    <i class="fas fa-home mr-3 text-blue-200"></i> Dashboard
                </a>
                <a href="{{ route('teacher.courses') }}"
                   class="flex items-center px-4 py-3 bg-gradient-to-r from-blue-900 to-blue-700 rounded-lg shadow-lg transform scale-105"> {{-- Tambahkan gradien dan efek scale pada menu aktif --}}
                    <i class="fas fa-book mr-3 text-yellow-300"></i> Kursus Saya
                </a>
                <a href="{{ route('teacher.courses.create') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200 transform hover:translate-x-2 hover:shadow-lg">
                    <i class="fas fa-plus-circle mr-3 text-green-300"></i> Buat Kursus
                </a>
                <a href="{{ route('teacher.quizzes.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200 transform hover:translate-x-2 hover:shadow-lg">
                    <i class="fas fa-question-circle mr-3 text-purple-300"></i> Kuis
                </a>
                <a href="{{ route('teacher.students.index') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition-all duration-200 transform hover:translate-x-2 hover:shadow-lg">
                    <i class="fas fa-users mr-3 text-pink-300"></i> Siswa
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-blue-700 bg-gradient-to-t from-blue-900 to-blue-800">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center shadow-lg animate-bounce"> {{-- Tambahkan gradien, shadow, dan animasi bounce pada avatar --}}
                    <i class="fas fa-chalkboard-teacher text-white text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-blue-300">Guru</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg text-sm">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100 overflow-hidden flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-lg flex-shrink-0 bg-gradient-to-r from-white to-gray-50"> {{-- Tambahkan gradien dan shadow lebih kuat --}}
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Kursus Saya</h1> {{-- Tambahkan gradien teks --}}
                    <p class="text-gray-600">Kelola kursus yang telah Anda buat</p>
                </div>
                <div>
                    <a href="{{ route('teacher.courses.create') }}"
                       class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Buat Kursus
                    </a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="mb-6 text-green-600 bg-green-100 p-4 rounded-lg shadow-lg animate-fade-in border-l-4 border-green-500"> {{-- Tambahkan animasi fade-in dan border --}}
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                        <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl card-hover relative overflow-hidden"> {{-- Tambahkan rounded-xl, shadow, efek hover scale, dan relative untuk overlay --}}
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div> {{-- Tambahkan strip gradien atas --}}
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4 shadow-md"> {{-- Tambahkan avatar placeholder --}}
                                    <i class="fas fa-book text-white"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $course->title }}</h3>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('teacher.courses.edit', $course->id) }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-md">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <a href="#"
                                   class="px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg hover:from-gray-300 hover:to-gray-400 transition-all duration-200 transform hover:scale-105 shadow-md">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </div>
                            {{-- Tambahkan statistik sederhana --}}
                            <div class="mt-4 text-sm text-gray-500">
                                <i class="fas fa-users mr-1"></i> 25 Siswa Terdaftar {{-- Placeholder, ganti dengan data nyata jika ada --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center min-h-[calc(100vh-200px)] animate-fade-in">
                    <div class="w-24 h-24 bg-gradient-to-r from-gray-300 to-gray-400 rounded-full flex items-center justify-center mb-4 shadow-lg animate-pulse"> {{-- Tambahkan animasi pulse --}}
                        <i class="fas fa-book text-4xl text-gray-500"></i>
                    </div>
                    <p class="text-gray-500 text-lg mb-4">Belum ada kursus. Buat kursus baru sekarang!</p>
                    <a href="{{ route('teacher.courses.create') }}"
                       class="mt-4 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Buat Kursus
                    </a>
                </div>
            @endif
        </div>
    </main>
</div>

{{-- Tambahkan CSS kustom untuk animasi --}}
<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .card-hover:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection