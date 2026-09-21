@props([
    'label',
    'value',
    'change',
    'tone' => 'blue',
    'icon' => 'users',
])

@php
    $toneMap = [
        'blue'   => ['bg' => 'bg-blue-50',    'icon' => 'text-blue-600',    'change' => 'text-blue-600'],
        'green'  => ['bg' => 'bg-emerald-50', 'icon' => 'text-emerald-600', 'change' => 'text-emerald-600'],
        'red'    => ['bg' => 'bg-rose-50',    'icon' => 'text-rose-500',    'change' => 'text-rose-500'],
        'purple' => ['bg' => 'bg-violet-50',  'icon' => 'text-violet-600',  'change' => 'text-violet-600'],
    ];
    $colors = $toneMap[$tone] ?? $toneMap['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-100 bg-white p-4 shadow-sm']) }}>
    <div class="flex items-start justify-between">
        <span class="text-xs font-medium text-slate-500">{{ $label }}</span>
        <span class="flex h-8 w-8 items-center justify-center rounded-full {{ $colors['bg'] }} {{ $colors['icon'] }}">
            <x-dashboard.icon :name="$icon" class="h-4 w-4" />
        </span>
    </div>
    <p class="mt-3 text-2xl font-bold text-slate-900">{{ $value }}</p>
    <p class="mt-1 text-xs font-medium {{ $colors['change'] }}">{{ $change }}</p>
</div>