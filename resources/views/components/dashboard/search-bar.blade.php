@props([
    'action' => '#',
    'name' => 'q',
    'placeholder' => 'Search address, neighborhood or landmark',
])

<form action="{{ $action }}" method="GET" {{ $attributes->merge(['class' => 'relative']) }}>
    <span class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
        <x-dashboard.icon name="search" class="h-4 w-4" />
    </span>
    <input
        type="text"
        name="{{ $name }}"
        value="{{ request($name) }}"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-700
               shadow-sm placeholder:text-slate-400 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100"
    >
</form>