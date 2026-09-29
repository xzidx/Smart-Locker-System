@extends('layouts.app')

@section('title', 'Create Staff Account')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-800">
            Create Staff Account
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Create a new account for a staff member.
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Enter staff name"
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Enter staff email"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Enter phone number"
                >

                @error('phone')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Enter password"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Confirm password"
                >
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                >
                    <i class="fa-solid fa-user-plus mr-2"></i>
                    Create Staff
                </button>

            </div>

        </form>

    </div>

</div>

@endsection