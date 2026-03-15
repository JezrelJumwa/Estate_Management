<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\JsonResponse;

class HouseApiController extends Controller
{
    public function index(): JsonResponse
    {
        $houses = House::query()
            ->with('landlord')
            ->whereDoesntHave('houseBookings.booking', function ($query) {
                $query->where('status', 'UNAVAILABLE');
            })
            ->latest()
            ->get();

        return response()->json($houses);
    }

    public function show(House $house): JsonResponse
    {
        $house->load(['landlord', 'estates']);

        return response()->json($house);
    }
}
