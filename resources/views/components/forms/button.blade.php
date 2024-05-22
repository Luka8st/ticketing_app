@props([
    'bg_color' => 'bg-blue-800/60', 
    'bg_color_hover' => 'bg-blue-800/80', 
    'type' => 'submit', 
    'onclick' => '', 
    'old_title' => '',
    'old_description' => '',
    'old_department' => '',
    ])
@php
    $defaults = [
        'class' => 'rounded font-bold min-w-40 min-h-12',
    ];
@endphp

<button {{ $attributes->merge(['class' => $bg_color . ' hover:' . $bg_color_hover . ' ' . $defaults['class']]) }} type={{ $type }}
    onclick="'{{$type}}'=='button' ? discard('{{$old_title}}', '{{$old_description}}', '{{$old_department}}'):void(0)">{{ $slot }} </button>

<script>
    function discard(oldTitle, oldDescription, oldDepartment) {
        document.getElementById("title").value = oldTitle
        document.getElementById("description").value = oldDescription
        document.getElementById("department").value = oldDepartment
    }
</script>
