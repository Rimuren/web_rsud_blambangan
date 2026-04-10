<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSUD Blambangan')</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    {{-- HEADER / NAVBAR --}}
    <header class="w-full bg-white shadow-sm border-b">
        <nav class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('build/assets/logo.png') }}" 
                     alt="Logo RSUD Blambangan"
                     class="h-10 w-auto object-contain">

                <span class="text-lg md:text-xl font-semibold text-gray-800">
                    RSUD Blambangan
                </span>
            </a>

            {{-- MENU --}}
            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="relative text-sm md:text-base font-medium transition 
                   {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    Beranda

                    @if(request()->routeIs('home'))
                        <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-blue-600 rounded"></span>
                    @endif
                </a>

                <a href="{{ route('profil') }}"
                   class="relative text-sm md:text-base font-medium transition 
                   {{ request()->routeIs('profil') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    Profil

                    @if(request()->routeIs('profil'))
                        <span class="absolute left-0 -bottom-1 w-full h-[2px] bg-blue-600 rounded"></span>
                    @endif
                </a>

            </div>

        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white text-center py-4 text-sm">
        © {{ date('Y') }} RSUD Blambangan. All rights reserved.
    </footer>

</body>
</html>