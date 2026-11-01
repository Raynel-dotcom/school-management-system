<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /** Readable by anyone with 'view courses'. */
    public function index(): View
    {
        return view('courses.index', [
            // Eager loaded: the table prints a lecturer name on every row.
            'courses' => Course::with('lecturer')->orderBy('code')->get(),
        ]);
    }

    public function show(Course $course): View
    {
        $course->load(['lecturer', 'students.user']);

        return view('courses.show', ['course' => $course]);
    }

    public function create(): View
    {
        return view('courses.create', ['lecturers' => $this->lecturers()]);
    }

    public function store(CourseRequest $request): RedirectResponse
    {
        $course = Course::create($request->validated());

        return redirect()->route('courses.index')
            ->with('success', "Course {$course->code} created.");
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', [
            'course' => $course,
            'lecturers' => $this->lecturers(),
        ]);
    }

    public function update(CourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()->route('courses.index')
            ->with('success', "Course {$course->code} updated.");
    }

    public function destroy(Course $course): RedirectResponse
    {
        $code = $course->code;
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', "Course {$code} deleted.");
    }

    /** Accounts that can be assigned to teach a course. */
    private function lecturers(): Collection
    {
        return User::role('lecturer')->orderBy('name')->get();
    }
}
