@extends('layouts.app')

@section('title', 'Locker Details')

@section('page-title', 'Locker Details')

@section('page-description', 'View locker information and reserve a locker')

@section('content')

<div class="p-8">

    <div class="w-full space-y-6 pb-12">

        <!-- Breadcrumb / Header Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-200 pb-4">

            <a
                href="{{ route('locations.show', $locker->location->id) }}"
                class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-[#2563EB] transition-colors"
            >
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Back to Location
            </a>

            <div class="flex items-center space-x-3 text-xs font-semibold text-slate-600">

                <span>
                    Location:
                    <strong class="text-slate-900">
                        {{ $locker->location->name }}
                    </strong>
                </span>

                <span>&bull;</span>

                <span class="text-emerald-600 font-bold">
                    Online
                </span>

            </div>

        </div>


        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


            <!-- LEFT COLUMN -->
            <div class="lg:col-span-5 space-y-6">


                <!-- Locker Image -->
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs">

                    <div class="relative w-full h-[320px] bg-slate-900">

                        <img
                            src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1000&q=80"
                            alt="Smart Locker"
                            class="w-full h-full object-cover filter contrast-105"
                        >

                        <div class="absolute bottom-3 left-3 bg-slate-900/90 text-white text-xs font-medium px-3 py-1.5 rounded border border-white/10">

                            Locker View
                            &bull;
                            {{ $locker->name }}

                        </div>

                    </div>

                </div>


                <!-- Location Information -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-3">

                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                        Location Information
                    </h3>

                    <div class="space-y-2.5 text-sm">

                        <!-- Location -->
                        <div class="flex justify-between py-1 border-b border-slate-100">

                            <span class="text-slate-500 font-medium">
                                Location
                            </span>

                            <span class="text-slate-900 font-semibold text-right">
                                {{ $locker->location->name }}
                            </span>

                        </div>


                        <!-- Address -->
                        <div class="flex justify-between py-1 border-b border-slate-100">

                            <span class="text-slate-500 font-medium">
                                Address
                            </span>

                            <span class="text-slate-900 font-semibold text-right">
                                {{ $locker->location->address ?: 'Not available' }}
                            </span>

                        </div>


                        <!-- Building -->
                        <div class="flex justify-between py-1 border-b border-slate-100">

                            <span class="text-slate-500 font-medium">
                                Building
                            </span>

                            <span class="text-slate-900 font-semibold">
                                {{ $locker->location->building ?: 'Not available' }}
                            </span>

                        </div>


                        <!-- Floor -->
                        <div class="flex justify-between py-1">

                            <span class="text-slate-500 font-medium">
                                Floor
                            </span>

                            <span class="text-slate-900 font-semibold">
                                {{ $locker->location->floor ?: 'Not available' }}
                            </span>

                        </div>

                    </div>

                </div>


            </div>


            <!-- RIGHT COLUMN -->
            <div class="lg:col-span-7 space-y-6">


                <!-- Main Locker Information -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-4">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <!-- Location -->
                            <span class="text-xs font-bold text-[#2563EB] tracking-wider uppercase">
                                {{ $locker->location->name }}
                            </span>


                            <!-- Locker Name -->
                            <h1 class="text-3xl font-extrabold text-slate-900 mt-1">
                                Locker {{ $locker->name }}
                            </h1>


                            <!-- Description -->
                            <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">

                                This locker is located at
                                {{ $locker->location->name }}.

                            </p>

                        </div>


                        <!-- Status -->
                        @if($locker->status === 'available')

                            <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded border border-emerald-200">
                                Available
                            </span>

                        @elseif($locker->status === 'occupied')

                            <span class="inline-flex items-center px-3 py-1 bg-red-50 text-red-700 text-xs font-bold rounded border border-red-200">
                                Occupied
                            </span>

                        @elseif($locker->status === 'maintenance')

                            <span class="inline-flex items-center px-3 py-1 bg-yellow-50 text-yellow-700 text-xs font-bold rounded border border-yellow-200">
                                Maintenance
                            </span>

                        @else

                            <span class="inline-flex items-center px-3 py-1 bg-gray-50 text-gray-700 text-xs font-bold rounded border border-gray-200">
                                {{ ucfirst($locker->status) }}
                            </span>

                        @endif

                    </div>


                    <!-- Locker Information -->
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">

                        <div>

                            <span class="text-slate-400 block font-semibold uppercase tracking-wider text-xs">
                                Locker
                            </span>

                            <span class="font-bold text-slate-900 text-base mt-0.5 block">
                                {{ $locker->name }}
                            </span>

                        </div>


                        <div>

                            <span class="text-slate-400 block font-semibold uppercase tracking-wider text-xs">
                                Status
                            </span>

                            <span class="font-bold text-slate-900 text-base mt-0.5 block">
                                {{ ucfirst($locker->status) }}
                            </span>

                        </div>

                    </div>


                    <!-- Locker Information -->
                    <div class="text-sm text-slate-700 bg-slate-50 border border-slate-200/60 p-3.5 rounded-lg">

                        <strong class="text-slate-900 font-bold block mb-1">
                            Locker Information:
                        </strong>

                        This locker is located on
                        <strong>
                            {{ $locker->location->floor }}
                        </strong>
                        at
                        <strong>
                            {{ $locker->location->building }}
                        </strong>.

                    </div>

                </div>


                <!-- RESERVATION SECTION -->

                @if($locker->status === 'available')

                    <div class="bg-white border border-slate-200 rounded-xl p-6">

                        <button
                            type="button"
                            id="reserve-btn"
                            class="w-full py-4 bg-[#2563EB] hover:bg-blue-700 text-white font-bold rounded-xl text-sm uppercase tracking-wider transition-colors flex items-center justify-center gap-2"
                        >

                            <i class="fa-solid fa-lock text-sm"></i>

                            <span>
                                Reserve Locker {{ $locker->name }}
                            </span>

                        </button>

                    </div>

                @else

                    <!-- Unavailable Locker -->

                    <div class="bg-white border border-slate-200 rounded-xl p-6">

                        <button
                            type="button"
                            disabled
                            class="w-full py-4 bg-slate-300 text-slate-500 font-bold rounded-xl text-sm uppercase tracking-wider cursor-not-allowed flex items-center justify-center gap-2"
                        >

                            <i class="fa-solid fa-lock text-sm"></i>

                            <span>
                                Locker {{ $locker->name }} Unavailable
                            </span>

                        </button>

                    </div>

                @endif


                <!-- QR Access Information -->

                <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-center space-x-4">

                    <div class="w-14 h-14 bg-slate-100 border border-slate-200 rounded-lg flex items-center justify-center shrink-0">

                        <i class="fa-solid fa-qrcode text-2xl text-slate-900"></i>

                    </div>

                    <div class="space-y-1">

                        <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">
                            Contactless QR Access
                        </h4>

                        <p class="text-xs text-slate-600 leading-relaxed">

                            Scan the locker screen terminal after completing your reservation for instant entry.

                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</div>


<!-- JavaScript -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const reserveBtn = document.getElementById('reserve-btn');

    if (reserveBtn) {

        reserveBtn.addEventListener('click', function () {

            reserveBtn.innerHTML =
                '<i class="fa-solid fa-circle-check text-sm"></i>' +
                '<span>Locker {{ $locker->name }} Selected</span>';

            reserveBtn.classList.remove(
                'bg-[#2563EB]',
                'hover:bg-blue-700'
            );

            reserveBtn.classList.add(
                'bg-emerald-600',
                'cursor-default'
            );

            reserveBtn.disabled = true;

        });

    }

});

</script>

@endsection
