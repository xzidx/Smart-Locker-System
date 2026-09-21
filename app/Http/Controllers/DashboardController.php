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
                'icon' => 'fa-lock',
            ],
            [
                'label' => 'Total Lockers',
                'value' => 50,
                'change' => '+5%',
                'tone' => 'blue',
                'icon' => 'fa-box',
            ],
            [
                'label' => 'Reservations',
                'value' => 18,
                'change' => '+8%',
                'tone' => 'orange',
                'icon' => 'fa-calendar-check',
            ],
            [
                'label' => 'Locations',
                'value' => 4,
                'change' => '+2%',
                'tone' => 'purple',
                'icon' => 'fa-location-dot',
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