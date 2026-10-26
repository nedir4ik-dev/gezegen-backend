<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Flight;
use App\Models\Ticket\Passenger;
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
            'flight_id' => 'required|exists:flights,id',
            'passengers' => 'required|array|min:1',
            'passengers.*.first_name' => 'required|string|max:255',
            'passengers.*.last_name' => 'required|string|max:255',
            'passengers.*.type' => 'required|in:adult,child,infant', // Uly, çaga ýa-da bäbek
            'passengers.*.passport_number' => 'nullable|string|max:50', // Çagalar üçin şahadatnama hem boluberýär
            'passengers.*.email' => 'nullable|email|max:255',
            'passengers.*.phone' => 'nullable|string|max:50',
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);
        $totalPassengersCount = count($validated['passengers']);

        if ($flight->available_seats < $totalPassengersCount) {
            return response()->json([
                'success' => false,
                'message' => 'Saýlanan ýolagçy sany üçin uçuşda ýeterlik boş ýer ýok!'
            ], 400);
        }

        $createdTickets = [];
        $basePrice = $flight->price;

        foreach ($validated['passengers'] as $passengerData) {

            $passenger = Passenger::firstOrCreate(
                ['passport_number' => $passengerData['passport_number'] ?? 'N/A-' . uniqid()],
                [
                    'first_name' => $passengerData['first_name'],
                    'last_name' => $passengerData['last_name'],
                    'email' => $passengerData['email'] ?? null,
                    'phone' => $passengerData['phone'] ?? null,
                ]
            );

            $ticketPrice = $basePrice;
            if ($passengerData['type'] === 'child') {
                $ticketPrice = $basePrice * 0.75;
            } elseif ($passengerData['type'] === 'infant') {
                $ticketPrice = 0;
            }

            $ticketCode = 'TCK-' . strtoupper(uniqid());

            $ticket = Ticket::create([
                'flight_id' => $flight->id,
                'passenger_id' => $passenger->id,
                'ticket_code' => $ticketCode,
                'seat_number' => $passengerData['type'] === 'infant' ? 'LAP' : ('A-' . rand(1, 30)),
                'price' => $ticketPrice,
                'status' => 'confirmed',
            ]);

            $createdTickets[] = $ticket->load(['passenger', 'flight']);
        }
        
        $flight->decrement('available_seats', $totalPassengersCount);

        return response()->json([
            'success' => true,
            'message' => 'Ähli biletler üstünlikli sargyt edildi!',
            'data' => $createdTickets
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
