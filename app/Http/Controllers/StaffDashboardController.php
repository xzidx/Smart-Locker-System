<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Locker;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        // Total registered users
        $totalUsers = User::where('role', 'user')->count();

        // Locker counts
        $availableLockers = Locker::where('status', 'available')->count();
        $occupiedLockers = Locker::where('status', 'occupied')->count();

        return view('dashboard.staff', compact(
            'totalUsers',
            'availableLockers',
            'occupiedLockers'
        ));
    }
}