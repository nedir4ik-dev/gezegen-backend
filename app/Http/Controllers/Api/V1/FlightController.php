<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Airport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Flight::with(['departureAirport', 'arrivalAirport']);

        if ($request->has('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->has('departure_airport_id')) {
            $query->where('departure_airport_id', $request->query('departure_airport_id'));
        }

        if ($request->has('arrival_airport_id')) {
            $query->where('arrival_airport_id', $request->query('arrival_airport_id'));
        }

        $flights = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $flights
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:50|unique:flights,flight_number',
            'airline' => 'required|string|max:100',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'required|date',
            'price' => 'required|numeric|min:0',
            'available_seats' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $departureAirport = Airport::find($request->departure_airport_id);
        $arrivalAirport = Airport::find($request->arrival_airport_id);

        $departureTimeUtc = Carbon::createFromFormat('Y-m-d H:i:s', $request->departure_time, $departureAirport->timezone)
            ->setTimezone('UTC');

        $flightDurationMinutes = (4 * 60) + 5;

        $arrivalTimeUtc = (clone $departureTimeUtc)->addMinutes($flightDurationMinutes);

        $validated['departure_time'] = $departureTimeUtc->setTimezone($departureAirport->timezone)->format('Y-m-d H:i:s');
        $validated['arrival_time'] = $arrivalTimeUtc->setTimezone($arrivalAirport->timezone)->format('Y-m-d H:i:s');

        $flight = Flight::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully created',
            'data' => $flight->load(['departureAirport', 'arrivalAirport'])
        ], 201);
    }

    public function show(Flight $flight): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $flight->load(['departureAirport', 'arrivalAirport', 'tickets'])
        ], 200);
    }

    public function update(Request $request, Flight $flight): JsonResponse
    {
        $validated = $request->validate([
            'flight_number' => 'sometimes|required|string|max:50|unique:flights,flight_number,' . $flight->id,
            'airline' => 'sometimes|required|string|max:100',
            'departure_airport_id' => 'sometimes|required|exists:airports,id',
            'arrival_airport_id' => 'sometimes|required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'sometimes|required|date',
            'status' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'available_seats' => 'sometimes|required|integer|min:1',
        ]);

        // Eger ugradyş wagty, ugraýan howa menzili ýa-da barýan howa menzili üýtgedilen bolsa...
        if (isset($validated['departure_time']) || isset($validated['departure_airport_id']) || isset($validated['arrival_airport_id'])) {

            // Täze ugradylan ID ýa-da üýtgemän galan öňki bazadaky ID-ni alýarys
            $depId = $validated['departure_airport_id'] ?? $flight->departure_airport_id;
            $arrId = $validated['arrival_airport_id'] ?? $flight->arrival_airport_id;
            $depTime = $validated['departure_time'] ?? $flight->departure_time;

            // Howa menzillerini bazadan tapýarys
            $departureAirport = Airport::find($depId);
            $arrivalAirport = Airport::find($arrId);

            // Ugradyş wagtyny ugraýan howa menziliniň öz timezone-na baglap, UTC formatyna öwürýäris
            $departureTimeUtc = Carbon::createFromFormat('Y-m-d H:i:s', $depTime, $departureAirport->timezone)
                ->setTimezone('UTC');

            // Uçuş dowamlylygyny minutlarda kesgitleýäris (Mysal üçin: 4 sagat * 60 minut + 5 minut)
            $flightDurationMinutes = (4 * 60) + 5;

            // Ugradyş wagtyna uçuş dowamlylygyny goşup, gelýän wagtyny UTC boýunça tapýarys
            $arrivalTimeUtc = (clone $departureTimeUtc)->addMinutes($flightDurationMinutes);

            // Ugradyş we geliş wagytlaryny degişli howa menzilleriniň ýerli wagtyna (local time) öwrüp we formatlap saklaýarys
            $validated['departure_time'] = $departureTimeUtc->setTimezone($departureAirport->timezone)->format('Y-m-d H:i:s');
            $validated['arrival_time'] = $arrivalTimeUtc->setTimezone($arrivalAirport->timezone)->format('Y-m-d H:i:s');
        }

        // Maglumatlary bazada täzeleýäris
        $flight->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully updated',
            'data' => $flight->load(['departureAirport', 'arrivalAirport'])
        ], 200);
    }

    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully deleted'
        ], 200);
    }
}
