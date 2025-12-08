@extends('student.layouts.student')

@section('title', $material->title)

@section('content')

    <div class="container mx-auto px-8 py-6">

        <!-- Header Navigasi -->
        <div class="mb-4 flex items-center justify-between">
            <a href="{{ route('student.courses.show', $course->id) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Kursus
            </a>
        </div>

        <!-- Judul -->
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $material->title }}</h1>

        <!-- Deskripsi -->
        @if($material->description)
            <p class="text-gray-600 mb-6 text-lg">{{ $material->description }}</p>
        @endif

        <!-- Konten Materi -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">

            <!-- Jika ada video -->
            @if($material->video_url)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Video Pembelajaran</h3>
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-sm">
                        <iframe src="{{ $material->video_url }}" class="w-full h-80 rounded-lg" allowfullscreen loading="lazy"
                            title="{{ $material->title }}">
                        </iframe>
                    </div>
                </div>
            @endif

            <!-- Jika ada file PDF -->
            @if($material->file_path)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Dokumen Materi</h3>
                    <div class="border-2 border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <iframe src="{{ asset('storage/' . $material->file_path) }}" class="w-full h-[600px]" loading="lazy"
                            title="PDF {{ $material->title }}">
                        </iframe>
                    </div>

                    <!-- Tombol download -->
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download PDF
                    </a>
                </div>
            @endif

            <!-- Jika ada konten text -->
            @if($material->content)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Materi Pembelajaran</h3>
                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                        {!! $material->content !!}
                    </div>
                </div>

                <!-- Ringkasan AI -->
                <div id="summary-ai"></div>
            @endif

        </div>

        <!-- Tombol Selesaikan -->
        <div class="mb-6">
            <form action="{{ route('student.courses.material.complete', [$course->id, $material->id]) }}" method="POST">
                @csrf

                @if($progress && $progress->is_completed)
                    <button type="button"
                        class="bg-green-600 text-white px-6 py-3 rounded-lg cursor-not-allowed flex items-center" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Sudah Selesai
                    </button>
                @else
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Tandai Selesai
                    </button>
                @endif
            </form>
        </div>

        <!-- Navigasi Previous / Next -->
        <div class="flex justify-between mt-8 gap-4">
            @if($previous)
                <a href="{{ route('student.courses.material.show', [$course->id, $previous->id]) }}"
                    class="inline-flex items-center px-5 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    {{ Str::limit($previous->title, 30) }}
                </a>
            @else
                <span></span>
            @endif

            @if($next)
                @if($progress && $progress->is_completed)
                    <a href="{{ route('student.courses.material.show', [$course->id, $next->id]) }}"
                        class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        {{ Str::limit($next->title, 30) }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="text-gray-400 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Selesaikan materi ini untuk lanjut
                    </span>
                @endif
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            console.log("🚀 Script AI Summary dimulai...");

            const summaryContainer = document.getElementById('summary-ai');

            if (!summaryContainer) {
                console.error("❌ Element #summary-ai tidak ditemukan!");
                return;
            }

            // Ambil konten raw
            const rawContent = @json(strip_tags($material->content ?? ''));

            // Validasi panjang konten
            if (!rawContent || rawContent.trim().length < 10) { // Saya naikkan sedikit agar AI punya konteks
                console.warn("⚠️ Konten terlalu pendek, AI summary dibatalkan");
                summaryContainer.style.display = 'none';
                return;
            }

            // Tampilkan loading state
            summaryContainer.innerHTML = `
                                            <div class="p-5 bg-blue-50 border-2 border-blue-200 rounded-lg animate-pulse">
                                                <div class="flex items-center">
                                                    <svg class="animate-spin h-5 w-5 text-blue-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    <p class="text-blue-700 font-semibold">Sedang membuat ringkasan dengan AI (Gemini)...</p>
                                                </div>
                                            </div>
                                        `;

            // --- KONFIGURASI GEMINI ---

            // 1. DAPATKAN API KEY ANDA DI: https://aistudio.google.com/app/apikey
            const API_KEY = 'AIzaSyDhFeD346hFq_jEt49JSklKeTkZJFwPt1k';

            // 2. URL Endpoint untuk Gemini 1.5 Flash (Gratis & Cepat)
            const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=${API_KEY}`;

            // Batasi konten agar tidak terkena limit token (sekitar 4000 karakter cukup aman)
            const contentForAPI = rawContent.substring(0, 4000);

            const promptText = `Buatkan ringkasan poin-poin penting (bullet points) yang mudah dipahami oleh siswa dari materi berikut. Gunakan Bahasa Indonesia yang santai tapi edukatif. Maksimal 5 poin. Outputkan dalam format Markdown. Langsung materinya saja

                                        Materi:
                                        ${contentForAPI}`;

            try {
                const response = await fetch(API_URL, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        contents: [{
                            parts: [{
                                text: promptText
                            }]
                        }]
                    })
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error("❌ Response error:", errorText);
                    throw new Error(`Gagal menghubungi Gemini. Status: ${response.status}`);
                }

                const data = await response.json();
                console.log("📦 Data received:", data);

                // Ekstrak teks dari respons Gemini
                if (data.candidates && data.candidates[0] && data.candidates[0].content) {
                    const aiText = data.candidates[0].content.parts[0].text;

                    // Render Markdown ke HTML
                    const htmlContent = marked.parse(aiText);

                    summaryContainer.innerHTML = `
                                                    <div class="p-6 bg-gradient-to-br from-indigo-50 to-purple-50 border-2 border-indigo-200 rounded-lg shadow-sm mt-6">
                                                        <div class="flex items-center mb-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                            </svg>
                                                            <h3 class="text-xl font-bold text-indigo-900">Ringkasan Materi (AI)</h3>
                                                        </div>
                                                        <div class="prose prose-sm max-w-none text-gray-800 leading-relaxed list-disc pl-4">
                                                            ${htmlContent}
                                                        </div>
                                                        <p class="text-xs text-gray-500 mt-4 italic">Dihasilkan oleh Gemini AI</p>
                                                    </div>
                                                `;
                } else {
                    throw new Error("Struktur respons API tidak dikenali.");
                }

            } catch (error) {
                console.error("💥 Error:", error);
                summaryContainer.innerHTML = `
                                                <div class="p-4 bg-red-50 border-2 border-red-200 text-red-700 text-sm rounded-lg mt-6">
                                                    <p class="font-bold">Gagal memuat ringkasan.</p>
                                                    <p class="text-xs mt-1">Pastikan API Key benar dan kuota tersedia.</p>
                                                </div>
                                            `;
            }
        });
    </script>

@endsection