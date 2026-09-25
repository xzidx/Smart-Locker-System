```blade
@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard overview')

@section('page-description', 'Live system summary')

@section('content')

    <div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 px-4 py-8 sm:px-8">

        <div class="mx-auto max-w-6xl space-y-8">

            {{-- =========================================================
                HEADER
            ========================================================== --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <p class="text-xs font-semibold tracking-widest text-blue-600">
                        GOOD MORNING, {{ strtoupper(auth()->user()?->name ?? 'THERE') }}
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        Find a locker nearby
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Live availability across
                        <span class="font-medium text-slate-700">
                            {{ $locationCount }}
                        </span>
                        secure locations.
                    </p>

                </div>


                {{-- SYSTEM STATUS --}}
                <div class="hidden sm:block">

                    <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-medium text-slate-500 shadow-sm">

                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                        All systems operational

                    </div>

                </div>

            </div>


            {{-- =========================================================
                SEARCH
            ========================================================== --}}
            <div class="">

                <x-dashboard.search-bar
                    :action="route('dashboard')"
                />

            </div>


            {{-- =========================================================
                STAT CARDS
            ========================================================== --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                {{-- TOTAL USERS --}}
                <x-dashboard.stat-card
                    :label="$stats[0]['label']"
                    :value="$stats[0]['value']"
                    :change="$stats[0]['change']"
                    :tone="$stats[0]['tone']"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="#2563eb"
                            d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"
                        />
                    </svg>

                </x-dashboard.stat-card>


                {{-- AVAILABLE LOCKERS --}}
                <x-dashboard.stat-card
                    :label="$stats[1]['label']"
                    :value="$stats[1]['value']"
                    :change="$stats[1]['change']"
                    :tone="$stats[1]['tone']"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                    >
                        <g
                            fill="none"
                            stroke="#15803d"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                        >
                            <path d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h4"/>

                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V8m.719-3.289A4 4 0 0 1 16 7v4M3 3l18 18"/>
                        </g>
                    </svg>

                </x-dashboard.stat-card>


                {{-- OCCUPIED LOCKERS --}}
                <x-dashboard.stat-card
                    :label="$stats[2]['label']"
                    :value="$stats[2]['value']"
                    :change="$stats[2]['change']"
                    :tone="$stats[2]['tone']"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 15 15"
                    >
                        <path
                            fill="#dc2626"
                            d="M14 1.5v12c0 .28-.22.5-.5.5h-12c-.28 0-.5-.22-.5-.5v-12c0-.28.22-.5.5-.5h12c.28 0 .5.22.5.5M13 5h-3v3h3zm-2 4h-1v1h1zm2 0h-1v1h1zM2 5v2h3V5zm0 3v2h3V8zm0 3v2h3v-2zm4 0v2h3v-2zm0-3v2h3V8zm0-3v2h3V5zm0-3v2h3V2zM5 2H2v2h3z"
                        />
                    </svg>

                </x-dashboard.stat-card>


                {{-- RESERVATIONS --}}
                <x-dashboard.stat-card
                    :label="$stats[3]['label']"
                    :value="$stats[3]['value']"
                    :change="$stats[3]['change']"
                    :tone="$stats[3]['tone']"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="#7c3aed"
                            d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 16H5V9h14z"
                        />
                    </svg>

                </x-dashboard.stat-card>

            </div>


            {{-- =========================================================
                RECENT RESERVATIONS
                FULL WIDTH / BLOCK
            ========================================================== --}}
            <div class="block">

                <div class="mb-3 flex items-center justify-between">

                    <h2 class="text-sm font-semibold text-slate-900">
                        Recent reservations
                    </h2>

                    <a
                        href="{{ route('reservations.index') }}"
                        class="text-xs font-medium text-blue-600 transition hover:text-blue-700"
                    >
                        View all &rarr;
                    </a>

                </div>


                <div class="overflow-hidden rounded-[20px] border border-slate-200 bg-white shadow-sm">

                    @forelse ($recentReservations as $reservation)

                        <x-dashboard.reservation-item
                            :title="$reservation->locker->location->name . ' · Locker ' . $reservation->locker->name"
                            :time="$reservation->time_range_label"
                            :status="ucfirst($reservation->status)"
                            :last="$loop->last"
                        />

                    @empty

                        <div class="flex flex-col items-center justify-center px-4 py-12 text-center">

                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="#94a3b8"
                                    stroke-width="1.5"
                                >
                                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 16H5V9h14z"/>
                                </svg>

                            </div>

                            <p class="text-sm font-medium text-slate-500">
                                No reservations yet
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Reserve a locker to see it appear here.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- =========================================================
                NEARBY LOCATIONS
                FULL WIDTH / BLOCK
            ========================================================== --}}
            <div class="block">

                <div class="mb-3 flex items-center justify-between">

                    <h2 class="text-sm font-semibold text-slate-900">
                        Nearby locations
                    </h2>

                    <a
                        href="{{ route('locations.index') }}"
                        class="text-xs font-medium text-blue-600 transition hover:text-blue-700"
                    >
                        View all &rarr;
                    </a>

                </div>


                <div class="space-y-3">

                    @forelse ($nearbyLocations as $location)

                        <a
                            href="{{ route('locations.find-locker', $location->id) }}"
                            class="block rounded-[20px] transition duration-200 hover:-translate-y-0.5 hover:shadow-md"
                        >

                            <x-dashboard.location-card
                                :name="$location->name"
                                :address="$location->address"
                                :hours="$location->hours_label"
                                :available="$location->available_lockers_count"
                            />

                        </a>

                    @empty

                        <div class="rounded-[20px] border border-dashed border-slate-200 bg-white px-4 py-10 text-center">

                            <p class="text-sm text-slate-400">
                                No locations found.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

@endsection
