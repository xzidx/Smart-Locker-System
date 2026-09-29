@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6">

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Profile card --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Banner --}}
        <div class="h-32 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 sm:h-40"></div>

        <div class="px-6 pb-8 sm:px-8">

            {{-- Avatar + actions --}}
            <div class="-mt-14 flex flex-col gap-4 sm:-mt-16 sm:flex-row sm:items-end sm:justify-between">

                <div class="flex items-end gap-4">
                    @if ($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                             class="h-28 w-28 rounded-full object-cover shadow-md ring-4 ring-white sm:h-32 sm:w-32">
                    @else
                        <div class="flex h-28 w-28 items-center justify-center rounded-full bg-blue-100 text-4xl font-bold text-blue-600 shadow-md ring-4 ring-white sm:h-32 sm:w-32">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <a href="{{ route('settings.profile.edit') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                    </svg>
                    Edit Profile
                </a>
            </div>

            {{-- Name + email --}}
            <div class="mt-5">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">{{ $user->name }}</h1>
                <p class="mt-1 text-sm text-slate-500">{{ $user->email }}</p>
            </div>

            {{-- Divider --}}
            <div class="my-8 border-t border-slate-100"></div>

            {{-- Details --}}
            <h2 class="mb-4 text-xs font-semibold uppercase tracking-widest text-slate-400">
                Personal information
            </h2>

            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="rounded-xl bg-slate-50 p-4">
                    <dt class="text-xs font-medium text-slate-500">Full name</dt>
                    <dd class="mt-1 truncate text-sm font-semibold text-slate-900">{{ $user->name }}</dd>
                </div>

                <div class="rounded-xl bg-slate-50 p-4">
                    <dt class="text-xs font-medium text-slate-500">Email address</dt>
                    <dd class="mt-1 truncate text-sm font-semibold text-slate-900">{{ $user->email }}</dd>
                </div>

                <div class="rounded-xl bg-slate-50 p-4">
                    <dt class="text-xs font-medium text-slate-500">Member since</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900">
                        {{ $user->created_at?->format('d M Y') ?? '-' }}
                    </dd>
                </div>

            </dl>

        </div>
    </div>

</div>

@endsection