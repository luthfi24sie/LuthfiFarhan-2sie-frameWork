<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserGuestController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $role = $request->string('role')->toString();
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

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->update($validated);

        return redirect()->route('guest.users.index')->with('success', 'User berhasil diperbarui');
    }

    public function show(User $user)
    {
        $medias = Media::where('model', 'users')->where('model_id', $user->id)->latest()->get();
        return view('guest.users.show', compact('user', 'medias'));
    }

    public function storeMedia(Request $request, User $user)
    {
        $request->validate([
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($request->file('photos') as $file) {
            $path = $file->store('uploads', 'public');
            Media::create([
                'model' => 'users',
                'model_id' => $user->id,
                'file_path' => $path,
            ]);
        }

        return back()->with('success', 'File berhasil diunggah');
    }
}

