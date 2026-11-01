<?php

namespace App\Http\Controllers;

use App\Actions\CreateStudent;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        return view('students.index', [
            // Eager loaded: the table prints a name and email on every row.
            'students' => Student::with('user')->orderBy('student_number')->get(),
        ]);
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StudentRequest $request, CreateStudent $createStudent): RedirectResponse
    {
        $student = $createStudent($request->validated());

        return redirect()->route('students.index')
            ->with('success', "Student {$student->student_number} created.");
    }

    public function show(Student $student): View
    {
        $student->load(['user', 'courses.lecturer']);

        return view('students.show', ['student' => $student]);
    }

    public function edit(Student $student): View
    {
        $student->load('user');

        return view('students.edit', ['student' => $student]);
    }

    public function update(StudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->validated();

        // The account and the profile are one thing to the user, so they
        // move together or not at all.
        DB::transaction(function () use ($student, $data) {
            $student->user->update(array_filter([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'] ?? null,
            ], fn ($value) => $value !== null));

            $student->update([
                'programme' => $data['programme'],
                'year_of_study' => (int) $data['year_of_study'],
            ]);
        });

        return redirect()->route('students.index')
            ->with('success', "Student {$student->student_number} updated.");
    }

    public function destroy(Student $student): RedirectResponse
    {
        $number = $student->student_number;

        // Deleting the account cascades to the students row and to this
        // student's registrations.
        $student->user->delete();

        return redirect()->route('students.index')
            ->with('success', "Student {$number} deleted.");
    }
}
