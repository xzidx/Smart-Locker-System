<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SmartHub Solutions</title>

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

<body class="min-h-screen bg-white">

<div
    id="loginApp"
    class="min-h-screen flex flex-col lg:flex-row"
>

    <!-- ===================================== -->
    <!-- LEFT SIDE - BRANDING -->
    <!-- ===================================== -->

    <section
        class="locker-image relative w-full lg:w-1/2 min-h-[420px] lg:min-h-screen flex items-end">

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


    <!-- ===================================== -->
    <!-- RIGHT SIDE - LOGIN -->
    <!-- ===================================== -->

    <section class="w-full lg:w-1/2 min-h-screen flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16 xl:px-24">

        <div class="w-full max-w-[420px]">

            <!-- Heading -->

            <div class="mb-7">

                <h2 class="text-3xl font-bold tracking-tight text-slate-800">
                    Welcome Back
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Access your smart locker dashboard.
                </p>

            </div>


            <!-- ================================= -->
            <!-- LOGIN / REGISTER TABS -->
            <!-- ================================= -->

            <div class="flex h-10 mb-8 rounded-lg bg-slate-50 p-1">

                <button type="button" class="flex-1 rounded-md bg-white text-sm font-medium text-blue-600 shadow-sm">
                    Login
                </button>

                <a href="{{ route('register') }}" class="flex-1 flex items-center justify-center rounded-md text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                    Register
                </a>

            </div>


            <!-- ================================= -->
            <!-- ERROR MESSAGE -->
            <!-- ================================= -->

            <div id="errorMessage" class="hidden mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600"></div>


            <!-- ================================= -->
            <!-- LOGIN FORM -->
            <!-- ================================= -->

            <form id="loginForm" novalidate >

                @csrf


                <!-- Email -->

                <div class="mb-5">

                    <label for="email" class="block mb-2 text-sm font-semibold text-slate-700" >
                        Email Address
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        placeholder="user@smarthub.com"
                        class="w-full h-10 rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" >

                    <p id="emailError" class="hidden mt-1 text-xs text-red-500" ></p>

                </div>


                <!-- Password -->

                <div class="mb-5">

                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"class="text-sm font-semibold text-slate-700">
                            Password
                        </label>

                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">
                            Forgot password?
                        </a>

                    </div>


                    <div class="relative">

                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="••••••••••••"
                            class="w-full h-10 rounded-lg border border-slate-200 bg-white px-3 pr-11 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" >


                        <!-- Show Password -->

                        <button type="button"
                                id="togglePassword"
                                class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                                aria-label="Show password">

                            <!-- Eye off icon -->

                            <svg
                                id="eyeOff"
                                xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" x2="22" y1="2" y2="22"></line>
                            </svg>

                            <!-- Eye icon -->

                            <svg
                                id="eye"
                                class="hidden"
                                xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M2.06 12.35a1 1 0 0 1 0-.7C3.67 7.11 7.55 4 12 4s8.33 3.11 9.94 7.65a1 1 0 0 1 0 .7C20.33 16.89 16.45 20 12 20s-8.33-3.11-9.94-7.65Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>

                        </button>

                    </div>

                </div>


                <!-- ================================= -->
                <!-- REMEMBER ME -->
                <!-- ================================= -->

                <div class="flex items-center mb-7">

                    <input id="remember"
                           name="remember"
                           type="checkbox"
                           class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" >

                    <label for="remember" class="ml-2 text-sm text-slate-600">
                        Keep me signed in on this device
                    </label>

                </div>


                <!-- ================================= -->
                <!-- LOGIN BUTTON -->
                <!-- ================================= -->

                <button id="loginButton" type="submit" class="w-full h-10 rounded-lg bg-blue-600 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200 disabled:cursor-not-allowed disabled:opacity-60">

                    <span id="buttonText">
                        Log In
                    </span>

                    <span id="loadingText" class="hidden" >
                        Logging in...
                    </span>

                </button>

            </form>

        </div>

    </section>

</div>


<!-- ========================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================= -->

<script>

    // -----------------------------------------
    // Elements
    // -----------------------------------------

    const loginForm = document.getElementById('loginForm');

    const emailInput = document.getElementById('email');

    const passwordInput = document.getElementById('password');

    const rememberInput = document.getElementById('remember');

    const loginButton = document.getElementById('loginButton');

    const buttonText = document.getElementById('buttonText');

    const loadingText = document.getElementById('loadingText');

    const errorMessage = document.getElementById('errorMessage');

    const emailError = document.getElementById('emailError');

    const togglePassword = document.getElementById('togglePassword');

    const eye = document.getElementById('eye');

    const eyeOff = document.getElementById('eyeOff');


    // -----------------------------------------
    // Show / Hide Password
    // -----------------------------------------

    togglePassword.addEventListener('click', function () {

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            eye.classList.remove('hidden');

            eyeOff.classList.add('hidden');

        } else {

            passwordInput.type = 'password';

            eye.classList.add('hidden');

            eyeOff.classList.remove('hidden');

        }

    });


    // -----------------------------------------
    // Email Validation
    // -----------------------------------------

    function validateEmail(email) {

        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    }


    // -----------------------------------------
    // Login
    // -----------------------------------------

    loginForm.addEventListener('submit', async function (event) {

        event.preventDefault();


        // Clear old errors

        errorMessage.classList.add('hidden');

        emailError.classList.add('hidden');


        const email = emailInput.value.trim();

        const password = passwordInput.value;

        const remember = rememberInput.checked;


        // -------------------------------------
        // Validation
        // -------------------------------------

        if (!email) {

            emailError.textContent = 'Email address is required.';

            emailError.classList.remove('hidden');

            emailInput.focus();

            return;

        }


        if (!validateEmail(email)) {

            emailError.textContent = 'Please enter a valid email address.';

            emailError.classList.remove('hidden');

            emailInput.focus();

            return;

        }


        if (!password) {

            showError('Password is required.');

            passwordInput.focus();

            return;

        }


        if (password.length < 6) {

            showError('Password must be at least 6 characters.');

            passwordInput.focus();

            return;

        }


        // -------------------------------------
        // Loading state
        // -------------------------------------

        loginButton.disabled = true;

        buttonText.classList.add('hidden');

        loadingText.classList.remove('hidden');


        try {

            // ---------------------------------
            // Send API request
            // ---------------------------------

            const response = await fetch('/api/login', {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'Accept': 'application/json',

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'input[name="_token"]'
                        ).value

                },

                body: JSON.stringify({

                    email: email,

                    password: password,

                    remember: remember

                })

            });


            const data = await response.json();


            // ---------------------------------
            // Login failed
            // ---------------------------------

            if (!response.ok) {

                if (data.errors) {

                    const firstError =
                        Object.values(data.errors)[0][0];

                    showError(firstError);

                } else {

                    showError(
                        data.message ||
                        'Invalid email or password.'
                    );

                }

                return;
            }


            // ---------------------------------
            // Store token
            // ---------------------------------

            if (data.token) {

                if (remember) {

                    localStorage.setItem(
                        'auth_token',
                        data.token
                    );

                } else {

                    sessionStorage.setItem(
                        'auth_token',
                        data.token
                    );

                }

            }


            // ---------------------------------
            // Redirect dashboard
            // ---------------------------------

            window.location.href = '/dashboard';


        } catch (error) {

            console.error(error);

            showError(
                'Unable to connect to the server. Please try again.'
            );

        } finally {

            loginButton.disabled = false;

            buttonText.classList.remove('hidden');

            loadingText.classList.add('hidden');

        }

    });


    // -----------------------------------------
    // Show Error
    // -----------------------------------------

    function showError(message) {

        errorMessage.textContent = message;

        errorMessage.classList.remove('hidden');

    }

</script>

</body>
</html>