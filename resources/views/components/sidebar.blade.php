```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Locker</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >
</head>

<body>

    <!-- Your Smart Locker sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-64 bg-[#0B1F3A] text-white">

        <div class="p-6">
            <h1 class="text-2xl font-bold">
                Smart Locker
            </h1>

            <p class="mt-2 text-sm text-[#90E0EF]">
                SOLUTIONS
            </p>
        </div>

        <nav class="mt-6 space-y-2">

            <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-[#2563EB]">
                <i class="fa-solid fa-house w-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-[#2563EB]">
                <i class="fa-solid fa-location-dot w-5"></i>
                <span>Locations</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-[#2563EB]">
                <i class="fa-solid fa-calendar-check w-5"></i>
                <span>Reservation</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 hover:bg-[#2563EB]">
                <i class="fa-solid fa-gear w-5"></i>
                <span>Settings</span>
            </a>

        </nav>


         <div class="absolute bottom-6 left-6 right-6 rounded-xl bg-[#132D50] p-4">
        <h2 class="font-semibold">Need help?</h2>

        <p class="mt-1 text-sm text-[#90E0EF]">
            Contact system support for urgent locker issues.
        </p>
    </div>

    </aside>

</body>

</html>
```
