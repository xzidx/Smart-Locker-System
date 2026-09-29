@extends('layouts.app')

@section('title', $location->name)
@section('page-title', $location->name)
@section('page-description', 'Location details')

@section('content')
@php
    $isActive = $location->total_lockers > 0
        && $location->maintenance_count < $location->total_lockers;
@endphp
<div class="mx-auto max-w-3xl space-y-6 p-8">
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">{{ $location->name }}</h2>
            @if ($isActive)
                <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Active</span>
            @else
                <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600">Inactive</span>
            @endif
        </div>
        <dl class="grid gap-4 text-sm sm:grid-cols-3">
            <div><dt class="text-slate-500">Address</dt><dd class="font-medium text-slate-900">{{ $location->address }}</dd></div>
            <div><dt class="text-slate-500">Building</dt><dd class="font-medium text-slate-900">{{ $location->building }}</dd></div>
            <div><dt class="text-slate-500">Floor</dt><dd class="font-medium text-slate-900">{{ $location->floor }}</dd></div>
        </dl>
    </div>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-slate-900">{{ $location->total_lockers }}</p>
            <p class="text-xs text-slate-500">Total</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-green-600">{{ $location->available_count }}</p>
            <p class="text-xs text-slate-500">Available</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-blue-600">{{ $location->occupied_count }}</p>
            <p class="text-xs text-slate-500">Occupied</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4 text-center shadow-sm">
            <p class="text-2xl font-bold text-amber-500">{{ $location->maintenance_count }}</p>
            <p class="text-xs text-slate-500">Maintenance</p>
        </div>
    </div>

    <a href="{{ route('locations-management.index') }}" class="inline-block text-sm text-blue-600 hover:underline">&larr; Back to list</a>
</div>
@endsection