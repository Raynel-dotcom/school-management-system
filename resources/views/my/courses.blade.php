@extends('layouts.app')

@section('title', 'My Registered Courses')
@section('header', 'My Course Registrations')

@section('content')
    <div class="space-y-8">
        {{-- Current Registrations --}}
        <div class="card overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-900">Enrolled Courses</h3>
                <p class="text-sm text-slate-500">The courses you are registered for this academic period.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Credit Units</th>
                            <th>Lecturer</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($registrations as $reg)
                            <tr>
                                <td class="whitespace-nowrap font-semibold text-brand-600">{{ $reg->course->code }}</td>
                                <td>
                                    <a href="{{ route('courses.show', $reg->course) }}" class="link">{{ $reg->course->title }}</a>
                                </td>
                                <td class="whitespace-nowrap">{{ $reg->course->credit_units }}</td>
                                <td class="whitespace-nowrap">{{ $reg->course->lecturer?->name ?? 'Unassigned' }}</td>
                                <td class="whitespace-nowrap text-right">
                                    <form action="{{ route('my.courses.destroy', $reg) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to drop this course?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-rose-600 hover:text-rose-800">
                                            Drop Course
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <p class="font-medium text-slate-900">No courses registered yet</p>
                                    <p class="mt-1 text-sm text-slate-400">
                                        Select from the available courses below to complete your registration.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Available Courses to Register --}}
        @if ($available->isNotEmpty())
            <div class="card p-6">
                <h3 class="text-base font-semibold text-slate-900">Register for a Course</h3>
                <p class="mt-1 text-sm text-slate-500">Choose from available department courses below.</p>

                <form action="{{ route('my.courses.store') }}" method="POST" class="mt-4 flex flex-col sm:flex-row gap-3">
                    @csrf
                    <div class="flex-1">
                        <select name="course_id" id="course_id" class="input-field" required>
                            <option value="">-- Select a course to enroll --</option>
                            @foreach ($available as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->code }} - {{ $course->title }} ({{ $course->credit_units }} CU)
                                    @if ($course->lecturer) - {{ $course->lecturer->name }} @endif
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary self-start">
                        Register Course
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
