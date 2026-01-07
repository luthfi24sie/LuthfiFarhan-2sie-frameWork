@extends('layouts.guest')

@section('title', 'Anggota Keluarga')
@section('page-title', 'Anggota Keluarga')

@section('content')
    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">Kependudukan</p>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-people-roof text-purple-500"></i> Anggota Keluarga
                </h3>
                <p class="text-sm text-gray-400 mt-1">Monitoring anggota keluarga per KK.</p>
            </div>
            
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex items-center w-full sm:w-64 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 focus-within:border-purple-500/50 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 mr-3"></i>
                    <input type="text" name="q" value="{{ $search }}" class="flex-1 bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none" placeholder="Cari nama/hubungan...">
                </div>
                <input type="text" name="hubungan" value="{{ $hubungan }}" class="w-full sm:w-40 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-colors" placeholder="Hubungan">
                <input type="text" name="kk" value="{{ $kk }}" class="w-full sm:w-40 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-colors" placeholder="Nomor KK">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-blue-600 text-white text-sm font-bold shadow-lg shadow-purple-500/20 hover:shadow-purple-500/30 transition-all hover:-translate-y-0.5">
                    Cari
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($anggota as $item)
                    @php
                        $photo = optional($item->warga->media->sortBy('sort_order')->first())->file_url;
                    @endphp
                    <div class="group bg-[#0B0B0F] rounded-3xl border border-white/5 overflow-hidden hover:border-purple-500/30 transition-all hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-500/10">
                        <div class="p-6">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-[#1A1A23] border border-white/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if($photo)
                                        <img src="{{ asset('storage/'.$photo) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-user text-2xl text-gray-600"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-purple-400 transition-colors">{{ $item->warga->nama ?? '-' }}</h3>
                                    <p class="text-xs font-mono text-purple-400 bg-purple-500/10 px-2 py-1 rounded-lg inline-block border border-purple-500/20">
                                        #{{ $item->anggota_id }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                                    <span class="text-gray-500">Hubungan</span>
                                    <span class="text-gray-300 font-medium">{{ $item->hubungan ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm pt-1">
                                    <span class="text-gray-500">Nomor KK</span>
                                    <span class="text-gray-300 font-mono">{{ $item->kk->kk_nomor ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-[#12121A] border-t border-white/5 flex justify-between items-center">
                            <span class="text-xs text-gray-500">
                                <i class="fa-solid fa-clock mr-1"></i> Update: {{ $item->updated_at ? $item->updated_at->diffForHumans() : '-' }}
                            </span>
                            <a href="{{ route('guest.anggota-keluarga.show', $item->anggota_id) }}" class="text-sm font-medium text-purple-400 hover:text-purple-300 flex items-center gap-1 transition-colors">
                                Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-folder-open text-3xl text-gray-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1">Belum ada data</h3>
                        <p class="text-gray-500">Data anggota keluarga belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="px-6 py-4 border-t border-white/5 bg-[#12121A]">
            {{ $anggota->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
