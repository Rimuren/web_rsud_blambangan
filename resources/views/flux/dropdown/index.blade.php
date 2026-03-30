@props(['align' => 'left'])

<div
    x-data="{ open: false }"
    @click.away="open = false"
    @close.stop="open = false"
    class="relative inline-block text-left"
    {{ $attributes }}
>
    <div @click="open = !open">
        {{ $trigger ?? '' }}
    </div>

    <div x-show="open" x-cloak>
        {{ $slot }}
    </div>
</div>