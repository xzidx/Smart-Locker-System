<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
{
    $user = auth()->user();

    return view('setting.profile', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    // validate

    // update user

    return redirect()
        ->route('setting.profile')
        ->with('success', 'Profile updated successfully!');
}
}
