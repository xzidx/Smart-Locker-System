<header class="border-b border-gray-200 bg-white px-8 py-5">

    <div class="flex items-center justify-between gap-6">

        <!-- Page title -->
        <div>
            <h1 class="text-2xl font-bold text-[#0B1F3A]">
                @yield('page-title', 'Smart Locker')
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                @yield('page-description', 'Smart Locker System')
            </p>
        </div>

        <!-- Search, notification and profile -->
        <div class="flex items-center gap-5">

            <!-- Search -->
            <div class="relative hidden md:block">

                <i
                    class="fa-solid fa-magnifying-glass absolute left-4 top-1/2
                           -translate-y-1/2 text-gray-400"
                ></i>

                <input
                    type="text"
                    placeholder="Search users, lockers..."
                    class="w-72 rounded-lg border border-gray-200
                           bg-gray-50 py-2.5 pl-11 pr-4 text-sm
                           text-gray-700 outline-none transition
                           focus:border-[#2563EB]
                           focus:ring-2 focus:ring-blue-100"
                >

            </div>

            <!-- Notification -->
            <button
                type="button"
                class="relative flex h-10 w-10 items-center
                       justify-center rounded-lg text-gray-500
                       transition hover:bg-gray-100
                       hover:text-[#0B1F3A]"
            >

                <i class="fa-regular fa-bell text-lg"></i>

                <span
                    class="absolute right-2 top-2 h-2.5 w-2.5
                           rounded-full bg-red-500 ring-2 ring-white"
                ></span>

            </button>

            <!-- User profile -->
            <button
                type="button"
                class="flex items-center gap-3 rounded-lg
                       px-2 py-1.5 transition hover:bg-gray-100"
            >

                <!-- Avatar -->
                <div
                    class="flex h-10 w-10 items-center justify-center
                           rounded-full bg-[#0B1F3A]
                           text-sm font-semibold text-white"
                >
                    AM
                </div>

                <!-- User information -->
                <div class="hidden text-left lg:block">

                    <p class="text-sm font-semibold text-gray-800">
                        Alex Morgan
                    </p>

                    <p class="text-xs text-gray-500">
                        Staff administrator
                    </p>

                </div>

                <!-- Dropdown arrow -->
                <i
                    class="fa-solid fa-chevron-down ml-1
                           text-xs text-gray-400"
                ></i>

            </button>

        </div>

    </div>

</header>