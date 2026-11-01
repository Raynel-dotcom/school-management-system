@extends('layouts.app')

@section('title', 'New student')
@section('header', 'New student')

@section('content')
    <div class="card max-w-2xl p-6">
        <p class="mb-5 max-w-prose text-sm text-slate-500">
            Creating a student also creates their login account and puts it in the Student role.
            A student number is generated automatically.
        </p>

        <form method="POST" action="{{ route('students.store') }}">
            @include('students.form', ['submit' => 'Create student'])
        </form>
    </div>
@endsection
