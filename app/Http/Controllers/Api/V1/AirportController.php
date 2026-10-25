<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Airport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AirportController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Airport::query();

        if ($request->has('city')) {
            $query->where('city', $request->query('city'));
        }

        if ($request->has('country')) {
            $query->where('country', $request->query('country'));
        }

        $airports = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $airports
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:airports,code',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $airport = Airport::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully created',
            'data' => $airport
        ], 201);
    }

    public function show(Airport $airport): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $airport
        ], 200);
    }

    public function update(Request $request, Airport $airport): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|size:3|unique:airports,code,' . $airport->id,
            'city' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
        ]);

        $airport->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully updated',
            'data' => $airport
        ], 200);
    }

    public function destroy(Airport $airport): JsonResponse
    {
        $airport->delete();

        return response()->json([
            'success' => true,
            'message' => 'Airport successfully deleted'
        ], 200);
    }
}
