@props(['as' => 'button'])

<{{ $as }}
    {{ $attributes->merge([
        'type' => 'button',
        'x-data' => '',
        'x-on:click' => 'toggle',
        ':class' => '{ "text-gray-900": open }'
    ]) }}
>
    {{ $slot }}
</{{ $as }}>