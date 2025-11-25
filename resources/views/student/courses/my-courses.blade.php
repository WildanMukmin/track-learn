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
                @php $course = $enrollment->course; @endphp

                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">

                    {{-- Thumbnail --}}
                    @if($course->thumbnail)
                        <div class="w-full h-40 overflow-hidden rounded-t-lg">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                alt="thumbnail"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-40 bg-gradient-to-r from-blue-100 to-green-100 rounded-t-lg"></div>
                    @endif

                    <div class="p-4">

                        {{-- Difficulty --}}
                        <span class="inline-block bg-emerald-600 text-white text-xs font-semibold px-2 py-1 rounded mb-2">
                            {{ $course->difficulty ?? 'Unknown Level' }}
                        </span>

                        {{-- Title --}}
                        <h2 class="font-bold text-xl text-gray-800 mb-1">
                            {{ $course->title }}
                        </h2>

                        {{-- Category --}}
                        @if($course->category)
                            <p class="text-sm text-green-700 font-semibold mb-1">
                                Category: {{ $course->category }}
                            </p>
                        @endif

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm mb-2">
                            {{ Str::limit($course->description, 90) }}
                        </p>

                        {{-- Duration --}}
                        @if($course->duration)
                            <p class="text-sm text-gray-500 mb-2">
                                <i class="fas fa-clock"></i> {{ $course->duration }}
                            </p>
                        @endif

                        {{-- Students Count --}}
                        <p class="text-sm text-gray-500 mb-3">
                            <i class="fas fa-user"></i> {{ number_format($course->students->count()) }} students
                        </p>

                        <hr class="my-3">

                        {{-- Instructor --}}
                        <p class="text-sm text-gray-600">Instructor</p>
                        <p class="font-semibold text-gray-800 mb-3">
                            {{ $course->teacher->name ?? '-' }}
                        </p>

                        {{-- Status --}}
                        <p class="text-sm text-gray-600 mb-4">
                            <strong>Status:</strong>
                            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                            </span>
                        </p>

                        {{-- Footer --}}
                        <div class="flex justify-between items-center">
                            <a href="{{ route('student.courses.show', $course->id) }}"
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
