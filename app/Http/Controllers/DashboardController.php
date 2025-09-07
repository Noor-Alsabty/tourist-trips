<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $tripsCount = Trip::count();
    $bookingsCount = Booking::count();
    $hotelsCount = Hotel::count();
    $activitiesCount = Activity::count();

    $totalSeats = Trip::sum('total_seats');
    $bookedSeats = Trip::sum('booked_seats');
    $seatPercentage = $totalSeats > 0 ? round(($bookedSeats / $totalSeats) * 100, 1) : 0;

    return view('auth.dashbord', compact(
        'tripsCount',
        'bookingsCount',
        'hotelsCount',
        'activitiesCount',
        'seatPercentage'
    ));
}
}
