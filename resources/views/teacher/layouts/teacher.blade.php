<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>@yield('title', 'Dashboard Guru')</title>
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
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">Track Learn | Guru</h1>
        <div class="space-x-6">
            <a href="{{ route('teacher.dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('teacher.courses') }}" class="hover:underline">Kursus Saya</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Konten utama -->
    <main class="flex-grow">
        <div class="max-w-6xl mx-auto p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-gray-500 py-4 border-t text-center">
        &copy; {{ date('Y') }} <span class="font-semibold text-blue-700">Track Learn</span> | Dashboard Guru
    </footer>

</body>
</html>
