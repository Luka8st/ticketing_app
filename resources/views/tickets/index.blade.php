<x-layout>
    @if (count($tickets) > 0)
        @foreach ($tickets as $ticket)
            <x-ticket-card-wide :ticket="$ticket" />
        @endforeach
        <div class="text-black">
            {{ $tickets->links() }}
        </div>
    @else
        @if ($list_type == 'new')
            <div class="bg-white/5 hover:bg-white/10 p-4 rounded-lg">
                You don't have any unopened tickets. <a href="{{ route('client.tickets.create') }}"
                    class="underline text-blue-500">Create a new ticket here</a>
            </div>
        @else
            @if ($list_type == 'open')
                <div class="bg-white/5 hover:bg-white/10 p-4 rounded-lg">
                    None of your tickets are opened. <a href="{{ route('client.tickets.index.new') }}"
                        class="underline text-blue-500">View your unopened tickets</a>
                </div>
            @else
                <div class="bg-white/5 hover:bg-white/10 p-4 rounded-lg">
                    None of your tickets are closed. <a href="{{ route('client.tickets.index.open') }}"
                        class="underline text-blue-500">View your opened tickets</a>
                </div>
            @endif
        @endif
    @endif

</x-layout>
