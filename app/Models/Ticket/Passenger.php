<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'first_name',
    'last_name',
    'email',
    'phone',
    'passport_number',
])]
class Passenger extends Model
{
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
