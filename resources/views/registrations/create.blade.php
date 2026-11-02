@extends('layouts.app')

@section('title', 'New registration')
@section('header', 'New registration')

@section('content')
    <div class="card max-w-2xl p-6">
        <form method="POST" action="{{ route('registrations.store') }}">
            @csrf

            <div class="space-y-5">
                <div>
                    <label for="student_id" class="field-label">Student</label>
                    <select name="student_id" id="student_id" required class="input-field">
                        <option value="">Choose a student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected((int) old('student_id') === $student->id)>
                                {{ $student->student_number }} — {{ $student->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="course_id" class="field-label">Course</label>
                    <select name="course_id" id="course_id" required class="input-field">
                        <option value="">Choose a course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" @selected((int) old('course_id') === $course->id)>
                                {{ $course->code }} — {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    <p class="field-hint">A student can be registered for a course only once.</p>
                </div>

                <div class="flex items-center gap-3 border-t border-slate-200 pt-5">
                    <button type="submit" class="btn btn-primary">Create registration</button>
                    <a href="{{ route('registrations.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
