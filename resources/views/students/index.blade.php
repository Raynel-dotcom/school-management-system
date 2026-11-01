@extends('layouts.app')

@section('title', 'Students')
@section('header', 'Students')

@section('content')
    <div class="mb-5 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-500">
            {{ $students->count() }} registered {{ Str::plural('student', $students->count()) }}.
        </p>

        <a href="{{ route('students.create') }}" class="btn btn-primary">New student</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Student number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Programme</th>
                        <th>Year</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="whitespace-nowrap font-semibold text-brand-600">{{ $student->student_number }}</td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="link">{{ $student->user->name }}</a>
                            </td>
                            <td class="whitespace-nowrap text-slate-600">{{ $student->user->email }}</td>
                            <td>{{ $student->programme }}</td>
                            <td class="whitespace-nowrap">{{ $student->year_of_study }}</td>
                            <td class="whitespace-nowrap text-right">
                                <a href="{{ route('students.edit', $student) }}" class="link">Edit</a>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" class="ml-3 inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="link-danger"
                                            onclick="return confirm('Delete {{ $student->user->name }}? Their account and registrations go too.')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <p class="font-medium text-slate-900">No students yet</p>
                                <p class="mt-1 text-sm text-slate-400">Add one, or let students sign up themselves.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
