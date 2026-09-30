@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard overview')
@section('page-description', 'Live system summary')

@section('content')

@php
    // Safe defaults
    $locationCount = $locationCount ?? 0;
    $recentReservations = $recentReservations ?? collect();
    $nearbyLocations = $nearbyLocations ?? collect();

    $stats = $stats ?? [
        [
            'label' => 'Total Lockers',
            'value' => 0,
            'change' => '',
            'tone' => 'blue',
        ],
        [
            'label' => 'Available Lockers',
            'value' => 0,
            'change' => '',
            'tone' => 'green',
        ],
        [
            'label' => 'Occupied Lockers',
            'value' => 0,
            'change' => '',
            'tone' => 'red',
        ],
    ];

    // Greeting
    $hour = now()->hour;

    $greeting = match (true) {
        $hour < 12 => 'Good morning',
        $hour < 18 => 'Good afternoon',
        default => 'Good evening',
    };

    // First name only
    $firstName = \Illuminate\Support\Str::of(
        auth()->user()?->name ?? 'there'
    )->before(' ');
@endphp


{{-- ===================== PAGE CONTAINER ===================== --}}
<div class="min-h-full bg-gradient-to-b from-slate-50 to-slate-100 px-4 py-5 sm:px-6 sm:py-6 lg:px-8">

    <div class="mx-auto w-full max-w-7xl space-y-6">


        {{-- ===================== HEADER ===================== --}}
        <header class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

            <div class="min-w-0">

                <p class="truncate text-xs font-semibold text-blue-600 sm:text-sm">
                    {{ $greeting }}, {{ $firstName }}
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Find a locker nearby
                </h1>

                <p class="mt-1.5 text-sm text-slate-500">
                    Live availability across
                    <span class="font-semibold text-slate-700">
                        {{ $locationCount }}
                    </span>
                    secure {{ \Illuminate\Support\Str::plural('location', $locationCount) }}.
                </p>

            </div>


            {{-- System Status --}}
            <div class="flex w-fit shrink-0 items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-600 shadow-sm">

                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                </span>

                All systems operational

            </div>

        </header>


        {{-- ===================== SEARCH ===================== --}}
        <section aria-label="Search lockers">

            <x-dashboard.search-bar :action="route('dashboard')" />

        </section>


        {{-- ===================== STAT CARDS ===================== --}}
        <section
            aria-label="Locker statistics"
            class="grid grid-cols-1 gap-3 sm:grid-cols-3"
        >

            {{-- Total Lockers --}}
            <x-dashboard.stat-card
                :label="$stats[0]['label']"
                :value="$stats[0]['value']"
                :change="$stats[0]['change']"
                :tone="$stats[0]['tone']"
            >
                <svg
                    class="h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        fill="#2563eb"
                        d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 0-7m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"
                    />
                </svg>
            </x-dashboard.stat-card>


            {{-- Available Lockers --}}
            <x-dashboard.stat-card
                :label="$stats[1]['label']"
                :value="$stats[1]['value']"
                :change="$stats[1]['change']"
                :tone="$stats[1]['tone']"
            >
                <svg
                    class="h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
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


            {{-- Occupied Lockers --}}
            <x-dashboard.stat-card
                :label="$stats[2]['label']"
                :value="$stats[2]['value']"
                :change="$stats[2]['change']"
                :tone="$stats[2]['tone']"
            >
                <svg
                    class="h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 15 15"
                    aria-hidden="true"
                >
                    <path
                        fill="#dc2626"
                        d="M14 1.5v12c0 .28-.22.5-.5.5h-12c-.28 0-.5-.22-.5-.5v-12c0-.28.22-.5.5-.5h12c.28 0 .5.22.5.5M13 5h-3v3h3zm-2 4h-1v1h1zm2 0h-1v1h1zM2 5v2h3V5zm0 3v2h3V8zm0 3v2h3v-2zm4 0v2h3v-2zm0-3v2h3V8zm0-3v2h3V5zm0-3v2h3V2zM5 2H2v2h3z"
                    />
                </svg>
            </x-dashboard.stat-card>

        </section>


        {{-- ===================== NEARBY LOCATIONS ===================== --}}
        <section aria-labelledby="locations-heading">

            <div class="mb-3 flex items-center justify-between gap-3">

                <div>
                    <h2
                        id="locations-heading"
                        class="text-base font-semibold text-slate-900"
                    >
                        Nearby locations
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Find available lockers near you
                    </p>
                </div>


                <a
                    href="{{ route('locations.index') }}"
                    class="rounded text-sm font-medium text-blue-600 transition hover:text-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                >
                    View all
                </a>

            </div>


            @if ($nearbyLocations->isNotEmpty())

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($nearbyLocations as $location)

                        <a
                            href="{{ route('locations.show', $location->id) }}"
                            class="block rounded-xl transition duration-200 hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                        >

                            <x-dashboard.location-card
                                :name="$location->name"
                                :address="$location->address"
                                :hours="$location->hours_label"
                                :available="$location->available_lockers_count"
                            />

                        </a>

                    @endforeach

                </div>

            @else

                <div class="rounded-xl border border-dashed border-slate-300 bg-white px-4 py-10 text-center">

                    <p class="text-sm font-medium text-slate-600">
                        No locations found
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Try a different search or check back later.
                    </p>

                </div>

            @endif

        </section>

    </div>

</div>


@endsection
