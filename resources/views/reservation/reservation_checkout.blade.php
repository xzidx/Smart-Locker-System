<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Overview</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- HEADER -->
    <header class="h-[88px] bg-white border-b border-slate-200">

        <div class="h-full px-8 flex items-center justify-between">

            <!-- LEFT -->
            <div>
                <h1 class="text-[21px] font-bold text-slate-900">
                    Dashboard overview
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    {{ now()->format('l, F d') }} · Live system summary
                </p>
            </div>


            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- SEARCH -->
                <div class="relative">

                    <i data-lucide="search"
                       class="absolute left-4 top-1/2 -translate-y-1/2
                              w-5 h-5 text-slate-400">
                    </i>

                    <input
                        type="text"
                        placeholder="Search users, lockers..."
                        class="w-[300px] h-[42px]
                               pl-11 pr-4
                               rounded-xl
                               bg-slate-100
                               border border-transparent
                               focus:outline-none
                               focus:border-blue-400
                               text-sm"
                    >

                </div>


                <!-- NOTIFICATION -->
                <button
                    class="relative w-[44px] h-[44px]
                           bg-slate-100
                           rounded-xl
                           flex items-center justify-center">

                    <i data-lucide="bell"
                       class="w-5 h-5 text-slate-700">
                    </i>

                    <span
                        class="absolute top-[8px] right-[8px]
                               w-2 h-2
                               bg-red-500
                               rounded-full">
                    </span>

                </button>


                <!-- PROFILE -->
                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-full
                               bg-slate-300
                               flex items-center justify-center
                               font-semibold text-slate-700">

                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}

                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            {{ auth()->user()->name ?? 'Alex Morgan' }}
                        </p>

                        <p class="text-xs text-slate-500">
                            Staff administrator
                        </p>

                    </div>

                    <i data-lucide="chevron-down"
                       class="w-4 h-4 text-slate-500">
                    </i>

                </div>

            </div>

        </div>

    </header>


    <!-- MAIN -->
    <main class="max-w-[1240px] mx-auto px-6 py-12">


        <!-- PAGE TITLE -->
        <div class="mb-8">

            <p class="text-blue-600
                      uppercase
                      tracking-[0.15em]
                      text-xs
                      font-bold
                      mb-3">

                MY RESERVATIONS

            </p>

            <h2 class="text-4xl font-bold text-slate-900">

                Upcoming reservations

            </h2>

            <p class="text-slate-500 mt-2">

                View and manage your active locker reservations.

            </p>

        </div>


        <!-- RESERVATION COUNT -->
        <div class="flex items-center justify-between mb-5">

            <div>

                <span class="text-sm text-slate-500">

                    {{ $reservations->count() }}

                    {{ $reservations->count() === 1 ? 'reservation' : 'reservations' }}

                </span>

            </div>

        </div>


        <!-- RESERVATIONS -->
        @if($reservations->count() > 0)

            <div class="grid grid-cols-1 gap-5">

                @foreach($reservations as $reservation)

                    <div
                        class="bg-white
                               border border-slate-200
                               rounded-2xl
                               p-6
                               shadow-sm
                               hover:shadow-md
                               transition">

                        <div class="flex items-center justify-between">


                            <!-- LEFT -->
                            <div class="flex items-start gap-5">

                                <!-- LOCKER ICON -->
                                <div
                                    class="w-14 h-14
                                           rounded-xl
                                           bg-blue-50
                                           flex items-center justify-center">

                                    <i data-lucide="lock-keyhole"
                                       class="w-7 h-7 text-blue-600">
                                    </i>

                                </div>


                                <div>

                                    <!-- LOCKER NAME -->
                                    <div class="flex items-center gap-3">

                                        <h3
                                            class="text-lg
                                                   font-bold
                                                   text-slate-900">

                                            {{ $reservation->locker->name }}

                                        </h3>


                                        <!-- STATUS -->
                                        @if($reservation->status === 'confirmed')

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-green-50
                                                       text-green-700">

                                                Confirmed

                                            </span>

                                        @elseif($reservation->status === 'active')

                                            <span
                                                class="px-3 py-1
                                                       rounded-full
                                                       text-xs
                                                       font-semibold
                                                       bg-blue-50
                                                       text-blue-700">

                                                Active

                                            </span>

                                        @endif

                                    </div>


                                    <!-- LOCATION -->
                                    <div
                                        class="flex items-center gap-2
                                               text-sm
                                               text-slate-500
                                               mt-2">

                                        <i data-lucide="map-pin"
                                           class="w-4 h-4">
                                        </i>

                                        {{ $reservation->locker->location }}

                                    </div>


                                    <!-- DATE/TIME -->
                                    <div
                                        class="flex items-center gap-2
                                               text-sm
                                               text-slate-500
                                               mt-2">

                                        <i data-lucide="calendar-days"
                                           class="w-4 h-4">
                                        </i>

                                        {{ $reservation->start_time->format('M d, Y') }}

                                        ·

                                        {{ $reservation->start_time->format('g:i A') }}

                                        -

                                        {{ $reservation->end_time->format('g:i A') }}

                                    </div>

                                </div>

                            </div>


                            <!-- RIGHT -->
                            <div class="flex items-center gap-3">


                                <!-- QR BUTTON -->
                                <button
                                    onclick="openQrModal(
                                        '{{ $reservation->locker->name }}',
                                        '{{ $reservation->access_code }}'
                                    )"
                                    class="h-11
                                           px-5
                                           rounded-xl
                                           bg-blue-600
                                           hover:bg-blue-700
                                           text-white
                                           text-sm
                                           font-semibold
                                           flex
                                           items-center
                                           gap-2
                                           transition">

                                    <i data-lucide="qr-code"
                                       class="w-4 h-4">
                                    </i>

                                    View access QR

                                </button>


                                <!-- MORE -->
                                <button
                                    class="w-11 h-11
                                           rounded-xl
                                           border
                                           border-slate-200
                                           flex
                                           items-center
                                           justify-center
                                           hover:bg-slate-50">

                                    <i data-lucide="more-horizontal"
                                       class="w-5 h-5 text-slate-600">
                                    </i>

                                </button>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


        @else

            <!-- EMPTY STATE -->
            <div
                class="bg-white
                       border border-slate-200
                       rounded-2xl
                       py-16
                       text-center">

                <div
                    class="w-16 h-16
                           mx-auto
                           rounded-full
                           bg-slate-100
                           flex
                           items-center
                           justify-center">

                    <i data-lucide="calendar-x"
                       class="w-7 h-7 text-slate-400">
                    </i>

                </div>

                <h3
                    class="mt-5
                           text-lg
                           font-semibold">

                    No upcoming reservations

                </h3>

                <p class="text-sm text-slate-500 mt-2">

                    You don't have any active locker reservations.

                </p>

                <a
                    href="#"
                    class="inline-flex
                           mt-5
                           px-5
                           py-2.5
                           bg-blue-600
                           text-white
                           rounded-xl
                           text-sm
                           font-semibold">

                    Find a locker

                </a>

            </div>

        @endif

    </main>


    <!-- QR MODAL -->
    <div
        id="qrModal"
        class="hidden fixed inset-0
               bg-black/50
               backdrop-blur-sm
               items-center
               justify-center
               z-50">

        <div
            class="bg-white
                   w-[380px]
                   rounded-2xl
                   p-7
                   shadow-2xl">

            <!-- CLOSE -->
            <div class="flex justify-between items-center">

                <h3 class="text-xl font-bold">

                    Locker Access

                </h3>

                <button
                    onclick="closeQrModal()"
                    class="w-9 h-9
                           rounded-lg
                           hover:bg-slate-100
                           flex
                           items-center
                           justify-center">

                    <i data-lucide="x"
                       class="w-5 h-5">
                    </i>

                </button>

            </div>


            <p
                id="qrLockerName"
                class="text-sm
                       text-slate-500
                       mt-2">
            </p>


            <!-- QR -->
            <div
                class="mt-6
                       flex
                       justify-center">

                <div
                    class="w-52 h-52
                           border-2
                           border-slate-200
                           rounded-xl
                           flex
                           items-center
                           justify-center
                           bg-white">

                    <div id="qrCode"
                         class="text-center">

                        <i data-lucide="qr-code"
                           class="w-32 h-32 text-slate-900">
                        </i>

                    </div>

                </div>

            </div>


            <p
                class="text-center
                       text-xs
                       text-slate-500
                       mt-5">

                Scan this QR code at the locker to unlock it.

            </p>


            <!-- ACCESS CODE -->
            <div
                class="mt-5
                       bg-slate-50
                       rounded-xl
                       p-4
                       text-center">

                <p
                    class="text-xs
                           text-slate-500
                           uppercase
                           tracking-wider">

                    Access code

                </p>

                <p
                    id="accessCode"
                    class="text-xl
                           font-bold
                           tracking-[0.2em]
                           mt-1">

                </p>

            </div>


            <button
                onclick="closeQrModal()"
                class="w-full
                       mt-5
                       h-11
                       rounded-xl
                       bg-blue-600
                       hover:bg-blue-700
                       text-white
                       font-semibold">

                Done

            </button>

        </div>

    </div>


    <script>

        lucide.createIcons();


        function openQrModal(lockerName, accessCode)
        {
            const modal = document.getElementById('qrModal');

            const locker =
                document.getElementById('qrLockerName');

            const code =
                document.getElementById('accessCode');


            locker.innerText =
                lockerName + ' · Access QR';


            code.innerText =
                accessCode || '------';


            modal.classList.remove('hidden');

            modal.classList.add('flex');
        }


        function closeQrModal()
        {
            const modal =
                document.getElementById('qrModal');

            modal.classList.add('hidden');

            modal.classList.remove('flex');
        }


        // Close modal when clicking outside
        document
            .getElementById('qrModal')
            .addEventListener('click', function(event)
            {

                if (event.target === this)
                {
                    closeQrModal();
                }

            });

    </script>

</body>

</html>