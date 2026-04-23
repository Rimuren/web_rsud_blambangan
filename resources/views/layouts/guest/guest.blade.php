<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RSUD Blambangan') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Userway --}}
    <script src="https://cdn.userway.org/widget.js" data-account="MXUJ6NMAPl" data-position="3"></script>

        <style>
        .uwy.userway_p1 .uai {
            transform: scale(1.2) !important;
           
        }

        .uai {
            transform: scale(1.2) !important;
        }
        .uwy .uai {
            width: 50px !important;
            height: 50px !important;
            bottom: 1px !important;
            right: 1px !important;
        }
    </style>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Styles / Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        {{-- Include Navbar --}}
        @include('partials.guest.header')

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.guest.footer')
    </div>

    @fluxScripts
</body>
</html>