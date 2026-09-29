@extends('layouts.app')

@section('title', $location->name)

@section('page-title', $location->name)

@section('page-description', 'View available lockers at this location')

@section('content')

<div class="p-8">

<div class="w-full space-y-5 pb-8">

    {{-- LOCATION INFORMATION --}}
    <div class="px-2">

        <span class="text-xs font-bold tracking-wider text-slate-500 uppercase">
            {{ $location->building }}
        </span>

        <h2 class="text-2xl font-black text-slate-900">
            {{ $location->name }}
        </h2>

        <p class="text-sm text-slate-600">
            {{ $location->address }}
            &bull;
            Floor {{ $location->floor }}
        </p>

    </div>


    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- LEFT SIDE --}}
        <div
            class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative min-h-[500px] lg:min-h-[660px] flex flex-col"
        >

            <div class="absolute inset-0 bg-slate-100 flex items-center justify-center">

                <div class="text-center p-6">

                    <i
                        class="fa-solid fa-map-location-dot text-6xl text-slate-300 mb-3"
                    ></i>

                    <p class="text-base font-semibold text-slate-600">
                        {{ $location->name }}
                    </p>

                    <span
                        class="inline-block mt-2 px-3.5 py-1.5 bg-white rounded-full shadow-sm text-sm font-bold text-[#2563EB] border border-slate-200"
                    >
                        <i class="fa-solid fa-location-dot text-red-500 mr-1.5"></i>

                        {{ $location->address }}
                    </span>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div
            class="lg:col-span-5 bg-white rounded-2xl shadow-sm border border-slate-200 p-6 lg:p-7 flex flex-col space-y-6"
        >

            {{-- HEADER --}}
            <div class="border-b border-slate-100 pb-4">

                <div class="flex items-center justify-between">

                    <h3 class="text-lg font-bold text-slate-900">
                        Locker Details
                    </h3>

                    <span
                        class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200"
                    >
                        Free Rental Service
                    </span>

                </div>

                <p class="text-sm text-slate-600 mt-1.5">
                    {{ $location->address }}
                </p>

                <p class="text-sm text-slate-600">
                    {{ $location->building }}
                    &bull;
                    Floor {{ $location->floor }}
                </p>

                @php
                    $availableLockers = $location->lockers
                        ->where('status', 'available')
                        ->count();

                    $totalLockers = $location->lockers->count();
                @endphp

                <div class="mt-3.5 flex items-center justify-between">

                    <span
                        class="text-xs font-bold text-emerald-600 bg-emerald-50/80 px-2.5 py-1 rounded-md"
                    >
                        {{ $availableLockers }} lockers available
                    </span>

                    <span
                        class="text-xs font-bold text-[#2563EB] bg-blue-50 px-2.5 py-1 rounded-md"
                    >
                        {{ $totalLockers }} total
                    </span>

                </div>

            </div>


            {{-- SECURITY --}}
            <div
                class="bg-slate-50 rounded-xl p-4 border border-slate-200/80 flex items-center space-x-3.5"
            >

                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 text-[#2563EB] flex items-center justify-center shrink-0"
                >
                    <i class="fa-solid fa-shield-halved text-base"></i>
                </div>

                <div>

                    <h4 class="text-sm font-bold text-slate-900">
                        Security & Access
                    </h4>

                    <p class="text-xs text-slate-600">
                        Secure locker access for users
                    </p>

                </div>

            </div>


            {{-- LOCKERS --}}
            <div>

                <div class="flex items-center justify-between mb-3.5">

                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">
                        Choose a locker
                    </h4>

                    <span class="text-xs font-medium text-slate-500">
                        Free Access
                    </span>

                </div>


                @if($location->lockers->count() > 0)

                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">

                        @foreach ($location->lockers as $locker)

                            @php
                                $isAvailable = strtolower($locker->status) === 'available';
                            @endphp

                            @if($isAvailable)

                                {{-- AVAILABLE LOCKER --}}
                                <a
                                    href="{{ route('lockers.show', $locker->id) }}"
                                    class="flex flex-col items-center justify-center py-3 px-2 rounded-xl border
                                    border-slate-200 bg-white hover:border-[#2563EB] hover:bg-blue-50/30
                                    cursor-pointer transition-all text-center group"
                                >

                                    <i
                                        class="fa-solid fa-box-archive text-slate-400 group-hover:text-[#2563EB] text-lg mb-1.5"
                                    ></i>

                                    <span class="text-xs font-extrabold text-slate-900">
                                        {{ $locker->name }}
                                    </span>

                                    <span class="text-[11px] font-semibold mt-0.5 text-emerald-600">
                                        {{ ucfirst($locker->status) }}
                                    </span>

                                </a>

                            @else

                                {{-- UNAVAILABLE LOCKER --}}
                                <div
                                    class="flex flex-col items-center justify-center py-3 px-2 rounded-xl border
                                    border-red-100 bg-red-50 cursor-not-allowed opacity-60
                                    transition-all text-center"
                                >

                                    <i
                                        class="fa-solid fa-box-archive text-red-400 text-lg mb-1.5"
                                    ></i>

                                    <span class="text-xs font-extrabold text-slate-900">
                                        {{ $locker->name }}
                                    </span>

                                    <span class="text-[11px] font-semibold mt-0.5 text-red-600">
                                        {{ ucfirst($locker->status) }}
                                    </span>

                                </div>

                            @endif

                        @endforeach

                    </div>

                @else

                    <div class="text-center py-8">

                        <i class="fa-solid fa-box-open text-4xl text-gray-300"></i>

                        <p class="text-sm font-semibold text-gray-600 mt-3">
                            No lockers available
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            This location does not have any lockers yet.
                        </p>

                    </div>

                @endif

            </div>


            {{-- SUPPORT --}}
            <div
                class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100"
            >

                <p class="flex items-center">
                    <i class="fa-solid fa-headset w-5 text-slate-400 text-sm"></i>
                    Contact System Support
                </p>

                <p class="flex items-center">
                    <i class="fa-solid fa-location-arrow w-5 text-slate-400 text-sm"></i>
                    {{ $location->address }}
                </p>

            </div>

        </div>

    </div>

</div>

</div>

@endsection