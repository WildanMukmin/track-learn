@extends('teacher.layouts.teacher')

@section('content')
<div class="p-8 text-center">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Kursus Saya</h1>

    @if(session('success'))
        <div class="mb-6 text-green-600 bg-green-100 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-lg shadow p-6 card-hover">
                    <h3 class="text-lg font-bold mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                    <div class="flex justify-between">
                        <a href="#" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                        <a href="#" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Lihat</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center min-h-[50vh]">
            <p class="text-gray-500 text-lg mb-4">Belum ada kursus. Buat kursus baru sekarang!</p>
            <a href="{{ route('teacher.courses.create') }}"
               class="mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
               <i class="fas fa-plus mr-2"></i> Buat Kursus
            </a>
        </div>
    @endif
</div>
@endsection
