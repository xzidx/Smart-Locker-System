<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LocationsManagementController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::query()
            ->withCount($this->counts())
            ->when($request->input('search'), function ($q, $term) {
                $like = '%' . strtolower($term) . '%';
                $q->where(function ($q) use ($like) {
                    $q->whereRaw('LOWER(name) LIKE ?', [$like])
                      ->orWhereRaw('LOWER(address) LIKE ?', [$like]);
                });
            })
            ->when($request->input('building'), fn ($q, $b) => $q->where('building', $b))
            ->when($request->input('status') === 'active', fn ($q) =>
                $q->whereHas('lockers', fn ($l) => $l->where('status', '!=', 'maintenance')))
            ->when($request->input('status') === 'inactive', fn ($q) =>
                $q->whereDoesntHave('lockers', fn ($l) => $l->where('status', '!=', 'maintenance')))
            ->latest('id')
            ->paginate(6)
            ->withQueryString();

        $buildings = Location::query()->select('building')->distinct()->orderBy('building')->pluck('building');

        return view('locations_management.index', compact('locations', 'buildings'));
    }

    public function create()
    {
        return view('locations_management.create');
    }

    public function store(Request $request)
    {
        Location::create($this->validated($request));

        return redirect()->route('locations-management.index')->with('success', 'Location created.');
    }

    public function show(Location $location)
    {
        $location->loadCount($this->counts());

        return view('locations_management.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('locations_management.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $location->update($this->validated($request));

        return redirect()->route('locations-management.index')->with('success', 'Location updated.');
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();
        } catch (QueryException $e) {
            return redirect()->route('locations-management.index')
                ->with('error', 'Cannot delete this location because it still has lockers.');
        }

        return redirect()->route('locations-management.index')->with('success', 'Location deleted.');
    }

    private function counts(): array
    {
        return [
            'lockers as total_lockers',
            'lockers as available_count'   => fn ($q) => $q->where('status', 'available'),
            'lockers as occupied_count'    => fn ($q) => $q->where('status', 'occupied'),
            'lockers as maintenance_count' => fn ($q) => $q->where('status', 'maintenance'),
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'address'  => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:100'],
            'floor'    => ['required', 'string', 'max:50'],
        ]);
    }
}