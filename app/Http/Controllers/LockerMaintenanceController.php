<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockerMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = LockerMaintenance::with('locker')->get();

        return view('locker-maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $lockers = Locker::all();

        return view(
            'locker-maintenance.create',
            compact('lockers')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|max:30',
        ]);

        LockerMaintenance::create($request->all());

        return redirect()->route('locker-maintenance.index');
    }

    public function show(LockerMaintenance $lockerMaintenance)
    {
        $lockerMaintenance->load('locker');

        return view(
            'locker-maintenance.show',
            compact('lockerMaintenance')
        );
    }

    public function edit(LockerMaintenance $lockerMaintenance)
    {
        $lockers = Locker::all();

        return view(
            'locker-maintenance.edit',
            compact('lockerMaintenance', 'lockers')
        );
    }

    public function update(
        Request $request,
        LockerMaintenance $lockerMaintenance
    ) {
        $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|max:30',
        ]);

        $lockerMaintenance->update($request->all());

        return redirect()->route('locker-maintenance.index');
    }

    public function destroy(LockerMaintenance $lockerMaintenance)
    {
        $lockerMaintenance->delete();

        return redirect()->route('locker-maintenance.index');
    }
}
