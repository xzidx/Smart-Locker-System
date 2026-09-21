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
                Locker A01
            </h3>
        </div>

        <!-- Location -->
        <div class="flex items-center gap-3 text-[15px] text-slate-500">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M20 10c0 5-8 11-8 11 S4 15 4 10a8 8 0 1 1 16 0z"/>
                <circle cx="12" cy="10" r="2.5"/>
            </svg>

            <span>Building A </span>
        </div>

        <!-- Date -->
        <p class="text-[15px] text-slate-500">
            15 Sep • 10AM - 2PM
                </p>

        <!-- Status -->
        <span class="w-fit px-3 py-1.5 rounded-full bg-green-50 text-green-600 text-xs font-semibold">
            Status: Confirmed
        </span>

    </div>

 <a
    href="{{ url('/reservations/active') }}"
    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition"
>
    View QR
</a>

</div>