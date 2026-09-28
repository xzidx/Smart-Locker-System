@extends('layouts.app')

@section('title', 'Locations')

@section('page-title', 'Locations')

@section('page-description', 'Manage your locations')
@section('content')

    <div class="p-8">

        @php
    $lockers = array(
        array('id' => 'L-101'),
        array('id' => 'L-102'),
        array('id' => 'L-103'),
        array('id' => 'L-104'),
        array('id' => 'L-105'),
        array('id' => 'L-106'),
        array('id' => 'L-107'),
        array('id' => 'L-108'),
        array('id' => 'L-109'),
        array('id' => 'L-110'),
        array('id' => 'L-111'),
        array('id' => 'L-112')
    );
@endphp

<div class="w-full space-y-5 pb-8">
    
    <!-- Section Title Info -->
    <div class="px-2">
        <span class="text-xs font-bold tracking-wider text-slate-500 uppercase">San Francisco</span>
        <h2 class="text-2xl font-black text-slate-900">Union Square Lockers</h2>
        <p class="text-sm text-slate-600">333 Post Street &bull; Open daily 6:00 AM–11:00 PM</p>
    </div>

    <!-- Main Grid Layout (Map + Panel) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Side: Interactive Map Simulation -->
        <div class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden relative min-h-[500px] lg:min-h-[660px] flex flex-col">
            <div class="absolute inset-0 bg-slate-100 flex items-center justify-center">
                <div class="text-center p-6">
                    <i class="fa-solid fa-map-location-dot text-6xl text-slate-300 mb-3 animate-pulse"></i>
                    <p class="text-base font-semibold text-slate-600">Interactive Map View (San Francisco)</p>
                    <span class="inline-block mt-2 px-3.5 py-1.5 bg-white rounded-full shadow-xs text-sm font-bold text-[#2563EB] border border-slate-200">
                        <i class="fa-solid fa-location-dot text-red-500 mr-1.5"></i> 333 Post Street
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Side: Locker Details & Selection Panel -->
        <div class="lg:col-span-5 bg-white rounded-2xl shadow-sm border border-slate-200 p-6 lg:p-7 flex flex-col space-y-6">
            
            <!-- Header Info -->
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Locker Details & Selection</h3>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">
                        Free Rental Service
                    </span>
                </div>
                <p class="text-sm text-slate-600 mt-1.5">333 Post Street, San Francisco, CA 94108</p>
                <p class="text-sm text-slate-600">Open daily 6:00 AM–11:00 PM</p>
                <div class="mt-3.5 flex items-center justify-between">
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50/80 px-2.5 py-1 rounded-md">18 lockers available</span>
                    <span class="text-xs font-bold text-[#2563EB] bg-blue-50 px-2.5 py-1 rounded-md">Cost: $0.00 (Free)</span>
                </div>
            </div>

            <!-- Security & Access Banner -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200/80 flex items-center space-x-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#2563EB] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-shield-halved text-base"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">Security & Access</h4>
                    <p class="text-xs text-slate-600">24/7 CCTV Surveillance & Staff On-site</p>
                </div>
            </div>

            <!-- Choose a Locker Section -->
            <div>
                <div class="flex items-center justify-between mb-3.5">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Choose a locker</h4>
                    <span class="text-xs font-medium text-slate-500">Uniform Size &bull; Free Access</span>
                </div>

                <!-- Uniform Locker Grid -->
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                    @foreach ($lockers as $locker)
                        <button type="button" 
                                class="locker-btn flex flex-col items-center justify-center py-3 px-2 rounded-xl border border-slate-200 bg-white hover:border-[#2563EB] hover:bg-blue-50/30 transition-all text-center group cursor-pointer" 
                                data-id="{{ $locker['id'] }}">
                            <i class="fa-solid fa-box-archive text-slate-400 group-hover:text-[#2563EB] text-lg mb-1.5"></i>
                            <span class="text-xs font-extrabold text-slate-900">{{ $locker['id'] }}</span>
                            <span class="text-[11px] text-emerald-600 font-semibold mt-0.5">Free</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Support & Directions -->
            <div class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-100">
                <p class="flex items-center"><i class="fa-solid fa-headset w-5 text-slate-400 text-sm"></i> Contact Support: +1 (415) 555-0199</p>
                <p class="flex items-center"><i class="fa-solid fa-compass w-5 text-slate-400 text-sm"></i> Directions available via Google Maps</p>
            </div>

            <!-- Action Button -->
            <button type="button" id="reserve-btn" class="w-full py-3.5 bg-[#2563EB] text-white font-bold rounded-xl shadow-sm hover:bg-blue-700 transition-all text-sm flex items-center justify-center space-x-2 cursor-pointer">
                <i class="fa-solid fa-lock-open text-sm"></i>
                <span>Select Locker to Reserve (Free)</span>
            </button>

        </div>
    </div>
</div>

<!-- Script to handle locker selection state -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lockerBtns = document.querySelectorAll('.locker-btn');
        var reserveBtn = document.getElementById('reserve-btn');
        var selectedLocker = null;

        lockerBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                lockerBtns.forEach(function(b) {
                    b.classList.remove('border-[#2563EB]', 'bg-blue-50/50', 'ring-2', 'ring-[#2563EB]');
                });
                btn.classList.add('border-[#2563EB]', 'bg-blue-50/50', 'ring-2', 'ring-[#2563EB]');
                selectedLocker = btn.getAttribute('data-id');
                reserveBtn.innerHTML = '<i class="fa-solid fa-lock text-sm"></i><span>Reserve Locker ' + selectedLocker + ' (Free)</span>';
            });
        });
    });
</script>

    </div>

@endsection