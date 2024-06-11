<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Department;
use App\Policies\TicketPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tickets = Auth::user()->tickets;
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(3);
        return view('tickets.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create', ['departments' => Department::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'department' => ['required']
        ]);

        $department_id = Department::where('name', $attributes['department'])->first()->id;

        $attributes = Arr::except($attributes, 'department');
        $attributes['department_id'] = $department_id;

        Auth::user()->tickets()->create($attributes);

        return redirect(route('client.homepage'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', ['ticket' => $ticket, 'departments' => Department::orderBy('name')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('edit', $ticket);
        
        $attributes = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'department' => ['required']
        ]);

        $department_id = Department::where('name', $attributes['department'])->first()->id;

        $attributes = Arr::except($attributes, 'department');
        $attributes['department_id'] = $department_id;

        $ticket->update($attributes);

        return redirect(route('client.homepage'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('edit', $ticket);
        $ticket->delete();

        return redirect(route('client.homepage'));
    }

    /**
     * Mark ticket as closed
     */
    public function close(Ticket $ticket) 
    {
        $ticket->update([
            'status' => 'closed',
            'closed_at' => date('Y-m-d H:i:s')
        ]);

        return redirect(route('agent.homepage'));
    }

    /**
     * Show all new tickets available to agent
     */
    public function indexNewForAgent() 
    {
        $department = Auth::user()->department;
        $tickets = Ticket::where('status', 'new')->where('department_id', $department->id)->paginate(6);

        return view('agents.new-tickets', ['tickets' => $tickets, 'department' => $department]);
    }

    /**
     * Mark ticket as open
     */
    public function open(Ticket $ticket) 
    {
        $ticket->update([
            'agent_id' => Auth::user()->id,
            'status' => 'open',
            'opened_at' => date('Y-m-d H:i:s')
        ]);

        return redirect(route('agent.homepage'));
    }

    /**
     * Show all tickets closed by agent
     */
    public function indexClosedForAgent() 
    {
        $tickets = Ticket::where('status', 'closed')->where('agent_id', Auth::user()->id)->paginate(6);

        return view('agents.closed-tickets', ['tickets' => $tickets]);
    }

    public function showNewForAgent(Ticket $ticket)
    {
        return view('agents.show-new-ticket', ['ticket' => $ticket, 'user' => $ticket->user]);
    }

}
