<x-layout>
    <x-page-heading>Edit Your Ticket</x-page-heading>


    <x-forms.form method="POST" action="/tickets/{{ $ticket->id }}">
        @csrf
        @method('PATCH')
        <x-forms.input label="Title" name="title" id="title" placeholder="" value="{{ $ticket->title }}" />
        <x-forms.textarea label="Description" name="description" id="description" placeholder=""
            text="{{ $ticket->description }}" />

        <x-forms.select label="Department" name="department" id="department" value="{{ $ticket->department->name }}">
            @foreach ($departments as $department)
                <option class="text-black">{{ $department->name }}</option>
            @endforeach
        </x-forms.select>

        <div class="flex justify-between ">
            <x-forms.button bg_color="bg-green-600">Update ticket</x-forms.button>
            <x-forms.button type="button" old_title="{{ $ticket->title }}" old_description="{{ $ticket->description }}"
                old_department="{{ $ticket->department->name }}">
                Discard changes
            </x-forms.button>
        </div>
    </x-forms.form>

    <x-forms.form method="POST" action="/tickets/{{ $ticket->id }}" id="delete-form" class="justify-right">
        @csrf
        @method('DELETE')

        <x-forms.button bg_color="bg-red-800">Delete ticket</x-forms.button>
    </x-forms.form>

</x-layout>
