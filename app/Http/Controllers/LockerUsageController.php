<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\LockerUsage;
use App\Models\User;
use Illuminate\Http\Request;

class LockerUsageController extends Controller
{
    public function index()
    {
        $usages = LockerUsage::with('user', 'locker')->get();

        return view('locker_usage.index', compact('usages'));
    }

    public function create()
    {
        $users = User::all();
        $lockers = Locker::all();

        return view('locker_usage.create', compact('users', 'lockers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'locker_id' => 'required|exists:lockers,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|max:30',
        ]);

        LockerUsage::create($request->all());

        return redirect()->route('locker_usage.index');
    }

    public function show(LockerUsage $lockerUsage)
    {
        $lockerUsage->load('user', 'locker');

        return view('locker_usage.show', compact('lockerUsage'));
    }

    public function edit(LockerUsage $lockerUsage)
    {
        $users = User::all();
        $lockers = Locker::all();

        return view('locker_usage.edit', compact(
            'lockerUsage',
            'users',
            'lockers'
        ));
    }

    public function update(Request $request, LockerUsage $lockerUsage)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'locker_id' => 'required|exists:lockers,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'status' => 'required|max:30',
        ]);

        $lockerUsage->update($request->all());

        return redirect()->route('locker-usage.index');
    }

    public function destroy(LockerUsage $lockerUsage)
    {
        $lockerUsage->delete();

        return redirect()->route('locker-usage.index');
    }
}