@extends('student.layouts.student')

@section('title', 'Sertifikat Saya')

@section('header')
<header class="bg-white shadow-sm">
    <div class="px-8 py-4">
        <h1 class="text-2xl font-bold text-gray-800">Sertifikat Saya</h1>
        <p class="text-gray-600 mt-1">Daftar semua sertifikat yang sudah kamu klaim.</p>
    </div>
</header>
@endsection

@section('content')
<div class="container mx-auto px-6 py-6">

    @php
        $certificates = \App\Models\Certificate::where('user_id', auth()->id())
            ->with('course')
            ->get();
    @endphp

    @if($certificates->count() == 0)
        <div class="bg-yellow-50 text-yellow-700 px-4 py-3 rounded mb-4">
            Kamu belum memiliki sertifikat. Ikuti kursus dan klaim sertifikatmu!
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($certificates as $cert)
            @php $course = $cert->course; @endphp

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

                    {{-- Title --}}
                    <h2 class="font-bold text-xl text-gray-800 mb-2">
                        {{ $course->title }}
                    </h2>

                    {{-- Description --}}
                    <p class="text-gray-600 text-sm mb-3">
                        {{ Str::limit($course->description, 80) }}
                    </p>

                    <hr class="my-3">

                    {{-- Download --}}
                    <a href="{{ route('student.certificate.download', $cert->id) }}"
                       class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded">
                        <i class="fas fa-download mr-2"></i> Download Sertifikat
                    </a>

                    {{-- Date --}}
                    <p class="text-xs text-gray-400 mt-2 text-right">
                        Klaim: {{ $cert->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
