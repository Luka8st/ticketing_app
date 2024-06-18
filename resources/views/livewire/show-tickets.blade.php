<!-- resources/views/livewire/show-tickets.blade.php -->
<div wire:init="loadTickets" class="my-8">
    {{-- <button wire:click="toggleTableVisibility" class="text-blue-500 mb-2">Tickets for {{$department->name}}</button>
    
    <table class="my-6 overflow-auto table-auto border-collapse border border-gray-300 transition-all duration-300 ease-in-out block {{ $isOpen ? 'max-h-60 ' : 'max-h-0' }}">
        <thead class="z-10 bg-gray-200 sticky top-0 left-0 right-0 ">
            
            <tr class="">
                <th class="border px-4 py-2 border-gray-400 ">
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
        <tbody class="transition-all duration-3000 ease-in-out">
            @foreach ($tickets as $ticket)
                <tr>
                    <td class="border px-4 py-2 border-gray-300">{{ $ticket->title }}</td>
                    <td class="border px-4 py-2 border-gray-300">{{ $ticket->user->name }}</td>
                    <td class="border px-4 py-2 border-gray-300">{{ $ticket->priority }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <button wire:click="toggleTableVisibility" class="text-blue-500 mb-2">New tickets for {{ $department->name }}</button>
    <div class="flex flex-col">
        <div class="flex-grow overflow-auto transition-all duration-300 ease-in-out  {{ $isOpen ? 'max-h-60 ' : 'max-h-0' }}">
            <table
                class="relative w-full border table-auto border-collapse border border-gray-300 ">
                <thead class="z-10 bg-blue-300 sticky top-0 left-0 right-0 ">

                    <tr class="">
                        <th class="border px-4 py-2 border-gray-400 ">
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

    {{-- <div class="overflow-hidden">
        <button id="toggleButton{{$department->id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            Toggle Table
        </button>
    
        <table id="ticketTable{{$department->id}}" class="min-w-full divide-y divide-gray-200 shadow-sm overflow-hidden sm:rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                </tr>
            </thead>
            <tbody id="ticketTableBody{{$department->id}}"  class="transition-all duration-3000 ease-in-out max-h-0 overflow-hidden bg-white divide-y divide-gray-200">
                <!-- Loop through tickets -->
                @foreach ($tickets as $ticket)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ticket->title }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
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
