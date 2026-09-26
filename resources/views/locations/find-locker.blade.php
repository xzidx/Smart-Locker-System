@extends('layouts.app')

@section('title', 'Find a Locker')

@section('page-title', 'Find a Locker')

@section('page-description', 'Find an available locker near your location')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 px-4 py-8 sm:px-8">

    <div class="mx-auto max-w-6xl space-y-8">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">
                Find a Locker
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Find an available locker near your location.
            </p>
        </div>


        {{-- SEARCH --}}
        <form method="GET" action="{{ route('locations.index') }}" class="mb-6">

            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl shadow-sm p-2">

                <div class="flex items-center flex-1 px-2">

                    <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search address, neighborhood or landmark"
                        class="w-full py-2 text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                    >

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg"
                >
                    <i class="fa-solid fa-magnifying-glass mr-1"></i>
                    Search
                </button>

            </div>

        </form>


        {{-- LOCATIONS --}}
        <div class="space-y-4">

            @forelse ($locations as $location)

                @php

                    $totalLockers = $location->lockers_count ?? 0;

                    $availableLockers = $location->available_count ?? 0;

                    if ($availableLockers > 0) {

                        $statusLabel = 'Available';

                        $statusClasses =
                            'bg-green-50 text-green-700 border border-green-200';

                    } elseif ($totalLockers > 0) {

                        $statusLabel = 'Full';

                        $statusClasses =
                            'bg-red-50 text-red-700 border border-red-200';

                    } else {

                        $statusLabel = 'No Lockers';

                        $statusClasses =
                            'bg-gray-50 text-gray-600 border border-gray-200';

                    }

                @endphp


                {{-- LOCATION CARD --}}
                <a
                    href="{{ route('locations.show', $location->id) }}"
                    class="block"
                >

                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-sm p-20 transition hover:shadow-md hover:border-blue-300 cursor-pointer"
                    >

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">


                            {{-- LOCATION INFORMATION --}}
                            <div class="flex-1">

                                <div class="flex items-center gap-2 flex-wrap">

                                    <h2 class="font-semibold text-slate-900 text-lg">
                                        {{ $location->name }}
                                    </h2>

                                    <span
                                        class="text-xs font-medium px-2 py-1 rounded-full {{ $statusClasses }}"
                                    >
                                        {{ $statusLabel }}
                                    </span>

                                </div>


                                {{-- ADDRESS --}}
                                <p class="text-sm text-gray-500 mt-2">

                                    <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i>

                                    {{ $location->address ?? $location->location ?? 'Address not available' }}

                                </p>


                                {{-- LOCKER COUNT --}}
                                <p class="text-sm text-gray-600 mt-2">

                                    <span class="font-medium text-green-700">
                                        {{ $availableLockers }} available
                                    </span>

                                    <span class="text-gray-400">
                                        / {{ $totalLockers }} total lockers
                                    </span>

                                </p>

                            </div>


                            {{-- VIEW LOCKERS --}}
                            <div>

                                <span
                                    class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg w-full sm:w-auto"
                                >

                                    <i class="fa-solid fa-box-open"></i>

                                    View Lockers

                                </span>

                            </div>

                        </div>

                    </div>

                </a>


            @empty

                {{-- NO LOCATIONS --}}
                <div
                    class="bg-white border border-gray-200 rounded-xl p-10 text-center"
                >

                    <div class="text-gray-400 text-4xl mb-4">

                        <i class="fa-solid fa-location-dot"></i>

                    </div>

                    <h2 class="text-lg font-semibold text-slate-900">
                        No locations found
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Try another search or check again later.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection