@props(['priority' => '', 'card' => ''])
@php
    $bgColor = 'bg-teal-light/70';
    if ($priority === 'high') {
        $bgColor = 'bg-red-300';
    } elseif ($priority === 'medium') {
        $bgColor = 'bg-yellow-200';
    } elseif ($priority === 'low') {
        $bgColor = 'bg-green-300';
    }
@endphp
<div {{ $attributes->merge(['class' => "$card p-4 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-1000 $bgColor"]) }}>
    {{ $slot }}
</div>