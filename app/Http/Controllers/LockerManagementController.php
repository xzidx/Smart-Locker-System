<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\Location;
use Illuminate\Http\Request;

class LockerManagementController extends Controller
{
    /**
     * Display all lockers.
     */
    public function index(Request $request)
    {
        $lockers = Locker::with('location')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('location', function ($locationQuery) use ($search) {
                        $locationQuery->where('name', 'like', "%{$search}%");
                    });
            })
            ->when(
                $request->filled('status') && $request->status !== 'all',
                fn ($query) => $query->where('status', $request->status)
            )
            ->latest('id')
            ->paginate(8)
            ->withQueryString();

        return view(
            'locker_management.index',
            compact('lockers')
        );
    }

    /**
     * Show create locker form.
     */
    public function create(Request $request)
    {
        $locations = Location::orderBy('name')->get();

        $location = null;

        if ($request->filled('location_id')) {
            $location = Location::findOrFail($request->location_id);
        }

        return view(
            'locker_management.create',
            compact('locations', 'location')
        );
    }

    /**
     * Store locker.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'location_id' => ['required', 'exists:locations,id'],
            'status' => ['required', 'in:available,occupied,maintenance'],
        ]);

        $locker = Locker::create($validated);

        return redirect()
            ->route('locations-management.show', $locker->location_id)
            ->with('success', 'Locker created successfully.');
    }

    /**
     * Display locker.
     */
    public function show(Locker $locker)
    {
        $locker->load([
            'location',
            'usages',
            'maintenances',
        ]);

        return view(
            'locker_management.show',
            compact('locker')
        );
    }

    /**
     * Show edit locker form.
     */
    public function edit(Locker $locker)
    {
        $locations = Location::orderBy('name')->get();

        return view(
            'locker_management.edit',
            compact('locker', 'locations')
        );
    }

    /**
     * Update locker.
     */
    public function update(Request $request, Locker $locker)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'location_id' => ['required', 'exists:locations,id'],
            'status' => ['required', 'in:available,occupied,maintenance'],
        ]);

        $locker->update($validated);

        return redirect()
            ->route('locker-management.index')
            ->with('success', 'Locker updated successfully.');
    }

    /**
     * Delete locker.
     */
    public function destroy(Locker $locker)
    {
        $locationId = $locker->location_id;

        $locker->delete();

        return redirect()
            ->route('locations-management.show', $locationId)
            ->with('success', 'Locker deleted successfully.');
    }
}