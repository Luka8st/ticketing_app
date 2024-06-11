<x-agents.layout>
    <h1 class="font-bold text-4xl">
        My Open Tickets
    </h1>
    <div class="grid grid-cols-2 gap-4 mt-8">
        @foreach ($tickets as $ticket)
            <x-agents.ticket-card-wide :ticket="$ticket" type="open"/>
        @endforeach
    </div>

    <div>
        {{ $tickets->links() }}
    </div>

</x-agents.layout>