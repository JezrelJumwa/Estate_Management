<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\House;
use App\Models\Estate;
use App\Models\Payment;
use App\Models\HouseBooking;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalHouses = House::count();
        $totalEstates = Estate::count();
        $totalBookings = HouseBooking::count();
        $totalRevenue = (float) Payment::where('status', 'PAID')->sum('amount');
        $pendingMaintenance = MaintenanceRequest::whereIn('status', ['OPEN', 'IN_PROGRESS'])->count();
        $monthlyRevenue = (float) Payment::where('status', 'PAID')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
        
        $recentUsers = User::with(['status', 'systemRole'])->latest()->take(5)->get();
        $recentHouses = House::latest()->take(6)->get();
        $recentBookings = HouseBooking::with(['user', 'house', 'booking'])->latest()->take(5)->get();
        $recentPayments = Payment::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalHouses',
            'totalEstates',
            'totalBookings',
            'totalRevenue',
            'pendingMaintenance',
            'monthlyRevenue',
            'recentUsers',
            'recentHouses',
            'recentBookings',
            'recentPayments'
        ));
    }
}
