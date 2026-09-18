<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">

    <div class="min-h-screen px-4 py-8 sm:px-8">
        <div class="mx-auto max-w-5xl space-y-6">

            {{-- Header --}}
            <div>
                <p class="text-xs font-semibold tracking-wide text-blue-600">
                    GOOD MORNING, {{ strtoupper($userName ?? 'RAKSA') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">Find a locker nearby</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Live availability across {{ $locationCount ?? 26 }} secure locations.
                </p>
            </div>

            {{-- Search --}}
            <form action="#" method="GET" class="relative">
                <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <input
                    type="text"
                    name="q"
                    placeholder="Search address, neighborhood or landmark"
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-700
                           shadow-sm placeholder:text-slate-400 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100"
                >
            </form>

            {{-- Stat cards --}}
            @php
                $stats = $stats ?? [
                    ['label' => 'Total Users',       'value' => '2,846', 'change' => '+13.5%',      'bg' => 'bg-blue-50',    'icon' => 'text-blue-600',    'change_color' => 'text-blue-600',    'icon_name' => 'users'],
                    ['label' => 'Available Lockers', 'value' => '384',   'change' => '62% of fleet', 'bg' => 'bg-emerald-50', 'icon' => 'text-emerald-600', 'change_color' => 'text-emerald-600', 'icon_name' => 'lock-open'],
                    ['label' => 'Occupied Lockers',  'value' => '196',   'change' => '32% of fleet', 'bg' => 'bg-rose-50',    'icon' => 'text-rose-500',    'change_color' => 'text-rose-500',    'icon_name' => 'lock-closed'],
                    ['label' => 'Active Bookings',   'value' => '214',   'change' => '+8 today',     'bg' => 'bg-violet-50',  'icon' => 'text-violet-600',  'change_color' => 'text-violet-600',  'icon_name' => 'calendar'],
                ];
            @endphp
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($stats as $stat)
                    <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between">
                            <span class="text-xs font-medium text-slate-500">{{ $stat['label'] }}</span>
                            <span class="flex h-8 w-8 items-center justify-center rounded-full {{ $stat['bg'] }} {{ $stat['icon'] }}">
                                @switch($stat['icon_name'])
                                    @case('users')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m5-6.13a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 10-8 0" />
                                        </svg>
                                        @break
                                    @case('lock-open')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0M6 11h12a1 1 0 011 1v8a1 1 0 01-1 1H6a1 1 0 01-1-1v-8a1 1 0 011-1z" />
                                        </svg>
                                        @break
                                    @case('lock-closed')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a1 1 0 001-1v-8a1 1 0 00-1-1H6a1 1 0 00-1 1v8a1 1 0 001 1zm1-13a4 4 0 118 0v3H7V7z" />
                                        </svg>
                                        @break
                                    @case('calendar')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        @break
                                @endswitch
                            </span>
                        </div>
                        <p class="mt-3 text-2xl font-bold text-slate-900">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-xs font-medium {{ $stat['change_color'] }}">{{ $stat['change'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Recent reservations --}}
            @php
                $recentReservations = $recentReservations ?? [
                    ['title' => 'Union Square · Locker A12', 'time' => 'Today, 2:30–6:30 PM', 'status' => 'Active'],
                ];
            @endphp
            <div>
                <h2 class="mb-3 text-sm font-semibold text-slate-900">Recent reservations</h2>
                <div class="rounded-xl border border-slate-100 bg-white shadow-sm">
                    @foreach ($recentReservations as $reservation)
                        <div class="flex items-center justify-between px-4 py-4 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                            <div>
                                <p class="text-sm font-medium text-slate-900">{{ $reservation['title'] }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">{{ $reservation['time'] }}</p>
                            </div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-600">
                                {{ $reservation['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Nearby locations --}}
            @php
                $nearbyLocations = $nearbyLocations ?? [
                    ['name' => 'Union Square Lockers', 'address' => '333 Post Street', 'hours' => '6:00 AM–11:00 PM', 'available' => 18],
                    ['name' => 'Union Square Lockers', 'address' => '333 Post Street', 'hours' => '6:00 AM–11:00 PM', 'available' => 18],
                ];
            @endphp
            <div>
                <h2 class="mb-3 text-sm font-semibold text-slate-900">Nearby locations</h2>
                <div class="space-y-3">
                    @foreach ($nearbyLocations as $location)
                        <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">
                            <p class="text-sm font-semibold text-slate-900">{{ $location['name'] }}</p>
                            <p class="mt-0.5 text-xs text-slate-500">
                                {{ $location['address'] }} · Open daily {{ $location['hours'] }}
                            </p>
                            <span class="mt-2 inline-block rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-600">
                                {{ $location['available'] }} available
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</body>
</html>