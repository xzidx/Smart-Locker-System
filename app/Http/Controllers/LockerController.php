<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerController extends Controller
{
    public function index()
    {
        // Logic to retrieve and return locker data
        $lockers = Locker::with('location')->get();

        return view('lockers.index', compact('lockers'));
    }

    public function create()
    {
        // Logic to show a form for creating a new locker
        $locations = Location::all();

        return view('lockers.create', compact('locations'));
    }

    public function store(Request $request)
    {
        // Logic to store a new locker record
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|string|max:30',
            'location_id' => 'required|exists:locations,id',
        ]);

        Locker::create($request->all());

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker created successfully.');
    }

    public function show(Locker $locker)
    {
         $locker->load('location', 'usages', 'maintenances');
        // Logic to retrieve and return a specific locker record
        return view('lockers.show', compact('locker'));
    }

    public function edit(Locker $locker)
    {
        // Logic to show a form for editing a specific locker record
        $locations = Location::all();

        return view('lockers.edit', compact('locker', 'locations'));
    }

    public function update(Request $request, Locker $locker)
    {
        // Logic to update a specific locker record
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|string|max:30',
            'location_id' => 'required|exists:locations,id',
        ]);

        $locker->update($request->all());

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker updated successfully.');
    }

    public function destroy(Locker $locker)
    {
        // Logic to delete a specific locker record
        $locker->delete();

        return redirect()->route('lockers.index')
                         ->with('success', 'Locker deleted successfully.');
    }
}
