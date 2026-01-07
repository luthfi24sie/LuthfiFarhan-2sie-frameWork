<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserGuestController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $role = $request->input('role');
        $hasPhoto = $request->boolean('has_photo');

        $users = User::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%$q%")
                       ->orWhere('email', 'like', "%$q%");
                });
            })
            ->when($role, fn($query) => $query->where('role', $role))
            ->when($hasPhoto, fn($query) => $query->whereNotNull('profile_photo'))
            ->orderByDesc('id')
            ->paginate(10)
            ->appends($request->query());

        return view('guest.users.index', compact('users', 'q', 'role', 'hasPhoto'));
    }

    public function create()
    {
        return view('guest.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,guest'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if ($request->hasFile('profile_photo')) {
            $userData['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        User::create($userData);

        return redirect()->route('guest.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return view('guest.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('guest.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,guest'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $user->profile_photo = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('guest.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }
        $user->delete();

        return redirect()->route('guest.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function storeMedia(Request $request, User $user)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('file')->store('uploads/users_media', 'public');

        Media::create([
            'ref_table' => 'users',
            'ref_id' => $user->id,
            'file_url' => $path,
            'caption' => $request->caption ?? $request->file('file')->getClientOriginalName(),
            'mime_type' => $request->file('file')->getMimeType(),
            'sort_order' => 0,
        ]);

        return back()->with('success', 'Media berhasil diunggah.');
    }
}
