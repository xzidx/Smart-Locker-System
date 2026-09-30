@extends('layouts.app')

@section('title', 'Create Maintenance Request')

@section('content')

<div class="min-h-screen bg-[#f5f8fc] px-6 py-8">

    {{-- Header --}}
    <div class="mx-auto mb-6 w-full max-w-5xl">

        <a
            href="{{ route('locker_maintenance.index') }}"
            class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-blue-600"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Maintenance
        </a>

        <h1 class="text-3xl font-bold text-slate-800">
            Create Maintenance Request
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Report a problem with a locker for staff to review.
        </p>

    </div>


    {{-- Main Form --}}
    <div class="mx-auto w-full max-w-5xl">

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            {{-- Selected Locker --}}
            <div class="mb-8 rounded-xl border border-blue-100 bg-blue-50 p-5">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div>

                        <p class="text-sm font-medium text-blue-600">
                            Selected Locker
                        </p>

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $locker->name }}
                        </h2>

                        <div class="mt-1 flex flex-wrap gap-5 text-sm text-slate-500">

                            <span>
                                <strong class="text-slate-600">
                                    Locker ID:
                                </strong>
                                #{{ $locker->id }}
                            </span>

                            @if ($locker->location)

                                <span>
                                    <strong class="text-slate-600">
                                        Location:
                                    </strong>
                                    {{ $locker->location->name }}
                                </span>

                                @if ($locker->location->floor)

                                    <span>
                                        <strong class="text-slate-600">
                                            Floor:
                                        </strong>
                                        {{ $locker->location->floor }}
                                    </span>

                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- Form --}}
            <form
                method="POST"
                action="{{ route('locker_maintenance.store') }}"
                class="space-y-7"
            >

                @csrf


                {{-- Locker ID --}}
                <input
                    type="hidden"
                    name="locker_id"
                    value="{{ $locker->id }}"
                >


                {{-- Issue --}}
                <div>

                    <label
                        for="issue"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Issue
                    </label>

                    <input
                        type="text"
                        id="issue"
                        name="issue"
                        value="{{ old('issue') }}"
                        placeholder="Example: Locker door is damaged"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('issue')

                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label
                        for="description"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Problem Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        placeholder="Please describe the problem with this locker..."
                        class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Dates --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Start Date --}}
                    <div>

                        <label
                            for="start_date"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Start Date
                        </label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        @error('start_date')

                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- End Date --}}
                    <div>

                        <label
                            for="end_date"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Expected End Date
                            <span class="font-normal text-slate-400">
                                (Optional)
                            </span>
                        </label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ old('end_date') }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        @error('end_date')

                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- Status --}}
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
                        class="w-full rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option
                            value="Open"
                            {{ old('status', 'Open') === 'Open' ? 'selected' : '' }}
                        >
                            Open
                        </option>

                        <option
                            value="In Progress"
                            {{ old('status') === 'In Progress' ? 'selected' : '' }}
                        >
                            In Progress
                        </option>

                    </select>

                    @error('status')

                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('locker_maintenance.index') }}"
                        class="flex items-center justify-center rounded-xl border border-slate-200 px-7 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        Submit Maintenance Request
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection