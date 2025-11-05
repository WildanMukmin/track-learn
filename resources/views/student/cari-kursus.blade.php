@extends('student.layouts.student')

@section('title', 'Cari Kursus')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4">
        <h1 class="text-2xl font-bold text-gray-800">Explore Courses</h1>
        <p class="text-gray-600 mt-1">Discover and enroll in courses to expand your skills</p>
    </div>
</header>
@endsection

@section('content')
<div class="mb-6">
    <form action="{{ route('student.courses.search') }}" method="GET" class="flex gap-2">
        <input
            type="text"
            name="q"
            placeholder="Cari nama kursus..."
            value="{{ request('q') }}"
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
        >
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Cari
        </button>
    </form>

</div>

@if($courses->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition card-hover">
                <div class="h-32 bg-gradient-to-r from-blue-100 to-green-100 rounded-t-lg"></div>

                <div class="p-4">
                    <span class="inline-block bg-emerald-600 text-white text-xs font-semibold px-2 py-1 rounded mb-2">
                        Beginner
                    </span>

                    <h2 class="font-bold text-xl text-gray-800 mb-1">
                        {{ $course->title }}
                    </h2>
                    <p class="text-gray-600 text-sm mb-2">
                        {{ Str::limit($course->description, 90) }}
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span><i class="fas fa-user"></i> {{ number_format($course->students->count()) }} students</span>
                    </div>

                    <hr class="my-3">

                    <p class="text-sm text-gray-600">Instructor</p>
                    <p class="font-semibold text-gray-800 mb-3">{{ $course->teacher->name ?? '-' }}</p>

                    <a href="#"
                       class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 text-sm font-semibold">
                        Enroll Now
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-gray-500">Tidak ada kursus ditemukan.</p>
@endif
@endsection
