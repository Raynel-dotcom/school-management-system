@extends('layouts.app')

@section('title', $course->code)
@section('header', $course->code . ' — ' . $course->title)

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="card overflow-hidden">
            <h2 class="border-b border-slate-200 px-6 py-3 font-semibold text-slate-900">
                Registered students ({{ $course->students->count() }})
            </h2>

            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Student number</th>
                            <th>Name</th>
                            <th>Programme</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($course->students as $student)
                            <tr>
                                <td class="whitespace-nowrap font-semibold text-brand-600">{{ $student->student_number }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->programme }}</td>
                                <td class="whitespace-nowrap">{{ $student->year_of_study }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-sm text-slate-400">
                                    Nobody has registered for this course yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('teaching.index') }}" class="btn btn-secondary">Back to your courses</a>
    </div>
@endsection
