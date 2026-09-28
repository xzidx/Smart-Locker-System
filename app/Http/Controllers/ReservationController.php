<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Locker;

class ReservationController extends Controller
{
    public function checkout($lockerId)
    {
        $locker = Locker::findOrFail($lockerId);

        $location = Location::findOrFail($locker->location_id);

        $user = auth()->user();

        return view('reservation.reservation_checkout', compact(
            'locker',
            'location',
            'user'
        ));
    }
}
