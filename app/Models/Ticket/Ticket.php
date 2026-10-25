<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'flight_id',
    'passenger_id',
    'seat_number',
    'ticket_code',
    'status',
])]
class Ticket extends Model
{
    use HasFactory;
    
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passenger::class);
    }
}
