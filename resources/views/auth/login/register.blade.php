<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account - SmartHub Solutions</title>

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
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-white">

    <main class="min-h-screen flex items-center">

        {{-- =====================================================
             LEFT SIDE
        ====================================================== --}}

        <section class="locker-image relative w-full lg:w-1/2 min-h-[420px] lg:min-h-screen flex items-end">

        <!-- Branding Content -->

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


        {{-- =====================================================
             RIGHT SIDE
        ====================================================== --}}

        <section class=" w-full lg:w-[52%] flex justify-center px-6 sm:px-10 " >

            <div class="w-full max-w-[420px]">

                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="mb-7">

                    <h2 class=" text-[29px] leading-9 font-bold text-slate-800">
                        Create your account
                    </h2>


                    <p class=" mt-1 text-[14px] text-slate-500">
                        Access your smart locker dashboard.
                    </p>

                </div>


                {{-- =================================================
                     LOGIN / REGISTER
                ================================================== --}}

                <div class=" w-full h-[42px] p-1 mb-8 grid grid-cols-2 rounded-lg bg-slate-50">

                    {{-- Login --}}

                    <a href="{{ route('login') }}" class=" flex items-center justify-center rounded-md text-[14px] font-medium text-slate-700 transition hover:bg-white">
                        Login
                    </a>


                    {{-- Register --}}

                    <a href="{{ route('register') }}" class=" flex items-center justify-center rounded-md bg-white text-[14px] font-medium text-blue-600 shadow-sm">
                        Register
                    </a>

                </div>


                {{-- =================================================
                     SERVER ERRORS
                ================================================== --}}

                @if ($errors->any())

                    <div class=" mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600 ">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- =================================================
                     FORM
                ================================================== --}}

                <form id="registerForm" method="POST" action="{{ route('register.store') }}">

                    @csrf


                    {{-- =================================================
                         FULL NAME
                    ================================================== --}}

                    <div class="mb-5">

                        <label for="name" class=" block mb-2 text-[14px] font-semibold text-slate-700">
                            Full name
                        </label>


                        <input id="name"
                               name="name"
                               type="text"
                               value="{{ old('name') }}"
                               placeholder="Enter your full name"
                               autocomplete="name"
                               required
                               class=" w-full h-[42px] px-3 rounded-lg border border-slate-200 bg-slate-50 text-[14px] text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"/>


                        <p id="nameError" class=" hidden mt-1 text-xs text-red-600 " >
                            Please enter your full name.
                        </p>

                    </div>


                    {{-- =================================================
                         EMAIL
                    ================================================== --}}

                    <div class="mb-5">

                        <label for="email" class=" block mb-2 text-[14px] font-semibold text-slate-700 ">
                            Email Address
                        </label>


                        <input id="email"
                               name="email"
                               type="email"
                               value="{{ old('email') }}"
                               placeholder="user@smarthub.com"
                               autocomplete="email"
                               required
                               class=" w-full h-[42px] px-3 rounded-lg border border-slate-200 bg-slate-50 text-[14px] text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 " />


                        <p id="emailError" class=" hidden mt-1 text-xs text-red-600 ">
                            Please enter a valid email address.
                        </p>

                    </div>


                    {{-- =================================================
                         PASSWORD
                    ================================================== --}}

                    <div class="mb-5">

                        <label
                            for="password"
                            class=" block mb-2 text-[14px] font-semibold text-slate-700 ">
                            Password
                        </label>


                        <div class="relative">

                            <input id="password"
                                   name="password"
                                   type="password"
                                   placeholder="Enter your password"
                                   autocomplete="new-password"
                                   required
                                   class=" w-full h-[42px] px-3 pr-12 rounded-lg border border-slate-200 bg-slate-50 text-[14px] text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 "/>


                            {{-- Eye icon --}}

                            <button type="button"
                                    onclick="togglePassword(
                                        'password',
                                        'passwordEye'
                                    )"
                                    class=" absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 ">

                                <svg
                                    id="passwordEye"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.06.21.06.434 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                </svg>

                            </button>

                        </div>


                        <p
                            id="passwordError" class=" hidden mt-1 text-xs text-red-600 ">
                            Password must be at least 8 characters.
                        </p>

                    </div>


                    {{-- =================================================
                         CONFIRM PASSWORD
                    ================================================== --}}

                    <div class="mb-8">

                        <label for="password_confirmation" class=" block mb-2 text-[14px] font-semibold text-slate-700 " >
                            Confirm Password
                        </label>


                        <div class="relative">

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="Confirm your password"
                                autocomplete="new-password"
                                required
                                class=" w-full h-[42px] px-3 pr-12 rounded-lg border border-slate-200 bg-slate-50 text-[14px] text-slate-700 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 " />


                            {{-- Eye icon --}}

                            <button type="button" onclick="togglePassword('password_confirmation','confirmEye')"
                                class=" absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-700 " >

                                <svg
                                    id="confirmEye"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.06.21.06.434 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                </svg>

                            </button>

                        </div>


                        <p id="confirmError" class=" hidden mt-1 text-xs text-red-600 ">
                            Passwords do not match.
                        </p>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <button id="submitButton" type="submit" class=" w-full h-[42px] rounded-lg bg-blue-600 text-[14px] font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20 disabled:bg-blue-400 disabled:cursor-not-allowed " >
                        Create account
                    </button>

                </form>


                {{-- =================================================
                     LOGIN LINK
                ================================================== --}}

                <p class=" mt-8 text-center text-[14px] text-slate-500 ">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class=" text-blue-600 font-medium hover:underline">
                        Log In
                    </a>

                </p>

            </div>

        </section>

    </main>


    {{-- =============================================================
         JAVASCRIPT
    ============================================================== --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | Password visibility
        |--------------------------------------------------------------------------
        */

        function togglePassword(inputId, iconId) {

            const input =
                document.getElementById(inputId);

            const icon =
                document.getElementById(iconId);


            if (input.type === 'password') {

                input.type = 'text';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19 12 19c1.534 0 2.96-.316 4.24-.876M6.228 6.228A10.451 10.451 0 0112 5c4.756 0 8.774 2.662 10.066 7a10.523 10.523 0 01-4.132 5.411M6.228 6.228L3 3m3.228 3.228l3.2 3.2m7.344 7.344L21 21"
                    />
                `;

            } else {

                input.type = 'password';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.06.21.06.434 0 .644C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                `;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Form validation
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('registerForm')
            .addEventListener('submit', function (event) {

                let valid = true;


                const name =
                    document.getElementById('name');

                const email =
                    document.getElementById('email');

                const password =
                    document.getElementById('password');

                const confirmation =
                    document.getElementById(
                        'password_confirmation'
                    );


                const nameError =
                    document.getElementById('nameError');

                const emailError =
                    document.getElementById('emailError');

                const passwordError =
                    document.getElementById('passwordError');

                const confirmError =
                    document.getElementById('confirmError');


                // Reset errors

                nameError.classList.add('hidden');

                emailError.classList.add('hidden');

                passwordError.classList.add('hidden');

                confirmError.classList.add('hidden');


                // Full name

                if (name.value.trim() === '') {

                    nameError.classList.remove('hidden');

                    valid = false;

                }


                // Email

                const emailRegex =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(email.value)) {

                    emailError.classList.remove('hidden');

                    valid = false;

                }


                // Password

                if (password.value.length < 8) {

                    passwordError.classList.remove('hidden');

                    valid = false;

                }


                // Confirm password

                if (
                    password.value !==
                    confirmation.value
                ) {

                    confirmError.classList.remove('hidden');

                    valid = false;

                }


                // Stop submission

                if (!valid) {

                    event.preventDefault();

                    return;

                }


                // Loading

                const button =
                    document.getElementById(
                        'submitButton'
                    );

                button.disabled = true;

                button.textContent =
                    'Creating account...';

            });

    </script>

</body>

</html>