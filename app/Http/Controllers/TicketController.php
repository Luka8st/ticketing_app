<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Mail\TicketClosed;
use App\Mail\TicketOpened;
use App\Models\Department;
use App\Policies\TicketPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\Mail;

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

    public function indexNew()
    {
        // $tickets = Auth::user()->tickets;
        $tickets = Ticket::where('user_id', Auth::user()->id)->where('status', 'new')->paginate(3);
        return view('tickets.index', ['tickets' => $tickets]);
    }

    public function indexOpen()
    {
        // $tickets = Auth::user()->tickets;
        $tickets = Ticket::where('user_id', Auth::user()->id)->where('status', 'open')->paginate(3);
        return view('tickets.index', ['tickets' => $tickets]);
    }

    public function indexClosed()
    {
        // $tickets = Auth::user()->tickets;
        $tickets = Ticket::where('user_id', Auth::user()->id)->where('status', 'closed')->paginate(3);
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
            'department' => ['required'],
            'files.*' => 'file|mimes:jpg,png|max:2048'
        ],
        [
            'files.*.mimes' => 'The files must be of type: jpg, png.'
        ]
    );

        // dd( $request->file('files'));
        $files = $request->file('files');
        $filePaths = [];
        if($request->hasFile('files'))
        {
            $counter = 1;
            foreach ($files as $file) {

                $filePaths[] = Storage::putFileAs('uploaded_files', $file, time().'-image'.$counter.'.jpg');

                $counter++;
            }
        }

        $department_id = Department::where('name', $attributes['department'])->first()->id;

        $attributes = Arr::except($attributes, ['department', 'files']);
        $attributes['department_id'] = $department_id;
        $attributes['files'] = $filePaths;

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
            'department' => ['required'],
            'files.*' => 'file|mimes:jpg,png|max:2048'
        ],
        [
            'files.*.mimes' => 'The files must be of type: jpg, png.'
        ]
    );

        $files = $request->file('files');
        $filePaths = [];
        if($request->hasFile('files'))
        {
            $counter = 1;
            foreach ($files as $file) {

                $filePaths[] = Storage::putFileAs('uploaded_files', $file, time().'-image'.$counter.'.jpg');

                $counter++;
            }
        }

        $department_id = Department::where('name', $attributes['department'])->first()->id;

        $attributes = Arr::except($attributes, ['department', 'files']);
        $attributes['department_id'] = $department_id;

        $existingFiles = $ticket->files;
        
        if ($ticket->files) {
            $attributes['files'] = array_merge($ticket->files, $filePaths);
        }
        else {
            $attributes['files'] = $filePaths;
        }

        $attributes['updated_at'] = date('Y-m-d H:i:s');

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
    public function close(Request $request, Ticket $ticket) 
    {
        $ticket->update([
            'status' => 'closed',
            'closed_at' => date('Y-m-d H:i:s'),
            'closing_comment' => $request->closing_comment
        ]);

        Mail::to($ticket->user)->queue(new TicketClosed($ticket));

        return redirect(route('agent.homepage'));
    }

    /**
     * Show all new tickets available to agent
     */
    public function indexNewForAgent() 
    {
        $departments = Department::all();
        $department = Auth::user()->department;
        $tickets = Ticket::where('status', 'new')->where('department_id', $department->id)->orderBy('created_at')->with('user')->get();#->paginate(12);

        foreach ($tickets as $ticket) {
            $createdAt = new DateTime($ticket['created_at']);
            $currentTime = new DateTime();
            $diff = $createdAt->diff($currentTime);
            if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 5) $ticket['priority'] = "low";
            else if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 10) $ticket['priority'] = "medium";
            else $ticket['priority'] = "high";
        }

        return view('agents.new-tickets', ['tickets' => $tickets, 'department' => $department, 'departments' => $departments]);
    }

    /**
     * Index tickets that agent opened
     */
    public function indexOpenedForAgent() 
    {
        $department = Auth::user()->department;
        // $tickets = Auth::user()->ticketsForAgent()->where('status', 'open')->orderBy('created_at')->paginate(12);
        $tickets = Ticket::where('status', 'open')->where('agent_id', Auth::user()->id)->orderBy('created_at')->paginate(6);

        // dd($tickets);

        foreach ($tickets as $ticket) {
            $createdAt = new DateTime($ticket['created_at']);
            $currentTime = new DateTime();
            $diff = $createdAt->diff($currentTime);
            if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 5) $ticket['priority'] = "low";
            else if ($diff->y == 0 && $diff->m == 0 && $diff->d <= 10) $ticket['priority'] = "medium";
            else $ticket['priority'] = "high";
        }

        return view('agents.homepage', ['tickets' => $tickets]);
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

        Mail::to($ticket->user)->queue(new TicketOpened($ticket, Auth::user()));

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

    public function showTicketForAgent(Ticket $ticket)
    {
        return view('agents.show-ticket', ['ticket' => $ticket, 'user' => $ticket->user]);
    }

    public function showTicketForClient(Ticket $ticket)
    {
        return view('tickets.show-ticket', ['ticket' => $ticket]);
    }

}
