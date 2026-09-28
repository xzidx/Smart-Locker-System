<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Locker;

class DashboardController extends Controller
{
    public function index()
    {
        // Count locations
        $locationCount = Location::count();

        // Count lockers
        $totalLockers = Locker::count();

        $availableLockers = Locker::where('status', 'available')->count();

        $occupiedLockers = Locker::where('status', 'occupied')->count();

        // No reservation data for now
        $reservationCount = 0;

        // Dashboard statistics
        $stats = [
            [
                'label' => 'Total Lockers',
                'value' => $totalLockers,
                'change' => '',
                'tone' => 'blue',
            ],
            [
                'label' => 'Available Lockers',
                'value' => $availableLockers,
                'change' => '',
                'tone' => 'green',
            ],
            [
                'label' => 'Occupied Lockers',
                'value' => $occupiedLockers,
                'change' => '',
                'tone' => 'red',
            ],
            [
                'label' => 'Reservations',
                'value' => $reservationCount,
                'change' => '',
                'tone' => 'purple',
            ],
        ];

        // Empty for now
        // Later we can get real reservations from database
        $recentReservations = collect();

        // Get locations with available locker count
        $nearbyLocations = Location::withCount([
            'lockers as available_lockers_count' => function ($query) {
                $query->where('status', 'available');
            }
        ])
        ->take(5)
        ->get();

        return view('dashboard.index', compact(
            'locationCount',
            'stats',
            'recentReservations',
            'nearbyLocations'
        ));
    }
}