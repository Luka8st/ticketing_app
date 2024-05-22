@props(['href' => '#'])
<a href="{{ $href }}" class="max-h-12.4 content-center group max-w-xs mx-auto rounded-xl px-6 py-4 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-white/10 hover:ring-sky-500">
    {{ $slot }}
</a>