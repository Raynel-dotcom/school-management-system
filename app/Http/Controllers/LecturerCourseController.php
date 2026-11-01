<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerCourseController extends Controller
{
    /** Scoped at the query: a lecturer's own courses and nothing else. */
    public function index(Request $request): View
    {
        return view('teaching.index', [
            'courses' => $request->user()->courses()
                ->withCount('registrations')
                ->orderBy('code')
                ->get(),
        ]);
    }

    public function show(Request $request, Course $course): View
    {
        // Middleware says lecturers may view course students; this says
        // which course is theirs.
        abort_unless($course->lecturer_id === $request->user()->id, 403);

        $course->load('students.user');

        return view('teaching.show', ['course' => $course]);
    }
}
