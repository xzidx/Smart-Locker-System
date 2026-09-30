@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard overview')

@section('page-description', 'Live system summary')

@section('content')

    <div class="p-8 space-y-6">

        <!-- ========================================================= -->
        <!-- TOP BANNER -->
        <!-- ========================================================= -->

        <div class="bg-[#0b1329] text-white p-6 rounded-2xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4 shadow-lg">

            <div>

                <h1 class="text-xl font-bold">
                    Hi! {{ auth()->user()->name }}
                </h1>

                <p class="text-slate-400 text-sm mt-1">
                    All systems are operational.
                    {{ $activeBookings }} active bookings across
                    {{ $locationCount }} locations.
                </p>

            </div>

            <button
                class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center gap-2 shadow-sm"
            >
                <i class="fa-solid fa-file-lines"></i>
                View system report
            </button>

        </div>


        <!-- ========================================================= -->
        <!-- 4 METRIC CARDS -->
        <!-- ========================================================= -->

        @php
            $availableFleetPercentage = $totalLockers > 0
                ? round(($availableLockers / $totalLockers) * 100)
                : 0;

            $occupiedFleetPercentage = $totalLockers > 0
                ? round(($occupiedLockers / $totalLockers) * 100)
                : 0;
        @endphp


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


            <!-- Total Users -->

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">

                <div class="flex justify-between items-start text-slate-500 text-sm">

                    Total Users

                    <span class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                        <i class="fa-solid fa-users"></i>
                    </span>

                </div>

                <div class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $totalUsers }}
                </div>

                <div class="text-xs text-blue-600 font-semibold mt-2">
                    Registered users
                </div>

            </div>


            <!-- Available Lockers -->

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">

                <div class="flex justify-between items-start text-slate-500 text-sm">

                    Available Lockers

                    <span class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                        <i class="fa-solid fa-lock-open"></i>
                    </span>

                </div>

                <div class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $availableLockers }}
                </div>

                <div class="text-xs text-emerald-600 font-semibold mt-2">
                    {{ $availableFleetPercentage }}% of fleet
                </div>

            </div>


            <!-- Occupied Lockers -->

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">

                <div class="flex justify-between items-start text-slate-500 text-sm">

                    Occupied Lockers

                    <span class="p-2.5 bg-rose-50 text-rose-600 rounded-xl">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                </div>

                <div class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $occupiedLockers }}
                </div>

                <div class="text-xs text-rose-600 font-semibold mt-2">
                    {{ $occupiedFleetPercentage }}% of fleet
                </div>

            </div>


            <!-- Maintenance Requests -->

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">

                <div class="flex justify-between items-start text-slate-500 text-sm">

                    Maintenance Requests

                    <span class="p-2.5 bg-purple-50 text-purple-600 rounded-xl">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </span>

                </div>

                <div class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $maintenanceRequests }}
                </div>

                <div class="text-xs text-purple-600 font-semibold mt-2">
                    Total requests
                </div>

            </div>

        </div>



        <!-- ========================================================= -->
        <!-- MIDDLE SECTION -->
        <!-- ========================================================= -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <!-- ===================================================== -->
            <!-- LOCKER USAGE -->
            <!-- ===================================================== -->

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | Locker Usage Percentages
                    |--------------------------------------------------------------------------
                    */

                    $totalLockersForChart =
                        $availableLockers +
                        $occupiedLockers +
                        $reservedLockers +
                        $maintenanceLockers;

                    $availablePercentage = $totalLockersForChart > 0
                        ? ($availableLockers / $totalLockersForChart) * 100
                        : 0;

                    $occupiedPercentage = $totalLockersForChart > 0
                        ? ($occupiedLockers / $totalLockersForChart) * 100
                        : 0;

                    $reservedPercentage = $totalLockersForChart > 0
                        ? ($reservedLockers / $totalLockersForChart) * 100
                        : 0;

                    $maintenancePercentage = $totalLockersForChart > 0
                        ? ($maintenanceLockers / $totalLockersForChart) * 100
                        : 0;

                @endphp


                <div>

                    <div class="flex justify-between items-center mb-1">

                        <h2 class="font-bold text-slate-800">
                            Locker usage
                        </h2>

                        <span class="text-xs text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                            Today
                            <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i>
                        </span>

                    </div>


                    <p class="text-xs text-slate-400 mb-6">
                        Fleet status across all locations
                    </p>


                    <!-- Status Bar -->

                    <div class="flex h-3 w-full rounded-full overflow-hidden gap-1 mb-6 bg-slate-100">


                        @if ($availablePercentage > 0)

                            <div
                                class="bg-emerald-500 rounded-l-full"
                                style="width: {{ $availablePercentage }}%"
                                title="Available"
                            ></div>

                        @endif


                        @if ($occupiedPercentage > 0)

                            <div
                                class="bg-rose-500"
                                style="width: {{ $occupiedPercentage }}%"
                                title="Occupied"
                            ></div>

                        @endif


                        @if ($reservedPercentage > 0)

                            <div
                                class="bg-blue-500"
                                style="width: {{ $reservedPercentage }}%"
                                title="Reserved"
                            ></div>

                        @endif


                        @if ($maintenancePercentage > 0)

                            <div
                                class="bg-amber-500 rounded-r-full"
                                style="width: {{ $maintenancePercentage }}%"
                                title="Maintenance"
                            ></div>

                        @endif

                    </div>

                </div>



                <!-- Legend -->

                <div class="grid grid-cols-2 gap-y-3 text-sm pt-4 border-t border-slate-100">


                    <!-- Available -->

                    <div class="flex items-center gap-2.5 text-slate-600">

                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>

                        Available

                        <span class="ml-auto font-bold text-slate-900">
                            {{ $availableLockers }}
                        </span>

                    </div>


                    <!-- Occupied -->

                    <div class="flex items-center gap-2.5 text-slate-600">

                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>

                        Occupied

                        <span class="ml-auto font-bold text-slate-900">
                            {{ $occupiedLockers }}
                        </span>

                    </div>


                    <!-- Reserved -->

                    <div class="flex items-center gap-2.5 text-slate-600">

                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>

                        Reserved

                        <span class="ml-auto font-bold text-slate-900">
                            {{ $reservedLockers }}
                        </span>

                    </div>


                    <!-- Maintenance -->

                    <div class="flex items-center gap-2.5 text-slate-600">

                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>

                        Maintenance

                        <span class="ml-auto font-bold text-slate-900">
                            {{ $maintenanceLockers }}
                        </span>

                    </div>

                </div>

            </div>



            <!-- ===================================================== -->
            <!-- LOCATION ACTIVITY -->
            <!-- ===================================================== -->

            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">

                <div>

                    <div class="flex justify-between items-center mb-6">

                        <h2 class="font-bold text-slate-800">
                            Location activity
                        </h2>

                        <a
                            href="{{ route('locations.index') }}"
                            class="text-xs text-blue-600 font-semibold hover:underline"
                        >
                            View all locations
                        </a>

                    </div>


                    <div class="space-y-4">


                        @forelse ($locations as $location)

                            @php

                                $total = $location->lockers_count;

                                $occupied = $location->occupied_lockers_count;

                                $usagePercentage = $total > 0
                                    ? round(($occupied / $total) * 100)
                                    : 0;

                            @endphp


                            <!-- Location Item -->

                            <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 last:border-0 last:pb-0">

                                <div class="flex items-center gap-3">

                                    <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>


                                    <div>

                                        <h4 class="text-sm font-bold text-slate-800">
                                            {{ $location->name }}
                                        </h4>

                                        <p class="text-xs text-slate-400">
                                            {{ $occupied }} / {{ $total }} lockers in use
                                        </p>

                                    </div>

                                </div>


                                <span class="text-sm font-bold text-slate-900">
                                    {{ $usagePercentage }}%
                                </span>

                            </div>


                        @empty

                            <div class="text-center py-6">

                                <p class="text-sm text-slate-400">
                                    No locations available.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>



        <!-- ========================================================= -->
        <!-- PENDING RESERVATIONS -->
        <!-- ========================================================= -->

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">


            <!-- Header -->

            <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">

                <div>

                    <h3 class="font-bold text-slate-800">
                        Pending Reservations
                    </h3>

                    <p class="text-xs text-slate-400">
                        Reservations waiting for staff approval
                    </p>

                </div>


                <span class="text-xs font-semibold px-3.5 py-2 rounded-xl bg-yellow-50 text-yellow-600 border border-yellow-100">

                    {{ $pendingReservations->count() }} Pending

                </span>

            </div>



            <!-- Table -->

            <div class="overflow-x-auto">


                @if ($pendingReservations->count() > 0)

                    <table class="w-full text-left border-collapse">


                        <thead>

                            <tr class="text-slate-400 text-xs border-b border-slate-100 bg-slate-50/50">

                                <th class="p-4 font-medium">
                                    Reservation ID
                                </th>

                                <th class="p-4 font-medium">
                                    User
                                </th>

                                <th class="p-4 font-medium">
                                    Locker
                                </th>

                                <th class="p-4 font-medium">
                                    Location
                                </th>

                                <th class="p-4 font-medium">
                                    Status
                                </th>

                                <th class="p-4 font-medium text-right">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="text-sm divide-y divide-slate-100 text-slate-700">


                            @foreach ($pendingReservations as $reservation)

                                <tr class="hover:bg-slate-50/50 transition">


                                    <!-- Reservation ID -->

                                    <td class="p-4 font-semibold text-blue-600">
                                        #{{ $reservation->id }}
                                    </td>


                                    <!-- User -->

                                    <td class="p-4">
                                        {{ $reservation->user->name ?? $reservation->name }}
                                    </td>


                                    <!-- Locker -->

                                    <td class="p-4">
                                        {{ $reservation->locker->name ?? '-' }}
                                    </td>


                                    <!-- Location -->

                                    <td class="p-4">
                                        {{ $reservation->locker->location->name ?? '-' }}
                                    </td>


                                    <!-- Status -->

                                    <td class="p-4">

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-600">

                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>

                                            Pending

                                        </span>

                                    </td>


                                    <!-- Actions -->

                                    <td class="p-4">

                                        <div class="flex items-center justify-end gap-2">


                                            <!-- Approve -->

                                            <form
                                                action="{{ route('reservation.approve', $reservation->id) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 text-xs font-semibold transition"
                                                >

                                                    <i class="fa-solid fa-check mr-1"></i>

                                                    Approve

                                                </button>

                                            </form>



                                            <!-- Reject -->

                                            <form
                                                action="{{ route('reservation.reject', $reservation->id) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold transition"
                                                >

                                                    <i class="fa-solid fa-xmark mr-1"></i>

                                                    Reject

                                                </button>

                                            </form>


                                        </div>

                                    </td>


                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                @else


                    <!-- Empty State -->

                    <div class="p-8 text-center">

                        <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-green-50 text-green-500 flex items-center justify-center">

                            <i class="fa-solid fa-check"></i>

                        </div>


                        <h4 class="text-sm font-semibold text-slate-700">
                            No pending reservations
                        </h4>


                        <p class="text-xs text-slate-400 mt-1">
                            All reservation requests have been processed.
                        </p>

                    </div>


                @endif

            </div>

        </div>

    </div>

@endsection