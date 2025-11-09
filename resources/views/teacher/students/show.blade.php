@extends('teacher.layouts.teacher')

@section('title', 'Detail Siswa')

@section('content')
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
@endsection
