<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\House;
use App\Models\Estate;
use App\Models\HouseBooking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalHouses = House::count();
        $totalEstates = Estate::count();
        $totalBookings = HouseBooking::count();
        
        $recentUsers = User::with(['status', 'systemRole'])->latest()->take(5)->get();
        $recentHouses = House::latest()->take(6)->get();
        $recentBookings = HouseBooking::with(['user', 'house', 'booking'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalHouses',
            'totalEstates',
            'totalBookings',
            'recentUsers',
            'recentHouses',
            'recentBookings'
        ));
    }
}
