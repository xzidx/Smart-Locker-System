<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Locker;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\LockerMaintenance;

class StaffDashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        // Count registered normal users
        $totalUsers = User::where('role', 'user')->count();


        /*
        |--------------------------------------------------------------------------
        | Locker Statistics
        |--------------------------------------------------------------------------
        */

        $totalLockers = Locker::count();

        $availableLockers = Locker::where('status', 'available')->count();

        $occupiedLockers = Locker::where('status', 'occupied')->count();


        /*
        |--------------------------------------------------------------------------
        | Reservations
        |--------------------------------------------------------------------------
        */

        // Pending reservations waiting for staff approval
        $pendingReservations = Reservation::with([
            'user',
            'locker.location'
        ])
        ->where('status', 'pending')
        ->latest()
        ->get();

        // Count lockers that currently have pending reservations
        $reservedLockers = Reservation::where('status', 'pending')
            ->distinct('locker_id')
            ->count('locker_id');


        // Active bookings
        $activeBookings = Reservation::where('status', 'confirmed')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Maintenance
        |--------------------------------------------------------------------------
        */

        // Total maintenance requests
        $maintenanceRequests = LockerMaintenance::count();

        // Count lockers currently marked as maintenance
        $maintenanceLockers = Locker::where('status', 'maintenance')->count();


        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $locationCount = Location::count();

        $locations = Location::withCount([
            'lockers',

            'lockers as occupied_lockers_count' => function ($query) {
                $query->where('status', 'occupied');
            },

            'lockers as available_lockers_count' => function ($query) {
                $query->where('status', 'available');
            },

            'lockers as reserved_lockers_count' => function ($query) {
                $query->where('status', 'reserved');
            },

            'lockers as maintenance_lockers_count' => function ($query) {
                $query->where('status', 'maintenance');
            },

        ])
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Staff Dashboard
        |--------------------------------------------------------------------------
        */

        return view('dashboard.staff', compact(
            'totalUsers',
            'totalLockers',
            'availableLockers',
            'occupiedLockers',
            'reservedLockers',
            'maintenanceLockers',
            'maintenanceRequests',
            'activeBookings',
            'locationCount',
            'locations',
            'pendingReservations'
        ));
    }
}