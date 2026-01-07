@extends('layouts.guest')

@section('title', 'Data User')
@section('page-title', 'Data User')

@section('content')
    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">List User</p>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-users-gear text-purple-500"></i> Data User
                </h3>
                <p class="text-sm text-gray-400 mt-1">Daftar pengguna terdaftar.</p>
            </div>
            
            <form method="get" class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                <div class="flex items-center w-full md:w-64 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 focus-within:border-purple-500/50 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 mr-3"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..." class="flex-1 bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none" />
                </div>
                
                <div class="relative w-full md:w-48">
                    <select name="role" class="w-full bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 text-sm text-white focus:outline-none focus:border-purple-500/50 appearance-none transition-colors">
                        <option value="">Semua Role</option>
                        <option value="admin" @selected(request('role')=='admin')>Admin</option>
                        <option value="guest" @selected(request('role')=='guest')>Guest</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs pointer-events-none"></i>
                </div>
                
                <label class="inline-flex items-center gap-2 text-sm text-gray-400 bg-[#0B0B0F] px-4 py-2.5 rounded-xl border border-white/10 cursor-pointer hover:bg-white/5 transition-colors">
                    <input type="checkbox" name="has_photo" value="1" @checked(request('has_photo')) class="rounded border-white/10 bg-[#1A1A23] text-purple-600 focus:ring-purple-500 focus:ring-offset-0"> 
                    <span>Dengan Foto</span>
                </label>
                
                <a href="{{ route('guest.users.index') }}" class="px-4 py-2.5 rounded-xl bg-white/5 text-gray-400 text-sm font-bold hover:bg-white/10 hover:text-white transition-all text-center">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
                
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-blue-600 text-white text-sm font-bold shadow-lg shadow-purple-500/20 hover:shadow-purple-500/30 transition-all hover:-translate-y-0.5">
                    Filter
                </button>
            </form>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto rounded-2xl border border-white/5">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#0B0B0F] text-gray-400 font-bold uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4 text-center">Foto Profil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-[#12121A]">
                        @forelse($users as $index => $u)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-white font-semibold group-hover:text-purple-400 transition-colors">
                                {{ $u->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $u->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $u->role === 'admin' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 'bg-gray-500/10 text-gray-400 border border-gray-500/20' }}">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="w-10 h-10 rounded-full border border-white/10 overflow-hidden bg-[#0B0B0F] inline-block">
                                    <img src="{{ $u->profile_picture ? asset('storage/'.$u->profile_picture) : asset('assets-admin-volt/img/team-2.jpg') }}" class="w-full h-full object-cover" alt="avatar">
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-users-slash text-2xl text-gray-600"></i>
                                </div>
                                <h3 class="text-white font-bold mb-1">Tidak ada data</h3>
                                <p class="text-gray-500 text-sm">Tidak ada user ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 border-t border-white/5 pt-6">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
@endsection
