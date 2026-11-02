@extends('layouts.app')

@section('title', 'Registrations')
@section('header', 'Registrations')

@section('content')
    <div class="mb-5 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-500">
            {{ $registrations->count() }} {{ Str::plural('registration', $registrations->count()) }} in total.
        </p>

        <a href="{{ route('registrations.create') }}" class="btn btn-primary">New registration</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Student number</th>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Registered</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="whitespace-nowrap font-semibold text-brand-600">
                                {{ $registration->student->student_number }}
                            </td>
                            <td>{{ $registration->student->user->name }}</td>
                            <td>
                                <span class="font-semibold text-brand-600">{{ $registration->course->code }}</span>
                                <span class="ml-2">{{ $registration->course->title }}</span>
                            </td>
                            <td class="whitespace-nowrap text-slate-600">
                                {{ $registration->created_at->format('d M Y') }}
                            </td>
                            <td class="whitespace-nowrap text-right">
                                <form method="POST" action="{{ route('registrations.destroy', $registration) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="link-danger"
                                            onclick="return confirm('Remove this registration?')">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <p class="font-medium text-slate-900">No registrations yet</p>
                                <p class="mt-1 text-sm text-slate-400">
                                    Register a student, or wait for students to register themselves.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
