<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];
    protected $table = 'tickets';
    protected $casts = [
        'files' => 'array',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department() 
    {
        return $this->belongsTo(Department::class);
    }

    public function agent() 
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
