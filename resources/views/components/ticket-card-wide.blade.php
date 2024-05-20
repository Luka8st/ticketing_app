@props(['ticket'])
<x-panel class="flex gap-x-6">
    <div class="flex-1 flex flex-col">
        {{-- <a href="#" class="self-start text-sm text-gray-400">
            {{ $job->employer->name }}
        </a> --}}

        <h3 class="group-hover:text-blue-800 font-bold text-xl mt-3 transition-colors duration-300">
            <a href="#" target="_blank">{{ $ticket->title }}</a>
        </h3>

        <h4>
            <b>Department</b>: {{ $ticket->department->name }}
            <br>
            <b>Agent</b>: {{--TODO--}}
        </h4>

        <p class="text-sm text-gray-400 mt-auto"><b>Description</b>: {{ $ticket->description }}</p>
    </div>

    <div>
        {{-- <form method="POST" action="/tickets/{{ $ticket->id }}" id="delete-form">
            @csrf
            @method('DELETE')

            <x-forms.button>Delete ticket</x-forms.button>
        </form> --}}

        <form action="/tickets/{{ $ticket->id }}">
            <x-forms.button>Edit ticket</x-forms.button>
        </form>
    </div>
</x-panel>
