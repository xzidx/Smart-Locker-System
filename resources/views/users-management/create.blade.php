@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-xl px-8 py-8">
    <h2 class="mb-6 text-2xl font-bold">Add new user</h2>

    <form method="POST" action="{{ route('users-management.store') }}"
          class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('users-management.index') }}"
               class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">Cancel</a>
            <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Save</button>
        </div>
    </form>
</main>
@endsection