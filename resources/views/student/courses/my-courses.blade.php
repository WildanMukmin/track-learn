@extends('student.layouts.student')

@section('title', 'Kursus Saya')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4">
        <h1 class="text-2xl font-bold text-gray-800">Kursus Saya</h1>
        <p class="text-gray-600 mt-1">Lihat semua kursus yang sudah kamu ikuti dan pelajari materinya.</p>
    </div>
</header>
@endsection

@section('content')
<div class="container mx-auto px-6 py-6">
    {{-- Pesan Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded mb-4">
            {{ session('info') }}
        </div>
    @endif

    {{-- Jika belum ada kursus --}}
    @if(isset($message))
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    {{-- Daftar kursus --}}
    @if($enrollments->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($enrollments as $enrollment)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="h-32 bg-gradient-to-r from-blue-100 to-green-100 rounded-t-lg"></div>
                    <div class="p-4">
                        <h2 class="font-bold text-xl text-gray-800 mb-2">
                            {{ $enrollment->course->title }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-3">
                            {{ \Illuminate\Support\Str::limit($enrollment->course->description, 100) }}
                        </p>

                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Pengajar:</strong> {{ $enrollment->course->teacher->name ?? '-' }}
                        </p>

                        <p class="text-sm text-gray-600 mb-3">
                            <strong>Status:</strong>
                            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                            </span>
                        </p>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('student.courses.show', $enrollment->course->id) }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                                    Lihat Detail
                            </a>
                            <span class="text-xs text-gray-400">
                                {{ $enrollment->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
