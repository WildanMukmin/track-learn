@extends('student.layouts.student')

@section('title', 'Sertifikat Kursus')

@section('content')
<div class="container mx-auto px-8 py-10">

    <div class="bg-white p-10 rounded-xl shadow-xl text-center">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">🎉 Sertifikat Penyelesaian</h1>

        <p class="text-gray-600 mb-2">Diberikan kepada:</p>
        <h2 class="text-2xl font-bold text-blue-700">{{ Auth::user()->name }}</h2>

        <p class="text-gray-600 mt-6 mb-2">Atas penyelesaian kursus</p>
        <h2 class="text-xl font-semibold">{{ $course->title }}</h2>

        <p class="text-gray-500 mt-6">
            Diselesaikan pada: {{ now()->format('d M Y') }}
        </p>

        <div class="mt-10">
            <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Download Sertifikat (PDF)
            </a>
        </div>

    </div>
</div>
@endsection
