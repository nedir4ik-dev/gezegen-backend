<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'name',
    'code',
    'city',
    'country',
])]
class Airport extends Model
{
    // Airport meýdançalary
}
