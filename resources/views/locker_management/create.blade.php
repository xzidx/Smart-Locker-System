@extends('layouts.app')

@section('title', 'Add Locker')

@section('page-title', 'Add Locker')

@section('page-description', 'Create a new locker')

@section('content')

<div class="w-full p-8">

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">
            <ul class="list-disc pl-5 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- BACK --}}
    <div class="mb-6">
        @if ($location)
            <a
                href="{{ route('locations-management.show', $location) }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-blue-600"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 18l-6-6 6-6"
                    />
                </svg>

                Back to {{ $location->name }}
            </a>
        @else
            <a
                href="{{ route('locker-management.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-blue-600"
            >
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 18l-6-6 6-6"
                    />
                </svg>

                Back to Lockers
            </a>
        @endif
    </div>


    {{-- FORM CARD --}}
    <div class="mx-auto max-w-3xl">

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}
            <div class="border-b border-slate-200 px-6 py-5">

                <h1 class="text-xl font-bold text-slate-900">
                    Add New Locker
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Create a locker and assign it to a location.
                </p>

            </div>


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('locker-management.store') }}"
                class="space-y-6 p-6"
            >

                @csrf


                {{-- LOCKER NAME --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Locker Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Example: A01"
                        required
                        class="h-11 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- LOCATION --}}
                <div>

                    <label
                        for="location_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Location
                    </label>

                    <select
                        id="location_id"
                        name="location_id"
                        required
                        class="h-11 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >

                        <option value="">
                            Select Location
                        </option>

                        @foreach ($locations as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected(old('location_id', $location?->id) == $item->id)
                            >
                                {{ $item->name }}
                                — {{ $item->building }}
                                — Floor {{ $item->floor }}
                            </option>

                        @endforeach

                    </select>

                    @error('location_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="h-11 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >

                        <option
                            value="available"
                            @selected(old('status', 'available') === 'available')
                        >
                            Available
                        </option>

                        <option
                            value="occupied"
                            @selected(old('status') === 'occupied')
                        >
                            Occupied
                        </option>

                        <option
                            value="maintenance"
                            @selected(old('status') === 'maintenance')
                        >
                            Maintenance
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- BUTTONS --}}
                <div class="flex items-center justify-end gap-3 border-t border-slate-200 pt-6">

                    @if ($location)

                        <a
                            href="{{ route('locations-management.show', $location) }}"
                            class="inline-flex h-10 items-center rounded-lg border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                        >
                            Cancel
                        </a>

                    @else

                        <a
                            href="{{ route('locker-management.index') }}"
                            class="inline-flex h-10 items-center rounded-lg border border-slate-200 bg-white px-5 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                        >
                            Cancel
                        </a>

                    @endif


                    <button
                        type="submit"
                        class="inline-flex h-10 items-center gap-2 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        Create Locker

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection