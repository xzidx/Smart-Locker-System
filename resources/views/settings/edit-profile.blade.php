@extends('layouts.app')

@section('title', 'Edit Profile')

@section('page-title', 'Edit Profile')

@section('page-description', 'Update your personal information')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            Edit Profile
        </h1>

        <p class="mt-1 text-gray-500">
            Update your photo and personal information
        </p>
    </div>

    {{-- Form --}}
    <div class="bg-white border border-gray-200 rounded-xl p-6">

        <form action="{{ route('settings.profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">

            {{-- Profile Photo --}}
            <div class="mb-8 pb-8 border-b border-gray-100">

                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Profile Photo
                </label>

                <div class="flex items-center gap-6">

                    {{-- Preview --}}
                    <div>
                        <img id="avatar-preview"
                             src="{{ $user->avatar_url }}"
                             alt="Avatar preview"
                             class="{{ $user->avatar_url ? '' : 'hidden' }} w-24 h-24 rounded-full object-cover ring-4 ring-gray-100">

                        <div id="avatar-initial"
                             class="{{ $user->avatar_url ? 'hidden' : 'flex' }} w-24 h-24 rounded-full bg-blue-100
                                    items-center justify-center text-3xl font-bold text-blue-600 ring-4 ring-gray-100">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div>
                        <div class="flex flex-wrap items-center gap-3">

                            <label for="avatar"
                                   class="cursor-pointer px-4 py-2 border border-gray-300 rounded-lg
                                          text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Upload new photo
                            </label>

                            <input type="file"
                                   id="avatar"
                                   name="avatar"
                                   accept="image/png,image/jpeg,image/webp"
                                   class="hidden">

                            <button type="button"
                                    id="remove-btn"
                                    class="{{ $user->avatar_url ? '' : 'hidden' }} px-4 py-2 rounded-lg
                                           text-sm font-medium text-red-600 hover:bg-red-50">
                                Remove
                            </button>

                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            JPG, PNG or WEBP. Max 2 MB.
                        </p>
                    </div>

                </div>

                @error('avatar')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Full Name --}}
            <div class="mb-6">

                <label for="name"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >

                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Email --}}
            <div class="mb-6">

                <label for="email"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('settings') }}"
                   class="px-5 py-2.5 border border-gray-300
                          text-gray-700 rounded-lg hover:bg-gray-50">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white
                           rounded-lg hover:bg-blue-700">
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    (function () {
        const input   = document.getElementById('avatar');
        const preview = document.getElementById('avatar-preview');
        const initial = document.getElementById('avatar-initial');
        const removeB = document.getElementById('remove-btn');
        const removeF = document.getElementById('remove_avatar');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            removeF.value = '0';
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            initial.classList.add('hidden');
            initial.classList.remove('flex');
            removeB.classList.remove('hidden');
        });

        removeB.addEventListener('click', function () {
            input.value = '';
            removeF.value = '1';
            preview.classList.add('hidden');
            initial.classList.remove('hidden');
            initial.classList.add('flex');
            removeB.classList.add('hidden');
        });
    })();
</script>

@endsection