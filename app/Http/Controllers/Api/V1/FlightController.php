<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $flights = Flight::with(['departureAirport', 'arrivalAirport'])->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $flights
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:50|unique:flights,flight_number',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|string',
        ]);

        $flight = Flight::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully created',
            'data' => $flight->load(['departureAirport', 'arrivalAirport'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $flight->load(['departureAirport', 'arrivalAirport', 'tickets'])
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight): JsonResponse
    {
        $validated = $request->validate([
            'flight_number' => 'sometimes|required|string|max:50|unique:flights,flight_number,' . $flight->id,
            'departure_airport_id' => 'sometimes|required|exists:airports,id',
            'arrival_airport_id' => 'sometimes|required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'sometimes|required|date',
            'arrival_time' => 'sometimes|required|date|after:departure_time',
            'status' => 'sometimes|required|string',
        ]);

        $flight->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully updated',
            'data' => $flight->load(['departureAirport', 'arrivalAirport'])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight): JsonResponse
    {
        $flight->delete();

        return response()->json([
            'success' => true,
            'message' => 'Flight successfully deleted'
        ], 200);
    }
}
