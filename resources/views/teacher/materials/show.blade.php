@extends('teacher.layouts.teacher')

@section('title', 'Detail Materi')

@section('content')
<div class="flex h-full w-full overflow-hidden">

    <!-- Sidebar tetap pakai dari layout -->

    <!-- Main Content -->
    <main class="flex-1 bg-gray-50 flex flex-col h-full overflow-hidden">

        <!-- Header -->
        <header class="bg-white shadow-md flex-shrink-0">
            <div class="px-8 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $material->title }}</h1>
                    <p class="text-gray-600">Detail materi yang Anda buat</p>
                </div>
                <div>
                    <a href="{{ route('teacher.materials.index') }}"
                       class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition shadow-md">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <!-- Kursus -->
                <div class="mb-4">
                    <p class="text-gray-600 text-sm">Mata Kuliah:</p>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $material->course->title ?? 'Tidak ada' }}</h3>
                </div>

                <hr class="my-4">

                <!-- Konten Materi -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-2">Isi Materi:</h4>
                    <p class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($material->content)) ?? 'Tidak ada konten.' !!}
                    </p>
                </div>

                <!-- File Materi -->
                @if($material->file_path)
                    <div class="mb-6">
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Download File Materi:</h4>
                        <a href="{{ asset('storage/' . $material->file_path) }}" 
                           target="_blank"
                           class="inline-block px-5 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow">
                            <i class="fas fa-download mr-2"></i> Download File
                        </a>
                    </div>
                @endif

                <!-- Info Tambahan -->
                <div class="mt-6 text-sm text-gray-500">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Dibuat pada: {{ $material->created_at->format('d M Y') }}
                </div>
            </div>
        </div>

    </main>
</div>
@endsection
