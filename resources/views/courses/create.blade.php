@extends('layouts.app')

@section('title', 'New course')
@section('header', 'New course')

@section('content')
    <div class="card max-w-2xl p-6">
        <form method="POST" action="{{ route('courses.store') }}">
            @include('courses.form', ['submit' => 'Create course'])
        </form>
    </div>
@endsection
