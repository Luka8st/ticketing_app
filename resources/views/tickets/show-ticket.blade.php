<x-layout>
    <div class="grid grid-cols-4 gap-2 relative z-0">
        <div class="col-span-3 border-r-2 border-r-gray-400 px-4">
            <div class="rounded relative z-10 bg-white/10 ring">
                <h1 class="font-bold text-lg p-3"> {{ $ticket->title }} </h1>
                <hr class="border-t-2 border-gray-500/50">
                <div class="m-3">
                    {{ $ticket->description }}
                    <br>
                    @if ($ticket->files)
                        @foreach ($ticket->files as $file)
                            <button onclick="window.open('{{ asset($file) }}', '_blank')"><img src="{{ asset($file) }}"
                                    class="w-20 h-20" /></button>
                        @endforeach
                    @endif
                    <div class="text-sm italic mt-8">Created at: {{ $ticket->created_at->format('H:i d.m.Y') }}</div>
                </div>
            </div>
            <hr class="my-8">
            <div class="bg-white/10 p-3 rounded mb-4">
                Agent <i>{{ $ticket->agent->name }}</i> opened this ticket at
                {{ $ticket->opened_at->format('H:i d.m.Y') }}
            </div>

            @if ($ticket->status == 'closed')
                <hr class="my-8">
                <div class="bg-white/10 p-3 rounded mb-4">
                    Agent <i>{{ $ticket->agent->name }}</i> closed this ticket at
                    {{ $ticket->closed_at->format('H:i d.m.Y') }} with a closing message:
                    <textarea class="w-full px-2 rounded h-10 resize-none" disabled>{{ $ticket->closing_comment }}</textarea>
                </div>
            @endif
        </div>

        <div class="px-4 mt-4">
            <img src="{{ asset($ticket->agent->image_path) }}" class="w-12 h-12 rounded-full" alt="" />
            {{ $ticket->agent->name }}
            <br>
            {{ $ticket->agent->email }}
        </div>

    </div>

</x-layout>
