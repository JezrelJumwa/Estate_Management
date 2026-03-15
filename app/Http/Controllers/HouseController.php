<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = House::with('landlord')->latest();

        if (Auth::user()->isTenant()) {
            $query->whereDoesntHave('houseBookings.booking', function ($bookingQuery) {
                $bookingQuery->where('status', 'UNAVAILABLE');
            });
        }

        if (Auth::user()->isLandlord()) {
            $query->where('landlord_id', Auth::id());
        }

        $houses = $query->paginate(12);
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $landlords = User::query()
            ->whereHas('systemRole', fn ($query) => $query->where('name', 'LANDLORD'))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('houses.create', compact('landlords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'house_number' => ['required', 'integer'],
            'rent' => ['required', 'numeric', 'min:0'],
            'house_type' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'landlord_id' => ['nullable', 'exists:users,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if (Auth::user()->isLandlord()) {
            $validated['landlord_id'] = Auth::id();
        }

        if (! empty($validated['landlord_id'])) {
            $isLandlord = User::query()
                ->whereKey($validated['landlord_id'])
                ->whereHas('systemRole', fn ($query) => $query->where('name', 'LANDLORD'))
                ->exists();

            if (! $isLandlord) {
                return back()->withErrors(['landlord_id' => 'Selected user must be a landlord.'])->withInput();
            }
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('houses', $filename, 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $filename;
        }

        House::create($validated);

        return redirect()->route('houses.index')->with('success', 'House created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        if (Auth::user()->isLandlord() && $house->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to view this house.');
        }

        $house->load(['landlord', 'estates', 'houseBookings.user', 'houseBookings.booking']);
        return view('houses.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        if (Auth::user()->isLandlord() && $house->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to edit this house.');
        }

        $landlords = User::query()
            ->whereHas('systemRole', fn ($query) => $query->where('name', 'LANDLORD'))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('houses.edit', compact('house', 'landlords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        if (Auth::user()->isLandlord() && $house->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to update this house.');
        }

        $validated = $request->validate([
            'house_number' => ['required', 'integer'],
            'rent' => ['required', 'numeric', 'min:0'],
            'house_type' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'landlord_id' => ['nullable', 'exists:users,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if (Auth::user()->isLandlord()) {
            $validated['landlord_id'] = Auth::id();
        }

        if (! empty($validated['landlord_id'])) {
            $isLandlord = User::query()
                ->whereKey($validated['landlord_id'])
                ->whereHas('systemRole', fn ($query) => $query->where('name', 'LANDLORD'))
                ->exists();

            if (! $isLandlord) {
                return back()->withErrors(['landlord_id' => 'Selected user must be a landlord.'])->withInput();
            }
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($house->file_path) {
                Storage::disk('public')->delete($house->file_path);
            }

            // Upload new image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('houses', $filename, 'public');
            
            $validated['file_path'] = $path;
            $validated['file_name'] = $filename;
        }

        $house->update($validated);

        return redirect()->route('houses.index')->with('success', 'House updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        if (Auth::user()->isLandlord() && $house->landlord_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this house.');
        }

        // Delete image if exists
        if ($house->file_path) {
            Storage::disk('public')->delete($house->file_path);
        }

        $house->delete();
        return redirect()->route('houses.index')->with('success', 'House deleted successfully.');
    }
}
