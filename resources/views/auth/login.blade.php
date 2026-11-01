<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-900">Sign in</h1>
        <p class="mt-1 text-sm text-slate-500">
            Use the account your department issued you.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="field-label">Campus email</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>
                    </svg>
                </span>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="you@university.test"
                       class="input-field input-field-icon">
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <label for="password" class="field-label">Password</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                </span>
                <input type="password" id="password" name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••"
                       class="input-field input-field-icon">
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex cursor-pointer items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember"
                       class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-600">
                <span class="text-sm text-slate-500">Keep me signed in</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm font-medium text-brand-600 hover:text-brand-700">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-full">Sign in</button>
    </form>

    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-slate-500">
            New here?
            <a href="{{ route('register') }}" class="text-brand-600 hover:text-brand-700">Create an account</a>
        </p>
    @endif
</x-guest-layout>
