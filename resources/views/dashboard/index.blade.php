<x-app-layout>

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-8">

        <div class="mx-auto max-w-5xl space-y-6">

            {{-- Header --}}
            <div>
                <p class="text-xs font-semibold tracking-wide text-blue-600">
                    GOOD MORNING,
                    {{ strtoupper(auth()->user()->name ?? 'THERE') }}
                </p>

                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    Find a locker nearby
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Live availability across {{ $locationCount }} secure locations.
                </p>
            </div>


            {{-- Search --}}
            <x-dashboard.search-bar
                :action="route('dashboard')"
            />


            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Total Users --}}
                <x-dashboard.stat-card
                    :label="$stats[0]['label']"
                    :value="$stats[0]['value']"
                    :change="$stats[0]['change']"
                    :tone="$stats[0]['tone']"
                >

                    {{-- Users Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="#2563eb"
                            d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"
                        />
                    </svg>

                </x-dashboard.stat-card>


                {{-- Available Lockers --}}
                <x-dashboard.stat-card
                    :label="$stats[1]['label']"
                    :value="$stats[1]['value']"
                    :change="$stats[1]['change']"
                    :tone="$stats[1]['tone']"
                >

                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#154b1c" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.50"><path d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h4"/><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V8m.719-3.289A4 4 0 0 1 16 7v4M3 3l18 18"/></g></svg>

                </x-dashboard.stat-card>


                {{-- Occupied Lockers --}}
                <x-dashboard.stat-card
                    :label="$stats[2]['label']"
                    :value="$stats[2]['value']"
                    :change="$stats[2]['change']"
                    :tone="$stats[2]['tone']"
                >

                    {{-- Closed Lock Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 15 15"><path fill="#cb1818" d="M14 1.5v12c0 .28-.22.5-.5.5h-12c-.28 0-.5-.22-.5-.5v-12c0-.28.22-.5.5-.5h12c.28 0 .5.22.5.5M13 5h-3v3h3zm-2 4h-1v1h1zm2 0h-1v1h1zM2 5v2h3V5zm0 3v2h3V8zm0 3v2h3v-2zm4 0v2h3v-2zm0-3v2h3V8zm0-3v2h3V5zm0-3v2h3V2zM5 2H2v2h3z"/></svg>
                   <!-- <svg xmlns="http://www.w3.org/2000/svg" width="4" height="24" viewBox="0 0 24 24"><path fill="#b71a1a" d="M24 7.88a2.5 2.5 0 0 0-2.5-2.5h-4.25a.5.5 0 0 1-.5-.5v-.76a2.51 2.51 0 0 0-2.5-2.5h-4.5a2.51 2.51 0 0 0-2.5 2.5v.76a.5.5 0 0 1-.5.5H2.5A2.5 2.5 0 0 0 0 7.88v12a2.51 2.51 0 0 0 2.5 2.5h19a2.51 2.51 0 0 0 2.5-2.5ZM9.25 4.12a.51.51 0 0 1 .5-.5h4.5a.51.51 0 0 1 .5.5v.76a.5.5 0 0 1-.5.5h-4.5a.5.5 0 0 1-.5-.5ZM15 17.88a3.53 3.53 0 0 1-2.73-1.32a.48.48 0 0 0-.39-.18H6.5a.5.5 0 0 1-.35-.15l-1.5-1.5a.5.5 0 0 1 0-.71l1.5-1.5a.5.5 0 0 1 .35-.14h5.38a.49.49 0 0 0 .39-.19A3.5 3.5 0 1 1 15 17.88"/><path fill="#212121" d="M15 12.88a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5"/></svg> -->

                </x-dashboard.stat-card>


                {{-- Reservations --}}
                <x-dashboard.stat-card
                    :label="$stats[3]['label']"
                    :value="$stats[3]['value']"
                    :change="$stats[3]['change']"
                    :tone="$stats[3]['tone']"
                >

                    {{-- Calendar Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="#7c3aed"
                            d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 16H5V9h14z"
                        />
                    </svg>

                </x-dashboard.stat-card>

            </div>


            {{-- Recent Reservations --}}
            <div>

                <h2 class="mb-3 text-sm font-semibold text-slate-900">
                    Recent reservations
                </h2>

                <div class="rounded-xl border border-slate-100 bg-white shadow-sm">

                    @forelse ($recentReservations as $reservation)

                        <x-dashboard.reservation-item
                            :title="$reservation->locker->location->name . ' · Locker ' . $reservation->locker->code"
                            :time="$reservation->time_range_label"
                            :status="ucfirst($reservation->status)"
                            :last="$loop->last"
                        />

                    @empty

                        <p class="px-4 py-6 text-sm text-slate-400">
                            No reservations yet.
                        </p>

                    @endforelse

                </div>

            </div>


            {{-- Nearby Locations --}}
            <div>

                <h2 class="mb-3 text-sm font-semibold text-slate-900">
                    Nearby locations
                </h2>

                <div class="space-y-3">

                    @forelse ($nearbyLocations as $location)

                        <x-dashboard.location-card
                            :name="$location->name"
                            :address="$location->address"
                            :hours="$location->hours_label"
                            :available="$location->available_lockers_count"
                        />

                    @empty

                        <p class="text-sm text-slate-400">
                            No locations found.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>