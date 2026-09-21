<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Get all locations
        $locations = Location::all();

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        // Show create location page
        return view('locations.create');
    }

    public function store(Request $request)
    {
        // Validate location data
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        // Create location
        Location::create($request->all());

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    public function show(Location $location)
    {
        // Show one location
        return view('locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        // Show edit location page
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        // Validate location data
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        // Update location
        $location->update($request->all());

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        // Delete location
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }
}