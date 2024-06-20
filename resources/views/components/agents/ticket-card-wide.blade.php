@props(['ticket', 'type', 'card' => ''])
{{-- <x-agents.panel class="flex gap-x-6 mb-5 {{
    !$ticket->priority ? '' : 
        ($ticket->priority == 'high' ? 'bg-red-300/70' : 
            ($ticket->priority == 'medium' ? 'bg-yellow-300/70' : 
                'bg-green-500/80'
            )
        )
    }}"> --}}
    <x-agents.panel class="flex gap-x-6 mb-5" priority="{{$ticket->priority}}" card="{{$card}}">
    
    <div class="flex-1 flex flex-col min-h-44">

        <h3 class="group-hover:text-blue-800 text-xl mt-3 transition-colors duration-300 ticket-name">
            {{-- <a href="#" target="_blank">{{ $ticket->title }}</a> --}}
            <b>{{ $ticket->title }}</b> by <i>{{ $ticket->user->name }}</i>
        </h3>

        <h4 class="mt-auto">

            @if ($type == 'open' || $type == 'closed')
                <b>Created at</b>: {{ $ticket->created_at ? $ticket->created_at->format('H:i F d.') : null }}
                <br>
                <b>Opened at</b>: {{ $ticket->opened_at ? $ticket->opened_at->format('H:i F d.') : null }}
            @endif
            @if ($type == 'closed')
                <br>
                <b>Closed at</b>: {{ $ticket->closed_at ? $ticket->closed_at->format('H:i F d.') : null }}
            @endif
        </h4>


        {{-- <p class="text-sm text-gray-800 mt-auto py-4"><b>Description</b>: {{ $ticket->description }}</p> --}}
    </div>

    <div class="my-4">
        {{-- @if ($type == 'open')
            <form method="POST" action="{{ route('agent.tickets.close', ['ticket' => $ticket->id]) }}">
                @csrf
                @method('PATCH')
                <x-forms.button>Mark as closed</x-forms.button>
            </form>
        @else
            @if ($type == 'new')
                <a href="{{ route('agent.tickets.showNew', ['ticket' => $ticket->id]) }}"
                    class="font-bold rounded-xl px-6 py-4 hover:bg-blue-800/80 bg-blue-800/60">
                    View Info
                </a>
            @endif
        @endif --}}
        @if ($type == 'new' || $type == 'open')
            <a href="{{ route('agent.tickets.showNew', ['ticket' => $ticket->id]) }}"
                class="font-bold rounded-xl px-6 py-4 hover:bg-blue-800/80 bg-blue-800/60">
                View Info
            </a>
        @endif

    </div>
    </x-panel>
