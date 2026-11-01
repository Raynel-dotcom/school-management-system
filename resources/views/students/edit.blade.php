@extends('layouts.app')

@section('title', 'Edit student')
@section('header', 'Edit ' . $student->user->name)

@section('content')
    <div class="card max-w-2xl p-6">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @method('PUT')
            @include('students.form', ['submit' => 'Save changes'])
        </form>
    </div>
@endsection
