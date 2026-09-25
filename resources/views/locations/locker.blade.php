@extends('layouts.app')

@section('title', 'Locations')

@section('page-title', 'Locations')

@section('page-description', 'Manage your locations')
@section('content')

    <div class="p-8">

     @php
    $lockerId = $lockerId ?? 'A12';
    $locationTitle = $locationTitle ?? 'UNION SQUARE • LEVEL 1';
    $size = $size ?? 'Medium';
    $dimensions = $dimensions ?? '24 × 18 × 20 in';
    $features = $features ?? 'Indoor • Camera monitored • Power outlet • Digital access';
    $description = $description ?? 'Medium locker for bags, parcels and everyday essentials.';
    $nearbyLockers = ['A11', 'A13', 'A14', 'B01', 'B02'];
@endphp

<div class="w-full space-y-6 pb-12">
    
    <!-- Breadcrumb / Header Bar -->
    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <a href="{{ route('locations.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-[#2563EB] transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to Locations
        </a>
        <div class="flex items-center space-x-3 text-xs font-semibold text-slate-600">
            <span>Terminal: <strong class="text-slate-900">US-SF-01</strong></span>
            <span>&bull;</span>
            <span class="text-emerald-600 font-bold">Online</span>
        </div>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Visual & Station Details -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Station Image Container -->
            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs">
                <div class="relative w-full h-[320px] bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1000&q=80" 
                        alt="Smart Locker Terminal Station" 
                        class="w-full h-full object-cover filter contrast-105">
                    <div class="absolute bottom-3 left-3 bg-slate-900/90 text-white text-xs font-medium px-3 py-1.5 rounded border border-white/10">
                        Station View &bull; Union Square
                    </div>
                </div>
            </div>

            <!-- Location Meta Panel -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 space-y-3">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Location Information</h3>
                <div class="space-y-2.5 text-sm">
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500 font-medium">Address</span>
                        <span class="text-slate-900 font-semibold text-right">333 Post Street, San Francisco</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-100">
                        <span class="text-slate-500 font-medium">Access Hours</span>
                        <span class="text-slate-900 font-semibold">6:00 AM – 11:00 PM Daily</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-500 font-medium">Support Line</span>
                        <span class="text-slate-900 font-semibold">+1 (415) 555-0199</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Specs & Configuration Panel -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Main Info Box -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-xs font-bold text-[#2563EB] tracking-wider uppercase">{{ $locationTitle }}</span>
                        <h1 class="text-3xl font-extrabold text-slate-900 mt-1">Locker {{ $lockerId }}</h1>
                        <p class="text-sm text-slate-600 mt-1.5 leading-relaxed">{{ $description }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded border border-emerald-200">
                        Available
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                    <div>
                        <span class="text-slate-400 block font-semibold uppercase tracking-wider text-xs">Locker Size</span>
                        <span class="font-bold text-slate-900 text-base mt-0.5 block">{{ $size }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold uppercase tracking-wider text-xs">Dimensions</span>
                        <span class="font-bold text-slate-900 text-base mt-0.5 block">{{ $dimensions }}</span>
                    </div>
                </div>

                <div class="text-sm text-slate-700 bg-slate-50 border border-slate-200/60 p-3.5 rounded-lg">
                    <strong class="text-slate-900 font-bold block mb-1">Built-in Features:</strong>
                    {{ $features }}
                </div>
            </div>

            <!-- Rental Duration Selector -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 space-y-3">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Select Rental Duration</label>
                <div class="grid grid-cols-3 gap-3">
                    <button type="button" class="duration-btn py-3 px-3 rounded-lg border-2 border-[#2563EB] bg-blue-50/30 text-[#2563EB] text-xs font-bold text-center cursor-pointer">
                        2 Hours ($0.00)
                    </button>
                    <button type="button" class="duration-btn py-3 px-3 rounded-lg border border-slate-200 bg-white text-slate-700 text-xs font-semibold text-center hover:border-slate-300 cursor-pointer">
                        6 Hours ($0.00)
                    </button>
                    <button type="button" class="duration-btn py-3 px-3 rounded-lg border border-slate-200 bg-white text-slate-700 text-xs font-semibold text-center hover:border-slate-300 cursor-pointer">
                        24 Hours ($0.00)
                    </button>
                </div>
            </div>

            <!-- QR Access Info -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-center space-x-4">
                <div class="w-14 h-14 bg-slate-100 border border-slate-200 rounded-lg flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-qrcode text-2xl text-slate-900"></i>
                </div>
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Contactless QR Access</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">Scan the locker screen terminal after completing your reservation for instant entry.</p>
                </div>
            </div>

            <!-- Action Button -->
            <button type="button" id="reserve-btn" class="w-full py-4 bg-[#2563EB] hover:bg-blue-700 text-white font-bold rounded-xl text-sm uppercase tracking-wider transition-colors cursor-pointer flex items-center justify-center space-x-2 shadow-xs">
                <i class="fa-solid fa-lock text-sm"></i>
                <span>Confirm Reservation for Locker {{ $lockerId }}</span>
            </button>

        </div>
    </div>
</div>

<!-- Simple Script for Duration Toggle & State -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var durationBtns = document.querySelectorAll('.duration-btn');
        durationBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                durationBtns.forEach(function(b) {
                    b.classList.remove('border-[#2563EB]', 'bg-blue-50/30', 'text-[#2563EB]', 'font-bold');
                    b.classList.add('border-slate-200', 'bg-white', 'text-slate-700', 'font-semibold');
                });
                btn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700', 'font-semibold');
                btn.classList.add('border-[#2563EB]', 'bg-blue-50/30', 'text-[#2563EB]', 'font-bold');
            });
        });

        var reserveBtn = document.getElementById('reserve-btn');
        if(reserveBtn) {
            reserveBtn.addEventListener('click', function() {
                reserveBtn.innerHTML = '<i class="fa-solid fa-circle-check text-sm"></i><span>Locker {{ $lockerId }} Reserved</span>';
                reserveBtn.classList.remove('bg-[#2563EB]', 'hover:bg-blue-700');
                reserveBtn.classList.add('bg-emerald-600', 'cursor-default');
            });
        }
    });
</script>

    </div>

@endsection