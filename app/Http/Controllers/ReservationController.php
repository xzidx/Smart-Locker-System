<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Locker;
use App\Models\Reservation;
use App\Models\LockerUsage;

class ReservationController extends Controller
{
    /**
     * Show all reservations
     */
    public function index()
    {
        $reservations = Reservation::with([
            'locker',
            'location',
            'user'
        ])
        ->latest()
        ->get();

        return view(
            'reservation.index',
            compact('reservations')
        );
        
    }


    /**
     * Show reservation checkout page
     */
    public function checkout($lockerId)
    {
        $locker = Locker::findOrFail($lockerId);

        $location = Location::findOrFail(
            $locker->location_id
        );

        $user = auth()->user();

        return view(
            'reservation.reservation_checkout',
            compact(
                'locker',
                'location',
                'user'
            )
        );
    }


    /**
     * Store a new reservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'location_id' => 'required|exists:locations,id',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
        ]);

        // Get logged-in user
        $validated['user_id'] = auth()->id();

        // Set reservation status
        $validated['status'] = 'pending';

        // Create reservation
        Reservation::create($validated);

        // Redirect to reservation list
        return redirect()
            ->route('reservation.index')
            ->with(
                'success',
                'Locker reserved successfully!'
            );
    }
public function show($id)
{
    $reservation = Reservation::with([
        'user',
        'locker.location'
    ])->findOrFail($id);

    return view('reservation.active_locker', compact('reservation'));
}

public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->delete();

    return redirect()
        ->route('reservation.index')
        ->with('success', 'Locker released successfully!');
}

public function approve($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->update([
        'status' => 'confirmed',
    ]);

    return back()->with(
        'success',
        'Reservation approved successfully.'
    );
}

public function reject($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->update([
        'status' => 'cancelled',
    ]);

    return back()->with(
        'success',
        'Reservation rejected.'
    );
}
}