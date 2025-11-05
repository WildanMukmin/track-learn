<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;     
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Cari user guru pertama (pastikan ada user role 'teacher')
        $teacher = User::where('role', 'teacher')->first();

        if (!$teacher) {
            // Buat dummy guru jika belum ada
            $teacher = User::create([
                'name' => 'Guru Demo',
                'email' => 'guru@demo.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]);
        }

        // Tambahkan beberapa kursus
        Course::insert([
            [
                'title' => 'Pemrograman Web Dasar',
                'description' => 'Belajar HTML, CSS, dan JavaScript untuk pemula.',
                'teacher_id' => $teacher->id,
            ],
            [
                'title' => 'Laravel Lanjut',
                'description' => 'Kuasai Laravel tingkat menengah hingga lanjut.',
                'teacher_id' => $teacher->id,
            ],
            [
                'title' => 'Machine Learning dengan Python',
                'description' => 'Pelajari dasar-dasar machine learning menggunakan Python dan Scikit-Learn.',
                'teacher_id' => $teacher->id,
            ],
            [
                'title' => 'Flutter Mobile App',
                'description' => 'Buat aplikasi Android dan iOS menggunakan Flutter.',
                'teacher_id' => $teacher->id,
            ],
        ]);
    }
}
