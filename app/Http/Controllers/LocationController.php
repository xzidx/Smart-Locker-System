<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Logic to retrieve and return locker usage data
        $locations = location::all();

        return view('locations.index', compact('locations'));

    }

    public function create()
    {
        // Logic to show a form for creating a new locker usage
        return view('locations.create');

    }

    public function store(Request $request)
    {
        // Logic to store a new locker usage record
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Location created successfully.');
    }

    public function show(location $location)
    {
        // Logic to retrieve and return a specific locker usage record

        return view('locations.show', compact('location'));
    }

    public function edit(location $location)
    {
        // Logic to show a form for editing a specific locker usage record
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, location $location)
    {
        // Logic to update a specific locker usage record
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
                         ->with('success', 'Location updated successfully.');
    }

    public function destroy(location $location)
    {
        // Logic to delete a specific locker usage record
        $location->delete();

        return redirect()->route('locations.index')
                         ->with('success', 'Location deleted successfully.');
    }
}
