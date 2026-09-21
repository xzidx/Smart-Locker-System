@props([
    'title',
    'time',
    'status' => 'Active',
    'last' => false,
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between px-4 py-4 ' . ($last ? '' : 'border-b border-slate-100')]) }}>
    <div>
        <p class="text-sm font-medium text-slate-900">{{ $title }}</p>
        <p class="mt-0.5 text-xs text-slate-500">{{ $time }}</p>
    </div>
    <span @class([
        'rounded-full px-3 py-1 text-xs font-medium',
        'bg-emerald-50 text-emerald-600' => strtolower($status) === 'active',
        'bg-slate-100 text-slate-500' => strtolower($status) !== 'active',
    ])>
        {{ $status }}
    </span>
</div>