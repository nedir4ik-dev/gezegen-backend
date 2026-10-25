<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Passenger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Passenger::query();

        if ($request->has('first_name')) {
            $query->where('first_name', 'like', '%' . $request->query('first_name') . '%');
        }

        if ($request->has('last_name')) {
            $query->where('last_name', 'like', '%' . $request->query('last_name') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', $request->query('email'));
        }

        if ($request->has('passport_number')) {
            $query->where('passport_number', $request->query('passport_number'));
        }

        $passengers = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $passengers
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'passport_number' => 'required|string|unique:passengers,passport_number',
            'phone' => 'nullable|string|max:50',
        ]);

        $passenger = Passenger::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully created',
            'data' => $passenger
        ], 201);
    }

    public function show(Passenger $passenger): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $passenger->load('tickets')
        ], 200);
    }

    public function update(Request $request, Passenger $passenger): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:passengers,email,' . $passenger->id,
            'passport_number' => 'sometimes|required|string|unique:passengers,passport_number,' . $passenger->id,
            'phone' => 'nullable|string|max:50',
        ]);

        $passenger->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully updated',
            'data' => $passenger
        ], 200);
    }

    public function destroy(Passenger $passenger): JsonResponse
    {
        $passenger->delete();

        return response()->json([
            'success' => true,
            'message' => 'Passenger successfully deleted'
        ], 200);
    }
}
