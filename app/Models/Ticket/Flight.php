<?php

namespace App\Models\Ticket;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'flight_number',
    'departure_airport_id',
    'arrival_airport_id',
    'departure_time',
    'arrival_time',
    'price',
    'available_seats',
    'status',
])]
class Flight extends Model
{
    use HasFactory;

    protected $appends = ['formatted_times'];

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'flight_id');
    }

    public function getFormattedTimesAttribute()
    {
        // Uçuş ugraýan howa menziliniň wagt guşagyny (timezone) alýarys, eger ýok bolsa adaty 'Asia/Ashgabat' ulanýarys
        $depTz = $this->departureAirport->timezone ?? 'Asia/Ashgabat';

        // Barýan howa menziliniň wagt guşagyny alýarys, eger ýok bolsa 'UTC' ulanýarys
        $arrTz = $this->arrivalAirport->timezone ?? 'UTC';

        return [
            // Ugraýan wagtyny UTC-den alyp, ugraýan ýeriniň ýerli wagtyna (local time) öwürýaris we formatlaýarys
            'departure_local' => $this->departure_time
                ? Carbon::parse($this->departure_time)->format('Y-m-d H:i')
                : null,

            // Barýan wagtyny UTC-den alyp, barýan ýeriniň ýerli wagtyna öwürýaris we formatlaýarys
            'arrival_local' => $this->arrival_time
                ? Carbon::parse($this->arrival_time)->format('Y-m-d H:i')
                : null,
        ];
    }
}
