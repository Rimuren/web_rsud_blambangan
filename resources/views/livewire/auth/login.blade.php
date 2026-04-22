<x-layouts::auth :title="__('Log in')">
    <div class="mx-auto flex w-full max-w-[820px] flex-col items-center py-6">
        <a href="{{ route('home') }}" class="auth-brand animate-fade-up delay-1" wire:navigate>
            <svg class="auth-logo-icon" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="40" cy="40" r="36" fill="#fff7ed" stroke="#f59e0b" stroke-width="1.5"/>
                <rect x="36" y="14" width="8" height="52" rx="4" fill="#f59e0b"/>
                <rect x="14" y="36" width="52" height="8" rx="4" fill="#f59e0b"/>
                <circle cx="40" cy="40" r="28" fill="none" stroke="#22c55e" stroke-width="2" stroke-dasharray="5 3"/>
                <path d="M32 22 Q22 32 28 40 Q34 48 28 56" stroke="#16a34a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                <path d="M48 22 Q58 32 52 40 Q46 48 52 56" stroke="#16a34a" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                <circle cx="40" cy="40" r="7" fill="#1b3a6b"/>
                <circle cx="40" cy="40" r="4" fill="white"/>
                <path d="M34 20 Q40 14 46 20" stroke="#f97316" stroke-width="2" fill="none" stroke-linecap="round"/>
                <rect x="12" y="60" width="16" height="8" rx="2" fill="#1b3a6b"/>
                <text x="20" y="67" text-anchor="middle" font-size="4.5" fill="white" font-weight="700" font-family="sans-serif">RSUD</text>
            </svg>
            <span class="auth-brand-divider"></span>
            <span class="auth-brand-text">
                <span class="auth-brand-title">RSUD BLAMBANGAN</span>
                <span class="auth-brand-subtitle">BANYUWANGI</span>
            </span>
            <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <div class="mb-8 w-full text-center animate-fade-up delay-2">
            <h1 class="font-auth text-4xl font-extrabold leading-tight text-gray-900 sm:text-[3.4rem] dark:text-white">
                {{ __('Sign in to Dashboard Portal') }}
            </h1>
        </div>

        <div class="auth-login-card animate-fade-up delay-3">
            <x-auth-session-status class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-center text-sm font-medium text-emerald-700 dark:border-emerald-500/25 dark:bg-emerald-500/10 dark:text-emerald-300" :status="session('status')" />

            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="sr-only">{{ __('Email address') }}</label>
                    <input
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="{{ __('Username') }}"
                        class="auth-login-input animate-fade-up delay-4"
                    >
                    @error('email')
                        <p class="px-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="{{ __('Password') }}"
                        class="auth-login-input animate-fade-up delay-5"
                    >
                    @error('password')
                        <p class="px-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 text-sm text-gray-600 sm:flex-row sm:items-center sm:justify-between dark:text-neutral-300 animate-fade-up delay-6">
                    <label class="flex cursor-pointer select-none items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            @checked(old('remember'))
                            class="custom-checkbox"
                        >
                        <span class="font-medium">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="font-medium text-gray-600 transition hover:text-[#1b3a6b] dark:text-white dark:hover:text-neutral-300">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <div class="auth-captcha-wrap animate-fade-up delay-6">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                </div>

                <div class="pt-1">
                    <button
                        type="submit"
                        class="auth-login-button animate-fade-up delay-6"
                        data-test="login-button">
                        {{ __('Sign In') }}
                    </button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="mt-5 text-center text-sm text-slate-600 dark:text-slate-400">
                    <span>{{ __('Don\'t have an account?') }}</span>
                    <a href="{{ route('register') }}" wire:navigate class="font-semibold text-[#1b3a6b] hover:underline dark:text-white">
                        {{ __('Sign up') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts::auth>
