<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Reservation;

class StaffDashboardController extends Controller
{
    public function index()
    {
        // Total registered users
        $totalUsers = User::where('role', 'user')->count();

        // Locker counts
        $availableLockers = Locker::where('status', 'available')->count();
        $occupiedLockers = Locker::where('status', 'occupied')->count();
        $reservedLockers = Locker::where('status', 'reserved')->count();
        $maintenanceLockers = Locker::where('status', 'maintenance')->count();

        // Location locker usage
        $locations = Location::withCount([
            'lockers',
            'lockers as occupied_lockers_count' => function ($query) {
                $query->where('status', 'occupied');
            }
        ])->get();

        // Pending reservations waiting for staff approval
        $pendingReservations = Reservation::with([
            'user',
            'locker.location'
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();

        return view('dashboard.staff', compact(
            'totalUsers',
            'availableLockers',
            'occupiedLockers',
            'reservedLockers',
            'maintenanceLockers',
            'locations',
            'pendingReservations'
        ));
    }
}