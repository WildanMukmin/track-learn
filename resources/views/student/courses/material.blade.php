@extends('student.layouts.student')

@section('title', $material->title)

@section('content')

<div class="container mx-auto px-8 py-6">

    <!-- Header Navigasi -->
    <div class="mb-4 flex items-center justify-between">
        <a href="{{ route('student.courses.show', $course->id) }}" 
           class="text-blue-600 text-sm">← Kembali ke Kursus</a>
    </div>

    <!-- Judul -->
    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $material->title }}</h1>

    <!-- Deskripsi -->
    <p class="text-gray-700 mb-4">{{ $material->description }}</p>

    <!-- Konten Materi -->
    <div class="bg-white shadow rounded-lg p-5 mb-6">

        <!-- Jika ada video -->
        @if($material->video_url)
            <div class="mb-4">
                <iframe 
                    src="{{ $material->video_url }}"
                    class="w-full h-80 rounded-lg"
                    allowfullscreen>
                </iframe>
            </div>
        @endif

        <!-- TAMBAHAN: Jika ada file PDF -->
        @if($material->file_path)
            <div class="mb-6">
                <iframe 
                    src="{{ asset('storage/' . $material->file_path) }}"
                    class="w-full h-[600px] border rounded">
                </iframe>

                <!-- optional tombol download -->
                <a href="{{ asset('storage/' . $material->file_path) }}"
                   target="_blank"
                   class="mt-2 inline-block text-blue-600 text-sm">
                    Download PDF →
                </a>
            </div>
        @endif

        <!-- Jika ada konten text -->
        @if($material->content)
            <div class="prose max-w-none text-gray-800">
                {!! $material->content !!}
            </div>
        @endif

    </div>

    <!-- Tombol Selesaikan -->
    <form action="{{ route('student.courses.material.complete', [$course->id, $material->id]) }}" method="POST">
        @csrf

        @if($progress && $progress->is_completed)
            <button class="bg-green-600 text-white px-4 py-2 rounded shadow">
                ✓ Sudah Selesai
            </button>
        @else
            <button class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                Tandai Selesai
            </button>
        @endif
    </form>

    <!-- Navigasi Previous / Next -->
    <div class="flex justify-between mt-8">

        @if($previous)
            <a href="{{ route('student.courses.material.show', [$course->id, $previous->id]) }}"
               class="text-blue-600 text-sm">
               ← {{ $previous->title }}
            </a>
        @else
            <span></span>
        @endif

        @if($next)
            @if($progress && $progress->is_completed)
                <a href="{{ route('student.courses.material.show', [$course->id, $next->id]) }}"
                   class="text-blue-600 text-sm">
                    {{ $next->title }} →
                </a>
            @else
                <span class="text-gray-400 text-sm">Selesaikan materi ini untuk lanjut →</span>
            @endif
        @endif
    </div>

</div>

@endsection
