<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::latest()->paginate(12);
        return view('houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('houses.create');
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

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
        $house->load(['estates', 'houseBookings.user', 'houseBookings.booking']);
        return view('houses.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        return view('houses.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        $validated = $request->validate([
            'house_number' => ['required', 'integer'],
            'rent' => ['required', 'numeric', 'min:0'],
            'house_type' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

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
        // Delete image if exists
        if ($house->file_path) {
            Storage::disk('public')->delete($house->file_path);
        }

        $house->delete();
        return redirect()->route('houses.index')->with('success', 'House deleted successfully.');
    }
}
