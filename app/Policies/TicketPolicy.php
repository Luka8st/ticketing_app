<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        //
    }

    public function edit(User $user, Ticket $ticket): bool
    {
        return $ticket->user->is($user);
    }

    public function changeStatus(User $user, Ticket $ticket): bool
    {
        return $ticket->agent == null || $ticket->agent->is($user);
    }

    public function beEdited(User $user, Ticket $ticket): bool
    {
        return $ticket->status == "new";
    }

    public function showInfo(User $user, Ticket $ticket): bool
    {
        return $ticket->status != "new";
    }
}
