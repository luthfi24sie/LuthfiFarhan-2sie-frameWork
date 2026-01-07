@extends('layouts.guest')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<section class="animate-fade-in-up">
  <!-- Cover & Profile -->
  <div class="relative mb-24">
    <div class="w-full bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl h-48 shadow-lg shadow-purple-500/20 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    </div>
    <div class="absolute -bottom-16 left-6 md:left-12 flex items-end gap-6">
        <div class="w-32 h-32 rounded-full p-1 bg-[#1A1A23]">
            <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('assets-admin-volt/img/team-2.jpg') }}" class="w-full h-full rounded-full object-cover border-4 border-[#1A1A23]" alt="avatar">
        </div>
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
            <div class="flex items-center gap-2 text-gray-400 text-sm">
                <span>{{ $user->email }}</span>
                <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                <span class="px-2 py-0.5 rounded text-xs uppercase font-bold bg-purple-500/10 text-purple-400 border border-purple-500/20">{{ $user->role }}</span>
            </div>
        </div>
    </div>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <!-- Upload Section Removed for Read-Only Guest Access -->
    <div class="xl:col-span-2 space-y-6">
        <div class="bg-[#1A1A23] rounded-3xl border border-white/5 p-6">
             <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-paperclip text-blue-400"></i> Lampiran Terunggah
                </h3>
                <span class="text-xs bg-[#0B0B0F] text-gray-400 px-3 py-1 rounded-lg border border-white/5">{{ count($medias) }} file</span>
             </div>
             
             <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @forelse($medias as $m)
                  <div class="group relative aspect-square bg-[#0B0B0F] rounded-xl overflow-hidden border border-white/10 hover:border-purple-500/30 transition-all">
                    <img src="{{ asset('storage/'.$m->file_path) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" alt="media">
                    <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white transition-all backdrop-blur-sm">
                        <span class="text-sm font-bold flex items-center gap-2"><i class="fa-solid fa-eye"></i> Lihat</span>
                    </a>
                  </div>
                @empty
                  <div class="col-span-full py-8 text-center text-gray-500 italic bg-[#0B0B0F] rounded-xl border border-white/5">
                    Belum ada lampiran.
                  </div>
                @endforelse
             </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="xl:col-span-1">
        <div class="bg-[#1A1A23] rounded-3xl border border-white/5 p-6 sticky top-24">
            <h3 class="font-bold text-white mb-6">Informasi Akun</h3>
            <div class="space-y-4">
                <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Status</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-emerald-400 font-medium">Aktif</span>
                    </div>
                </div>
                <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Bergabung Sejak</p>
                    <p class="text-white">{{ $user->created_at->format('d F Y') }}</p>
                </div>
                <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                    <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Total Upload</p>
                    <p class="text-white">{{ count($medias) }} Berkas</p>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-white/5">
                <a href="{{ route('guest.users.index') }}" class="w-full block text-center px-4 py-3 rounded-xl bg-[#0B0B0F] border border-white/10 text-gray-400 hover:text-white hover:bg-[#12121A] transition-all font-bold text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar User
                </a>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection
