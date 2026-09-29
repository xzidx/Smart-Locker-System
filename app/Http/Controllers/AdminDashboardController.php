<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Locker;
use App\Models\Location;
use App\Models\Reservation;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();

        $availableLockers = Locker::where('status', 'available')->count();
        $occupiedLockers = Locker::where('status', 'occupied')->count();
        $reservedLockers = Locker::where('status', 'reserved')->count();
        $maintenanceLockers = Locker::where('status', 'maintenance')->count();

        $locations = Location::withCount([
            'lockers',
            'lockers as occupied_lockers_count' => function ($query) {
                $query->where('status', 'occupied');
            }
        ])->get();

        $pendingReservations = Reservation::with([
            'user',
            'locker.location'
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();

        $totalStaff = User::where('role', 'staff')->count();

        return view('dashboard.admin', compact(
            'totalUsers',
            'availableLockers',
            'occupiedLockers',
            'reservedLockers',
            'maintenanceLockers',
            'locations',
            'pendingReservations',
            'totalStaff'
        ));
    }
}