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
</script>