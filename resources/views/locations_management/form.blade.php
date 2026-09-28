@php
    $fields = [
        'name'     => 'Location Name',
        'address'  => 'Address',
        'building' => 'Building',
        'floor'    => 'Floor',
    ];
@endphp

<div class="grid gap-5 sm:grid-cols-2">
    @foreach ($fields as $name => $label)
        <div class="{{ in_array($name, ['name', 'address']) ? 'sm:col-span-2' : '' }}">
            <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-slate-700">{{ $label }}</label>
            <input id="{{ $name }}" name="{{ $name }}" type="text"
                   value="{{ old($name, $location->$name ?? '') }}"
                   class="w-full rounded-lg border px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 {{ $errors->has($name) ? 'border-red-400' : 'border-slate-200' }}">
            @error($name)
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endforeach
</div>

<div class="mt-8 flex justify-end gap-3">
    <a href="{{ route('locations-management.index') }}"
       class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</a>
    <button type="submit"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Save</button>
</div>