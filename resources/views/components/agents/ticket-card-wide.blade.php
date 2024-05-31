@props(['ticket', 'type'])
<x-agents.panel class="flex gap-x-6 mb-5">
    <div class="flex-1 flex flex-col min-h-52">
        {{-- <a href="#" class="self-start text-sm text-gray-400">
            {{ $job->employer->name }}
        </a> --}}

        <h3 class="group-hover:text-blue-800 font-bold text-xl mt-3 transition-colors duration-300">
            {{-- <a href="#" target="_blank">{{ $ticket->title }}</a> --}}
            {{ $ticket->title }}
        </h3>

        <h4>
            <b>Department</b>: {{ $ticket->department->name }}
            <br>
            <b>Created at</b>: {{ $ticket->created_at ? $ticket->created_at->format('H:i d.m.Y') : null}}
            @if ($type == "open" || $type == "closed")
                <br>
                <b>Opened at</b>: {{ $ticket->opened_at ? $ticket->opened_at->format('H:i d.m.Y') : null}}
            @endif
            @if ($type == "closed")
                <br>
                <b>Closed at</b>: {{ $ticket->closed_at ? $ticket->closed_at->format('H:i d.m.Y') : null }}
            @endif
        </h4>

        <p class="text-sm text-gray-800 mt-auto py-4"><b>Description</b>: {{ $ticket->description }}</p>
    </div>

    <div>
        @if ($type == "open")
            <form method="POST" action="{{route('agent.tickets.close', ['ticket' => $ticket->id])}}">
                @csrf
                @method('PATCH')
                <x-forms.button>Mark as closed</x-forms.button>
            </form>
        @else
            @if ($type == "new")
                <form method="POST" action="{{route('agent.tickets.open', ['ticket' => $ticket->id])}}">
                    @csrf
                    @method('PATCH')
                    <x-forms.button>Start Resolving</x-forms.button>
                </form>
            @endif
        @endif
        
    </div>
</x-panel>
