<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\LockerMaintenance;
use Illuminate\Http\Request;

class LockerMaintenanceController extends Controller
{
    /**
     * Display maintenance tickets.
     */
    public function index(Request $request)
    {
        $query = LockerMaintenance::with([
            'locker.location'
        ]);

        // Search by locker or issue
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('issue', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('locker', function ($lockerQuery) use ($search) {
                        $lockerQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $maintenances = $query
            ->latest()
            ->paginate(8)
            ->withQueryString();

        // Statistics
        $openIssues = LockerMaintenance::where('status', 'Open')->count();

        $inProgress = LockerMaintenance::where('status', 'In Progress')->count();

        $completedThisMonth = LockerMaintenance::where('status', 'Completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $criticalIssues = 0;

        $lockers = Locker::with('location')->get();

        return view('locker_maintenance.index', compact(
            'maintenances',
            'openIssues',
            'inProgress',
            'completedThisMonth',
            'criticalIssues',
            'lockers'
        ));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $lockers = Locker::with('location')->get();

        return view(
            'locker_maintenance.create',
            compact('lockers')
        );
    }


    /**
     * Store new maintenance ticket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|max:30',
        ]);

        LockerMaintenance::create($validated);

        return redirect()
            ->route('locker_maintenance.index')
            ->with('success', 'Maintenance ticket created successfully.');
    }


    /**
     * Show maintenance ticket.
     */
    public function show(LockerMaintenance $lockerMaintenance)
    {
        $lockerMaintenance->load([
            'locker.location'
        ]);

        return view(
            'locker_maintenance.show',
            compact('lockerMaintenance')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(LockerMaintenance $lockerMaintenance)
    {
        $lockers = Locker::with('location')->get();

        return view(
            'locker_maintenance.edit',
            compact(
                'lockerMaintenance',
                'lockers'
            )
        );
    }


    /**
     * Update maintenance ticket.
     */
    public function update(
        Request $request,
        LockerMaintenance $lockerMaintenance
    ) {
        $validated = $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|max:30',
        ]);

        $lockerMaintenance->update($validated);

        return redirect()
            ->route('locker_maintenance.index')
            ->with('success', 'Maintenance ticket updated successfully.');
    }


    /**
     * Delete maintenance ticket.
     */
    public function destroy(LockerMaintenance $lockerMaintenance)
    {
        $lockerMaintenance->delete();

        return redirect()
            ->route('locker_maintenance.index')
            ->with('success', 'Maintenance ticket deleted successfully.');
    }
}