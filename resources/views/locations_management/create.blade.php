@extends('layouts.app')

@section('title', 'Add Location')
@section('page-title', 'Add Location')
@section('page-description', 'Create a new locker location')

@section('content')
<div class="mx-auto max-w-3xl p-8">
    <form method="POST" action="{{ route('locations-management.store') }}"
          class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Location Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Address</label>
                <input type="text" name="address" value="{{ old('address') }}"
                       class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Building</label>
                <input type="text" name="building" value="{{ old('building') }}"
                       class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('building') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Floor</label>
                <input type="text" name="floor" value="{{ old('floor') }}"
                       class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('floor') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="h-10 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-blue-700">Save</button>
            <a href="{{ route('locations-management.index') }}"
               class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-5 text-sm text-slate-600 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>
@endsection