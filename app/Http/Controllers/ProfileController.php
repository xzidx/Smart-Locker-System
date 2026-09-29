<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile settings page.
     */
    public function index()
    {
        $user = Auth::user();

        return view('settings.index', compact('user'));
    }


    /**
     * Show edit profile page.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('settings.edit-profile', compact('user'));
    }


    /**
     * Update user profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate user information
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'unique:users,email,' . $user->id,
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        // Update name
        $user->name = $validated['name'];


        // Update email
        $user->email = $validated['email'];


        // Check if user uploaded a new profile picture
        if ($request->hasFile('profile_photo')) {

            // Delete old profile picture
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }


            // Store new profile picture
            $path = $request->file('profile_photo')
                ->store('profile-photos', 'public');


            // Save path in database
            $user->profile_photo = $path;
        }


        // Save everything
        $user->save();


        // Go back to settings page
        return redirect()
            ->route('settings')
            ->with('success', 'Profile updated successfully.');
    }
}