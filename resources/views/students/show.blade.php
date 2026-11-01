@extends('layouts.app')

@section('title', $student->user->name)
@section('header', $student->user->name)

@section('content')
    <div class="max-w-4xl space-y-6">

        <div class="card p-6">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-sm text-slate-500">Student number</dt>
                    <dd class="mt-1 font-semibold text-slate-900">{{ $student->student_number }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Email</dt>
                    <dd class="mt-1 text-slate-900">{{ $student->user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Programme</dt>
                    <dd class="mt-1 text-slate-900">{{ $student->programme }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Year of study</dt>
                    <dd class="mt-1 text-slate-900">{{ $student->year_of_study }}</dd>
                </div>
            </dl>
        </div>

        <div class="card overflow-hidden">
            <h2 class="border-b border-slate-200 px-6 py-3 font-semibold text-slate-900">
                Registered courses ({{ $student->courses->count() }})
            </h2>
            <ul class="divide-y divide-slate-100">
                @forelse ($student->courses as $course)
                    <li class="flex flex-wrap items-center gap-x-3 px-6 py-3">
                        <span class="font-semibold text-brand-600">{{ $course->code }}</span>
                        <span class="text-slate-900">{{ $course->title }}</span>
                        <span class="ml-auto text-sm text-slate-500">
                            {{ $course->lecturer?->name ?? 'Unassigned' }}
                        </span>
                    </li>
                @empty
                    <li class="px-6 py-10 text-center text-sm text-slate-400">
                        Not registered for any course yet.
                    </li>
                @endforelse
            </ul>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to students</a>
    </div>
@endsection
