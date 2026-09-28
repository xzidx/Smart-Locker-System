<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = LockerUsage::with(['user', 'locker.location'])->get();

        return view('reservation.index', compact('reservations'));
    }
public function show($id)
{
    $activeLocker = LockerUsage::with([
        'user',
        'locker.location'
    ])->findOrFail($id);

    return view('reservation.active_locker', compact('activeLocker'));
}
}