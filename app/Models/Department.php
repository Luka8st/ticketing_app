<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
