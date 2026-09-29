<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{


    public function staffIndex()
    {
        $locations = Location::withCount('lockers')->get();

        return view('locker_maintenance.index', compact('locations'));
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $locations = Location::withCount('lockers')
            ->withCount([
                'lockers as available_count' => function ($query) {
                    $query->where('status', 'available');
                }
            ])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'ILIKE', "%{$search}%")
                        ->orWhere('address', 'ILIKE', "%{$search}%")
                        ->orWhere('building', 'ILIKE', "%{$search}%")
                        ->orWhere('floor', 'ILIKE', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(4)
            ->withQueryString();

        return view('locations.index', compact('locations', 'search'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        Location::create($validated);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    public function show(Location $location)
    {
        $location->load('lockers');

        return view('locations.details', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'building' => 'required|string|max:100',
            'floor' => 'required|string|max:50',
        ]);

        $location->update($validated);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }
    
}