<x-layout>
    @foreach ($tickets as $ticket)
        <x-ticket-card-wide :ticket="$ticket"/>
    @endforeach

    <div class="text-black">
        {{ $tickets->links()}}
    </div>
</x-layout>