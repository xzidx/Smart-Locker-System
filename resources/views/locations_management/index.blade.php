@extends('layouts.app')

@section('title', 'Locations')

@section('page-title', 'Locations')

@section('page-description', 'Manage your locations')

@section('content')

<div class="w-full p-8">

    @if (session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-2 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Top bar --}}
    <form id="filters" method="GET" action="{{ route('locations-management.index') }}"
          class="mb-6 flex flex-wrap items-center justify-between gap-3">

        <div class="flex flex-wrap items-center gap-3">

            {{-- Search --}}
            <div class="relative">

                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <circle cx="11" cy="11" r="7"/>
                    <path stroke-linecap="round" d="m20 20-3.5-3.5"/>

                </svg>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search locations..."
                    class="h-10 w-72 rounded-lg border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >

            </div>

            {{-- Building filter --}}
            <div class="relative">

                <select
                    name="building"
                    onchange="this.form.submit()"
                    class="h-10 appearance-none rounded-lg border border-slate-200 bg-white pl-3 pr-9 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >

                    <option value="">Building: All</option>

                    @foreach ($buildings as $building)

                        <option
                            value="{{ $building }}"
                            @selected(request('building') === $building)
                        >
                            Building: {{ $building }}
                        </option>

                    @endforeach

                </select>

                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>

                </svg>

            </div>

            {{-- Status filter --}}
            <div class="relative">

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="h-10 appearance-none rounded-lg border border-slate-200 bg-white pl-3 pr-9 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >

                    <option value="">Status: All</option>

                    <option
                        value="active"
                        @selected(request('status') === 'active')
                    >
                        Status: Active
                    </option>

                    <option
                        value="inactive"
                        @selected(request('status') === 'inactive')
                    >
                        Status: Inactive
                    </option>

                </select>

                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/>

                </svg>

            </div>

        </div>

        {{-- Add Location button --}}
        <a
            href="{{ route('locations-management.create') }}"
            class="inline-flex h-10 items-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
        >

            <svg
                class="h-5 w-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" d="M12 8v8M8 12h8"/>
            </svg>

            Add Location

        </a>

    </form>


    {{-- Table card --}}
    <div class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 text-xs font-medium text-slate-600">

                <tr>

                    <th class="px-6 py-4 text-left font-medium">
                        Location Name
                    </th>

                    <th class="px-4 py-4 text-left font-medium">
                        Address
                    </th>

                    <th class="px-4 py-4 text-center font-medium">
                        Total Lockers
                    </th>

                    <th class="px-4 py-4 text-center font-medium">
                        Available
                    </th>

                    <th class="px-4 py-4 text-center font-medium">
                        Occupied
                    </th>

                    <th class="px-4 py-4 text-center font-medium">
                        Maintenance
                    </th>

                    <th class="px-4 py-4 text-center font-medium">
                        Status
                    </th>

                    <th class="px-6 py-4 text-right font-medium">
                        Actions
                    </th>

                </tr>

                </thead>


                <tbody class="divide-y divide-slate-200 border-t border-slate-200">

                @forelse ($locations as $location)

                    @php
                        $isActive = $location->total_lockers > 0
                            && $location->maintenance_count < $location->total_lockers;
                    @endphp

                    <tr class="hover:bg-slate-50/60">

                        {{-- Location Name --}}
                        <td class="whitespace-nowrap px-6 py-4 font-bold text-slate-900">
                            {{ $location->name }}
                        </td>


                        {{-- Address --}}
                        <td
                            class="max-w-[230px] truncate px-4 py-4 text-slate-500"
                            title="{{ $location->address }} · {{ $location->building }} · Floor {{ $location->floor }}"
                        >
                            {{ $location->address }}
                        </td>


                        {{-- Total Lockers --}}
                        <td class="px-4 py-4 text-center text-slate-900">
                            {{ $location->total_lockers }}
                        </td>


                        {{-- Available --}}
                        <td class="px-4 py-4 text-center font-semibold text-green-600">
                            {{ $location->available_count }}
                        </td>


                        {{-- Occupied --}}
                        <td class="px-4 py-4 text-center font-semibold text-blue-600">
                            {{ $location->occupied_count }}
                        </td>


                        {{-- Maintenance --}}
                        <td class="px-4 py-4 text-center font-semibold text-amber-500">
                            {{ $location->maintenance_count }}
                        </td>


                        {{-- Status --}}
                        <td class="px-4 py-4 text-center">

                            @if ($isActive)

                                <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    Active
                                </span>

                            @else

                                <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600">
                                    Inactive
                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-end gap-3 text-slate-600">

                                {{-- Add Locker --}}
                                <a
                                    href="{{ route('locker-management.create', ['location_id' => $location->id]) }}"
                                    title="Add Locker"
                                    class="hover:text-green-600"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 8v8M8 12h8"
                                        />

                                    </svg>

                                </a>


                                {{-- View --}}
                                <a
                                    href="{{ route('locations-management.show', $location) }}"
                                    title="View"
                                    class="hover:text-blue-600"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                        />

                                    </svg>

                                </a>


                                {{-- Edit --}}
                                <a
                                    href="{{ route('locations-management.edit', $location) }}"
                                    title="Edit"
                                    class="hover:text-blue-600"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m16.9 3.6 3.5 3.5-11 11-4.4.9.9-4.4 11-11Z"
                                        />

                                    </svg>

                                </a>


                                {{-- Delete --}}
                                <form
                                    method="POST"
                                    action="{{ route('locations-management.destroy', $location) }}"
                                    onsubmit="return confirm('Delete this location?')"
                                    class="flex"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Delete"
                                        class="hover:text-red-600"
                                    >

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-12M9 7V4h6v3"
                                            />

                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-6 py-12 text-center text-slate-500"
                        >
                            No locations found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- Footer: count + pagination --}}
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 px-6 py-4">

            <p class="text-sm text-slate-500">

                @if ($locations->total())

                    Showing
                    {{ $locations->firstItem() }}-{{ $locations->lastItem() }}
                    of
                    {{ $locations->total() }}
                    locations

                @else

                    Showing 0 locations

                @endif

            </p>


            @if ($locations->hasPages())

                @php
                    $current = $locations->currentPage();
                    $last = $locations->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp

                <div class="flex items-center gap-2 text-xs">

                    @if ($locations->onFirstPage())

                        <span class="rounded-md border border-slate-200 px-3 py-1.5 text-slate-300">
                            Previous
                        </span>

                    @else

                        <a
                            href="{{ $locations->previousPageUrl() }}"
                            class="rounded-md border border-slate-200 px-3 py-1.5 text-slate-600 hover:bg-slate-50"
                        >
                            Previous
                        </a>

                    @endif


                    @for ($page = $start; $page <= $end; $page++)

                        @if ($page === $current)

                            <span class="rounded-md bg-blue-600 px-3 py-1.5 font-semibold text-white">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $locations->url($page) }}"
                                class="rounded-md border border-slate-200 px-3 py-1.5 text-slate-600 hover:bg-slate-50"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endfor


                    @if ($locations->hasMorePages())

                        <a
                            href="{{ $locations->nextPageUrl() }}"
                            class="rounded-md border border-slate-200 px-3 py-1.5 text-slate-600 hover:bg-slate-50"
                        >
                            Next
                        </a>

                    @else

                        <span class="rounded-md border border-slate-200 px-3 py-1.5 text-slate-300">
                            Next
                        </span>

                    @endif

                </div>

            @endif

        </div>

    </div>

</div>


<script>

    const search = document.querySelector('input[name="search"]');

    let t;

    if (search) {
        search.addEventListener('input', () => {

            clearTimeout(t);

            t = setTimeout(() => {
                document.getElementById('filters').submit();
            }, 500);

        });
    }

</script>

@endsection