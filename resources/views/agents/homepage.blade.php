<x-agents.layout>
    <h1 class="font-bold text-4xl">
        My Open Tickets
    </h1>
    <br><br>
    <div class="grid grid-cols-2 gap-4">
    @foreach ($tickets as $ticket)
        <x-agents.ticket-card-wide :ticket="$ticket"/>
    @endforeach
    </div>

</x-agents.layout>