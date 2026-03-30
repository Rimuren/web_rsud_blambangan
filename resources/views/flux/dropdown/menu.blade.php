@props(['align' => 'left'])

@php
$alignClasses = [
    'left' => 'left-0',
    'right' => 'right-0',
][$align];
@endphp

<div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    x-cloak
    class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 {{ $alignClasses }}"
    {{ $attributes }}
>
    <div class="py-1">
        {{ $slot }}
    </div>
</div>