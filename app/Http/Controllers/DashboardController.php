<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * A role-aware landing summary. Counts only — the detail lives on the
     * pages each role is allowed to reach.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $summary = match (true) {
            $user->hasRole('administrator') => [
                'Students' => Student::count(),
                'Courses' => Course::count(),
                'Registrations' => CourseRegistration::count(),
            ],
            $user->hasRole('lecturer') => [
                'Courses you teach' => $user->courses()->count(),
                'Students enrolled' => CourseRegistration::whereIn(
                    'course_id',
                    $user->courses()->select('id')
                )->count(),
            ],
            // Null-safe: a user may hold the student role without a profile row.
            $user->hasRole('student') => [
                'Courses registered' => $user->student?->registrations()->count() ?? 0,
                'Courses available' => Course::count(),
            ],
            default => [],
        };

        return view('dashboard', ['summary' => $summary]);
    }
}
