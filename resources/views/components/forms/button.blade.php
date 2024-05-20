@props(['bg_color' => 'bg-blue-800'])
@php
    $defaults = [
        'class' => 'rounded py-2 px-6 font-bold'
    ];
@endphp

{{-- <button {{ $attributes(['class' => 'bg-blue-800 rounded py-2 px-6 font-bold']) }}>{{ $slot }}</button> --}}
<button {{ $attributes->merge(['class' => $bg_color . ' ' . $defaults['class']]) }}>{{ $slot }}</button>