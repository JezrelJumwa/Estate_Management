<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HouseBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $bookings = HouseBooking::query()
            ->with(['house', 'booking'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($bookings);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'house_id' => ['required', 'exists:houses,id'],
            'booking_id' => ['required', 'exists:bookings,id'],
        ]);

        $booking = HouseBooking::create([
            'user_id' => $request->user()->id,
            'house_id' => $validated['house_id'],
            'booking_id' => $validated['booking_id'],
        ]);

        return response()->json($booking->load(['house', 'booking']), 201);
    }
}
