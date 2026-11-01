@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('subheader', 'Welcome back, ' . auth()->user()->name . '.')

@section('content')
    @php($role = auth()->user()->getRoleNames()->first())

    @if (count($summary) > 0)
        <!-- Stats cards -->
        <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($summary as $label => $value)
                <div class="card p-5">
                    <p class="text-2xl font-bold text-slate-900">{{ $value }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $label }}</p>
                </div>
            @endforeach
        </div>

        <!-- Shortcuts -->
        <div class="card p-5">
            <p class="mb-4 text-sm font-semibold text-slate-900">
                @switch($role)
                    @case('administrator') What would you like to manage? @break
                    @case('lecturer') Your teaching @break
                    @case('student') Your studies @break
                    @default Shortcuts
                @endswitch
            </p>

            <div class="flex flex-wrap gap-3">
                @can('manage students')
                    <a href="{{ route('students.create') }}" class="btn btn-primary">Add a student</a>
                @endcan
                @can('manage courses')
                    <a href="{{ route('courses.create') }}" class="btn btn-secondary">Add a course</a>
                @endcan
                @can('manage registrations')
                    <a href="{{ route('registrations.create') }}" class="btn btn-secondary">Register a student</a>
                @endcan
                @can('view assigned courses')
                    <a href="{{ route('teaching.index') }}" class="btn btn-primary">View your courses</a>
                @endcan
                @can('register courses')
                    <a href="{{ route('my.courses') }}" class="btn btn-primary">Register for a course</a>
                @endcan
                @can('view courses')
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Browse courses</a>
                @endcan
            </div>
        </div>
    @else
        <div class="card p-6 text-slate-500">
            Your account has no role assigned yet. Contact an administrator.
        </div>
    @endif
@endsection
