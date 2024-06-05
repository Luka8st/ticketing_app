@props(['label', 'name'])

<div>
    @if ($label)
        <x-forms.label :$name :$label />
    @endif

    <div class="mt-1">
        {{ $slot }}

        @if ($name == "files[]")
            <x-forms.error :error="$errors->first('files.*')" />
        @else
            <x-forms.error :error="$errors->first($name)" />
        @endif
        
    </div>
</div>