<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackLearn - Platform E-Learning Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #6d28d9 0%, #9333ea 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between h-16 items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                <span class="text-2xl font-bold text-gray-800">TrackLearn</span>
            </div>
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                <a href="#kursus" class="text-gray-700 hover:text-purple-600 transition">Kursus</a>
                <a href="#testimoni" class="text-gray-700 hover:text-purple-600 transition">Testimoni</a>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-purple-600 hover:text-purple-700 font-semibold transition">Masuk</a>
                <a href="{{ route('register') }}"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-md">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg pt-28 pb-20 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-10">
            <div class="text-white">
                <h1 class="text-5xl font-extrabold mb-6 leading-tight">Belajar Lebih Pintar dengan <span
                        class="text-yellow-300">Tracking Progress</span> Real-Time</h1>
                <p class="text-lg text-gray-100 mb-8">Nikmati pengalaman belajar interaktif, terarah, dan mudah
                    dipantau.
                    TrackLearn membuat perjalanan belajar jadi menyenangkan!</p>
                <div class="flex space-x-4">
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 bg-white text-purple-700 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">Mulai
                        Sekarang</a>
                    <a href="#fitur"
                        class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-700 transition">Lihat
                        Fitur</a>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="https://images.pexels.com/photos/4144222/pexels-photo-4144222.jpeg?auto=compress&cs=tinysrgb&w=800"
                    alt="Learning Illustration" class="rounded-2xl shadow-lg">
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan Kami</h2>
            <p class="text-gray-600 text-lg">Semua yang Anda butuhkan untuk pengalaman belajar terbaik</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                <i class="fas fa-chart-line text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Tracking Progress</h3>
                <p class="text-gray-600">Lihat perkembangan belajar Anda secara real-time dan pantau progres setiap
                    kursus.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                <i class="fas fa-certificate text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Sertifikat Otomatis</h3>
                <p class="text-gray-600">Sertifikat digital langsung diterbitkan setelah Anda menyelesaikan kursus.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                <i class="fas fa-laptop-code text-4xl text-green-600 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Kuis Interaktif</h3>
                <p class="text-gray-600">Uji kemampuan Anda dengan kuis dinamis yang dinilai otomatis oleh sistem.</p>
            </div>
        </div>
    </section>

    <!-- Kursus Populer -->
    <section id="kursus" class="py-20 bg-gray-100 px-4">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Kursus Terpopuler</h2>
            <p class="text-gray-600 text-lg">Upgrade kemampuan Anda dengan kursus favorit pengguna TrackLearn</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Kursus 1 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                <img src="https://images.pexels.com/photos/1181343/pexels-photo-1181343.jpeg?auto=compress&cs=tinysrgb&w=800"
                    alt="Web Development" class="h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Web Development Fundamentals</h3>
                    <p class="text-gray-600 mb-4">Pelajari HTML, CSS, dan JavaScript untuk membangun website
                        profesional.</p>
                    <a href="#"
                        class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Lihat
                        Kursus</a>
                </div>
            </div>

            <!-- Kursus 2 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                <img src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg?auto=compress&cs=tinysrgb&w=800"
                    alt="Database" class="h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Database Management</h3>
                    <p class="text-gray-600 mb-4">Pahami konsep relasional dan PostgreSQL dengan studi kasus nyata.</p>
                    <a href="#"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Lihat
                        Kursus</a>
                </div>
            </div>

            <!-- Kursus 3 -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                <img src="https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=800"
                    alt="Laravel" class="h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Laravel Framework Mastery</h3>
                    <p class="text-gray-600 mb-4">Bangun aplikasi web modern menggunakan framework Laravel PHP.</p>
                    <a href="#"
                        class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Lihat
                        Kursus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-20 px-4">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Apa Kata Pengguna?</h2>
            <p class="text-gray-600 text-lg">Ulasan dari pengguna setia TrackLearn</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg text-left card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg"
                        class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                        <p class="text-sm text-gray-600">Mahasiswa</p>
                    </div>
                </div>
                <p class="text-gray-600">“Tracking progress-nya keren banget! Jadi tahu sejauh mana aku belajar. Super
                    membantu!”</p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-lg text-left card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/47.jpg"
                        class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Siti Nurhaliza</h4>
                        <p class="text-sm text-gray-600">Instruktur</p>
                    </div>
                </div>
                <p class="text-gray-600">“Sangat mudah digunakan untuk mengajar online. Sertifikat otomatisnya juga
                    keren.”</p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-lg text-left card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/33.jpg"
                        class="w-12 h-12 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                        <p class="text-sm text-gray-600">Pelajar</p>
                    </div>
                </div>
                <p class="text-gray-600">“Belajar di TrackLearn bikin semangat. Tampilan modern, dan sistemnya
                    responsif.”</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <i class="fas fa-graduation-cap text-2xl text-purple-400"></i>
                    <span class="ml-2 text-xl font-bold text-white">TrackLearn</span>
                </div>
                <p>Platform e-learning dengan fitur tracking progress belajar secara real-time.</p>
            </div>

            <div>
                <h4 class="font-bold mb-4 text-white">Menu</h4>
                <ul class="space-y-2">
                    <li><a href="#beranda" class="hover:text-white">Beranda</a></li>
                    <li><a href="#fitur" class="hover:text-white">Fitur</a></li>
                    <li><a href="#kursus" class="hover:text-white">Kursus</a></li>
                    <li><a href="#testimoni" class="hover:text-white">Testimoni</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4 text-white">Kontak</h4>
                <ul class="space-y-2">
                    <li><i class="fas fa-envelope mr-2"></i> info@tracklearn.id</li>
                    <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Universitas Lampung</li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4 text-white">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 flex items-center justify-center rounded-full hover:bg-purple-600">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 flex items-center justify-center rounded-full hover:bg-purple-600">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://github.com/WildanMukmin/track-learn" target="_blank"
                        class="w-10 h-10 bg-gray-800 flex items-center justify-center rounded-full hover:bg-purple-600">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
            &copy; 2025 TrackLearn - Universitas Lampung. Developed by <b>Wildan Mukmin</b> dan Tim.
        </div>
    </footer>
</body>

</html>