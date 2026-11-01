<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sign in') — Student Management System</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-white font-sans text-slate-900 antialiased">

    <div class="flex flex-1 items-center justify-center bg-white p-4">
        <div class="w-full max-w-md">

            <!-- Brand -->
            <div class="mb-8 flex justify-center">
                <a href="{{ route('dashboard') }}" class="inline-flex flex-col items-center gap-3">
                    <img src="{{ asset('images/mubs-crest.png') }}"
                         alt="Makerere University Business School crest" class="h-16 w-16">
                    <span class="text-sm font-semibold text-slate-900">Student Management System</span>
                </a>
            </div>

            <!-- Card -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8">
                {{ $slot }}
            </div>

        </div>
    </div>

    <footer class="bg-brand-900">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-4 sm:flex-row sm:px-6 lg:px-8">
            <p class="text-sm text-blue-100">
                &copy; {{ date('Y') }}
                <span class="font-semibold text-white">Makerere University Business School</span>
            </p>
            <p class="text-sm text-blue-200">Enabling the Future</p>
        </div>
    </footer>

</body>
</html>
