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
                @if ($department == $ticket->department)
                    <option class="text-black" selected>{{ $department->name }}</option>
                @else
                    <option class="text-black">{{ $department->name }}</option>
                @endif
                
            @endforeach
        </x-forms.select>

        <div class="flex flex-row">
            @foreach ($ticket->files as $file)
                <img src={{asset($file)}} alt="" class="w-40 h-40 mx-8"/>
            @endforeach
        </div>

        <div class="flex justify-between ">
            <x-forms.button bg_color="bg-green-600/60" bg_color_hover="hover:bg-green-600/80">Update ticket</x-forms.button>
            <x-forms.button 
                type="button" 
                old_title="{{ $ticket->title }}" 
                old_description="{{ $ticket->description }}"
                old_department="{{ $ticket->department->name }}"
                bg_color="bg-gray-100/20"
                bg_color_hover="hover:bg-gray-100/50">
                Discard changes
            </x-forms.button>
        </div>
    </x-forms.form>

    <x-forms.form method="POST" action="/tickets/{{ $ticket->id }}" id="delete-form" class="justify-right">
        @csrf
        @method('DELETE')

        <x-forms.button bg_color="bg-red-600/60" bg_color_hover="hover:bg-red-600/80">Delete ticket</x-forms.button>
    </x-forms.form>

</x-layout>
