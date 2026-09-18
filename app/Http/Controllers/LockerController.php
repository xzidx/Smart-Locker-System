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
}
