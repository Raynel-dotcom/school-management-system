<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'credit_units',
        'lecturer_id',
    ];

    protected function casts(): array
    {
        return [
            'credit_units' => 'integer',
        ];
    }

    /** The user who lectures this course. Null when unassigned. */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    /** Every registration row pointing at this course. */
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /** The students registered for this course, through course_registrations. */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_registrations')->withTimestamps();
    }
}
