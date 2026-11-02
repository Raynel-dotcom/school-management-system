@extends('layouts.app')

@section('title', 'Edit course')
@section('header', 'Edit ' . $course->code)

@section('content')
    <div class="card max-w-2xl p-6">
        <form method="POST" action="{{ route('courses.update', $course) }}">
            @method('PUT')
            @include('courses.form', ['submit' => 'Save changes'])
        </form>
    </div>
@endsection
