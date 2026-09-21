<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Smart Locker')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >
</head>

<body class="bg-gray-100">

    <!-- Mobile header -->
    <header
        class="fixed left-0 right-0 top-0 z-40 flex h-16
               items-center bg-white px-4 shadow md:hidden"
    >

        <!-- Menu button -->
        <button
            id="menuButton"
            type="button"
            class="text-2xl text-[#0B1F3A]"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Mobile logo -->
        <div class="ml-4">

            <h1 class="text-lg font-bold text-[#0B1F3A]">
                Smart Locker
            </h1>

            <p class="text-xs text-[#2563EB]">
                SOLUTIONS
            </p>

        </div>

    </header>

    <!-- Mobile overlay -->
    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/50 md:hidden"
    ></div>

    <!-- Sidebar -->
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

            <h1 class="text-2xl font-bold">
                Smart Locker
            </h1>

            <p class="mt-2 text-sm text-[#90E0EF]">
                SOLUTIONS
            </p>

        </div>

        <!-- Navigation -->
        <nav class="mt-6 flex-1 space-y-2">

            <!-- Dashboard -->
            <a
                href="/dashboard"
                class="flex items-center gap-3 px-6 py-3
                       transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-house w-5"></i>

                <span>
                    Dashboard
                </span>
            </a>

            <!-- Locations -->
            <a
                href="/locations"
                class="flex items-center gap-3 px-6 py-3
                       transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-location-dot w-5"></i>

                <span>
                    Locations
                </span>
            </a>

            <!-- Reservation -->
            <a
                href="/reservation"
                class="flex items-center gap-3 px-6 py-3
                       transition hover:bg-[#2563EB]"
            >
                <i class="fa-solid fa-calendar-check w-5"></i>

                <span>
                    Reservation
                </span>
            </a>

            <!-- Settings -->
            <a
                href="/settings"
                class="flex items-center gap-3 px-6 py-3
                       transition hover:bg-[#2563EB]"
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



    <!-- Mobile sidebar script -->
    <script>

        const menuButton = document.getElementById('menuButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Open sidebar
        menuButton.addEventListener('click', function () {

            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');

        });

        // Close sidebar
        sidebarOverlay.addEventListener('click', function () {

            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');

        });

    </script>

</body>

</html>