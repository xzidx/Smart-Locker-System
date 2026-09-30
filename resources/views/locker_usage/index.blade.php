@extends('layouts.app')

@section('content')

<div class="p-6">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#0B1F3A]">
            Locker Usage
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            View and monitor locker usage records.
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif


    {{-- Usage Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Table Header --}}
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-bold text-[#0B1F3A]">
                Usage Records
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Records are created automatically when a reservation is approved.
            </p>
        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr class="text-left text-gray-600">

                        <th class="px-6 py-4 font-semibold">
                            User
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Locker
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Location
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Start Time
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            End Time
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 font-semibold text-center">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($usages as $usage)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- User --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-[#90E0EF]
                                                flex items-center justify-center">

                                        <i class="fa-solid fa-user text-[#0B1F3A]"></i>

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            {{ $usage->user->name ?? 'N/A' }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            {{ $usage->user->email ?? 'No email' }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Locker --}}
                            <td class="px-6 py-4">

                                <span class="font-semibold text-[#0B1F3A]">
                                    {{ $usage->locker->name ?? 'N/A' }}
                                </span>

                            </td>


                            {{-- Location --}}
                            <td class="px-6 py-4">

                                @if($usage->locker && $usage->locker->location)

                                    <div>

                                        <p class="font-medium text-gray-800">
                                            {{ $usage->locker->location->name }}
                                        </p>

                                        <p class="text-xs text-gray-500">

                                            {{ $usage->locker->location->building ?? '' }}

                                            @if($usage->locker->location->floor)
                                                · Floor {{ $usage->locker->location->floor }}
                                            @endif

                                        </p>

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            {{-- Start Time --}}
                            <td class="px-6 py-4 text-gray-600">

                                @if($usage->start_time)

                                    <div>
                                        {{ $usage->start_time->format('M d, Y') }}
                                    </div>

                                    <div class="text-xs text-gray-400">
                                        {{ $usage->start_time->format('h:i A') }}
                                    </div>

                                @else

                                    -

                                @endif

                            </td>


                            {{-- End Time --}}
                            <td class="px-6 py-4 text-gray-600">

                                @if($usage->end_time)

                                    <div>
                                        {{ $usage->end_time->format('M d, Y') }}
                                    </div>

                                    <div class="text-xs text-gray-400">
                                        {{ $usage->end_time->format('h:i A') }}
                                    </div>

                                @else

                                    -

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($usage->status === 'active')

                                    <span class="inline-flex items-center gap-1
                                                 px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-100 text-green-700">

                                        <i class="fa-solid fa-circle text-[7px]"></i>

                                        Active

                                    </span>

                                @elseif($usage->status === 'completed')

                                    <span class="inline-flex items-center gap-1
                                                 px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-blue-100 text-blue-700">

                                        <i class="fa-solid fa-check text-[10px]"></i>

                                        Completed

                                    </span>

                                @elseif($usage->status === 'cancelled')

                                    <span class="inline-flex items-center gap-1
                                                 px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-100 text-red-700">

                                        <i class="fa-solid fa-xmark text-[10px]"></i>

                                        Cancelled

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1
                                                 px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-gray-100 text-gray-600">

                                        {{ ucfirst($usage->status) }}

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('locker_usage.show', $usage->id) }}"
                                       class="w-9 h-9 flex items-center justify-center
                                              rounded-lg bg-blue-50 text-blue-600
                                              hover:bg-blue-100 transition"
                                       title="View">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('locker_usage.edit', $usage->id) }}"
                                       class="w-9 h-9 flex items-center justify-center
                                              rounded-lg bg-yellow-50 text-yellow-600
                                              hover:bg-yellow-100 transition"
                                       title="Edit">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('locker_usage.destroy', $usage->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this usage record?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-9 h-9 flex items-center justify-center
                                                       rounded-lg bg-red-50 text-red-600
                                                       hover:bg-red-100 transition"
                                                title="Delete">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="7" class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-full bg-gray-100
                                                flex items-center justify-center mb-4">

                                        <i class="fa-solid fa-clipboard-list
                                                  text-2xl text-gray-400"></i>

                                    </div>


                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Usage Records
                                    </h3>


                                    <p class="text-sm text-gray-500 mt-1">
                                        Locker usage records will appear here
                                        after a reservation is approved.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection