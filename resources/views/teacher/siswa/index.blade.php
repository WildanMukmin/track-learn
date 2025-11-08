@extends('teacher.layouts.teacher')

@section('title', 'Daftar Siswa')

@section('content')
<div x-data="{ openSidebar: false }" class="min-h-screen flex bg-gray-50">

    <!-- Sidebar (Responsive) -->
    <aside 
        :class="openSidebar ? 'translate-x-0' : '-translate-x-full'" 
        class="fixed md:static inset-y-0 left-0 w-64 bg-blue-800 text-white flex flex-col justify-between transform transition-transform duration-300 z-40 md:translate-x-0">

        <div class="p-6 flex-1 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center mb-8">
                <i class="fas fa-graduation-cap text-3xl"></i>
                <span class="ml-2 text-2xl font-bold">TrackLearn</span>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-home mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('teacher.courses') }}"
                   class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-book mr-3"></i>
                    <span>Kursus Saya</span>
                </a>
                <a href="{{ route('teacher.courses.create') }}"
                   class="flex items-center px-4 py-3 bg-blue-900 rounded-lg">
                    <i class="fas fa-plus-circle mr-3"></i>
                    <span>Buat Kursus</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-question-circle mr-3"></i>
                    <span>Kuis</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-users mr-3"></i>
                    <span>Siswa</span>
                </a>
            </nav>
        </div>

        <!-- User info + Logout -->
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

    <!-- Overlay (mobile) -->
    <div 
        x-show="openSidebar"
        @click="openSidebar = false"
        class="fixed inset-0 bg-black opacity-50 z-30 md:hidden">
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-8 w-full">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📚 Daftar Siswa</h1>

            <!-- Hamburger (mobile) -->
            <button @click="openSidebar = !openSidebar" class="md:hidden p-2 rounded-md bg-blue-800 text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Card Container -->
        <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6">
            @if ($students->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    Tidak ada siswa terdaftar.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200 rounded-lg">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">No</th>
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr class="border-b hover:bg-gray-100 transition">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 font-medium text-gray-800">{{ $student->name }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $student->email }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('teacher.siswa.show', $student->id) }}" 
                                           class="bg-indigo-500 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg text-sm transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>
</div>

<!-- Alpine.js for responsive sidebar -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
