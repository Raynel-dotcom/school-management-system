<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — Student Management System</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-slate-900 antialiased">

@php
    $user = auth()->user();
    $role = $user?->getRoleNames()->first();
    $initials = collect(explode(' ', $user?->name ?? ''))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->join('');
@endphp

<div x-data="{ open: false }">

    {{-- Backdrop, phone only --}}
    <div x-show="open" x-cloak @click="open = false"
         class="fixed inset-0 z-30 bg-slate-900/30 sm:hidden"></div>

    <!-- Header -->
    <header class="fixed top-0 z-50 w-full border-b border-slate-200 bg-white">
        <div class="flex h-16 items-center gap-3 px-4 sm:px-6">

            <button type="button" @click="open = !open"
                    class="rounded-lg p-2 text-slate-500 hover:bg-slate-50 sm:hidden"
                    aria-label="Toggle navigation">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('images/mubs-crest-192.png') }}"
                     alt="Makerere University Business School crest" class="h-9 w-9">
                <span class="hidden text-sm font-semibold text-slate-900 sm:block">
                    Student Management System
                </span>
            </a>

            <div class="ml-auto flex items-center gap-3">
                @auth
                    <a href="{{ route('profile.edit') }}"
                       class="hidden items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-brand-600 hover:text-brand-600 sm:inline-flex">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-600 hover:border-red-500 hover:text-red-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside :class="{ 'is-open': open }"
           class="sidebar flex flex-col border-r border-slate-200 bg-white">

        <div class="sidebar-scrollbar flex-1 overflow-y-auto px-3 py-4">
            @include('partials.nav')
        </div>

        @auth
            <div class="mt-auto border-t border-slate-200 p-4">
                <div class="mb-3 flex items-center gap-3">
                    <div class="relative">
                        <div class="avatar">{{ $initials ?: '?' }}</div>
                        <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-emerald-500"></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-slate-900">{{ $user->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                    </div>
                </div>

                @if ($role)
                    <div class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2">
                        <svg class="h-4 w-4 text-brand-600" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-800">
                            {{ $role }}
                        </span>
                    </div>
                @endif
            </div>
        @endauth
    </aside>

    <!-- Main content -->
    <main class="pt-16 sm:ml-64">
        <div class="min-h-[calc(100vh-4rem)] bg-canvas px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">

                <div class="mb-6">
                    <h1 class="text-xl font-bold text-slate-900">@yield('header', 'Dashboard')</h1>
                    @hasSection('subheader')
                        <p class="mt-1 text-sm text-slate-500">@yield('subheader')</p>
                    @endif
                </div>

                @include('partials.alerts')
                @yield('content')
            </div>
        </div>

        <footer class="bg-brand-900">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-4 text-sm sm:flex-row sm:px-6 lg:px-8">
                <p class="text-blue-100">
                    &copy; {{ date('Y') }}
                    <span class="font-semibold text-white">Makerere University Business School</span>
                </p>
                <p class="text-blue-200">Students · Courses · Lecturers · Registrations</p>
            </div>
        </footer>
    </main>
</div>

</body>
</html>
