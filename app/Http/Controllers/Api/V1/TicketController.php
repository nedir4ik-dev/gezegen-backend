<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::with(['passenger', 'flight']);

        if ($request->has('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->has('passenger_id')) {
            $query->where('passenger_id', $request->query('passenger_id'));
        }

        if ($request->has('flight_id')) {
            $query->where('flight_id', $request->query('flight_id'));
        }

        $tickets = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $tickets
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'passenger_id' => 'required|exists:passengers,id',
            'flight_id' => 'required|exists:flights,id',
            'ticket_number' => 'required|string|unique:tickets,ticket_number',
            'seat_number' => 'required|string|max:10',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $ticket = Ticket::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully created',
            'data' => $ticket->load(['passenger', 'flight'])
        ], 201);
    }

    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $ticket->load(['passenger', 'flight'])
        ], 200);
    }

    public function update(Request $request, Ticket $ticket): JsonResponse
    {
        $validated = $request->validate([
            'passenger_id' => 'sometimes|required|exists:passengers,id',
            'flight_id' => 'sometimes|required|exists:flights,id',
            'ticket_number' => 'sometimes|required|string|unique:tickets,ticket_number,' . $ticket->id,
            'seat_number' => 'sometimes|required|string|max:10',
            'price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|string',
        ]);

        $ticket->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully updated',
            'data' => $ticket->load(['passenger', 'flight'])
        ], 200);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket successfully deleted'
        ], 200);
    }
}
