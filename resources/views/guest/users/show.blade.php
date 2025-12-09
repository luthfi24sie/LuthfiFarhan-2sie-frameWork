@extends('layouts.guest')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<section class="px-2 md:px-0">
  <div class="w-full bg-gradient-to-r from-[#5E72E4] to-[#7f97ff] rounded-2xl h-36 shadow-md"></div>
  <div class="-mt-14 grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 bg-white rounded-xl shadow-lg p-6">
      <div class="flex items-center gap-4">
        <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('assets-admin-volt/img/team-2.jpg') }}" class="w-16 h-16 rounded-full object-cover" alt="avatar">
        <div>
          <div class="text-lg font-semibold">{{ $user->name }}</div>
          <div class="text-sm text-slate-500">{{ $user->email }} • <span class="capitalize">{{ $user->role }}</span></div>
        </div>
      </div>
      <div class="mt-6">
        <div class="text-sm font-semibold text-slate-700">Unggah Bukti (multiple)</div>
        @if(session('success'))
          <div class="mt-2 px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600">{{ session('success') }}</div>
        @endif
        <form method="post" action="{{ route('guest.users.media.store', $user) }}" enctype="multipart/form-data" class="mt-2">
          @csrf
          <input type="file" name="photos[]" multiple accept="image/*" class="block">
          @error('photos')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
          @error('photos.*')<div class="text-rose-600 text-xs mt-1">{{ $message }}</div>@enderror
          <button class="mt-3 px-4 py-2 bg-argon text-white rounded-lg shadow">Upload</button>
        </form>
      </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
      <div class="text-sm font-semibold text-slate-700">Lampiran</div>
      <div class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3">
        @forelse($medias as $m)
          <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank" class="block rounded-lg overflow-hidden shadow">
            <img src="{{ asset('storage/'.$m->file_path) }}" class="w-full h-24 object-cover" alt="media">
          </a>
        @empty
          <div class="text-slate-400 text-sm">Belum ada lampiran.</div>
        @endforelse
      </div>
    </div>
  </div>
</section>
@endsection

