<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is teacher
     */
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Get courses taught by teacher
     */
    public function coursesTeaching()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    /**
     * Get enrollments for student
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function materialProgress()
    {
        return $this->hasMany(MaterialProgress::class);
    }


    /**
     * Get quiz submissions
     */
    public function quizSubmissions()
    {
        return $this->hasMany(QuizSubmission::class, 'student_id');
    }

    /**
     * Get courses enrolled by student
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}