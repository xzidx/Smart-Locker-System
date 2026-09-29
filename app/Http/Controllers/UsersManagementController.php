<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersManagementController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('latestLockerUsage')
            ->withCount('lockerUsages')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->whereHas('lockerUsages', fn ($q) => $q->where('status', $status));
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $totalUsers   = User::count();
        $newThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('users-management.index', compact('users', 'totalUsers', 'newThisMonth'));
    }

    public function create()
    {
        return view('users-management.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:30',
        ]);

        // The 'hashed' cast in the model hashes this automatically
        User::create($data + ['password' => 'password']);

        return redirect()->route('users-management.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load('lockerUsages');

        return view('users-management.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users-management.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
        ]);

        $user->update($data);

        return redirect()->route('users-management.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users-management.index')
            ->with('success', 'User deleted.');
    }
}