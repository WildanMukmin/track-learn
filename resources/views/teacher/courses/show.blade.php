@extends('teacher.layouts.teacher')


@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold">{{ $course->title }}</h2>
    <p>{{ $course->description }}</p>

    <h3 class="mt-4 text-lg font-semibold">Daftar Siswa Terdaftar:</h3>

    @if($course->students->count() > 0)
        <ul class="mt-3">
            @foreach($course->students as $student)
                <li>{{ $student->name }} ({{ $student->email }})</li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Belum ada siswa yang enroll.</p>
    @endif
</div>
@endsection
