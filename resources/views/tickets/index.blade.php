<x-layout>
    @foreach ($tickets as $ticket)
        <x-ticket-card-wide :ticket="$ticket"/>
    @endforeach
</x-layout>