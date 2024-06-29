<p>
    Your ticket <i>{{ $ticket->title }}</i> has been opened by agent <i>{{ $user->name }}</i>
    <br>
    <a href="http://127.0.0.1:8000/client/tickets/show/{{$ticket->id}}">More info</a>
</p>
