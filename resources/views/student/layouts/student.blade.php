<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            transition: width 0.5s ease;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">

        {{-- Sidebar --}}
        @include('student.sidebar')

        {{-- Konten utama --}}
        <main class="flex-1 overflow-y-auto">
            @yield('header')
            <div class="p-8">
                @yield('content')
            </div>
        </main>

    </div>
</body>

</html>
