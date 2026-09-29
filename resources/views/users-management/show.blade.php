@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-4xl px-8 py-8">

    {{-- Back link + actions --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('users-management.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">
            ← Back to users
        </a>
        <a href="{{ route('users-management.edit', $user) }}"
           class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
            Edit user
        </a>
    </div>

    {{-- User info card --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 text-base font-bold text-blue-600">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </span>
            <div>
                <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                <p class="text-sm capitalize text-slate-500">{{ $user->role ?? 'User' }}</p>
            </div>
        </div>

        <dl class="mt-6 grid gap-4 sm:grid-cols-3">
            <div>
                <dt class="text-xs font-medium text-slate-500">Email</dt>
                <dd class="mt-1 text-sm font-medium">{{ $user->email }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-slate-500">Phone</dt>
                <dd class="mt-1 text-sm font-medium">{{ $user->phone ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-slate-500">Joined</dt>
                <dd class="mt-1 text-sm font-medium">{{ $user->created_at?->format('M d, Y') }}</dd>
            </div>
        </dl>
    </div>

    {{-- Booking history --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="p-5">
            <h3 class="text-lg font-semibold">Booking history</h3>
            <p class="text-sm text-slate-500">{{ $user->lockerUsages->count() }} bookings</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-y border-slate-200 bg-slate-50">
                    <tr class="text-xs font-medium text-slate-500">
                        <th class="px-5 py-3">#</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($user->lockerUsages as $usage)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-5 py-4 text-slate-500">{{ $usage->id }}</td>
                            <td class="px-5 py-4">
                                @if ($usage->status === 'Active')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span> {{ $usage->status ?? 'None' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4">{{ $usage->created_at?->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-10 text-center text-slate-500">No bookings yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection