<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegistrationRequest;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('registrations.index', [
            // Eager loaded: every row prints a student name and a course.
            'registrations' => CourseRegistration::with(['student.user', 'course'])
                ->latest()
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('registrations.create', [
            'students' => Student::with('user')->orderBy('student_number')->get(),
            'courses' => Course::orderBy('code')->get(),
        ]);
    }

    public function store(AdminRegistrationRequest $request): RedirectResponse
    {
        CourseRegistration::create($request->validated());

        return redirect()->route('registrations.index')
            ->with('success', 'Registration created.');
    }

    public function destroy(CourseRegistration $registration): RedirectResponse
    {
        $registration->delete();

        return redirect()->route('registrations.index')
            ->with('success', 'Registration removed.');
    }
}
