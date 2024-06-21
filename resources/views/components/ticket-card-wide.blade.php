@props(['ticket'])
<x-panel class="flex gap-x-6 mb-5">
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
            @if ($ticket->status != 'new')
                <b>Agent</b>: {{ $ticket->agent->name }}
                <br>
            @endif

            <b>Status</b>: {{ $ticket->status }}
        </h4>

        <p class="text-sm text-gray-400 mt-auto"><b>Description</b>: {{ $ticket->description }}</p>
    </div>

    <div>
        @if ($ticket->status == 'new')
            <form action="{{ route('client.tickets.edit', ['ticket' => $ticket->id]) }}">
                <x-forms.button>Edit ticket</x-forms.button>
            </form>
        @else
            <form action="{{ route('client.tickets.show', ['ticket' => $ticket->id]) }}">
                <x-forms.button>View info</x-forms.button>
            </form>
        @endif

    </div>
</x-panel>
