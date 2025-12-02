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
                ->orderBy('created_at', 'desc')
                ->get();
        @endphp

        @if($certificates->count() == 0)
            <div class="max-w-2xl mx-auto">
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-certificate text-yellow-500 text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Belum Ada Sertifikat</h3>
                            <p class="text-gray-600 mt-1">Kamu belum memiliki sertifikat. Ikuti kursus dan klaim sertifikatmu!
                            </p>
                            <a href="{{ route('student.courses.search') }}"
                                class="inline-block mt-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded transition">
                                Jelajahi Kursus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Certificates Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($certificates as $cert)
                    @php $course = $cert->course; @endphp

                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group">

                        {{-- Thumbnail with Certificate Badge --}}
                        <div class="relative">
                            @if($course->thumbnail)
                                <div class="w-full h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div
                                    class="h-48 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 flex items-center justify-center">
                                    <i class="fas fa-graduation-cap text-white text-6xl opacity-50"></i>
                                </div>
                            @endif

                            {{-- Certificate Badge --}}
                            <div
                                class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                <i class="fas fa-certificate mr-1"></i>
                                Tersertifikasi
                            </div>
                        </div>

                        <div class="p-5">
                            {{-- Title --}}
                            <h2 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition">
                                {{ $course->title }}
                            </h2>

                            {{-- Description --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $course->description ?? 'Tidak ada deskripsi' }}
                            </p>

                            {{-- Metadata --}}
                            <div class="flex items-center text-xs text-gray-500 mb-4 space-x-3">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-check mr-1"></i>
                                    {{ $cert->created_at->format('d M Y') }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $cert->user->name }}
                                </div>
                            </div>

                            <hr class="my-4 border-gray-200">

                            {{-- Action Buttons --}}
                            <div class="flex gap-2">
                                <a href="{{ route('student.certificate.download', $course->id) }}"
                                    class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors duration-200 shadow-sm">
                                    <i class="fas fa-download mr-2"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection