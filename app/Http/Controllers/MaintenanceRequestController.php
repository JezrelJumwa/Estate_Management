<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\MaintenanceRequest;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $query = MaintenanceRequest::with(['user', 'house'])->latest();

        if (Auth::user()->isTenant()) {
            $query->where('user_id', Auth::id());
        }

        if (Auth::user()->isLandlord()) {
            $query->whereHas('house', function ($houseQuery) {
                $houseQuery->where('landlord_id', Auth::id());
            });
        }

        $requests = $query->paginate(12);

        return view('maintenance.index', compact('requests'));
    }

    public function create()
    {
        $houses = House::query()->orderBy('house_number')->get();

        return view('maintenance.create', compact('houses'));
    }

    public function store(Request $request, SmsService $smsService)
    {
        $validated = $request->validate([
            'house_id' => ['required', 'exists:houses,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'priority' => ['required', 'in:LOW,MEDIUM,HIGH'],
        ]);

        $record = MaintenanceRequest::create([
            'user_id' => Auth::id(),
            'house_id' => $validated['house_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'OPEN',
        ]);

        Mail::raw('Maintenance request submitted: ' . $record->title, function ($message) {
            $message->to(Auth::user()->email)->subject('Maintenance Request Received');
        });

        $smsService->send(Auth::user()->id_number, 'Maintenance request received: ' . $record->title, Auth::user());

        return redirect()->route('maintenance-requests.index')->with('success', 'Maintenance request submitted.');
    }

    public function update(Request $request, MaintenanceRequest $maintenanceRequest)
    {
        if (Auth::user()->isTenant() && $maintenanceRequest->user_id !== Auth::id()) {
            abort(403);
        }

        if (Auth::user()->isLandlord() && $maintenanceRequest->house?->landlord_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:OPEN,IN_PROGRESS,RESOLVED,CLOSED'],
        ]);

        $maintenanceRequest->update([
            'status' => $validated['status'],
            'resolved_at' => in_array($validated['status'], ['RESOLVED', 'CLOSED'], true) ? now() : null,
        ]);

        return back()->with('success', 'Maintenance request updated.');
    }
}
