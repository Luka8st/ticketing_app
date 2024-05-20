<x-layout>
    <x-page-heading>Edit Your Ticket</x-page-heading>


    <x-forms.form method="POST" action="/tickets/{{ $ticket->id }}">
        @csrf
        @method('PATCH')
        <x-forms.input label="Title" name="title" placeholder="" value="{{ $ticket->title }}" />
        <x-forms.textarea label="Description" name="description" placeholder="" text="{{ $ticket->description }}" />

        <x-forms.select label="Department" name="department" value="{{ $ticket->department }}">
            @foreach ($departments as $department)
                <option class="text-black">{{ $department->name }}</option>
            @endforeach
        </x-forms.select>

        <div class="flex justify-between">
            <x-forms.button>Update ticket</x-forms.button>

            <form method="POST" action="/tickets/{{ $ticket->id }}" id="delete-form" class="justify-right">
                @csrf
                @method('DELETE')

                <x-forms.button bg_color="bg-red-800">Delete ticket</x-forms.button>
            </form>
        </div>
    </x-forms.form>


</x-layout>
