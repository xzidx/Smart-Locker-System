@extends('layouts.app')

@section('title', 'Staff Lockers')

@section('content')

<div class="min-h-screen bg-[#f5f8fc] px-6 py-8 text-slate-800">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold tracking-tight text-slate-800">
            Staff Lockers
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Monitor and manage locker assignments across all locations.
        </p>

        <a
            href="{{ route('lockers.create') }}"
            class="mt-5 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            <span class="text-xl leading-none">+</span>
            Assign Locker
        </a>
    </div>


    {{-- ========================= --}}
    {{-- STATISTICS --}}
    {{-- ========================= --}}

    <div class="mb-3 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_5px_18px_rgba(30,50,80,0.05)]">

            <div class="mb-3 flex items-center gap-2 text-sm text-slate-500">
                <span class="h-2.5 w-2.5 rounded-full bg-blue-600"></span>
                Total Lockers
            </div>

            <p class="text-3xl font-bold text-slate-800">
                {{ number_format($totalLockers) }}
            </p>

        </div>


        {{-- Available --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_5px_18px_rgba(30,50,80,0.05)]">

            <div class="mb-3 flex items-center gap-2 text-sm text-slate-500">
                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                Available
            </div>

            <p class="text-3xl font-bold text-slate-800">
                {{ number_format($availableLockers) }}
            </p>

        </div>


        {{-- Occupied --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_5px_18px_rgba(30,50,80,0.05)]">

            <div class="mb-3 flex items-center gap-2 text-sm text-slate-500">
                <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                Occupied
            </div>

            <p class="text-3xl font-bold text-slate-800">
                {{ number_format($occupiedLockers) }}
            </p>

        </div>


        {{-- Maintenance --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_5px_18px_rgba(30,50,80,0.05)]">

            <div class="mb-3 flex items-center gap-2 text-sm text-slate-500">
                <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                Under Maintenance
            </div>

            <p class="text-3xl font-bold text-slate-800">
                {{ number_format($maintenanceLockers) }}
            </p>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- SEARCH + FILTERS --}}
    {{-- ========================= --}}

    <form
        method="GET"
        action="{{ route('lockers.index') }}"
        class="mb-4 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-[0_5px_18px_rgba(30,50,80,0.05)] xl:flex-row xl:items-center xl:justify-between"
    >

        {{-- Search --}}
        <div class="flex w-full items-center rounded-xl border border-slate-200 bg-white px-3 xl:max-w-[430px]">

            <svg
                class="h-5 w-5 shrink-0 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                />
            </svg>

            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by locker number or location..."
                class="w-full border-0 bg-transparent px-3 py-3 text-sm text-slate-700 outline-none ring-0 placeholder:text-slate-400 focus:border-0 focus:ring-0"
            >

        </div>


        {{-- Filters --}}
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">

            {{-- Location --}}
            <select
                name="location_id"
                onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >

                <option value="">
                    All Locations
                </option>

                @foreach($locations as $location)

                    <option
                        value="{{ $location->id }}"
                        {{ request('location_id') == $location->id ? 'selected' : '' }}
                    >
                        {{ $location->name }}
                    </option>

                @endforeach

            </select>


            {{-- Status --}}
            <select
                name="status"
                onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >

                <option value="">
                    All Statuses
                </option>

                <option
                    value="available"
                    {{ request('status') === 'available' ? 'selected' : '' }}
                >
                    Available
                </option>

                <option
                    value="occupied"
                    {{ request('status') === 'occupied' ? 'selected' : '' }}
                >
                    Occupied
                </option>

                <option
                    value="reserved"
                    {{ request('status') === 'reserved' ? 'selected' : '' }}
                >
                    Reserved
                </option>

                <option
                    value="maintenance"
                    {{ request('status') === 'maintenance' ? 'selected' : '' }}
                >
                    Under Maintenance
                </option>

            </select>


            {{-- Size --}}
            <select
                id="sizeFilter"
                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
            >

                <option value="">
                    All Sizes
                </option>

                <option value="small">
                    Small
                </option>

                <option value="medium">
                    Medium
                </option>

                <option value="large">
                    Large
                </option>

            </select>

        </div>

    </form>


    {{-- ========================= --}}
    {{-- LOCKER GRID --}}
    {{-- ========================= --}}

    <div
        id="lockerGrid"
        class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4"
    >

        
    @forelse($lockers as $locker)

    @php
        $status = strtolower(trim($locker->status ?? 'available'));

        $locationName = $locker->location
            ? $locker->location->name
            : 'Not assigned';

        $floor = $locker->location
            ? $locker->location->floor
            : null;
    @endphp

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

        {{-- Header --}}
        <div class="mb-5 flex items-start justify-between">

            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    {{ $locker->name }}
                </h3>

                {{-- Dynamic status --}}
                @if($status === 'available')

                    <span class="mt-1 inline-flex items-center gap-1.5 text-sm text-emerald-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Available
                    </span>

                @elseif($status === 'occupied')

                    <span class="mt-1 inline-flex items-center gap-1.5 text-sm text-blue-600">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        Occupied
                    </span>

                @elseif($status === 'reserved')

                    <span class="mt-1 inline-flex items-center gap-1.5 text-sm text-amber-600">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        Reserved
                    </span>

                @else

                    <span class="mt-1 inline-flex items-center gap-1.5 text-sm text-red-600">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Maintenance
                    </span>

                @endif

            </div>

            <a
                href="{{ route('lockers.edit', $locker->id) }}"
                class="text-xl font-bold tracking-widest text-slate-400 hover:text-blue-600"
            >
                ···
            </a>

        </div>

        {{-- Dynamic information --}}
        <div class="space-y-2 text-sm text-slate-500">

            <p>
                <span class="font-medium text-slate-600">
                    Locker ID:
                </span>

                #{{ $locker->id }}
            </p>

            <p>
                <span class="font-medium text-slate-600">
                    Location:
                </span>

                {{ $locationName }}
            </p>

            @if($floor)

                <p>
                    <span class="font-medium text-slate-600">
                        Floor:
                    </span>

                    {{ $floor }}
                </p>

            @endif

            <p>
                <span class="font-medium text-slate-600">
                    Status:
                </span>

                {{ ucfirst($status) }}
            </p>

        </div>

    </div>

@empty

    <div class="col-span-full rounded-2xl border border-slate-200 bg-white px-6 py-14 text-center">

        <h3 class="text-lg font-semibold text-slate-800">
            No lockers found
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Try changing your search or filters.
        </p>

    </div>

@endforelse

    </div>


    {{-- ========================= --}}
    {{-- PAGINATION --}}
    {{-- ========================= --}}

    <div class="mt-10 flex flex-col items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-[0_5px_18px_rgba(30,50,80,0.05)] sm:flex-row">

        <p class="text-sm text-slate-500">

            Showing

            <span class="font-medium text-slate-700">
                {{ $lockers->firstItem() ?? 0 }}
            </span>

            -

            <span class="font-medium text-slate-700">
                {{ $lockers->lastItem() ?? 0 }}
            </span>

            of

            <span class="font-medium text-slate-700">
                {{ number_format($lockers->total()) }}
            </span>

            lockers

        </p>


        <div class="flex items-center gap-1.5">

            {{-- Previous --}}
            @if($lockers->onFirstPage())

                <span class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-300">
                    Previous
                </span>

            @else

                <a
                    href="{{ $lockers->previousPageUrl() }}"
                    class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    Previous
                </a>

            @endif


            {{-- Pages --}}
            @for(
                $page = 1;
                $page <= $lockers->lastPage();
                $page++
            )

                @if($page == $lockers->currentPage())

                    <span class="rounded-lg border border-blue-600 bg-blue-600 px-3.5 py-2 text-sm font-semibold text-white">
                        {{ $page }}
                    </span>

                @else

                    <a
                        href="{{ $lockers->url($page) }}"
                        class="rounded-lg border border-slate-200 px-3.5 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                    >
                        {{ $page }}
                    </a>

                @endif

            @endfor


            {{-- Next --}}
            @if($lockers->hasMorePages())

                <a
                    href="{{ $lockers->nextPageUrl() }}"
                    class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    Next
                </a>

            @else

                <span class="rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-300">
                    Next
                </span>

            @endif

        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- SIZE FILTER --}}
{{-- ========================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const sizeFilter = document.getElementById('sizeFilter');

    const lockerCards = document.querySelectorAll('.locker-card');


    sizeFilter.addEventListener('change', function () {

        const selectedSize = this.value.toLowerCase();


        lockerCards.forEach(function (card) {

            const cardSize =
                (card.dataset.size || '').toLowerCase();


            if (
                selectedSize === '' ||
                cardSize === selectedSize
            ) {

                card.classList.remove('hidden');

            } else {

                card.classList.add('hidden');

            }

        });

    });

});

</script>

@endsection