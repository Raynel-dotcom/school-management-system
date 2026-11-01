@extends('layouts.app')

@section('title', 'Teaching')
@section('header', 'Courses you teach')

@section('content')
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Credit units</th>
                        <th>Registered students</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td class="whitespace-nowrap font-semibold text-brand-600">{{ $course->code }}</td>
                            <td>
                                <a href="{{ route('teaching.show', $course) }}" class="link">{{ $course->title }}</a>
                            </td>
                            <td class="whitespace-nowrap">{{ $course->credit_units }}</td>
                            <td class="whitespace-nowrap">{{ $course->registrations_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <p class="font-medium text-slate-900">No courses assigned</p>
                                <p class="mt-1 text-sm text-slate-400">
                                    An administrator assigns courses to lecturers.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
