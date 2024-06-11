@props(['label', 'name', 'status' => 'new'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full text-white',
    ];
@endphp

<x-forms.field :$label :$name>

    @if ($status == 'new')
        <select {{ $attributes($defaults) }}>
            {{ $slot }}
        </select>
    @else
        <select {{ $attributes($defaults) }} disabled>
            {{ $slot }}
        </select>
    @endif
</x-forms.field>
