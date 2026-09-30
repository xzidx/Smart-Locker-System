```blade
@extends('layouts.app')

@section('title', 'Locker Maintenance')
@section('page-title', 'Locker Maintenance')
@section('page-description', 'Monitor and manage locker maintenance issues')

@section('content')

<div class="w-full min-w-0 bg-slate-50">

    <div class="mx-auto w-full min-w-0 space-y-6 p-3 sm:p-5 lg:p-6 xl:p-8">

        {{-- ===================================================== --}}
        {{-- SUCCESS MESSAGE                                       --}}
        {{-- ===================================================== --}}
        @if(session('success'))

            <div class="flex w-full min-w-0 items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-emerald-800">
                        Success
                    </p>

                    <p class="mt-0.5 break-words text-sm text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- PAGE HEADER                                           --}}
        {{-- ===================================================== --}}
        <div class="flex min-w-0 flex-col gap-4 sm:gap-5 md:flex-row md:items-center md:justify-between">

            <div class="min-w-0">
                <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl lg:text-3xl">
                    Locker Maintenance
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Monitor and manage locker maintenance issues.
                </p>
            </div>

            {{-- Create Button --}}
            <a
                href="{{ route('locker_maintenance.create') }}"
                class="inline-flex w-full shrink-0 items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto"
            >
                <i class="fa-solid fa-circle-plus"></i>
                <span>Create Maintenance</span>
            </a>

        </div>


        {{-- ===================================================== --}}
        {{-- STATISTICS CARDS                                      --}}
        {{-- ===================================================== --}}
        <div class="grid min-w-0 grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Open Issues --}}
            <div class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">
                        <p class="text-sm text-slate-500">
                            Open Issues
                        </p>

                        <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                            {{ $openIssues ?? 0 }}
                        </h2>

                        <p class="mt-2 text-xs font-semibold text-rose-600">
                            Requires attention
                        </p>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600 sm:h-11 sm:w-11">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                </div>

            </div>


            {{-- In Progress --}}
            <div class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">
                        <p class="text-sm text-slate-500">
                            In Progress
                        </p>

                        <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                            {{ $inProgress ?? 0 }}
                        </h2>

                        <p class="mt-2 text-xs font-semibold text-blue-600">
                            Currently being repaired
                        </p>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 sm:h-11 sm:w-11">
                        <i class="fa-solid fa-wrench"></i>
                    </div>

                </div>

            </div>


            {{-- Completed --}}
            <div class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">
                        <p class="text-sm text-slate-500">
                            Completed This Month
                        </p>

                        <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                            {{ $completedThisMonth ?? 0 }}
                        </h2>

                        <p class="mt-2 text-xs font-semibold text-emerald-600">
                            Successfully resolved
                        </p>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 sm:h-11 sm:w-11">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                </div>

            </div>


            {{-- Critical --}}
            <div class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">
                        <p class="text-sm text-slate-500">
                            Critical Issues
                        </p>

                        <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
                            {{ $criticalIssues ?? 0 }}
                        </h2>

                        <p class="mt-2 text-xs font-semibold text-amber-600">
                            High priority
                        </p>
                    </div>

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 sm:h-11 sm:w-11">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SEARCH & FILTER CARD                                  --}}
        {{-- ===================================================== --}}
        <div class="min-w-0 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-sm sm:p-5 lg:p-6">

            <div class="mb-5">
                <h2 class="font-bold text-slate-800">
                    Search & Filters
                </h2>

                <p class="mt-1 text-xs leading-5 text-slate-400 sm:text-sm">
                    Find maintenance tickets by locker, location, priority, or status.
                </p>
            </div>


            <form
                action="{{ route('locker_maintenance.index') }}"
                method="GET"
                class="grid w-full min-w-0 grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-5"
            >

                {{-- Search --}}
                <div class="relative min-w-0 sm:col-span-2 xl:col-span-1">

                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search locker or issue..."
                        class="h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                {{-- Location --}}
                <select
                    name="location"
                    class="h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-600 outline-none transition focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

                    <option value="all">
                        Location: All
                    </option>

                    @foreach($lockers->pluck('location')->filter()->unique('id') as $location)

                        <option
                            value="{{ $location->id }}"
                            @selected(request('location') == $location->id)
                        >
                            {{ $location->name }}
                        </option>

                    @endforeach

                </select>


                {{-- Priority --}}
                <select
                    name="priority"
                    class="h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-600 outline-none transition focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

                    <option value="all">
                        Priority: Any
                    </option>

                    <option value="Low" @selected(request('priority') == 'Low')>
                        Low
                    </option>

                    <option value="Medium" @selected(request('priority') == 'Medium')>
                        Medium
                    </option>

                    <option value="High" @selected(request('priority') == 'High')>
                        High
                    </option>

                    <option value="Critical" @selected(request('priority') == 'Critical')>
                        Critical
                    </option>

                </select>


                {{-- Status --}}
                <select
                    name="status"
                    class="h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-600 outline-none transition focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100"
                >

                    <option value="all">
                        Status: Any
                    </option>

                    <option value="Open" @selected(request('status') == 'Open')>
                        Open
                    </option>

                    <option value="In Progress" @selected(request('status') == 'In Progress')>
                        In Progress
                    </option>

                    <option value="Completed" @selected(request('status') == 'Completed')>
                        Completed
                    </option>

                    <option value="Cancelled" @selected(request('status') == 'Cancelled')>
                        Cancelled
                    </option>

                </select>


                {{-- Filter Button --}}
                <button
                    type="submit"
                    class="inline-flex h-11 w-full min-w-0 items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 xl:w-full"
                >
                    <i class="fa-solid fa-filter text-xs"></i>
                    <span>Filter</span>
                </button>

            </form>

        </div>


        {{-- ===================================================== --}}
        {{-- MAINTENANCE TABLE                                    --}}
        {{-- ===================================================== --}}
        <div class="min-w-0 overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm">

            {{-- Table Header --}}
            <div class="flex min-w-0 flex-col gap-3 border-b border-slate-100 px-4 py-5 sm:px-6 md:flex-row md:items-center md:justify-between">

                <div class="min-w-0">
                    <h2 class="font-bold text-slate-800">
                        Maintenance Tickets
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Monitor all locker maintenance requests.
                    </p>
                </div>

                <div class="flex shrink-0 items-center gap-2 text-xs text-slate-500">

                    <span class="h-2 w-2 shrink-0 rounded-full bg-blue-500"></span>

                    <span>
                        {{ $maintenances->total() ?? $maintenances->count() }}
                        tickets
                    </span>

                </div>

            </div>


            {{-- Responsive Table --}}
            <div class="w-full min-w-0 overflow-x-auto">

                <table class="w-full min-w-[1000px] text-sm">

                    {{-- Table Head --}}
                    <thead class="border-b border-slate-100 bg-slate-50">

                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Locker
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Location
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Issue Description
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Priority
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Start Date
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                End Date
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 sm:px-5">
                                Status
                            </th>

                            <th class="whitespace-nowrap px-4 py-4 text-right sm:px-5">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-slate-100">

                        @forelse($maintenances as $maintenance)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Locker --}}
                                <td class="whitespace-nowrap px-4 py-4 sm:px-5">

                                    <a
                                        href="{{ route('locker_maintenance.show', $maintenance) }}"
                                        class="font-semibold text-blue-600 transition hover:text-blue-800"
                                    >
                                        {{ $maintenance->locker->name ?? 'N/A' }}
                                    </a>

                                </td>


                                {{-- Location --}}
                                <td class="px-4 py-4 sm:px-5">

                                    <div class="flex min-w-[140px] items-center gap-2 text-slate-600">

                                        <i class="fa-solid fa-location-dot shrink-0 text-xs text-slate-400"></i>

                                        <span class="truncate">
                                            {{ $maintenance->locker->location->name ?? 'N/A' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Issue --}}
                                <td class="px-4 py-4 sm:px-5">

                                    <div
                                        class="max-w-[240px] truncate text-slate-700"
                                        title="{{ $maintenance->description ?? $maintenance->issue }}"
                                    >
                                        {{ $maintenance->description ?? $maintenance->issue }}
                                    </div>

                                </td>


                                {{-- Priority --}}
                                <td class="whitespace-nowrap px-4 py-4 sm:px-5">

                                    @php

                                        $priority = $maintenance->priority ?? 'Medium';

                                        $priorityClasses = [

                                            'Low' =>
                                                'border border-slate-200 bg-slate-50 text-slate-600',

                                            'Medium' =>
                                                'border border-amber-200 bg-amber-50 text-amber-700',

                                            'High' =>
                                                'border border-orange-200 bg-orange-50 text-orange-700',

                                            'Critical' =>
                                                'border border-rose-200 bg-rose-50 text-rose-700',

                                        ];

                                    @endphp

                                    <span
                                        class="inline-flex whitespace-nowrap rounded-lg px-2.5 py-1 text-xs font-semibold {{ $priorityClasses[$priority] ?? 'border border-slate-200 bg-slate-50 text-slate-600' }}"
                                    >
                                        {{ $priority }}
                                    </span>

                                </td>


                                {{-- Start Date --}}
                                <td class="whitespace-nowrap px-4 py-4 text-slate-500 sm:px-5">

                                    {{ $maintenance->start_date
                                        ? \Carbon\Carbon::parse($maintenance->start_date)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </td>


                                {{-- End Date --}}
                                <td class="whitespace-nowrap px-4 py-4 text-slate-500 sm:px-5">

                                    {{ $maintenance->end_date
                                        ? \Carbon\Carbon::parse($maintenance->end_date)->format('M d, Y')
                                        : '—'
                                    }}

                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-4 py-4 sm:px-5">

                                    @php

                                        $statusClasses = [

                                            'Open' =>
                                                'border border-rose-200 bg-rose-50 text-rose-700',

                                            'In Progress' =>
                                                'border border-blue-200 bg-blue-50 text-blue-700',

                                            'Completed' =>
                                                'border border-emerald-200 bg-emerald-50 text-emerald-700',

                                            'Cancelled' =>
                                                'border border-slate-200 bg-slate-50 text-slate-600',

                                        ];

                                    @endphp

                                    <span
                                        class="inline-flex whitespace-nowrap rounded-lg px-2.5 py-1 text-xs font-semibold {{ $statusClasses[$maintenance->status] ?? 'border border-slate-200 bg-slate-50 text-slate-600' }}"
                                    >
                                        {{ $maintenance->status }}
                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td class="px-4 py-4 sm:px-5">

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('locker_maintenance.show', $maintenance) }}"
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-blue-50 hover:text-blue-600"
                                            title="View"
                                        >
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('locker_maintenance.edit', $maintenance) }}"
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-blue-50 hover:text-blue-600"
                                            title="Edit"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('locker_maintenance.destroy', $maintenance) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this maintenance ticket?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-rose-50 hover:text-rose-600"
                                                title="Delete"
                                            >
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- Empty State --}}
                            <tr>

                                <td
                                    colspan="8"
                                    class="px-5 py-16 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-2xl text-slate-300">
                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                        </div>

                                        <p class="font-semibold text-slate-700">
                                            No maintenance tickets found
                                        </p>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Create a maintenance ticket to get started.
                                        </p>

                                        <a
                                            href="{{ route('locker_maintenance.create') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >
                                            <i class="fa-solid fa-circle-plus text-xs"></i>
                                            Create Maintenance
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION                                        --}}
            {{-- ================================================= --}}
            @if($maintenances->hasPages())

                <div class="flex min-w-0 flex-col gap-4 border-t border-slate-100 px-4 py-4 sm:px-6 md:flex-row md:items-center md:justify-between">

                    <p class="text-xs text-slate-500">

                        Showing

                        <span class="font-semibold text-slate-700">
                            {{ $maintenances->firstItem() ?? 0 }}
                        </span>

                        -

                        <span class="font-semibold text-slate-700">
                            {{ $maintenances->lastItem() ?? 0 }}
                        </span>

                        of

                        <span class="font-semibold text-slate-700">
                            {{ $maintenances->total() }}
                        </span>

                        maintenance tickets

                    </p>

                    <div class="max-w-full overflow-x-auto">
                        {{ $maintenances->links() }}
                    </div>

                </div>

            @else

                <div class="border-t border-slate-100 px-4 py-4 sm:px-6">

                    <p class="text-xs text-slate-500">

                        Showing

                        <span class="font-semibold text-slate-700">
                            {{ $maintenances->count() }}
                        </span>

                        maintenance tickets

                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
