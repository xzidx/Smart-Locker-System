@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard overview')

@section('page-description', 'Live system summary')

@section('content')


<main class="px-8 py-8">

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Page title + CTA --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold tracking-tight">{{ number_format($totalUsers) }} users</h2>
            <p class="mt-1 text-sm text-slate-500">{{ $newThisMonth }} new users joined this month</p>
        </div>

        <a href="{{ route('users-management.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <path d="M19 8v6M22 11h-6"/>
            </svg>
            Add new user
        </a>
    </div>

    {{-- Table card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Toolbar (search + filter) --}}
        <form method="GET" action="{{ route('users-management.index') }}"
              class="flex flex-wrap items-center justify-between gap-3 p-5">

            <div class="relative w-full max-w-sm">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name, email, or phone"
                       class="w-full rounded-lg border border-slate-200 py-2.5 pl-10 pr-3 text-sm placeholder-slate-500 focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            </div>

           
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="border-y border-slate-200 bg-slate-50">
                    <tr class="text-xs font-medium text-slate-500">
                        <th class="px-5 py-3">User</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Phone</th>
                        <th class="px-5 py-3">Booking Status</th>
                        <th class="px-5 py-3">Booking History</th>
                        <th class="px-5 py-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/60">
                            {{-- User --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-xs font-bold text-blue-600">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </span>
                                    <span class="font-semibold">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="px-5 py-4">{{ $user->email }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ $user->phone ?? '—' }}</td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                @php $status = $user->latestLockerUsage?->status; @endphp

                                @if ($status === 'Active')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span> {{ $status ?? 'None' }}
                                    </span>
                                @endif
                            </td>

                            {{-- History --}}
                            <td class="px-5 py-4">
                                <a href="{{ route('users-management.show', $user) }}" class="text-blue-600 hover:underline">
                                    {{ $user->locker_usages_count }} bookings
                                </a>
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('users-management.show', $user) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('users-management.edit', $user) }}" class="text-slate-500 hover:text-slate-800" title="Edit">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M4 6h16M4 12h16M4 18h16"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer / Pagination --}}
        <div class="flex flex-wrap items-center justify-between gap-3 p-5">
            <p class="text-sm text-slate-500">
                Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ number_format($users->total()) }} users
            </p>

            @if ($users->hasPages())
                <nav class="flex items-center gap-2">
                    {{-- Previous --}}
                    @if ($users->onFirstPage())
                        <span class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-400">Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-50">Previous</a>
                    @endif

                    {{-- Page numbers (current page ±1) --}}
                    @php
                        $start = max(1, $users->currentPage() - 1);
                        $end   = min($users->lastPage(), $users->currentPage() + 1);
                    @endphp

                    @foreach ($users->getUrlRange($start, $end) as $page => $url)
                        @if ($page == $users->currentPage())
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-sm font-semibold text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-sm font-semibold hover:bg-slate-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold hover:bg-slate-50">Next</a>
                    @else
                        <span class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-400">Next</span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</main>



@endsection