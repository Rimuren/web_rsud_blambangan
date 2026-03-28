<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        @if (isset($slot) && trim($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </flux:main>
</x-layouts::app.sidebar>
