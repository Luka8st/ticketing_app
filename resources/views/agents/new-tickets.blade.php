<x-agents.layout>
    @for ($i = 0; $i < $departments->count(); $i++)
        @if ($departments->get($i)->id != $department->id)
            <livewire:show-tickets :department="$departments->get($i)" />
        @endif
    @endfor
    

    <h1 class="font-bold text-4xl">
        New Tickets For Department: {{ $department->name }}
    </h1>
        
    {{-- <x-forms.form action="/search" class="mt-6 bg-gray-200 rounded-xl">
        <x-forms.input name="q" :label="false" placeholder=""/>
    </x-forms.form>
     --}}
     
     <div class="flex justify-center">
        <input type="text" id="ticketSearch" placeholder="Search tickets by name" class="w-1/3 p-2 bg-gray-200/40 border border-gray-300 rounded">
    </div>

    <div class="grid grid-cols-4 gap-4 mt-8 overflow-auto max-h-screen">
        @foreach ($tickets as $ticket)
            <x-agents.ticket-card-wide :ticket="$ticket" type="new" card="ticket-card"/>
        @endforeach
    </div>

    {{-- <div>
        {{ $tickets->links() }}
    </div> --}}
</x-agents.layout>

<script>
    document.getElementById('ticketSearch').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let tickets = document.getElementsByClassName('ticket-card');

        console.log("here, " + filter);
        console.log("tickets - ", tickets)

        Array.from(tickets).forEach(function(ticket) {
            let ticketName = ticket.querySelector('.ticket-name').innerText.toLowerCase();
            console.log("ticket - " + ticket);
            console.log("name - " + ticketName)
            if (ticketName.includes(filter)) {
                ticket.style.display = '';
            } else {
                ticket.style.display = 'none';
            }
        });
    });
</script>
