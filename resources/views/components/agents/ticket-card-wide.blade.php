@props(['ticket', 'type', 'card' => ''])
    <x-agents.panel class="flex gap-x-6 mb-5" priority="{{$ticket->priority}}" card="{{$card}}">
    
    <div class="flex-1 flex flex-col min-h-44">

        <h3 class="group-hover:text-blue-800 text-xl mt-3 transition-colors duration-300 ticket-name">
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


    </div>

    <div class="my-4">
        @if ($type == 'new' || $type == 'open')
            <a href="{{ route('agent.tickets.showNew', ['ticket' => $ticket->id]) }}"
                class="font-bold rounded-xl px-6 py-4 hover:bg-blue-800/80 bg-blue-800/60">
                View Info
            </a>
        @endif

    </div>
    </x-panel>
