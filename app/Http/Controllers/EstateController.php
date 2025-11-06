<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Models\House;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estates = Estate::with('house')->latest()->paginate(10);
        return view('estates.index', compact('estates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $houses = House::all();
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

        Estate::create($validated);

        return redirect()->route('estates.index')->with('success', 'Estate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estate $estate)
    {
        $estate->load('house');
        return view('estates.show', compact('estate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estate $estate)
    {
        $houses = House::all();
        return view('estates.edit', compact('estate', 'houses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estate)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'house_id' => ['required', 'exists:houses,id'],
        ]);

        $estate->update($validated);

        return redirect()->route('estates.index')->with('success', 'Estate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        return redirect()->route('estates.index')->with('success', 'Estate deleted successfully.');
    }
}
