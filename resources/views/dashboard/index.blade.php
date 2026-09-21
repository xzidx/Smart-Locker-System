<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-8">
        <div class="mx-auto max-w-5xl space-y-6">

            {{-- Header --}}
            <div>
                <p class="text-xs font-semibold tracking-wide text-blue-600">
                    GOOD MORNING, {{ strtoupper(auth()->user()->name ?? 'THERE') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">Find a locker nearby</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Live availability across {{ $locationCount }} secure locations.
                </p>
            </div>

            {{-- Search --}}
            <x-dashboard.search-bar :action="route('dashboard')" />

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($stats as $stat)
                    <x-dashboard.stat-card
                        :label="$stat['label']"
                        :value="$stat['value']"
                        :change="$stat['change']"
                        :tone="$stat['tone']"
                        :icon="$stat['icon']"
                    />
                @endforeach
            </div>

            {{-- Recent reservations --}}
            <div>
                <h2 class="mb-3 text-sm font-semibold text-slate-900">Recent reservations</h2>
                <div class="rounded-xl border border-slate-100 bg-white shadow-sm">
                    @forelse ($recentReservations as $reservation)
                        <x-dashboard.reservation-item
                            :title="$reservation->locker->location->name . ' · Locker ' . $reservation->locker->code"
                            :time="$reservation->time_range_label"
                            :status="ucfirst($reservation->status)"
                            :last="$loop->last"
                        />
                    @empty
                        <p class="px-4 py-6 text-sm text-slate-400">No reservations yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Nearby locations --}}
            <div>
                <h2 class="mb-3 text-sm font-semibold text-slate-900">Nearby locations</h2>
                <div class="space-y-3">
                    @forelse ($nearbyLocations as $location)
                        <x-dashboard.location-card
                            :name="$location->name"
                            :address="$location->address"
                            :hours="$location->hours_label"
                            :available="$location->available_lockers_count"
                        />
                    @empty
                        <p class="text-sm text-slate-400">No locations found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>