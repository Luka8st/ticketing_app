<x-agents.layout>
    <div class="grid grid-cols-3 gap-2">
        <div class="col-span-2 border-r-2 border-r-gray-400 px-4">
            ticket info
            <br>
            Title: {{ $ticket->title }}
            <br>
            Description: {{ $ticket->description }}
            <br>
            Created at: {{ $ticket->created_at->format('H:i d.m.Y') }}
        </div>
        <div class="px-4">
            client info
            <br>
            <img src="{{ Vite::asset('resources/images/profile_image.jpg') }}" class="w-12" alt="" />
            {{ $user->name }}
            <br>
            {{ $user->email }}
        </div>

    </div>
    <hr class="m-3">
    <form method="POST" action="{{ route('agent.tickets.open', ['ticket' => $ticket->id]) }}">
        @csrf
        @method('PATCH')
        <x-forms.button>Start Resolving</x-forms.button>
    </form>
</x-agents.layout>
