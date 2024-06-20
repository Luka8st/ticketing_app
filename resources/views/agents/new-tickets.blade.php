<x-agents.layout>
    @for ($i = 0; $i < $departments->count(); $i++)
        @if ($departments->get($i)->id != $department->id)
            <livewire:show-tickets :department="$departments->get($i)" />
        @endif
    @endfor
    

    <h1 class="font-bold text-4xl">
        New Tickets For Department: {{ $department->name }}
    </h1>
        
    
    <div class="grid grid-cols-4 gap-4 mt-8 overflow-auto max-h-screen">
        @foreach ($tickets as $ticket)
            <x-agents.ticket-card-wide :ticket="$ticket" type="new"/>
        @endforeach
    </div>

    {{-- <div>
        {{ $tickets->links() }}
    </div> --}}
</x-agents.layout>