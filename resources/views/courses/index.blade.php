@extends('layouts.app')

@section('title', 'Courses')
@section('header', 'Courses')

@section('content')
    <div class="mb-5 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-500">
            {{ $courses->count() }} {{ Str::plural('course', $courses->count()) }} on offer.
        </p>

        @can('manage courses')
            <a href="{{ route('courses.create') }}" class="btn btn-primary">New course</a>
        @endcan
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Credit units</th>
                        <th>Lecturer</th>
                        @can('manage courses')
                            <th class="text-right">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td class="whitespace-nowrap font-semibold text-brand-600">{{ $course->code }}</td>
                            <td>
                                <a href="{{ route('courses.show', $course) }}" class="link">{{ $course->title }}</a>
                            </td>
                            <td class="whitespace-nowrap">{{ $course->credit_units }}</td>
                            <td class="whitespace-nowrap">
                                @if ($course->lecturer)
                                    {{ $course->lecturer->name }}
                                @else
                                    <span class="text-slate-400">Unassigned</span>
                                @endif
                            </td>
                            @can('manage courses')
                                <td class="whitespace-nowrap text-right">
                                    <a href="{{ route('courses.edit', $course) }}" class="link">Edit</a>
                                    <form method="POST" action="{{ route('courses.destroy', $course) }}" class="ml-3 inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-danger"
                                                onclick="return confirm('Delete {{ $course->code }}? Its registrations will be removed too.')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <p class="font-medium text-slate-900">No courses yet</p>
                                <p class="mt-1 text-sm text-slate-400">
                                    @can('manage courses')
                                        Add the first one to start taking registrations.
                                    @else
                                        Courses will appear here once an administrator adds them.
                                    @endcan
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
