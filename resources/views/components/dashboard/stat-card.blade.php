@props([
    'label',
    'value',
    'change' => null,
    'tone' => 'blue',
])

@php
    $toneMap = [
        'blue' => [
            'bg' => 'bg-blue-50',
            'icon' => 'text-blue-600',
            'change' => 'text-blue-600',
            'line' => 'bg-blue-500',
        ],

        'green' => [
            'bg' => 'bg-emerald-50',
            'icon' => 'text-emerald-600',
            'change' => 'text-emerald-600',
            'line' => 'bg-emerald-500',
        ],

        'red' => [
            'bg' => 'bg-rose-50',
            'icon' => 'text-rose-600',
            'change' => 'text-rose-600',
            'line' => 'bg-rose-500',
        ],

        'purple' => [
            'bg' => 'bg-violet-50',
            'icon' => 'text-violet-600',
            'change' => 'text-violet-600',
            'line' => 'bg-violet-500',
        ],
    ];

    $colors = $toneMap[$tone] ?? $toneMap['blue'];
@endphp

<div
    class="group relative flex h-[155px] w-full flex-col overflow-hidden rounded-[20px] border border-slate-200 bg-white p-5 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-slate-300 hover:shadow-lg"
>

    {{-- Top Section --}}
    <div class="flex items-start justify-between gap-4">

        {{-- Text --}}
        <div class="min-w-0">

            <p class="text-sm font-medium text-slate-500">
                {{ $label }}
            </p>

            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                {{ $value }}
            </p>

        </div>

        {{-- Icon --}}
        <div
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[14px] {{ $colors['bg'] }} {{ $colors['icon'] }}"
        >
            {{ $slot }}
        </div>

    </div>

    {{-- Change --}}
    @if($change)
        <div class="mt-auto">
            <p class="text-xs font-medium {{ $colors['change'] }}">
                {{ $change }}
            </p>
        </div>
    @endif

    {{-- Bottom Accent --}}
    <div
        class="absolute inset-x-0 bottom-0 h-1 {{ $colors['line'] }} opacity-0 transition-opacity duration-200 group-hover:opacity-100"
    ></div>

</div>