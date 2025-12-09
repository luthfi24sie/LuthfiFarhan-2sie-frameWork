@extends('layouts.guest')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<section class="px-2 md:px-0">
  <div class="w-full bg-gradient-to-r from-[#5E72E4] to-[#7f97ff] rounded-2xl h-36 shadow-md"></div>
  <div class="-mt-14 bg-white rounded-xl shadow-lg p-6">
    <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or email" class="px-3 py-2 rounded-lg border border-slate-200" />
      <select name="role" class="px-3 py-2 rounded-lg border border-slate-200">
        <option value="">All Roles</option>
        <option value="admin" @selected(request('role')=='admin')>Admin</option>
        <option value="guest" @selected(request('role')=='guest')>Guest</option>
      </select>
      <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="has_photo" value="1" @checked(request('has_photo')) class="rounded"> Only with photo</label>
      <button class="px-4 py-2 bg-argon text-white rounded-lg shadow">Filter</button>
    </form>

    @if(session('success'))
      <div class="mt-4 px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600">{{ session('success') }}</div>
    @endif

    <div class="mt-4 overflow-x-auto">
      <table class="min-w-full">
        <thead>
          <tr class="text-xs text-slate-400">
            <th class="text-left font-semibold py-2">User</th>
            <th class="text-left font-semibold py-2">Email</th>
            <th class="text-left font-semibold py-2">Role</th>
            <th class="text-left font-semibold py-2">Created</th>
            <th class="text-left font-semibold py-2">Action</th>
          </tr>
        </thead>
        <tbody class="text-sm text-slate-700">
          @foreach($users as $u)
          <tr class="border-t">
            <td class="py-3">
              <div class="flex items-center gap-3">
                <img src="{{ $u->profile_photo ? asset('storage/'.$u->profile_photo) : asset('assets-admin-volt/img/team-2.jpg') }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
                <span class="font-semibold">{{ $u->name }}</span>
              </div>
            </td>
            <td class="py-3">{{ $u->email }}</td>
            <td class="py-3 capitalize">{{ $u->role }}</td>
            <td class="py-3">{{ $u->created_at?->format('d M Y') }}</td>
            <td class="py-3 space-x-2">
              <a href="{{ route('guest.users.edit', $u) }}" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200">Edit</a>
              <a href="{{ route('guest.users.show', $u) }}" class="px-3 py-1 rounded-lg bg-argon text-white">Detail</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4">{{ $users->links('pagination::tailwind') }}</div>
    </div>
  </div>
  <div class="mt-6 text-xs text-slate-400">Distributed by ThemeWagon</div>
</section>
@endsection

