@extends('layouts.app')

@section('title', 'Locker Maintenance')
@section('page-title', 'Locker Maintenance')
@section('page-description', 'Monitor and manage locker maintenance issues')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3">
            <p class="text-sm text-green-700">
                {{ session('success') }}
            </p>
        </div>
    @endif


    {{-- ============================= --}}
    {{-- Statistics Cards --}}
    {{-- ============================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Open Issues --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs text-gray-500">
                        Open Issues
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $openIssues ?? 0 }}
                    </h2>
                </div>

                <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
                </div>

            </div>

        </div>


        {{-- In Progress --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs text-gray-500">
                        In Progress
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $inProgress ?? 0 }}
                    </h2>
                </div>

                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-wrench text-blue-500"></i>
                </div>

            </div>

        </div>


        {{-- Completed This Month --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs text-gray-500">
                        Completed This Month
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $completedThisMonth ?? 0 }}
                    </h2>
                </div>

                <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-green-500"></i>
                </div>

            </div>

        </div>


        {{-- Critical Issues --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-xs text-gray-500">
                        Critical Issues
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $criticalIssues ?? 0 }}
                    </h2>
                </div>

                <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-gray-600"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- Search & Filters --}}
    {{-- ============================= --}}

    <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm mb-4">

        <form
            action="{{ route('locker_maintenance.index') }}"
            method="GET"
            class="flex flex-col lg:flex-row gap-3"
        >

            {{-- Search --}}
            <div class="relative flex-1">

                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Locker ID or issue..."
                    class="w-full h-10 pl-9 pr-3 rounded-lg border border-gray-200 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >

            </div>


            {{-- Location --}}
            <select
                name="location"
                class="h-10 rounded-lg border border-gray-200 px-3 text-sm text-gray-600 focus:ring-2 focus:ring-blue-500"
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
                class="h-10 rounded-lg border border-gray-200 px-3 text-sm text-gray-600 focus:ring-2 focus:ring-blue-500"
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
                class="h-10 rounded-lg border border-gray-200 px-3 text-sm text-gray-600 focus:ring-2 focus:ring-blue-500"
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
                class="h-10 px-4 rounded-lg bg-gray-900 text-white text-sm font-medium hover:bg-gray-800"
            >
                Filter
            </button>


            {{-- Create Maintenance --}}
            <a
                href="{{ route('locker_maintenance.create') }}"
                class="h-10 px-4 rounded-lg bg-blue-600 text-white text-sm font-medium flex items-center justify-center gap-2 hover:bg-blue-700"
            >

                <i class="fa-solid fa-circle-plus"></i>

                Create Maintenance

            </a>

        </form>

    </div>


    {{-- ============================= --}}
    {{-- Maintenance Table --}}
    {{-- ============================= --}}

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- Table Header --}}
                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr class="text-left text-xs text-gray-500">

                        <th class="px-4 py-3 font-medium">
                            Locker
                        </th>

                        <th class="px-4 py-3 font-medium">
                            Location
                        </th>

                        <th class="px-4 py-3 font-medium">
                            Issue Description
                        </th>

                        <th class="px-4 py-3 font-medium">
                            Priority
                        </th>

                        <th class="px-4 py-3 font-medium">
                            Start Date
                        </th>

                        <th class="px-4 py-3 font-medium">
                            End Date
                        </th>

                        <th class="px-4 py-3 font-medium">
                            Status
                        </th>

                        <th class="px-4 py-3 font-medium text-right">
                            Actions
                        </th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($maintenances as $maintenance)

                        <tr class="hover:bg-gray-50">


                            {{-- Locker --}}
                            <td class="px-4 py-3">

                                <a
                                    href="{{ route('locker_maintenance.show', $maintenance) }}"
                                    class="font-medium text-blue-600 hover:text-blue-800"
                                >
                                    {{ $maintenance->locker->name ?? 'N/A' }}
                                </a>

                            </td>


                            {{-- Location --}}
                            <td class="px-4 py-3 text-gray-600">

                                {{ $maintenance->locker->location->name ?? 'N/A' }}

                            </td>


                            {{-- Issue --}}
                            <td class="px-4 py-3 max-w-xs">

                                <div
                                    class="truncate text-gray-700"
                                    title="{{ $maintenance->description ?? $maintenance->issue }}"
                                >
                                    {{ $maintenance->description ?? $maintenance->issue }}
                                </div>

                            </td>


                            {{-- Priority --}}
                            <td class="px-4 py-3">

                                @php

                                    $priority = $maintenance->priority ?? 'Medium';

                                    $priorityClasses = [

                                        'Low' =>
                                            'bg-gray-100 text-gray-600',

                                        'Medium' =>
                                            'bg-yellow-100 text-yellow-700',

                                        'High' =>
                                            'bg-orange-100 text-orange-700',

                                        'Critical' =>
                                            'bg-red-100 text-red-700',

                                    ];

                                @endphp

                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium {{ $priorityClasses[$priority] ?? 'bg-gray-100 text-gray-600' }}"
                                >
                                    {{ $priority }}
                                </span>

                            </td>


                            {{-- Start Date --}}
                            <td class="px-4 py-3 text-gray-500 whitespace-nowrap">

                                {{ $maintenance->start_date
                                    ? \Carbon\Carbon::parse($maintenance->start_date)->format('M d, Y')
                                    : 'N/A'
                                }}

                            </td>


                            {{-- End Date --}}
                            <td class="px-4 py-3 text-gray-500 whitespace-nowrap">

                                {{ $maintenance->end_date
                                    ? \Carbon\Carbon::parse($maintenance->end_date)->format('M d, Y')
                                    : '—'
                                }}

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3">

                                @php

                                    $statusClasses = [

                                        'Open' =>
                                            'bg-red-100 text-red-600',

                                        'In Progress' =>
                                            'bg-blue-100 text-blue-600',

                                        'Completed' =>
                                            'bg-green-100 text-green-600',

                                        'Cancelled' =>
                                            'bg-gray-100 text-gray-600',

                                    ];

                                @endphp

                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClasses[$maintenance->status] ?? 'bg-gray-100 text-gray-600' }}"
                                >
                                    {{ $maintenance->status }}
                                </span>

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center justify-end gap-3">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('locker_maintenance.show', $maintenance) }}"
                                        class="text-gray-500 hover:text-blue-600"
                                        title="View"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('locker_maintenance.edit', $maintenance) }}"
                                        class="text-gray-500 hover:text-blue-600"
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
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
                                            class="text-gray-500 hover:text-red-600"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- No Data --}}
                        <tr>

                            <td
                                colspan="8"
                                class="px-4 py-12 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <i class="fa-solid fa-screwdriver-wrench text-3xl text-gray-300 mb-3"></i>

                                    <p class="font-medium text-gray-600">
                                        No maintenance tickets found
                                    </p>

                                    <p class="text-sm text-gray-400 mt-1">
                                        Create a maintenance ticket to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ============================= --}}
        {{-- Pagination --}}
        {{-- ============================= --}}

        @if($maintenances->hasPages())

            <div class="px-4 py-3 border-t border-gray-200 flex items-center justify-between">

                <p class="text-xs text-gray-500">

                    Showing
                    {{ $maintenances->firstItem() ?? 0 }}
                    -
                    {{ $maintenances->lastItem() ?? 0 }}
                    of
                    {{ $maintenances->total() }}
                    maintenance tickets

                </p>

                <div>
                    {{ $maintenances->links() }}
                </div>

            </div>

        @else

            <div class="px-4 py-3 border-t border-gray-200">

                <p class="text-xs text-gray-500">

                    Showing
                    {{ $maintenances->count() }}
                    maintenance tickets

                </p>

            </div>

        @endif

    </div>

</div>

@endsection