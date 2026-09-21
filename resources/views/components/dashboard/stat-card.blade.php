@props([
    'label',
    'value',
    'change',
    'tone' => 'blue',
])

@php
    $toneMap = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'change' => 'text-blue-600',
        ],

        'green' => [
            'bg' => 'bg-emerald-50',
            'change' => 'text-emerald-600',
        ],

        'red' => [
            'bg' => 'bg-rose-50',
            'change' => 'text-rose-500',
        ],

        'purple' => [
            'bg' => 'bg-violet-50',
            'change' => 'text-violet-600',
        ],
    ];

    $colors = $toneMap[$tone] ?? $toneMap['blue'];
@endphp

<div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

    <div class="flex items-start justify-between">

        {{-- Dynamic Label --}}
        <span class="text-xs font-medium text-slate-500">
            {{ $label }}
        </span>

        {{-- Static Icon --}}
        <span class="flex h-9 w-9 items-center justify-center rounded-full {{ $colors['bg'] }}">
            {{ $slot }}
        </span>

    </div>

    {{-- Dynamic Value --}}
    <p class="mt-3 text-2xl font-bold text-slate-900">
        {{ $value }}
    </p>

    {{-- Dynamic Change --}}
    <p class="mt-1 text-xs font-medium {{ $colors['change'] }}">
        {{ $change }}
    </p>

</div>