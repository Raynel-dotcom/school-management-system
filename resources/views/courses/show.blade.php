@extends('layouts.app')

@section('title', $course->code)
@section('header', $course->code . ' — ' . $course->title)

@section('content')
    <div class="max-w-4xl space-y-6">

        <div class="card p-6">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-sm text-slate-500">Code</dt>
                    <dd class="mt-1 font-semibold text-slate-900">{{ $course->code }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Credit units</dt>
                    <dd class="mt-1 font-semibold text-slate-900">{{ $course->credit_units }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Lecturer</dt>
                    <dd class="mt-1 text-slate-900">{{ $course->lecturer?->name ?? 'Unassigned' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Registered students</dt>
                    <dd class="mt-1 text-slate-900">{{ $course->students->count() }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm text-slate-500">Description</dt>
                    <dd class="mt-1 max-w-prose text-slate-900">{{ $course->description ?: 'No description.' }}</dd>
                </div>
            </dl>
        </div>

        @can('manage courses')
            <div class="card overflow-hidden">
                <h2 class="border-b border-slate-200 px-6 py-3 font-semibold text-slate-900">
                    Registered students
                </h2>
                <ul class="divide-y divide-slate-100">
                    @forelse ($course->students as $student)
                        <li class="flex items-center justify-between px-6 py-3">
                            <span class="text-slate-900">{{ $student->user->name }}</span>
                            <span class="text-sm font-medium text-slate-500">{{ $student->student_number }}</span>
                        </li>
                    @empty
                        <li class="px-6 py-10 text-center text-sm text-slate-400">
                            Nobody has registered yet.
                        </li>
                    @endforelse
                </ul>
            </div>
        @endcan

        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to courses</a>
    </div>
@endsection
