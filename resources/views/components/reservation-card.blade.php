@props(['reservation'])

@php
    $statusStyles = match($reservation->status) {
        'confirmed', 'active' => 'bg-green-50 text-green-600',
        'pending'             => 'bg-yellow-50 text-yellow-600',
        'expired', 'cancelled'=> 'bg-red-50 text-red-500',
        default               => 'bg-gray-50 text-gray-500',
    };

    $startTime = \Carbon\Carbon::parse($reservation->start_time);

    $endTime = $startTime->copy()->addHours($reservation->duration);
@endphp

<div class="bg-white border border-gray-200 rounded-[18px] min-h-[198px] px-6 py-6 mb-6 flex items-center justify-between shadow-[0_8px_20px_rgba(35,52,80,0.12)]">

    <div class="flex flex-col gap-4">

        <!-- Locker -->
        <div class="flex items-center gap-3">

            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="5" y="3" width="14" height="18" rx="1" stroke-width="2"/>
                <line x1="9" y1="3" x2="9" y2="21" stroke-width="2"/>
                <circle cx="7" cy="12" r="0.5"/>
            </svg>

            <h3 class="text-lg font-bold">
                {{ $reservation->locker->name }}
            </h3>

        </div>


        <!-- Location -->
        <div class="flex items-center gap-3 text-[15px] text-slate-500">

            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"/>
                <circle cx="12" cy="10" r="2.5"/>
            </svg>

            <span>
                {{ $reservation->locker->location->building ?? '-' }}

                @if ($reservation->locker->location?->floor)
                    • Floor {{ $reservation->locker->location->floor }}
                @endif
            </span>

        </div>


        <!-- Date & Time -->
        <p class="text-[15px] text-slate-500">

            {{ $startTime->format('d M') }}
            •
            {{ $startTime->format('g:i A') }}
            -
            {{ $endTime->format('g:i A') }}

        </p>


        <!-- Status -->
        <span class="w-fit px-3 py-1.5 rounded-full {{ $statusStyles }} text-xs font-semibold">

            Status: {{ ucfirst($reservation->status) }}

        </span>

    </div>


    <!-- View Reservation -->
    <a
        href="{{ route('reservation.show', $reservation->id) }}"
        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition"
    >
        View QR
    </a>

</div>