<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased">
        <div class="relative flex min-h-svh items-center justify-center overflow-hidden bg-[#f0f2f5] px-4 py-10 dark:bg-[#0d1117]">
            <div class="pointer-events-none absolute inset-0 auth-grid-bg opacity-100 dark:opacity-40"></div>

            <div class="relative z-10 w-full max-w-4xl">
                {{ $slot }}
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @fluxScripts
    </body>
</html>
