<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kursus - TrackLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-purple-800 text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <i class="fas fa-graduation-cap text-3xl"></i>
                    <span class="ml-2 text-2xl font-bold">TrackLearn</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-home mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                        class="flex items-center px-4 py-3 bg-purple-900 rounded-lg">
                        <i class="fas fa-book mr-3"></i>
                        Kelola Kursus
                    </a>
                </nav>
            </div>

            <div class="absolute bottom-0 w-64 p-6 border-t border-purple-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-purple-300">Administrator</p>
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

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Kelola Kursus</h1>
                            <p class="text-gray-600">Manajemen seluruh kursus di platform</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div
                        class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Kursus</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCourses }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Kursus Aktif</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $activeCourses }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Total Enrollments</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEnrollments }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold">Guru Aktif</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $activeTeachers }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter & Search -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <input type="text" id="searchInput" placeholder="Cari judul kursus..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <select id="teacherFilter"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Semua Guru</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button onclick="filterCourses()"
                                class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="coursesGrid">
                    @forelse($courses as $course)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition course-card"
                            data-teacher="{{ $course->teacher_id }}">
                            <!-- Course Header -->
                            <div class="w-full h-40 overflow-hidden rounded-t-lg">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="thumbnail"
                                    class="w-full h-full object-cover">
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-bold text-gray-800 text-lg course-title">{{ $course->title }}</h3>
                                    <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-xs font-semibold">
                                        Aktif
                                    </span>
                                </div>


                                @if($course->category)
                                    <p class="text-sm text-green-700 font-semibold mb-1">
                                        Category: {{ $course->category }}
                                    </p>
                                @endif
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit($course->description, 100) }}
                                </p>

                                @if($course->duration)
                                    <p class="text-sm text-gray-500 mb-2">
                                        <i class="fas fa-clock"></i> Duration: {{ $course->duration }}
                                    </p>
                                @endif

                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>{{ $course->teacher->name }}</span>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-users mr-2"></i>
                                        <span>{{ $course->enrollments_count }} Siswa</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <span>{{ $course->materials_count }} Materi</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <button onclick="viewCourse({{ $course->id }})"
                                        class="flex-1 px-3 py-2 bg-purple-600 text-white text-center rounded-lg hover:bg-purple-700 transition text-sm">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </button>
                                    <button onclick="editCourse({{ $course->id }})"
                                        class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete({{ $course->id }})"
                                        class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Belum ada kursus yang tersedia</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            </div>
        </main>
    </div>

    <!-- Create/Edit Course Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Tambah Kursus Baru</h3>
                <button onclick="closeModal('createModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.courses.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kursus</label>
                    <input type="text" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Guru</label>
                    <select name="teacher_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Pilih Guru</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('createModal')"
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Kursus?</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kursus ini? Semua materi, kuis, dan
                    enrollment akan ikut terhapus.</p>

                <form id="deleteForm" method="POST" class="flex space-x-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('deleteModal')"
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- View Course Detail Modal -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Detail Kursus</h3>
                <button onclick="closeModal('viewModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div id="courseDetailContent" class="p-6">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function confirmDelete(courseId) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/courses/${courseId}`;
            openModal('deleteModal');
        }

        function editCourse(courseId) {
            window.location.href = `/admin/courses/${courseId}/edit`;
        }

        function viewCourse(courseId) {
            window.location.href = `/admin/courses/${courseId}`;
        }

        function filterCourses() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const teacherId = document.getElementById('teacherFilter').value;
            const cards = document.querySelectorAll('.course-card');

            cards.forEach(card => {
                const title = card.querySelector('.course-title')?.textContent.toLowerCase() || '';
                const cardTeacherId = card.getAttribute('data-teacher');

                const matchesSearch = title.includes(search);
                const matchesTeacher = teacherId === '' || cardTeacherId === teacherId;

                if (matchesSearch && matchesTeacher) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', filterCourses);
        document.getElementById('teacherFilter').addEventListener('change', filterCourses);
    </script>
</body>

</html>