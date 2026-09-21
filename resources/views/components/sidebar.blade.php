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
            href="/dashboard"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-house w-5"></i>

            <span>
                Dashboard
            </span>
        </a>

        <!-- Locations -->
        <a
            href="/locations"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-location-dot w-5"></i>

            <span>
                Locations
            </span>
        </a>

        <!-- Reservation -->
        <a
            href="/reservation"
            class="flex items-center gap-3 px-6 py-3 transition hover:bg-[#2563EB]"
        >
            <i class="fa-solid fa-calendar-check w-5"></i>

            <span>
                Reservation
            </span>
        </a>

        <!-- Settings -->
        <a
            href="/settings"
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

</aside>