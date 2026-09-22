<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $locationCount = 4;

        $stats = [
            [
                'label' => 'Available Lockers',
                'value' => 24,
                'change' => '+12%',
                'tone' => 'green',
            ],
            [
                'label' => 'Total Lockers',
                'value' => 50,
                'change' => '+5%',
                'tone' => 'blue',
            ],
            [
                'label' => 'Reservations',
                'value' => 18,
                'change' => '+8%',
                'tone' => 'orange',
            ],
            [
                'label' => 'Locations',
                'value' => 4,
                'change' => '+2%',
                'tone' => 'purple',
            ],
        ];

        $recentReservations = [];

        $nearbyLocations = [];

        return view('dashboard.index', compact(
            'locationCount',
            'stats',
            'recentReservations',
            'nearbyLocations'
        ));
    }
}