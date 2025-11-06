<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - TrackLearn</title>
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
                        class="flex items-center px-4 py-3 bg-purple-900 rounded-lg">
                        <i class="fas fa-users mr-3"></i>
                        Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                        class="flex items-center px-4 py-3 hover:bg-purple-700 rounded-lg transition">
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
                            <h1 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h1>
                            <p class="text-gray-600">Manajemen seluruh pengguna sistem</p>
                        </div>
                        <button onclick="openModal('createModal')"
                            class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                        </button>
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

                <!-- Filter & Search -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <input type="text" id="searchInput" placeholder="Cari nama atau email..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <select id="roleFilter"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Guru</option>
                                <option value="student">Siswa</option>
                            </select>
                        </div>
                        <div>
                            <button onclick="filterUsers()"
                                class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Pengguna</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Email</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Role</th>
                                    <th class="text-left py-4 px-6 text-sm font-semibold text-gray-700">Terdaftar</th>
                                    <th class="text-center py-4 px-6 text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                @forelse($users as $user)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                                        @if($user->role == 'admin') bg-red-100
                                                        @elseif($user->role == 'teacher') bg-blue-100
                                                        @else bg-green-100
                                                        @endif">
                                                    <i class="fas 
                                                            @if($user->role == 'admin') fa-user-shield text-red-600
                                                            @elseif($user->role == 'teacher') fa-chalkboard-teacher text-blue-600
                                                            @else fa-user-graduate text-green-600
                                                            @endif"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-gray-600">{{ $user->email }}</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if($user->role == 'admin') bg-red-100 text-red-600
                                                    @elseif($user->role == 'teacher') bg-blue-100 text-blue-600
                                                    @else bg-green-100 text-green-600
                                                    @endif">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-600 text-sm">
                                            {{ $user->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex justify-center space-x-2">
                                                <button onclick="editUser({{ $user->id }})"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                @if($user->id !== Auth::id())
                                                    <button onclick="confirmDelete({{ $user->id }})"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500">
                                            Tidak ada pengguna ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Create/Edit Modal -->
    <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Tambah Pengguna Baru</h3>
                <button onclick="closeModal('createModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                    <select name="role" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="teacher">Guru</option>
                        <option value="student">Siswa</option>
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
                <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Pengguna?</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat
                    dibatalkan.</p>

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

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function confirmDelete(userId) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/users/${userId}`;
            openModal('deleteModal');
        }

        function editUser(userId) {
            window.location.href = `/admin/users/${userId}/edit`;
        }

        function filterUsers() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const role = document.getElementById('roleFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#usersTableBody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || '';
                const email = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const userRole = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';

                const matchesSearch = name.includes(search) || email.includes(search);
                const matchesRole = role === '' || userRole.includes(role);

                if (matchesSearch && matchesRole) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', filterUsers);
        document.getElementById('roleFilter').addEventListener('change', filterUsers);
    </script>
</body>

</html>