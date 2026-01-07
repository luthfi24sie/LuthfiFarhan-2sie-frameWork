<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $role = $request->query('role');
        $hasPhoto = $request->query('has_photo');

        $users = User::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($role, function ($q) use ($role) {
                $q->where('role', $role);
            })
            ->when($hasPhoto, function ($q) {
                $q->whereNotNull('profile_picture');
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('guest.users.index', compact('users', 'search', 'role'));
    }

    public function show(User $user)
    {
        return view('guest.users.show', compact('user'));
    }

    public function storeMedia(Request $request, User $user)
    {
        // Placeholder for media storage logic
        return back();
    }
}
