<x-agents.layout>
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-3 border-r-2 border-r-gray-400 px-4 ">
            <div class="border ring rounded relative z-10">
                <h1 class="font-bold text-lg m-3"> {{ $ticket->title }} </h1>
                <hr class="border-t-2 border-gray-500/50">
                <div class="bg-gray-200 p-3">
                    {{ $ticket->description }}
                    <br>

                    @if ($ticket->images)
                        @foreach ($ticket->images as $image)
                            <button onclick="window.open('{{ asset($image->path) }}', '_blank')"><img
                                    src="{{ asset($image->path) }}" class="w-20 h-20" /></button>
                        @endforeach
                    @endif
                    <br>
                    <div class="text-sm italic">Created at: {{ $ticket->created_at->format('H:i d.m.Y') }}</div>
                </div>
            </div>
            @if (Auth::user()->department == $ticket->department)
                @if ($ticket->status == 'new')
                    <form method="POST" action="{{ route('agent.tickets.open', ['ticket' => $ticket->id]) }}"
                        class="mt-4">
                        @csrf
                        @method('PATCH')
                        <x-forms.button>Start Resolving</x-forms.button>
                    </form>
                @elseif ($ticket->status == 'open')
                    <div class="grid grid-cols-2 divide-x-2 h-20">
                        <div class="px-2 text-gray-600 content-center h-20 relative z-0">Opened at:
                            {{ $ticket->opened_at->format('H:i d.m.Y') }}</div>
                    </div>

                    <form method="POST" action="{{ route('agent.tickets.close', ['ticket' => $ticket->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="border ring rounded p-3 relative z-0">
                            <x-forms.textarea label="Closing comment" name="closing_comment" class="w-full" />
                        </div>
                        <div class="mt-4">
                            <x-forms.button>Mark as closed</x-forms.button>
                        </div>
                    </form>
                @endif
            @else
                @if ($ticket->status == 'open' || $ticket->status == 'closed')
                    <div class="my-3 p-2 bg-gray-200 rounded">
                        Agent <i>{{ $ticket->agent->name }}</i> opened this ticket at
                        {{ $ticket->opened_at->format('H:i d.m.Y') }}
                    </div>
                @endif

                @if ($ticket->status == 'closed')
                    <div class="my-3 p-2 bg-gray-200 rounded">
                        Agent <i>{{ $ticket->agent->name }}</i> closed this ticket at
                        {{ $ticket->closed_at->format('H:i d.m.Y') }}
                    </div>
                @endif
            @endif


        </div>
        <div class="px-4">
            <img src="{{ asset($ticket->user->image_path) }}" class="w-12 h-12 rounded-full" alt="" />
            {{ $user->name }}
            <br>
            {{ $user->email }}
        </div>

    </div>


</x-agents.layout>
