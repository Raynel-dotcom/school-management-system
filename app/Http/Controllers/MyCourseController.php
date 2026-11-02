<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class MyCourseController extends Controller
{
    /**
     * The signed-in student's own registrations, scoped at the query so
     * another student's rows are never loaded in the first place.
     */
    public function index(Request $request): View
    {
        $student = $request->user()->student;

        if ($student === null) {
            return view('my.courses', [
                'student' => null,
                'registrations' => new Collection,
                'available' => new Collection,
            ]);
        }

        $registrations = $student->registrations()->with('course.lecturer')->get();

        return view('my.courses', [
            'student' => $student,
            'registrations' => $registrations,
            'available' => Course::with('lecturer')
                ->whereNotIn('id', $registrations->pluck('course_id'))
                ->orderBy('code')
                ->get(),
        ]);
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $student = $request->user()->student;

        if ($student === null) {
            return back()->with('error', 'Your account has no student profile. Contact an administrator.');
        }

        try {
            CourseRegistration::create([
                'student_id' => $student->id,
                'course_id' => $request->validated('course_id'),
            ]);
        } catch (QueryException $exception) {
            // The unique index caught a duplicate that validation did not —
            // two tabs, a double-clicked button, a direct POST.
            if ($exception->getCode() === '23000') {
                return back()->with('error', 'You are already registered for that course.');
            }

            throw $exception;
        }

        return redirect()->route('my.courses')->with('success', 'Registered for the course.');
    }

    public function destroy(CourseRegistration $registration): RedirectResponse
    {
        // Middleware says a student may unregister; the policy says whose.
        $this->authorize('delete', $registration);

        $registration->delete();

        return redirect()->route('my.courses')->with('success', 'Registration removed.');
    }
}
