@extends('layouts.app')

@section('title', 'Find a Locker')

@section('page-title', 'Find a Locker')

@section('page-description', 'Find an available locker near your location')

@section('content')

<div class="w-full bg-slate-50">

    <div class="w-full space-y-6 p-4 sm:p-6 lg:p-8">

        {{-- ===================================================== --}}
        {{-- HEADER                                                --}}
        {{-- ===================================================== --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    Find a Locker
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Find an available locker near your location.
                </p>
            </div>

            {{-- Location Count --}}
            <div class="flex w-fit items-center gap-3 rounded-2xl border border-slate-200/80 bg-white px-4 py-3 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-400">
                        Available Locations
                    </p>

                    <p class="text-lg font-bold text-slate-900">
                        {{ $locations->count() }}
                    </p>
                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SEARCH CARD                                           --}}
        {{-- ===================================================== --}}
        <div class="rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">

            <div class="mb-4">

                <h2 class="font-bold text-slate-800">
                    Search Locations
                </h2>

                <p class="mt-1 text-xs text-slate-400 sm:text-sm">
                    Search by address, neighborhood, or landmark.
                </p>

            </div>


            <form
                method="GET"
                action="{{ route('locations.index') }}"
                class="w-full"
            >

                <div class="flex w-full flex-col gap-3 sm:flex-row">

                    {{-- Search Input --}}
                    <div class="flex min-w-0 flex-1 items-center rounded-xl border border-slate-200 bg-slate-50 px-4 transition focus-within:border-blue-400 focus-within:bg-white">

                        <i class="fa-solid fa-magnifying-glass mr-3 text-sm text-slate-400"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search location..."
                            class="w-full border-0 bg-transparent py-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:ring-0"
                        >

                    </div>


                    {{-- Search Button --}}
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >

                        <i class="fa-solid fa-magnifying-glass"></i>

                        Search

                    </button>

                </div>

            </form>

        </div>


        {{-- ===================================================== --}}
        {{-- LOCATIONS HEADER                                      --}}
        {{-- ===================================================== --}}
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    Locker Locations
                </h2>

                <p class="mt-1 text-sm text-slate-400">
                    Select a location to view available lockers.
                </p>

            </div>


            @if ($locations->count() > 0)

                <span class="w-fit rounded-xl bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-600">

                    <i class="fa-solid fa-location-dot mr-1"></i>

                    {{ $locations->count() }}
                    {{ \Illuminate\Support\Str::plural('location', $locations->count()) }}

                </span>

            @endif

        </div>


        {{-- ===================================================== --}}
        {{-- LOCATION GRID                                         --}}
        {{-- ===================================================== --}}
        <section>

            @if ($locations->count() > 0)

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                    @foreach ($locations as $location)

                        @php

                            $totalLockers = $location->lockers_count ?? 0;

                            $availableLockers = $location->available_count ?? 0;

                            $percentage = $totalLockers > 0
                                ? ($availableLockers / $totalLockers) * 100
                                : 0;

                            if ($availableLockers > 0) {

                                $statusLabel = 'Available';

                                $statusClasses =
                                    'bg-emerald-50 text-emerald-700 border-emerald-200';

                                $iconClasses =
                                    'bg-emerald-50 text-emerald-600';

                                $progressClass =
                                    'bg-emerald-500';

                            } elseif ($totalLockers > 0) {

                                $statusLabel = 'Full';

                                $statusClasses =
                                    'bg-rose-50 text-rose-700 border-rose-200';

                                $iconClasses =
                                    'bg-rose-50 text-rose-600';

                                $progressClass =
                                    'bg-rose-500';

                            } else {

                                $statusLabel = 'No Lockers';

                                $statusClasses =
                                    'bg-slate-50 text-slate-600 border-slate-200';

                                $iconClasses =
                                    'bg-slate-50 text-slate-500';

                                $progressClass =
                                    'bg-slate-400';

                            }

                        @endphp


                        {{-- ================================================= --}}
                        {{-- LOCATION CARD                                    --}}
                        {{-- ================================================= --}}
                        <a
                            href="{{ route('locations.show', $location->id) }}"
                            class="group block h-full"
                        >

                            <div class="flex h-full flex-col rounded-2xl border border-slate-200/80 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-md sm:p-6">


                                {{-- Card Header --}}
                                <div class="flex items-start justify-between gap-3">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $iconClasses }}">

                                            <i class="fa-solid fa-location-dot"></i>

                                        </div>


                                        <div class="min-w-0">

                                            <h3 class="truncate text-base font-bold text-slate-800">
                                                {{ $location->name }}
                                            </h3>

                                            <p class="mt-0.5 text-xs text-slate-400">
                                                Locker Location
                                            </p>

                                        </div>

                                    </div>


                                    {{-- Status --}}
                                    <span class="shrink-0 rounded-lg border px-2.5 py-1 text-[11px] font-semibold {{ $statusClasses }}">

                                        {{ $statusLabel }}

                                    </span>

                                </div>


                                {{-- Address --}}
                                <div class="mt-5 flex items-start gap-2">

                                    <i class="fa-solid fa-location-dot mt-0.5 shrink-0 text-xs text-slate-400"></i>

                                    <p class="line-clamp-2 text-xs leading-5 text-slate-500 sm:text-sm">

                                        {{ $location->address ?? $location->location ?? 'Address not available' }}

                                    </p>

                                </div>


                                {{-- Locker Statistics --}}
                                <div class="mt-5 grid grid-cols-2 gap-3">

                                    {{-- Available --}}
                                    <div class="rounded-xl bg-emerald-50 p-3">

                                        <p class="text-xs text-emerald-600">
                                            Available
                                        </p>

                                        <p class="mt-1 text-xl font-bold text-emerald-700">
                                            {{ $availableLockers }}
                                        </p>

                                    </div>


                                    {{-- Total --}}
                                    <div class="rounded-xl bg-slate-50 p-3">

                                        <p class="text-xs text-slate-500">
                                            Total Lockers
                                        </p>

                                        <p class="mt-1 text-xl font-bold text-slate-800">
                                            {{ $totalLockers }}
                                        </p>

                                    </div>

                                </div>


                                {{-- Availability --}}
                                <div class="mt-5">

                                    <div class="mb-2 flex items-center justify-between">

                                        <span class="text-xs font-medium text-slate-500">
                                            Availability
                                        </span>

                                        <span class="text-xs font-bold text-slate-700">
                                            {{ number_format($percentage, 0) }}%
                                        </span>

                                    </div>


                                    <div class="h-2 w-full overflow-hidden rounded-full bg-slate-100">

                                        <div
                                            class="h-full rounded-full {{ $progressClass }} transition-all duration-300"
                                            style="width: {{ min($percentage, 100) }}%"
                                        ></div>

                                    </div>

                                </div>


                                {{-- View Button --}}
                                <div class="mt-6 border-t border-slate-100 pt-4">

                                    <span class="flex items-center justify-between text-sm font-semibold text-blue-600 transition group-hover:text-blue-700">

                                        <span>
                                            View Lockers
                                        </span>

                                        <i class="fa-solid fa-arrow-right text-xs transition group-hover:translate-x-1"></i>

                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                {{-- ================================================= --}}
                {{-- EMPTY STATE                                      --}}
                {{-- ================================================= --}}
                <div class="rounded-2xl border border-slate-200/80 bg-white px-6 py-16 text-center shadow-sm">

                    <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-2xl text-slate-300">

                        <i class="fa-solid fa-location-dot"></i>

                    </div>

                    <h2 class="text-lg font-bold text-slate-800">
                        No locations found
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm text-slate-400">
                        We couldn't find any locker locations matching your search.
                        Try another location or check again later.
                    </p>

                    <a
                        href="{{ route('locations.index') }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >

                        <i class="fa-solid fa-rotate-right text-xs"></i>

                        View All Locations

                    </a>

                </div>

            @endif

        </section>

    </div>

</div>

@endsection