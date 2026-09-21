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

    <!-- Mobile Header -->
    <header
        class="fixed top-0 left-0 right-0 z-[60] flex h-16 items-center bg-white px-4 shadow md:hidden"
    >

        <button
            id="menuButton"
            type="button"
            class="p-2 text-2xl text-[#0B1F3A]"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="ml-6">

            <h1 class="text-lg font-bold text-[#0B1F3A]">
                Smart Locker
            </h1>

            <p class="text-xs text-[#2563EB]">
                SOLUTIONS
            </p>

        </div>

    </header>

    <!-- Mobile Overlay -->
    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/50 md:hidden"
    ></div>

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <main class="min-h-screen pt-16 md:ml-64 md:pt-0">

        <!-- Page Header -->
        @include('components.page-header')

        <!-- Page Content -->
        @yield('content')

    </main>

    <!-- Mobile Sidebar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const menuButton = document.getElementById('menuButton');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (!menuButton || !sidebar || !sidebarOverlay) {
                return;
            }

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

        });
    </script>

</body>

</html>