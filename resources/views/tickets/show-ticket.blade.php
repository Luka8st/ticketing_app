<x-layout>
    <div class="grid grid-cols-4 gap-2 h-max">
        <div class="col-span-3 border-r-2 border-r-gray-400 px-4 ">
            <div class="border rounded p-3 relative z-10">
                Title: {{ $ticket->title }}
                <br>
                Description: {{ $ticket->description }}
                <br>
                @if ($ticket->files)
                    @foreach ($ticket->files as $file)
                        {{-- <img src="{{ asset($file) }}" class="w-20 h-20"/> --}}

                        {{-- <button onclick="window.open('{{ asset($file) }}', '_blank')">{{ $file }}</button> --}}
                        <button onclick="window.open('{{ asset($file) }}', '_blank')"><img src="{{ asset($file) }}"
                                class="w-20 h-20" /></button>
                    @endforeach
                @endif
                <br>
                Created at: {{ $ticket->created_at->format('H:i d.m.Y') }}
            </div>
            <div class="mt-4">
                Agent {{ $ticket->agent->name }} opened this ticket at {{ $ticket->opened_at->format('H:i d.m.Y') }}
            </div>

            @if ($ticket->status == 'closed')
                <div>
                    Agent {{ $ticket->agent->name }} closed this ticket at {{ $ticket->closed_at->format('H:i d.m.Y') }} with a closing message: {{ $ticket->closing_comment }}
                </div>
            @endif
        </div>

        <div class="px-4">
            <img src="{{ asset($ticket->agent->image_path) }}" class="w-12 h-12 rounded-full" alt="" />
            {{ $ticket->agent->name }}
            <br>
            {{ $ticket->agent->email }}
        </div>

    </div>

</x-layout>
