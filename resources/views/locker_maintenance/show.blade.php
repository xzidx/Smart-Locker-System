@extends('layouts.app')

@section('title', 'Maintenance Details')

@section('page-title', 'Maintenance Details')

@section('page-description', 'View locker maintenance information')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('locker_maintenance.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Maintenance
        </a>
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Maintenance Details
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                View the details of this locker maintenance record.
            </p>
        </div>

        {{-- Edit Button --}}
        <a href="{{ route('locker_maintenance.edit', $lockerMaintenance->id) }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">

            <i class="fa-solid fa-pen-to-square"></i>

            Edit Maintenance
        </a>

    </div>


    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-screwdriver-wrench text-blue-600 text-lg"></i>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        Locker Maintenance
                    </h2>

                    <p class="text-sm text-gray-500">
                        Maintenance record #{{ $lockerMaintenance->id }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Information --}}
        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Locker --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Locker
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">
                            <i class="fa-solid fa-box text-gray-600"></i>
                        </div>

                        <p class="text-base font-semibold text-gray-900">
                            {{ $lockerMaintenance->locker->name ?? 'N/A' }}
                        </p>

                    </div>
                </div>


                {{-- Status --}}
                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Status
                    </p>

                    <div class="mt-2">

                        @if ($lockerMaintenance->status === 'Completed')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                Completed
                            </span>

                        @elseif ($lockerMaintenance->status === 'In Progress')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                In Progress
                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Open
                            </span>

                        @endif

                    </div>
                </div>


                {{-- Issue --}}
                <div class="md:col-span-2">

                    <p class="text-sm font-medium text-gray-500">
                        Issue
                    </p>

                    <p class="mt-2 text-base font-semibold text-gray-900">
                        {{ $lockerMaintenance->issue }}
                    </p>

                </div>


                {{-- Description --}}
                <div class="md:col-span-2">

                    <p class="text-sm font-medium text-gray-500">
                        Description
                    </p>

                    <div class="mt-2 rounded-lg bg-gray-50 border border-gray-200 p-4">

                        <p class="text-sm leading-6 text-gray-700">
                            {{ $lockerMaintenance->description ?: 'No description provided.' }}
                        </p>

                    </div>

                </div>


                {{-- Start Date --}}
                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Start Date
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <i class="fa-regular fa-calendar text-blue-600"></i>

                        <p class="text-sm font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($lockerMaintenance->start_date)->format('d M Y') }}
                        </p>

                    </div>

                </div>


                {{-- End Date --}}
                <div>

                    <p class="text-sm font-medium text-gray-500">
                        End Date
                    </p>

                    <div class="mt-2 flex items-center gap-2">

                        <i class="fa-regular fa-calendar-check text-green-600"></i>

                        <p class="text-sm font-semibold text-gray-900">

                            @if ($lockerMaintenance->end_date)

                                {{ \Carbon\Carbon::parse($lockerMaintenance->end_date)->format('d M Y') }}

                            @else

                                <span class="text-gray-400">
                                    Ongoing
                                </span>

                            @endif

                        </p>

                    </div>

                </div>


                {{-- Created At --}}
                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Created At
                    </p>

                    <p class="mt-2 text-sm text-gray-700">
                        {{ $lockerMaintenance->created_at?->format('d M Y, h:i A') }}
                    </p>

                </div>


                {{-- Updated At --}}
                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Last Updated
                    </p>

                    <p class="mt-2 text-sm text-gray-700">
                        {{ $lockerMaintenance->updated_at?->format('d M Y, h:i A') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="px-6 py-5 border-t border-gray-200 bg-gray-50">

            <div class="flex flex-col sm:flex-row sm:justify-between gap-3">

                {{-- Back --}}
                <a href="{{ route('locker_maintenance.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">

                    <i class="fa-solid fa-arrow-left"></i>

                    Back
                </a>


                {{-- Edit --}}
                <a href="{{ route('locker_maintenance.edit', $lockerMaintenance->id) }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">

                    <i class="fa-solid fa-pen-to-square"></i>

                    Edit Maintenance
                </a>

            </div>

        </div>

    </div>

</div>

@endsection