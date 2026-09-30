<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use App\Models\LockerMaintenance;
use Illuminate\Http\Request;

class LockerMaintenanceController extends Controller
{
    /**
     * Display maintenance requests.
     */
    public function index(Request $request)
    {
        $query = LockerMaintenance::with([
            'locker.location'
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('issue', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('locker', function ($lockerQuery) use ($search) {

                        $lockerQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    });

            });
        }

        // Status filter
        if (
            $request->filled('status') &&
            $request->status !== 'all'
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        $maintenances = $query
            ->latest()
            ->paginate(8)
            ->withQueryString();

        // Statistics
        $openIssues = LockerMaintenance::where(
            'status',
            'Open'
        )->count();

        $inProgress = LockerMaintenance::where(
            'status',
            'In Progress'
        )->count();

        $completedThisMonth = LockerMaintenance::where(
            'status',
            'Completed'
        )
            ->whereMonth(
                'created_at',
                now()->month
            )
            ->whereYear(
                'created_at',
                now()->year
            )
            ->count();

        $criticalIssues = 0;

        $lockers = Locker::with('location')->get();

        return view(
            'locker_maintenance.index',
            compact(
                'maintenances',
                'openIssues',
                'inProgress',
                'completedThisMonth',
                'criticalIssues',
                'lockers'
            )
        );
    }


    /**
     * Show create maintenance form.
     */
    public function create(Request $request)
    {
        // Get the locker selected from the Report Maintenance button
        $locker = Locker::with('location')
            ->findOrFail($request->locker_id);

        // Also load all lockers because the current
        // create.blade.php still contains the locker dropdown.
        $lockers = Locker::with('location')->get();

        return view(
            'locker_maintenance.create',
            compact(
                'locker',
                'lockers'
            )
        );
    }


    /**
     * Store maintenance request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|max:30',
        ]);

        $maintenance = LockerMaintenance::create($validated);

        // If maintenance starts immediately,
        // change locker status to maintenance.
        if ($maintenance->status === 'In Progress') {

            $maintenance->locker->update([
                'status' => 'maintenance'
            ]);
        }

        return redirect()
            ->route('locker_maintenance.index')
            ->with(
                'success',
                'Maintenance ticket created successfully.'
            );
    }


    /**
     * Display maintenance request.
     */
    public function show(
        LockerMaintenance $lockerMaintenance
    ) {
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
    public function edit(
        LockerMaintenance $lockerMaintenance
    ) {
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
     * Update maintenance request.
     */
    public function update(
        Request $request,
        LockerMaintenance $lockerMaintenance
    ) {
        $validated = $request->validate([
            'locker_id' => 'required|exists:lockers,id',
            'issue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|string|max:30',
        ]);

        $lockerMaintenance->update($validated);

        $locker = $lockerMaintenance->locker;

        // In Progress = Under Maintenance
        if ($lockerMaintenance->status === 'In Progress') {

            $locker->update([
                'status' => 'maintenance'
            ]);
        }

        // Completed = Available
        elseif ($lockerMaintenance->status === 'Completed') {

            $locker->update([
                'status' => 'available'
            ]);
        }

        return redirect()
            ->route('locker_maintenance.index')
            ->with(
                'success',
                'Maintenance ticket updated successfully.'
            );
    }


    /**
     * Delete maintenance request.
     */
    public function destroy(
        LockerMaintenance $lockerMaintenance
    ) {
        $locker = $lockerMaintenance->locker;

        $lockerMaintenance->delete();

        if ($locker) {

            $hasActiveMaintenance = LockerMaintenance::where(
                'locker_id',
                $locker->id
            )
                ->whereIn(
                    'status',
                    ['Open', 'In Progress']
                )
                ->exists();

            if (!$hasActiveMaintenance) {

                $locker->update([
                    'status' => 'available'
                ]);
            }
        }

        return redirect()
            ->route('locker_maintenance.index')
            ->with(
                'success',
                'Maintenance ticket deleted successfully.'
            );
    }
}