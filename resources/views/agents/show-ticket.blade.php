<x-agents.layout>
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-3 border-r-2 border-r-gray-400 px-4 ">
            <div class="border ring rounded p-3 relative z-10">
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
            @if ($ticket->status == 'new')
                <form method="POST" action="{{ route('agent.tickets.open', ['ticket' => $ticket->id]) }}" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <x-forms.button>Start Resolving</x-forms.button>
                </form>
            @elseif ($ticket->status == 'open')
                <div class="grid grid-cols-2 divide-x-2 h-20">
                    <div></div>
                    <div class="px-2 text-gray-600 content-center h-20 relative z-0">Opened at:
                        {{ $ticket->opened_at->format('H:i d.m.Y') }}</div>
                </div>

                <form method="POST" action="{{ route('agent.tickets.close', ['ticket' => $ticket->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="border ring rounded p-3 relative z-0">
                        <x-forms.textarea label="Closing comment" name="closing_comment" class="w-full" />
                    </div>
                    <div class="mt-4">
                        <x-forms.button>Mark as closed</x-forms.button>
                    </div>
                </form>
            @endif

        </div>
        <div class="px-4">
            <img src="{{ asset($ticket->user->image_path) }}" class="w-12 h-12 rounded-full" alt="" />
            {{ $user->name }}
            <br>
            {{ $user->email }}
        </div>

    </div>


</x-agents.layout>
