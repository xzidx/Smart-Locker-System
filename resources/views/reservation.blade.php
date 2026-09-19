<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="max-w-[1080px] mx-auto px-4 py-6">

    <h1 class="text-[32px] font-bold text-slate-900">
        My Reservations
    </h1>

    <p class="text-[15px] text-slate-500 mt-3 mb-8">
        Manage your upcoming locker reservations.
    </p>

    <div class="flex justify-between items-center mb-5">

        <h2 class="text-[18px] font-bold text-slate-900">
            Upcoming
        </h2>

        <button
            onclick="viewAll()"
            id="viewAllButton"
            class="text-blue-600 text-sm font-semibold hover:text-blue-700">
            View all
        </button>

    </div>

    <x-reservation-card />
    <x-reservation-card />
    <x-reservation-card />

    <div id="moreReservations" class="hidden">

        <x-reservation-card />
        <x-reservation-card />
        <x-reservation-card />

    </div>

</div>


<div
    id="qrModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">

    <div class="bg-white rounded-[18px] w-full max-w-[320px] p-5 shadow-xl">

        <div class="flex justify-center mb-4">

            <div class="border border-gray-200 rounded-lg p-3">

                <img
                    src="{{ asset('images/QR.jpg') }}"
                    alt="QR Code"
                    class="w-[150px] h-[150px] object-contain">

            </div>

        </div>
        <p class="text-center text-[13px] leading-5 text-slate-500 mb-4">
            Show this QR code at the locker to access
            your reservation.
        </p>
        <button
            onclick="closeQR()"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-xl transition">
            Close
        </button>

    </div>

</div>


<script>
    // View All
    function viewAll() {

        const moreReservations =
            document.getElementById('moreReservations');

        const button =
            document.getElementById('viewAllButton');

        moreReservations.classList.toggle('hidden');

        if (moreReservations.classList.contains('hidden')) {

            button.textContent = 'View all';

        } else {

            button.textContent = 'View less';

        }
    }


    // Open QR
    function openQR() {

        const qrModal =
            document.getElementById('qrModal');

        qrModal.classList.remove('hidden');

    }


    // Close QR
    function closeQR() {

        const qrModal =
            document.getElementById('qrModal');

        qrModal.classList.add('hidden');

    }
</script>