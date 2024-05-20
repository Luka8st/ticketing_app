@props(['label', 'name', 'text' => ''])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full',
        'value' => old($name),
        'rows' => 6
    ];
@endphp

<x-forms.field :$label :$name>
    <textarea {{ $attributes($defaults) }}>{{ old($name) ? old($name) : $text }}</textarea>
</x-forms.field>
