<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'code',
    'city',
    'country',
])]
class Airport extends Model
{
    public function departureFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    public function arrivalFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }
}
