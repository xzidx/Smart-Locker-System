<?php

namespace App\Http\Controllers;

use App\Models\LockerUsage;

class ActiveLockerController extends Controller
{
    public function index()
    {
        $activeLocker = LockerUsage::with(['locker.location', 'user'])
            ->latest('start_time')
            ->first();

        if (!$activeLocker) {
            return redirect('/reservation')->with('error', 'No active locker found.');
        }

        return view('reservation.active_locker', compact('activeLocker'));
    }
}