<aside class="w-64 bg-green-800 text-white">
    <div class="p-6">
        <div class="flex items-center mb-8">
            <i class="fas fa-graduation-cap text-3xl"></i>
            <span class="ml-2 text-2xl font-bold">TrackLearn</span>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('student.dashboard') }}"
               class="flex items-center px-4 py-3 rounded-lg {{ Route::is('student.dashboard') ? 'bg-green-900' : 'hover:bg-green-700 transition' }}">
                <i class="fas fa-home mr-3"></i> Dashboard
            </a>
            <a href="{{ route('student.my-courses') }}"
               class="flex items-center px-4 py-3 rounded-lg {{ Route::is('student.my-courses') ? 'bg-green-900' : 'hover:bg-green-700 transition' }}">
                <i class="fas fa-book-open mr-3"></i> Kursus Saya
            </a>
            <a href="{{ route('student.courses.search') }}"
               class="flex items-center px-4 py-3 rounded-lg {{ Route::is('student.courses.search') ? 'bg-green-900' : 'hover:bg-green-700 transition' }}">
                <i class="fas fa-search mr-3"></i> Cari Kursus
            </a>
            <a href="#"
               class="flex items-center px-4 py-3 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-certificate mr-3"></i> Sertifikat
            </a>
        </nav>
    </div>

    <div class="absolute bottom-0 w-64 p-6 border-t border-green-700">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="ml-3">
                <p class="font-semibold">{{ Auth::user()->name }}</p>
                <p class="text-sm text-green-300">Siswa</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit"
                    class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition text-sm">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </form>
    </div>
</aside>
