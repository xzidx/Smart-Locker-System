<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function index()
        {
            $lockers = Locker::with('location')
                ->paginate(10);

            $locations = Location::orderBy('name')->get();

            $totalLockers = Locker::count();

            $availableLockers = Locker::where('status', 'available')->count();

            $occupiedLockers = Locker::where('status', 'occupied')->count();

            $reservedLockers = Locker::where('status', 'reserved')->count();

            $maintenanceLockers = Locker::where('status', 'maintenance')->count();

            return view('lockers.index', compact(
                'lockers',
                'locations',
                'totalLockers',
                'availableLockers',
                'occupiedLockers',
                'reservedLockers',
                'maintenanceLockers'
            ));
        }

    public function create()
    {
        $locations = Location::all();

        return view('lockers.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|string|max:30',
            'location_id' => 'required|exists:locations,id',
        ]);

        Locker::create($request->all());

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker created successfully.');
    }

    public function show(Locker $locker)
    {
        $locker->load('location', 'usages', 'maintenances');

           $location = $locker->location;

        return view('lockers.locker_detail', compact('locker', 'location'));
    }

    public function edit(Locker $locker)
    {
        $locations = Location::all();

        return view('lockers.edit', compact('locker', 'locations'));
    }

    public function update(Request $request, Locker $locker)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|string|max:30',
            'location_id' => 'required|exists:locations,id',
        ]);

        $locker->update($request->all());

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker updated successfully.');
    }

    public function destroy(Locker $locker)
    {
        $locker->delete();

        return redirect()
            ->route('lockers.index')
            ->with('success', 'Locker deleted successfully.');
    }
}