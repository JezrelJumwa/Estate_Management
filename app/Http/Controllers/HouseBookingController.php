<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\House;
use App\Models\HouseBooking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = HouseBooking::with(['user.systemRole', 'house', 'booking'])->latest();

        if (Auth::user()->isTenant()) {
            $query->where('user_id', Auth::id());
        }

        if (Auth::user()->isLandlord()) {
            $query->whereHas('house', function ($houseQuery) {
                $houseQuery->where('landlord_id', Auth::id());
            });
        }

        $bookings = $query->paginate(12);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $houses = House::query()
            ->when(Auth::user()->isLandlord(), function ($query) {
                $query->where('landlord_id', Auth::id());
            })
            ->orderBy('house_number')
            ->get();

        $statuses = Booking::orderBy('status')->get();

        if (Auth::user()->isTenant()) {
            $users = User::whereKey(Auth::id())->get();
        } elseif (Auth::user()->isLandlord()) {
            $users = User::with('systemRole')
                ->whereHas('systemRole', function ($query) {
                    $query->where('name', 'TENANT');
                })
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();
        } else {
            $users = User::with('systemRole')
                ->whereHas('systemRole', function ($query) {
                    $query->whereIn('name', ['TENANT', 'LANDLORD', 'ADMINISTRATOR']);
                })
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();
        }

        return view('bookings.create', compact('houses', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'house_id' => ['required', 'exists:houses,id'],
            'booking_id' => ['required', 'exists:bookings,id'],
        ]);

        if (Auth::user()->isTenant()) {
            $validated['user_id'] = Auth::id();
        }

        if (Auth::user()->isLandlord()) {
            $ownsHouse = House::query()
                ->whereKey($validated['house_id'])
                ->where('landlord_id', Auth::id())
                ->exists();

            if (! $ownsHouse) {
                abort(403, 'You can only create bookings for your own houses.');
            }
        }

        HouseBooking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseBooking $booking)
    {
        if (Auth::user()->isTenant() && $booking->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to view this booking.');
        }

        if (Auth::user()->isLandlord() && $booking->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to view this booking.');
        }

        $booking->load(['user.systemRole', 'house', 'booking']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HouseBooking $booking)
    {
        if (Auth::user()->isTenant() && $booking->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to edit this booking.');
        }

        if (Auth::user()->isLandlord() && $booking->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to edit this booking.');
        }

        $houses = House::query()
            ->when(Auth::user()->isLandlord(), function ($query) {
                $query->where('landlord_id', Auth::id());
            })
            ->orderBy('house_number')
            ->get();

        $statuses = Booking::orderBy('status')->get();

        if (Auth::user()->isTenant()) {
            $users = User::whereKey(Auth::id())->get();
        } elseif (Auth::user()->isLandlord()) {
            $users = User::with('systemRole')
                ->whereHas('systemRole', function ($query) {
                    $query->where('name', 'TENANT');
                })
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get();
        } else {
            $users = User::orderBy('first_name')->orderBy('last_name')->get();
        }

        return view('bookings.edit', compact('booking', 'houses', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HouseBooking $booking)
    {
        if (Auth::user()->isTenant() && $booking->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to update this booking.');
        }

        if (Auth::user()->isLandlord() && $booking->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to update this booking.');
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'house_id' => ['required', 'exists:houses,id'],
            'booking_id' => ['required', 'exists:bookings,id'],
        ]);

        if (Auth::user()->isTenant()) {
            $validated['user_id'] = Auth::id();
        }

        if (Auth::user()->isLandlord()) {
            $ownsHouse = House::query()
                ->whereKey($validated['house_id'])
                ->where('landlord_id', Auth::id())
                ->exists();

            if (! $ownsHouse) {
                abort(403, 'You can only update bookings for your own houses.');
            }
        }

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseBooking $booking)
    {
        if (Auth::user()->isTenant() && $booking->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this booking.');
        }

        if (Auth::user()->isLandlord() && $booking->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this booking.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
