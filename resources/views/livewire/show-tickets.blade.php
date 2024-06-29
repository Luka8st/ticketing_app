<div wire:init="loadTickets" class="my-8">
    <button wire:click="toggleTableVisibility" class="text-blue-500 mb-2">New tickets for {{ $department->name }}</button>
    <div class="flex flex-col">
        <div class="flex-grow overflow-auto transition-all duration-300 ease-in-out  {{ $isOpen ? 'max-h-60 ' : 'max-h-0' }}">
            <table
                class="relative w-full border table-auto border-collapse border border-gray-300 ">
                <thead class="z-10 bg-blue-300 sticky top-0 left-0 right-0 ">

                    <tr class="">
                        <th class="border px-4 py-2 border-gray-400 w-3/4">
                            Title
                        </th>
                        <th class="border px-4 py-2 border-gray-400 ">
                            User
                        </th>
                        <th class="border px-4 py-2 border-gray-400 ">
                            Priority
                        </th>
                    </tr>
                </thead>
                <tbody class="transition-all duration-3000 ease-in-out bg-blue-100/60">
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="border px-4 py-2 border-gray-300">{{ $ticket->title }}</td>
                            <td class="border px-4 py-2 border-gray-300">{{ $ticket->user->name }}</td>
                            @if ($ticket->priority == "high")
                                <td class="border px-4 py-2 border-gray-300 text-red-300"><b>{{ strtoupper($ticket->priority) }}</b></td>
                            @else
                                @if ($ticket->priority == "medium")
                                <td class="border px-4 py-2 border-gray-300 text-yellow-300"><b>{{ strtoupper($ticket->priority) }}</b></td>
                                @else
                                <td class="border px-4 py-2 border-gray-300 text-green-300"><b>{{ strtoupper($ticket->priority) }}</b></td>
                                @endif
                            @endif
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton<?php echo $department->id; ?>');
        const tableBody = document.getElementById('ticketTableBody<?php echo $department->id; ?>');

        toggleButton.addEventListener('click', function() {
            console.log("aaaaaa");
            // tableBody.classList.toggle('hidden');
            tableBody.style.maxHeight = '10px';
            console.log(tableBody);
        });
    });
</script>
