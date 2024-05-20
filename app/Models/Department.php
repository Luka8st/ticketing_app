<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function agents()
    {
        // TODO kad dodam agente
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
