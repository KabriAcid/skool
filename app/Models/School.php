<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'state',
        'city',
        'address',
        'logo',
        'status',
        'max_students',
        'current_students',
    ];

    protected $casts = [
        'max_students' => 'integer',
        'current_students' => 'integer',
    ];

    /**
     * Get all users (admins and students) for this school
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get only admin users for this school
     */
    public function admins(): HasMany
    {
        return $this->hasMany(User::class)->where('role', 'school_admin');
    }

    /**
     * Get only students for this school
     */
    public function students(): HasMany
    {
        return $this->hasMany(User::class)->where('role', 'student');
    }

    /**
     * Check if school can accept more students
     */
    public function canAcceptMoreStudents(): bool
    {
        return $this->current_students < $this->max_students;
    }

    /**
     * Check if school is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if school is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
