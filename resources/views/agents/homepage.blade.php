<x-agents.layout>
    <h1 class="font-bold text-4xl">
        My Open Tickets
    </h1>

    @if (count($tickets) > 0)
        <div class="grid grid-cols-2 gap-4 mt-8">
            @foreach ($tickets as $ticket)
                <x-agents.ticket-card-wide :ticket="$ticket" type="open" />
            @endforeach
        </div>
    @else
        <div class="mt-8 p-4 w-full bg-gray-200/40 border border-gray-300 rounded">
            You don't have any tickets opened. <a href="{{ route('agent.tickets.indexNew') }}"
                class="underline text-blue-500">View all tickets that need to be resolved</a>
        </div>
    @endif



    <div>
        {{ $tickets->links() }}
    </div>

</x-agents.layout>
