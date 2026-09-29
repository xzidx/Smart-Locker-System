@extends('layouts.app')

@section('title', 'Settings')

@section('page-title', 'Settings')

@section('page-description', 'Manage your profile and account settings')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-2xl font-bold text-[#0B1F3A]">
                My Profile
            </h1>

            <p class="mt-1 text-gray-500">
                Manage your personal information and account details
            </p>
        </div>

        <a href="{{ route('settings.profile.edit') }}"
           class="inline-flex items-center justify-center gap-2
                  px-5 py-2.5
                  bg-blue-600 text-white
                  rounded-lg
                  font-medium
                  hover:bg-blue-700
                  transition">

            {{-- Edit Icon --}}
            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                         M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

            </svg>

            Edit Profile
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 flex items-center gap-3
                    rounded-lg border border-green-200
                    bg-green-50 px-4 py-3 text-green-700">

            <svg class="w-5 h-5 shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>

            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Profile Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- Profile Top Section --}}
        <div class="px-6 py-8 sm:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center gap-6">

                {{-- Profile Image --}}
                <div class="relative shrink-0">

                    @if(!empty($user->profile_photo))

                        <img
                            src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="{{ $user->name }}"
                            class="w-24 h-24 rounded-full object-cover
                                   border-4 border-white shadow-md"
                        >

                    @else

                        {{-- Default Avatar --}}
                        <div class="w-24 h-24 rounded-full
                                    bg-blue-100
                                    flex items-center justify-center
                                    border-4 border-white
                                    shadow-md">

                            <span class="text-3xl font-bold text-blue-600">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            </span>

                        </div>

                    @endif

                    {{-- Online Status --}}
                    <span class="absolute bottom-1 right-1
                                 w-5 h-5
                                 bg-green-500
                                 border-4 border-white
                                 rounded-full">
                    </span>

                </div>


                {{-- User Information --}}
                <div class="flex-1">

                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $user->name ?? 'User' }}
                    </h2>

                    <p class="mt-1 text-gray-500">
                        {{ $user->email ?? 'No email available' }}
                    </p>

                    <div class="mt-3 flex flex-wrap items-center gap-2">

                        {{-- Role --}}
                        <span class="inline-flex items-center
                                     px-3 py-1
                                     rounded-full
                                     bg-blue-50
                                     text-blue-700
                                     text-xs font-semibold">

                            {{ ucfirst($user->role ?? 'User') }}

                        </span>

                        {{-- Account Status --}}
                        <span class="inline-flex items-center
                                     gap-1.5
                                     px-3 py-1
                                     rounded-full
                                     bg-green-50
                                     text-green-700
                                     text-xs font-semibold">

                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>

                            Active

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Divider --}}
        <div class="border-t border-gray-200"></div>


        {{-- Account Information --}}
        <div class="px-6 py-8 sm:px-8">

            <div class="mb-6">

                <h3 class="text-lg font-semibold text-[#0B1F3A]">
                    Personal Information
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Your account information
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- Full Name --}}
                <div class="p-5 rounded-xl border border-gray-200 bg-gray-50">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-10 h-10 rounded-lg
                                    bg-blue-100
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-blue-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0z
                                         M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>

                            </svg>

                        </div>

                        <p class="text-sm text-gray-500">
                            Full Name
                        </p>

                    </div>

                    <p class="font-semibold text-gray-900">
                        {{ $user->name ?? 'Not available' }}
                    </p>

                </div>


                {{-- Email --}}
                <div class="p-5 rounded-xl border border-gray-200 bg-gray-50">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-10 h-10 rounded-lg
                                    bg-purple-100
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-purple-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8
                                         M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5
                                         a2 2 0 00-2 2v10a2 2 0 002 2z"/>

                            </svg>

                        </div>

                        <p class="text-sm text-gray-500">
                            Email Address
                        </p>

                    </div>

                    <p class="font-semibold text-gray-900 break-all">
                        {{ $user->email ?? 'Not available' }}
                    </p>

                </div>


                {{-- Account Created --}}
                <div class="p-5 rounded-xl border border-gray-200 bg-gray-50">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-10 h-10 rounded-lg
                                    bg-green-100
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-green-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10
                                         M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5
                                         a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                            </svg>

                        </div>

                        <p class="text-sm text-gray-500">
                            Account Created
                        </p>

                    </div>

                    <p class="font-semibold text-gray-900">
                        {{ $user->created_at?->format('d M Y') ?? 'Not available' }}
                    </p>

                </div>


                {{-- Account ID --}}
                <div class="p-5 rounded-xl border border-gray-200 bg-gray-50">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-10 h-10 rounded-lg
                                    bg-orange-100
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-orange-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 12h14
                                         M12 5v14"/>

                            </svg>

                        </div>

                        <p class="text-sm text-gray-500">
                            Account ID
                        </p>

                    </div>

                    <p class="font-semibold text-gray-900">
                        #{{ $user->id }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 sm:px-8">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-3">

                <p class="text-sm text-gray-500">
                    Need to update your information?
                </p>

                <a href="{{ route('settings.profile.edit') }}"
                   class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Edit your profile →
                </a>

            </div>

        </div>

    </div>

</div>

@endsection