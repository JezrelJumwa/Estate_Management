<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\House;
use App\Models\HouseBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $query = Document::with(['user', 'house', 'houseBooking'])->latest();

        if (! Auth::user()->isAdmin()) {
            $query->where(function ($q) {
                $q->where('user_id', Auth::id())
                    ->orWhere('visibility', 'SHARED');
            });
        }

        $documents = $query->paginate(12);

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $houses = House::orderBy('house_number')->get();
        $bookings = HouseBooking::with('house')->orderByDesc('id')->limit(50)->get();

        return view('documents.create', compact('houses', 'bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'file' => ['required', 'file', 'max:5120'],
            'house_id' => ['nullable', 'exists:houses,id'],
            'house_booking_id' => ['nullable', 'exists:house_bookings,id'],
            'visibility' => ['required', 'in:PRIVATE,SHARED'],
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        Document::create([
            'user_id' => Auth::id(),
            'house_id' => $validated['house_id'] ?? null,
            'house_booking_id' => $validated['house_booking_id'] ?? null,
            'name' => $validated['name'],
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'visibility' => $validated['visibility'],
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded.');
    }

    public function download(Document $document)
    {
        if (! Auth::user()->isAdmin() && $document->visibility !== 'SHARED' && $document->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($document->file_path, $document->name);
    }
}
