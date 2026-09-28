@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                My Profile
            </h1>

            <p class="text-gray-500 mt-1">
                Manage your personal information
            </p>
        </div>

        <a href="{{ route('settings.profile.edit') }}"
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Edit Profile
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="bg-white border border-gray-200 rounded-xl p-6">

        {{-- Avatar --}}
        <div class="flex items-center gap-5 mb-8">

            <div class="w-20 h-20 rounded-full bg-blue-100
                        flex items-center justify-center">

                <span class="text-2xl font-bold text-blue-600">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>

            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ $user->name }}
                </h2>

                <p class="text-gray-500">
                    {{ $user->email }}
                </p>
            </div>

        </div>

        {{-- Information --}}
        <div class="space-y-5">

            <div>
                <p class="text-sm text-gray-500">
                    Full Name
                </p>

                <p class="font-medium text-gray-900">
                    {{ $user->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Email Address
                </p>

                <p class="font-medium text-gray-900">
                    {{ $user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Account Created
                </p>

                <p class="font-medium text-gray-900">
                    {{ $user->created_at?->format('d M Y') }}
                </p>
            </div>

        </div>

    </div>

</div>

@endsection