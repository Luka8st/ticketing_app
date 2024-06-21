<x-layout>
    <x-page-heading>Edit Your Ticket</x-page-heading>

    <x-forms.form method="POST" action="{{ route('client.tickets.update', ['ticket' => $ticket->id]) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PATCH')
        <x-forms.input label="Title" name="title" id="title" placeholder="" value="{{ $ticket->title }}" />
        <x-forms.textarea label="Description" name="description" id="description" placeholder=""
            text="{{ $ticket->description }}" />

        <x-forms.select label="Department" name="department" id="department" value="{{ $ticket->department->name }}"
            status="{{ $ticket->status }}">
            @foreach ($departments as $department)
                @if ($department == $ticket->department)
                    <option class="text-black" selected>{{ $department->name }}</option>
                @else
                    <option class="text-black">{{ $department->name }}</option>
                @endif
            @endforeach
        </x-forms.select>

        <x-forms.label name="" label="Uploaded Files" />
        <div class="flex flex-row grid grid-cols-2 gap-8">
            @if ($ticket->images)
                @foreach ($ticket->images as $index => $image)
                    <div class="flex flex-row">
                        <img id="{{ $image->id }}" src={{ asset($image->path) }} alt="" class="w-40 h-40 mx-8" />
                        <button type="button" id="button-{{ $index }}" onclick="selectImage(this, {{$image->id}})"
                            class="w-4 h-4" style="z-index: 1; cursor: pointer;">
                            <i class="fa-solid fa-trash text-white"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
        
        <input type="hidden" name="deleted_image_ids" id="deleted_image_ids" value="">


        <x-forms.input name="files[]" label="Add New Files" type="file" multiple />

        <div class="flex justify-between ">
            <x-forms.button bg_color="bg-green-600/60" bg_color_hover="hover:bg-green-600/80">Update
                ticket</x-forms.button>
            <x-forms.button type="button" old_title="{{ $ticket->title }}"
                old_description="{{ $ticket->description }}" old_department="{{ $ticket->department->name }}"
                bg_color="bg-gray-100/20" bg_color_hover="hover:bg-gray-100/50">
                Discard changes
            </x-forms.button>
        </div>
    </x-forms.form>

    <x-forms.form method="POST" action="{{ route('client.tickets.destroy', ['ticket' => $ticket->id]) }}"
        id="delete-form" class="justify-right">
        @csrf
        @method('DELETE')

        <x-forms.button bg_color="bg-red-600/60" bg_color_hover="hover:bg-red-600/80">Delete ticket</x-forms.button>
    </x-forms.form>

</x-layout>

<script>
    function selectImage(button, imageId) {
        const icon = button.querySelector('i');

        icon.classList.toggle('text-white');
        icon.classList.toggle('text-red-500');

        const deletedImageIdsInput = document.getElementById('deleted_image_ids');
        let deletedImageIds = deletedImageIdsInput.value ? deletedImageIdsInput.value.split(',') : [];
        
        if (!deletedImageIds.includes(imageId.toString())) {
            deletedImageIds.push(imageId);
        }
        else {
            deletedImageIds.pop(imageId);
        }

        deletedImageIdsInput.value = deletedImageIds.join(',');
    }
</script>

