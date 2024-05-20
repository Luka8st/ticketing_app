<x-layout>
    <x-page-heading>New Ticket</x-page-heading>

    <x-forms.form method="POST" action="/tickets">
        <x-forms.input label="Title" name="title" placeholder="" />
        <x-forms.textarea label="Description" name="description" placeholder="" />

        <x-forms.select label="Department" name="department">
            @foreach ($departments as $department)
                <option class="text-black">{{ $department->name }}</option>
            @endforeach
        </x-forms.select>
        
        <x-forms.button>Send your ticket</x-forms.button>
    </x-forms.form>
</x-layout>