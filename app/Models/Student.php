<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_number',
        'programme',
        'year_of_study',
    ];

    protected function casts(): array
    {
        return [
            'year_of_study' => 'integer',
        ];
    }

    /** The login account this student record belongs to. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Every registration row this student owns. */
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /** The courses this student is registered for, through course_registrations. */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_registrations')->withTimestamps();
    }
}
