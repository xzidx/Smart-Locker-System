@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-xl px-8 py-8">
    <h2 class="mb-6 text-2xl font-bold">Edit user</h2>

    <form method="POST" action="{{ route('users-management.update', $user) }}"
          class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label class="mb-1 block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between pt-2">
            {{-- Delete button (separate form, outside the update form's fields) --}}
            <button type="submit" form="delete-user-form"
                    onclick="return confirm('Delete this user? This cannot be undone.')"
                    class="rounded-lg border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50">
                Delete
            </button>

            <div class="flex gap-3">
                <a href="{{ route('users-management.index') }}"
                   class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold hover:bg-slate-50">
                    Cancel
                </a>
                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    Update
                </button>
            </div>
        </div>
    </form>

    {{-- Hidden delete form (linked to the Delete button by id) --}}
    <form id="delete-user-form" method="POST" action="{{ route('users-management.destroy', $user) }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</main>
@endsection