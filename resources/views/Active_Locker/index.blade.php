<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="max-w-[850px] mx-auto px-5 py-6">

    <!-- Back -->
    <a
        href="{{ url('/reservations') }}"
        class="text-blue-600 font-semibold text-sm flex items-center gap-2"
    >
        <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15 19l-7-7 7-7"
            />
        </svg>

        Reservation Details
    </a>


    <!-- Locker Information -->
    <div class="bg-white border border-gray-200 rounded-[18px] p-6 mt-6 shadow-[0_8px_20px_rgba(35,52,80,0.12)]">

        <div class="flex justify-between">

            <div>

                <h1 class="text-[20px] font-bold text-slate-900 flex items-center gap-3">

                    <!-- Locker Icon -->
                    <svg
                        class="w-6 h-6 text-slate-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            x="5"
                            y="3"
                            width="14"
                            height="18"
                            rx="2"
                            stroke-width="2"
                        />

                        <line
                            x1="9"
                            y1="3"
                            x2="9"
                            y2="21"
                            stroke-width="2"
                        />

                        <circle
                            cx="7"
                            cy="12"
                            r="0.5"
                            fill="currentColor"
                        />
                    </svg>

                    Locker A01

                </h1>


                <div class="mt-3 text-[15px] text-slate-500 space-y-1">

                    <!-- Location Icon -->
                    <p class="flex items-center gap-2">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-width="2"
                                d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="2.5"
                            />
                        </svg>

                        PSE Building

                    </p>


                    <!-- Building Icon -->
                    <p class="flex items-center gap-2">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <rect
                                x="6"
                                y="3"
                                width="12"
                                height="18"
                                rx="1"
                                stroke-width="2"
                            />

                            <line
                                x1="9"
                                y1="7"
                                x2="11"
                                y2="7"
                                stroke-width="2"
                            />

                            <line
                                x1="13"
                                y1="7"
                                x2="15"
                                y2="7"
                                stroke-width="2"
                            />

                            <line
                                x1="9"
                                y1="11"
                                x2="11"
                                y2="11"
                                stroke-width="2"
                            />

                            <line
                                x1="13"
                                y1="11"
                                x2="15"
                                y2="11"
                                stroke-width="2"
                            />
                        </svg>

                        Main Building

                    </p>


                    <!-- Floor Icon -->
                    <p class="flex items-center gap-2">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-width="2"
                                d="M4 8l8-4 8 4-8 4-8-4z"
                            />

                            <path
                                stroke-width="2"
                                d="M4 12l8 4 8-4"
                            />

                            <path
                                stroke-width="2"
                                d="M4 16l8 4 8-4"
                            />
                        </svg>

                        2nd Floor

                    </p>


                    <!-- Row Icon -->
                    <p class="flex items-center gap-2">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <rect
                                x="5"
                                y="5"
                                width="14"
                                height="14"
                                rx="1"
                                stroke-width="2"
                            />

                            <line
                                x1="9"
                                y1="5"
                                x2="9"
                                y2="19"
                                stroke-width="2"
                            />

                            <line
                                x1="15"
                                y1="5"
                                x2="15"
                                y2="19"
                                stroke-width="2"
                            />
                        </svg>

                        Row A

                    </p>

                </div>

            </div>


            <!-- Active -->
            <span class="h-fit px-3 py-1.5 rounded-full bg-green-50 text-green-600 text-xs font-semibold">
                ACTIVE
            </span>

        </div>

    </div>


    <!-- Reservation Time -->
    <div class="bg-white border border-gray-200 rounded-[18px] p-6 mt-6 shadow-[0_8px_20px_rgba(35,52,80,0.12)]">

        <h2 class="text-[18px] font-bold text-slate-900">
            Reservation Time
        </h2>


        <!-- Date -->
        <p class="text-[15px] text-slate-500 mt-3 flex items-center gap-2">

            <!-- Calendar Icon -->
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="16"
                    rx="2"
                    stroke-width="2"
                />

                <line
                    x1="3"
                    y1="10"
                    x2="21"
                    y2="10"
                    stroke-width="2"
                />

                <line
                    x1="8"
                    y1="3"
                    x2="8"
                    y2="7"
                    stroke-width="2"
                />

                <line
                    x1="16"
                    y1="3"
                    x2="16"
                    y2="7"
                    stroke-width="2"
                />
            </svg>

            15 September 2026

        </p>


        <!-- Time -->
        <p class="text-[15px] text-slate-500 mt-2 flex items-center gap-2">

            <!-- Clock Icon -->
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke-width="2"
                />

                <path
                    stroke-width="2"
                    d="M12 7v5l3 2"
                />
            </svg>

            10:00 AM - 2:00 PM

        </p>

    </div>


    <!-- Access -->
    <div class="bg-white border border-gray-200 rounded-[18px] p-6 mt-6 shadow-[0_8px_20px_rgba(35,52,80,0.12)]">

        <div class="flex flex-col md:flex-row items-center justify-between gap-8">


            <!-- Countdown -->
            <div class="text-center  ">

                <div
                    id="countdown"
                    class="text-[48px] font-bold text-slate-900"
                >
                    02:35:18
                </div>


                <p
                    id="remainingText"
                    class="text-sm text-slate-500"
                >
                    2h 35m remaining
                </p>

            </div>


            <!-- PIN -->
            <div class="w-full md:w-[340px] border border-gray-200 rounded-[18px] p-5">

                <h2 class="text-[18px] font-bold text-slate-900">
                    Access
                </h2>


                <p class="text-sm text-slate-500">
                    Your PIN
                </p>


                <div class="bg-slate-50 border border-gray-200 rounded-xl text-center py-3 mt-3 text-[24px] font-bold">
                    839214
                </div>


                <!-- Show QR -->
                <button
                    onclick="openQR()"
                    class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2"
                >

                    <!-- QR Icon -->
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            x="3"
                            y="3"
                            width="6"
                            height="6"
                            stroke-width="2"
                        />

                        <rect
                            x="15"
                            y="3"
                            width="6"
                            height="6"
                            stroke-width="2"
                        />

                        <rect
                            x="3"
                            y="15"
                            width="6"
                            height="6"
                            stroke-width="2"
                        />

                        <path
                            stroke-width="2"
                            d="M15 15h3v3h3v3h-6v-6z"
                        />
                    </svg>

                    Show QR Code

                </button>

            </div>

        </div>

    </div>


    <!-- Locker Buttons -->
    <div class="bg-white border border-gray-200 rounded-[18px] p-6 mt-6 shadow-[0_8px_20px_rgba(35,52,80,0.12)]">


        <!-- Open Locker -->
        <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl mb-4 flex items-center justify-center gap-2"
        >

            <!-- Unlock Icon -->
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <rect
                    x="4"
                    y="10"
                    width="16"
                    height="11"
                    rx="2"
                    stroke-width="2"
                />

                <path
                    stroke-width="2"
                    d="M8 10V7a4 4 0 0 1 8 0"
                />
            </svg>

            Open Locker

        </button>


        <!-- Release Locker -->
        <button
            class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-xl flex items-center justify-center gap-2"
        >

            <!-- Lock Icon -->
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <rect
                    x="4"
                    y="10"
                    width="16"
                    height="11"
                    rx="2"
                    stroke-width="2"
                />

                <path
                    stroke-width="2"
                    d="M8 10V7a4 4 0 0 1 8 0v3"
                />
            </svg>

            Release Locker

        </button>

    </div>


    <!-- Reservation ID -->
    <p class="text-sm text-slate-500 mt-6">
        Reservation ID: RES-001
    </p>

</div>


<!-- ================= QR MODAL ================= -->

<div
    id="qrModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4"
>

    <div class="bg-white rounded-[18px] p-6 w-full max-w-[320px]">

        <h2 class="text-lg font-bold text-center mb-4">
            Your QR Code
        </h2>


        <div class="flex justify-center">

            <img
                src="{{ asset('images/QR.jpg') }}"
                alt="QR Code"
                class="w-[180px] h-[180px] object-contain"
            >

        </div>


        <!-- Close -->
        <button
            onclick="closeQR()"
            class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold"
        >
            Close
        </button>

    </div>

</div>


<script>

    /* =========================
       COUNTDOWN
    ========================= */

    let totalSeconds = (2 * 60 * 60) + (35 * 60) + 18;

    let countdownTimer;


    function updateCountdown() {

        const hours =
            Math.floor(totalSeconds / 3600);

        const minutes =
            Math.floor((totalSeconds % 3600) / 60);

        const seconds =
            totalSeconds % 60;


        document.getElementById('countdown').textContent =
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');


        document.getElementById('remainingText').textContent =
            hours + 'h ' +
            minutes + 'm remaining';


        if (totalSeconds > 0) {

            totalSeconds--;

        } else {

            clearInterval(countdownTimer);

            document.getElementById('remainingText').textContent =
                'Reservation time ended';

        }

    }


    updateCountdown();

    countdownTimer = setInterval(updateCountdown, 1000);



    /* =========================
       OPEN QR
    ========================= */

    function openQR() {

        document
            .getElementById('qrModal')
            .classList
            .remove('hidden');

    }



    /* =========================
       CLOSE QR
    ========================= */

    function closeQR() {

        document
            .getElementById('qrModal')
            .classList
            .add('hidden');

    }

</script>