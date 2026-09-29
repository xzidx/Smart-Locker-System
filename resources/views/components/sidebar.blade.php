<aside
    id="sidebar"
    class="fixed left-0 top-0 z-50 flex h-screen w-64
           -translate-x-full flex-col
           bg-[#0B1F3A] text-white
           transition-transform duration-300
           md:translate-x-0"
>

    <!-- Logo -->
    <div class="p-6">

        <h1 class="hidden text-2xl font-bold md:block">
            Smart Locker
        </h1>

        <p class="mt-2 hidden text-sm text-[#90E0EF] md:block">
            SOLUTIONS
        </p>

    </div>


    <!-- Navigation -->
    <nav class="mt-6 flex-1 space-y-2">

        <!-- Dashboard -->
        <a
            href="{{ auth()->user()->role === 'admin'
                ? route('admin.dashboard')
                : (auth()->user()->role === 'staff'
                    ? route('staff.dashboard')
                    : route('dashboard')) }}"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-house w-5"></i>

            <span>
                Dashboard
            </span>
        </a>


        <!-- Locations -->
        <a
            href="{{ in_array(auth()->user()->role, ['staff', 'admin'])
                ? route('locations-management.index')
                : route('locations.index') }}"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-location-dot w-5"></i>

            <span>
                Locations
            </span>
        </a>


        <!-- User Reservation -->
        @if(auth()->user()->role === 'user')

            <a
                href="{{ route('reservation.index') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-calendar-check w-5"></i>

                <span>
                    Reservation
                </span>
            </a>

        @endif


        <!-- =================================================
             STAFF + ADMIN MENUS
        ================================================== -->

        @if(in_array(auth()->user()->role, ['staff', 'admin']))

            <!-- Lockers -->
            <a
                href="{{ route('lockers.index') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-lock w-5"></i>

                <span>
                    Lockers
                </span>
            </a>


            <!-- Locker Usage -->
            <a
                href="{{ route('locker_usage.index') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-clipboard-list w-5"></i>

                <span>
                    Locker Usage
                </span>
            </a>


            <!-- Maintenance -->
            <a
                href="{{ route('locker_maintenance.index') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-screwdriver-wrench w-5"></i>

                <span>
                    Maintenance
                </span>
            </a>


            <!-- Users -->
            <a
                href="{{ route('users-management.index') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-users w-5"></i>

                <span>
                    Users
                </span>
            </a>

        @endif


        <!-- Admin Only -->
        @if(auth()->user()->role === 'admin')

            <!-- Add Staff -->
            <a
                href="{{ route('admin.staff.create') }}"
                class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-user-plus w-5"></i>

                <span>
                    Add Staff
                </span>
            </a>

        @endif


        <!-- Settings -->
        <a
            href="{{ route('settings') }}"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-gear w-5"></i>

            <span>
                Settings
            </span>
        </a>

    </nav>


    <!-- Help section -->
    <div class="m-6 rounded-xl bg-[#132D50] p-4">

        <h2 class="font-semibold">
            Need help?
        </h2>

        <p class="mt-1 text-sm text-[#90E0EF]">
            Contact system support for urgent locker issues.
        </p>

    </div>


    <!-- Logout -->
    <div class="px-6 pb-6">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-lg
                       px-4 py-3 text-left text-white
                       transition hover:bg-red-500"
            >

                <i class="fa-solid fa-right-from-bracket w-5"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>