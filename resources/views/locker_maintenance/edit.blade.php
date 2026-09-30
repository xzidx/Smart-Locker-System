@extends('layouts.app')

@section('title', 'Edit Maintenance')

@section('page-title', 'Edit Maintenance')

@section('page-description', 'Update locker maintenance information')

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


    {{-- Page Header --}}
    <div class="mb-8">

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Locker Maintenance
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Update the maintenance information for this locker.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-700">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">


        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-gray-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">

                    <i class="fa-solid fa-pen-to-square text-blue-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Maintenance Information
                    </h2>

                    <p class="text-sm text-gray-500">
                        Update the details below.
                    </p>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('locker_maintenance.update', $lockerMaintenance->id) }}"
            method="POST"
            class="p-6">

            @csrf
            @method('PUT')


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Locker --}}
                <div class="md:col-span-2">

                    <label
                        for="locker_id"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Locker <span class="text-red-500">*</span>

                    </label>


                    <select
                        id="locker_id"
                        name="locker_id"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">

                        <option value="">
                            Select a locker
                        </option>


                        @foreach ($lockers as $locker)

                            <option
                                value="{{ $locker->id }}"
                                {{ old('locker_id', $lockerMaintenance->locker_id) == $locker->id ? 'selected' : '' }}>

                                {{ $locker->name }}

                            </option>

                        @endforeach

                    </select>


                    @error('locker_id')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Issue --}}
                <div class="md:col-span-2">

                    <label
                        for="issue"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Issue <span class="text-red-500">*</span>

                    </label>


                    <input
                        type="text"
                        id="issue"
                        name="issue"
                        value="{{ old('issue', $lockerMaintenance->issue) }}"
                        placeholder="Example: Lock is not working"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">


                    @error('issue')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Description

                    </label>


                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe the maintenance issue..."
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">{{ old('description', $lockerMaintenance->description) }}</textarea>


                    @error('description')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Start Date --}}
                <div>

                    <label
                        for="start_date"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Start Date <span class="text-red-500">*</span>

                    </label>


                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date', $lockerMaintenance->start_date) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">


                    @error('start_date')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- End Date --}}
                <div>

                    <label
                        for="end_date"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        End Date

                    </label>


                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date', $lockerMaintenance->end_date) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">


                    <p class="mt-1 text-xs text-gray-500">
                        Leave empty if maintenance is still ongoing.
                    </p>


                    @error('end_date')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Status --}}
                <div class="md:col-span-2">

                    <label
                        for="status"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Status <span class="text-red-500">*</span>

                    </label>


                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">

                        <option
                            value="Open"
                            {{ old('status', $lockerMaintenance->status) == 'Open' ? 'selected' : '' }}>

                            Open

                        </option>


                        <option
                            value="In Progress"
                            {{ old('status', $lockerMaintenance->status) == 'In Progress' ? 'selected' : '' }}>

                            In Progress

                        </option>


                        <option
                            value="Completed"
                            {{ old('status', $lockerMaintenance->status) == 'Completed' ? 'selected' : '' }}>

                            Completed

                        </option>

                    </select>


                    @error('status')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-gray-200">


                {{-- Cancel --}}
                <a
                    href="{{ route('locker_maintenance.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">

                    Cancel

                </a>


                {{-- Update --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Update Maintenance

                </button>

            </div>


        </form>

    </div>

</div>

@endsection

