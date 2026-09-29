@props([
    'name',
    'address',
    'hours',
    'available',
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-100 bg-white p-4 shadow-sm']) }}>
    <p class="text-sm font-semibold text-slate-900">{{ $name }}</p>
    <p class="mt-0.5 text-xs text-slate-500">{{ $address }} · Open daily {{ $hours }}</p>
    <span class="mt-2 inline-block rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-600">
        {{ $available }} available
    </span>
</div>