@extends('layouts.app')

@section('title', 'Reserve Locker')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reserve Locker {{ $locker->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body class="bg-[#f5f7fb]">

    <div class="min-h-screen px-6 py-16">

        <div class="mx-auto max-w-[1240px]">

            {{-- HEADER --}}
            <div class="mb-7">

                <div class="mb-3 text-[13px] font-bold uppercase tracking-[1px] text-[#2563eb]">
                    Secure Checkout
                </div>

                <h1 class="text-[32px] font-bold leading-tight text-[#172033]">
                    Reserve Locker {{ $locker->name }}
                </h1>

                <p class="mt-3 text-[15px] text-[#526078]">
                    {{ $location->name }}
                    ·
                    {{ ucfirst($locker->size ?? 'Medium') }} locker
                </p>

            </div>


            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())

                <div class="mb-6 rounded-[12px] border border-red-200 bg-red-50 p-4">

                    <div class="mb-2 font-semibold text-red-700">
                        Please fix the following errors:
                    </div>

                    <ul class="list-disc pl-5 text-[14px] text-red-600">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))

                <div class="mb-6 rounded-[12px] border border-green-200 bg-green-50 p-4 text-[14px] text-green-700">
                    {{ session('success') }}
                </div>

            @endif


            {{-- CONTENT --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1.65fr_1fr]">


                {{-- LEFT CARD --}}
                <div
                    class="rounded-[20px] border border-[#dce3ec] bg-white px-6 py-6 shadow-[0_8px_25px_rgba(15,23,42,0.06)]">

                    {{-- FORM --}}
                    <form
                        action="{{ route('reservation.store') }}"
                        method="POST"
                        id="reservationForm"
                    >

                        @csrf

                        {{-- SEND LOCKER ID --}}
                        <input
                            type="hidden"
                            name="locker_id"
                            value="{{ $locker->id }}"
                        >

                        {{-- SEND LOCATION ID --}}
                        <input
                            type="hidden"
                            name="location_id"
                            value="{{ $location->id }}"
                        >


                        {{-- RESERVATION DETAILS --}}
                        <h2 class="mb-4 text-[18px] font-bold text-black">
                            Reservation details
                        </h2>


                        {{-- START TIME --}}
                        <div class="mb-4">

                            <label
                                for="start_time"
                                class="mb-2 block text-[13px] font-semibold text-[#526078]"
                            >
                                Start time
                            </label>

                            <input
                                id="start_time"
                                type="datetime-local"
                                name="start_time"
                                value="{{ old('start_time') }}"
                                class="h-[49px] w-full rounded-[12px] border border-[#dce3ec] bg-[#f8fafc] px-4 text-[14px] text-[#172033] outline-none focus:border-[#2563eb]"
                                required
                            >

                        </div>


                        {{-- DURATION --}}
                        <div class="mb-4">

                            <label
                                for="duration"
                                class="mb-2 block text-[13px] font-semibold text-[#526078]"
                            >
                                Duration
                            </label>

                            <select
                                id="duration"
                                name="duration"
                                class="h-[49px] w-full rounded-[12px] border border-[#dce3ec] bg-[#f8fafc] px-4 text-[14px] text-[#172033] outline-none focus:border-[#2563eb]"
                                required
                            >

                                <option value="">Select duration</option>

                                <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>
                                    1 Hour
                                </option>

                                <option value="2" {{ old('duration') == 2 ? 'selected' : '' }}>
                                    2 Hours
                                </option>

                                <option value="3" {{ old('duration') == 3 ? 'selected' : '' }}>
                                    3 Hours
                                </option>

                                <option value="4" {{ old('duration') == 4 ? 'selected' : '' }}>
                                    4 Hours
                                </option>

                                <option value="8" {{ old('duration') == 8 ? 'selected' : '' }}>
                                    8 Hours
                                </option>

                                <option value="24" {{ old('duration') == 24 ? 'selected' : '' }}>
                                    24 Hours
                                </option>

                            </select>

                        </div>


                        {{-- END TIME PREVIEW --}}
                        <div
                            id="endTimePreview"
                            class="mb-6 hidden rounded-[12px] border border-blue-100 bg-blue-50 p-4"
                        >

                            <div class="text-[13px] font-semibold text-[#526078]">
                                Reservation ends
                            </div>

                            <div
                                id="endTimeText"
                                class="mt-1 text-[15px] font-bold text-[#2563eb]"
                            ></div>

                        </div>


                        {{-- USER CONTACT --}}
                        <h2 class="mb-4 mt-3 text-[18px] font-bold text-black">
                            User Contact
                        </h2>


                        {{-- NAME --}}
                        <div class="mb-4">

                            <label
                                for="name"
                                class="mb-2 block text-[13px] font-semibold text-[#526078]"
                            >
                                Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name ?? '') }}"
                                class="h-[49px] w-full rounded-[12px] border border-[#dce3ec] bg-[#f8fafc] px-4 text-[14px] text-[#172033] outline-none focus:border-[#2563eb]"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-4">

                            <label
                                for="email"
                                class="mb-2 block text-[13px] font-semibold text-[#526078]"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email ?? '') }}"
                                class="h-[49px] w-full rounded-[12px] border border-[#dce3ec] bg-[#f8fafc] px-4 text-[14px] text-[#172033] outline-none focus:border-[#2563eb]"
                                required
                            >

                        </div>


                        {{-- PHONE --}}
                        <div class="mb-6">

                            <label
                                for="phone"
                                class="mb-2 block text-[13px] font-semibold text-[#526078]"
                            >
                                Phone
                            </label>

                            <input
                                id="phone"
                                type="text"
                                name="phone"
                                value="{{ old('phone', $user->phone ?? '') }}"
                                class="h-[49px] w-full rounded-[12px] border border-[#dce3ec] bg-[#f8fafc] px-4 text-[14px] text-[#172033] outline-none focus:border-[#2563eb]"
                                required
                            >

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="w-full rounded-[12px] bg-[#2864e8] px-5 py-[14px] text-[14px] font-semibold text-white transition hover:bg-[#1f56d0]"
                        >
                            Confirm reservation
                        </button>

                    </form>

                </div>



                {{-- RIGHT CARD --}}
                <div
                    class="h-fit rounded-[20px] border border-[#dce3ec] bg-white px-6 py-6 shadow-[0_8px_25px_rgba(15,23,42,0.06)]">

                    {{-- TITLE --}}
                    <h2 class="mb-4 text-[18px] font-bold text-black">
                        Locker details
                    </h2>


                    {{-- DETAILS --}}
                    <div class="space-y-3 text-[14px] text-[#172033]">

                        <p>
                            <span class="font-bold">Locker:</span>
                            {{ $locker->name }}
                        </p>

                        <p>
                            <span class="font-bold">Locker Size:</span>
                            {{ ucfirst($locker->size ?? 'Medium') }}
                        </p>

                        <p>
                            <span class="font-bold">Status:</span>

                            <span
                                class="
                                    ml-1 rounded-full px-2 py-1 text-[12px] font-semibold
                                    {{ strtolower($locker->status) === 'available'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700'
                                    }}
                                "
                            >
                                {{ ucfirst($locker->status ?? 'Available') }}
                            </span>
                        </p>

                        <p>
                            <span class="font-bold">Location:</span>
                            {{ $location->name }}
                        </p>

                        <p>
                            <span class="font-bold">Address:</span>
                            {{ $location->address }}
                        </p>

                        <p>
                            <span class="font-bold">Building:</span>
                            {{ $location->building }}
                        </p>

                        <p>
                            <span class="font-bold">Floor:</span>
                            {{ $location->floor }}
                        </p>

                        <p>
                            <span class="font-bold">Access:</span>
                            PIN Code will be sent via SMS/Email
                        </p>

                    </div>


                    {{-- MAP --}}
                    @php

                        $latitude = $location->latitude ?? 11.5564;
                        $longitude = $location->longitude ?? 104.9282;

                    @endphp

                    <div
                        class="relative mt-5 h-[278px] overflow-hidden rounded-[20px] bg-[#e8edf2]"
                    >

                        <iframe
                            src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&z=15&output=embed"
                            class="h-full w-full border-0"
                            loading="lazy"
                            allowfullscreen
                        >
                        </iframe>

                    </div>


                    {{-- COORDINATES --}}
                    <div class="mt-3 text-[12px] text-[#718096]">

                        Location coordinates:

                        {{ $latitude }}, {{ $longitude }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DYNAMIC JAVASCRIPT --}}
    <script>

        const startTime = document.getElementById('start_time');
        const duration = document.getElementById('duration');

        const endTimePreview = document.getElementById('endTimePreview');
        const endTimeText = document.getElementById('endTimeText');


        function calculateEndTime() {

            if (!startTime.value || !duration.value) {

                endTimePreview.classList.add('hidden');

                return;
            }


            const start = new Date(startTime.value);

            const hours = parseInt(duration.value);

            start.setHours(start.getHours() + hours);


            const formatted = start.toLocaleString('en-US', {

                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'

            });


            endTimeText.textContent = formatted;

            endTimePreview.classList.remove('hidden');

        }


        startTime.addEventListener('change', calculateEndTime);

        duration.addEventListener('change', calculateEndTime);

    </script>

</body>

</html>


@endsection






