<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Locker</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .locker-image {
            background-image:
                linear-gradient(
                    rgba(37, 99, 235, 0.68),
                    rgba(37, 99, 235, 0.68)
                ),
                url('/images/logo.png');
        
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body class="min-h-screen bg-white">

    <div id="loginApp" class="min-h-screen flex flex-col lg:flex-row">

        <!-- LEFT SIDE  -->

        <section class="locker-image relative w-full lg:w-1/2 min-h -[420px] lg:min-h-screen flex items-end">

        <!-- LIFT SIDE - CONTENT -->

            <div class="relative z-10 w-full p-8 sm:p-12 lg:p-16">
                <div class="max-w-xl text-white">
                    <h1 class="text-4xl sm:text-5xl lg:text-[40px] font-bold leading-tight mb-5">
                        Secure storage for the modern commuter.
                    </h1>
                    <p class="text-base sm:text-lg leading-7 text-white/90 max-w-xl">
                         Create an account with SmartHub Solutions and unlock any
                    available public locker instantly. Track your rentals,
                    receive alerts, and make easy contactless payments.
                    </p>

                </div>

            </div>
        </section>

        <!-- RIGHT SIDE - LOGIN -->

        <section class="w-full lg:w-1/2 min-h-screen flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16 xl:px-24">
            <div class="w-full max-w-[420px]">

                <!-- HEADING -->

                <div class="mb-7">
                    <h2 class="text-3xl font-bold tracking-tght text-slate-800">Welcome back</h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Access your smart locker dashboard.
                    </p>
                </div>

                <!-- LOGIN/REGISTER -->

                <div class="flex h-10 mb-8 ">

                </div>

            </div>

        </section>
        
    </div>
    
</body>
</html>