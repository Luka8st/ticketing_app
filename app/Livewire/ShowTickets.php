<?php

namespace App\Livewire;

use App\Models\Ticket;
use DateTime;
use Livewire\Component;

class ShowTickets extends Component
{
    public $department;
    public $readyToLoad = false;
    public $isOpen = false;

    public function mount($department)
    {
        $this->department = $department;
    }

    public function toggleTableVisibility()
    {
        $this->isOpen = !$this->isOpen; // Toggle table visibility
    }

    public function loadTickets()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $tickets = Ticket::where('department_id', $this->department->id)->where('status','new')->orderBy('created_at')->orderBy('title')->get();
        foreach ($tickets as $ticket) {
            $createdAt = new DateTime($ticket['created_at']);
            $currentTime = new DateTime();
            $diff = $createdAt->diff($currentTime);
            if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 5) $ticket['priority'] = "low";
            else if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 10) $ticket['priority'] = "medium";
            else $ticket['priority'] = "high";
        }
        return view('livewire.show-tickets', [
            'tickets' => $this->readyToLoad
                ? $tickets
                : [],
        ]);
    }
}
