<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackLearn - Platform E-Learning dengan Tracking Progress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                    <span class="ml-2 text-2xl font-bold text-gray-800">TrackLearn</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                    <a href="#kursus" class="text-gray-700 hover:text-purple-600 transition">Kursus</a>
                    <a href="#testimoni" class="text-gray-700 hover:text-purple-600 transition">Testimoni</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-purple-600 hover:text-purple-700 font-semibold transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-md">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg pt-24 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6">Belajar Online dengan Tracking Progress Real-Time</h1>
                    <p class="text-xl mb-8 text-gray-100">Platform e-learning yang memungkinkan Anda melacak progres
                        belajar layaknya tracking pesanan e-commerce. Transparan, terstruktur, dan mudah!</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                            Mulai Sekarang
                        </a>
                        <a href="#fitur"
                            class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f4da.svg" alt="Learning"
                        class="w-full ">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="fitur" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan TrackLearn</h2>
                <p class="text-gray-600 text-lg">Berbagai fitur untuk mendukung perjalanan belajar Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tracking Progress</h3>
                    <p class="text-gray-600">Pantau progres belajar Anda secara real-time dari enroll hingga mendapatkan
                        sertifikat. Seperti tracking paket, tapi untuk pembelajaran!</p>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-certificate text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Sertifikat Otomatis</h3>
                    <p class="text-gray-600">Dapatkan sertifikat digital secara otomatis setelah menyelesaikan kursus
                        dan lulus kuis dengan nilai minimal yang ditentukan.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-tasks text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Kuis Interaktif</h3>
                    <p class="text-gray-600">Evaluasi pemahaman Anda dengan kuis interaktif yang dinilai otomatis.
                        Sistem validasi memastikan pembelajaran berjalan bertahap.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-video text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Materi Lengkap</h3>
                    <p class="text-gray-600">Akses berbagai format materi pembelajaran: video YouTube, PDF, dan dokumen.
                        Semua dalam satu platform terpadu.</p>
                </div>

                <!-- Fitur 5 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-graduate text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Multi-Role System</h3>
                    <p class="text-gray-600">Sistem role yang jelas: Admin mengelola platform, Guru membuat konten,
                        Siswa belajar dengan nyaman.</p>
                </div>

                <!-- Fitur 6 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Responsif</h3>
                    <p class="text-gray-600">Akses dari desktop, tablet, atau smartphone. Tampilan responsif yang nyaman
                        di semua perangkat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kursus Populer -->
    <section id="kursus" class="py-20 px-4 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Kursus Populer</h2>
                <p class="text-gray-600 text-lg">Pilihan kursus terbaik untuk meningkatkan skill Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Kursus 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center">
                        <i class="fas fa-code text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Web Development Fundamentals</h3>
                        <p class="text-gray-600 mb-4">Pelajari dasar-dasar pemrograman web dari HTML, CSS hingga
                            JavaScript</p>
                        <div class="flex items-center justify-between">
                            <span class="text-purple-600 font-semibold">15 Materi • 5 Kuis</span>
                            <button
                                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- Kursus 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center">
                        <i class="fas fa-database text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Database Management</h3>
                        <p class="text-gray-600 mb-4">Menguasai PostgreSQL dan konsep database relasional</p>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-600 font-semibold">12 Materi • 4 Kuis</span>
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- Kursus 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-teal-400 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laravel Framework Mastery</h3>
                        <p class="text-gray-600 mb-4">Bangun aplikasi web modern dengan Laravel PHP Framework</p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">20 Materi • 8 Kuis</span>
                            <button
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                <p class="text-gray-600 text-lg">Pengalaman pengguna TrackLearn</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                            <p class="text-sm text-gray-600">Siswa</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Fitur tracking progress sangat membantu! Saya bisa tahu persis di mana
                        posisi saya dalam proses belajar. Sangat recommended!"</p>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">Guru</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Platform yang mudah digunakan untuk membuat kursus. Sistem kuis otomatis
                        menghemat banyak waktu saya dalam menilai siswa."</p>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Siswa</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Sertifikat otomatis langsung terbit setelah lulus kuis. Prosesnya cepat
                        dan transparan. Sangat profesional!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-graduation-cap text-2xl text-purple-400"></i>
                        <span class="ml-2 text-xl font-bold">TrackLearn</span>
                    </div>
                    <p class="text-gray-400">Platform e-learning dengan sistem tracking progress yang transparan dan
                        terstruktur.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#kursus" class="text-gray-400 hover:text-white transition">Kursus</a></li>
                        <li><a href="#testimoni" class="text-gray-400 hover:text-white transition">Testimoni</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i> info@tracklearn.id</li>
                        <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Universitas Lampung</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Sosial Media</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://github.com/WildanMukmin/track-learn" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 TrackLearn - Universitas Lampung. Developed by Wildan Mukmin, Nafisya Yagtias, Daniel
                    Okto M.S, Imam Ahdy Sabilla</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>