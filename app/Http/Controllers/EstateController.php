<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Estate::with('house')->latest();

        if (Auth::user()->isLandlord()) {
            $query->whereHas('house', function ($houseQuery) {
                $houseQuery->where('landlord_id', Auth::id());
            });
        }

        $estates = $query->paginate(10);
        return view('estates.index', compact('estates'));
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

        return view('estates.create', compact('houses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'house_id' => ['required', 'exists:houses,id'],
        ]);

        if (Auth::user()->isLandlord()) {
            $allowedHouse = House::query()
                ->whereKey($validated['house_id'])
                ->where('landlord_id', Auth::id())
                ->exists();

            if (! $allowedHouse) {
                abort(403, 'You can only create estates for your own houses.');
            }
        }

        Estate::create($validated);

        return redirect()->route('estates.index')->with('success', 'Estate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estate $estate)
    {
        if (Auth::user()->isLandlord() && $estate->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to view this estate.');
        }

        $estate->load('house');
        return view('estates.show', compact('estate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estate $estate)
    {
        if (Auth::user()->isLandlord() && $estate->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to edit this estate.');
        }

        $houses = House::query()
            ->when(Auth::user()->isLandlord(), function ($query) {
                $query->where('landlord_id', Auth::id());
            })
            ->orderBy('house_number')
            ->get();

        return view('estates.edit', compact('estate', 'houses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estate)
    {
        if (Auth::user()->isLandlord() && $estate->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to update this estate.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'house_id' => ['required', 'exists:houses,id'],
        ]);

        if (Auth::user()->isLandlord()) {
            $allowedHouse = House::query()
                ->whereKey($validated['house_id'])
                ->where('landlord_id', Auth::id())
                ->exists();

            if (! $allowedHouse) {
                abort(403, 'You can only assign estates to your own houses.');
            }
        }

        $estate->update($validated);

        return redirect()->route('estates.index')->with('success', 'Estate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        if (Auth::user()->isLandlord() && $estate->house?->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this estate.');
        }

        $estate->delete();
        return redirect()->route('estates.index')->with('success', 'Estate deleted successfully.');
    }
}
