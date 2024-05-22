<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tickets';

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    public function agent() 
    {
        return $this->belongsTo(Agent::class);
    }
}
