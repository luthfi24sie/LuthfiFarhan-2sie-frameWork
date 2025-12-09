@extends('layouts.guest')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<section class="px-2 md:px-0">
  <div class="w-full bg-gradient-to-r from-[#5E72E4] to-[#7f97ff] rounded-2xl h-36 shadow-md"></div>
  <div class="-mt-14 bg-white rounded-xl shadow-lg p-6 max-w-2xl">
    @if($errors->any())
      <div class="mb-4 px-4 py-2 rounded-lg bg-rose-50 text-rose-600">Periksa kembali input Anda.</div>
    @endif
    <form method="post" action="{{ route('guest.users.update', $user) }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')
      <div class="flex items-center gap-4">
        <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('assets-admin-volt/img/team-2.jpg') }}" class="w-14 h-14 rounded-full object-cover" alt="avatar">
        <div>
          <label class="text-sm text-slate-500">Foto Profil</label>
          <input type="file" name="profile_photo" accept="image/*" class="block mt-1 text-sm" />
          @error('profile_photo')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
      </div>

      <div>
        <label class="text-sm text-slate-500">Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200" />
        @error('name')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="text-sm text-slate-500">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200" />
        @error('email')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="text-sm text-slate-500">Role</label>
        <select name="role" class="mt-1 w-full px-3 py-2 rounded-lg border border-slate-200">
          <option value="admin" @selected(old('role',$user->role)=='admin')>Admin</option>
          <option value="guest" @selected(old('role',$user->role)=='guest')>Guest</option>
        </select>
        @error('role')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="flex gap-3">
        <button class="px-4 py-2 bg-argon text-white rounded-lg shadow">Simpan</button>
        <a href="{{ route('guest.users.index') }}" class="px-4 py-2 bg-slate-100 rounded-lg">Batal</a>
      </div>
    </form>
  </div>
</section>
@endsection

