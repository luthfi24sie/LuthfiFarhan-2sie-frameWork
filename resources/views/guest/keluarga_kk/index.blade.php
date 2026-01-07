@extends('layouts.guest')

@section('title', 'Data Keluarga KK')
@section('page-title', 'Data Keluarga KK')

@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up mb-8">
        <article class="bg-[#1A1A23] rounded-3xl border border-white/5 p-6 relative overflow-hidden group hover:border-purple-500/30 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            <p class="text-xs font-bold uppercase text-gray-500 tracking-wider">Total KK</p>
            <div class="flex items-center justify-between mt-4">
                <div>
                    <p class="text-4xl font-bold text-white">{{ $totalKk }}</p>
                    <p class="text-sm text-gray-400 mt-1">Keseluruhan data keluarga</p>
                </div>
                <span class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500/20 to-purple-500/20 text-purple-400 flex items-center justify-center text-2xl border border-white/5 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-users"></i>
                </span>
            </div>
        </article>
        <article class="bg-[#1A1A23] rounded-3xl border border-white/5 p-6 relative overflow-hidden group hover:border-emerald-500/30 transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
            <p class="text-xs font-bold uppercase text-gray-500 tracking-wider">Kepala Terdata</p>
            <div class="flex items-center justify-between mt-4">
                <div>
                    <p class="text-4xl font-bold text-white">{{ $kepalaTerisi }}</p>
                    <p class="text-sm text-gray-400 mt-1">KK memiliki kepala keluarga</p>
                </div>
                <span class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/20 text-emerald-400 flex items-center justify-center text-2xl border border-white/5 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-user-check"></i>
                </span>
            </div>
        </article>
        <article class="bg-gradient-to-br from-purple-600 to-blue-600 rounded-3xl p-6 relative overflow-hidden shadow-lg shadow-purple-500/20">
            <div class="absolute top-0 right-0 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="relative z-10 text-white">
                <h3 class="text-xl font-bold mb-2">Informasi</h3>
                <p class="text-sm text-purple-100 leading-relaxed">
                    Data Keluarga KK mencakup informasi detail mengenai kartu keluarga, alamat domisili, dan kepala keluarga yang terdaftar.
                </p>
            </div>
        </article>
    </section>

    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up delay-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">Daftar KK</p>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice text-purple-500"></i> Monitoring Data Keluarga
                </h3>
                <p class="text-sm text-gray-400 mt-1">Menampilkan {{ $keluarga->count() }} dari total {{ $keluarga->total() }} data.</p>
            </div>
            
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex items-center w-full sm:w-64 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 focus-within:border-purple-500/50 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 mr-3"></i>
                    <input type="text" name="q" value="{{ $search }}" class="flex-1 bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none" placeholder="Cari nomor KK / alamat...">
                </div>
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
                @forelse($keluarga as $item)
                    @php
                        $media = $item->kepalaKeluarga ? $item->kepalaKeluarga->media : collect();
                        $photo = optional($media->sortBy('sort_order')->first())->file_url;
                    @endphp
                    <div class="group bg-[#0B0B0F] rounded-3xl border border-white/5 overflow-hidden hover:border-purple-500/30 transition-all hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-500/10">
                        <div class="p-6">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-[#1A1A23] border border-white/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if($photo)
                                        <img src="{{ asset('storage/'.$photo) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-users text-2xl text-gray-600"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-purple-400 transition-colors">{{ $item->kepalaKeluarga->nama ?? 'Belum diatur' }}</h3>
                                    <p class="text-xs font-mono text-purple-400 bg-purple-500/10 px-2 py-1 rounded-lg inline-block border border-purple-500/20">
                                        #{{ $item->kk_nomor }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                                    <span class="text-gray-500">RT / RW</span>
                                    <span class="text-gray-300 font-mono">{{ $item->rt ?? '-' }} / {{ $item->rw ?? '-' }}</span>
                                </div>
                                <div class="flex items-start justify-between text-sm pt-1">
                                    <span class="text-gray-500">Alamat</span>
                                    <span class="text-gray-300 text-right max-w-[60%]">{{ $item->alamat }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-[#12121A] border-t border-white/5 flex justify-between items-center">
                            <span class="text-xs text-gray-500">
                                <i class="fa-solid fa-clock mr-1"></i> Update: {{ $item->updated_at ? $item->updated_at->diffForHumans() : '-' }}
                            </span>
                            <a href="{{ route('guest.keluarga-kk.show', $item->kk_id) }}" class="text-sm font-medium text-purple-400 hover:text-purple-300 flex items-center gap-1 transition-colors">
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
                        <p class="text-gray-500">Data keluarga belum tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="px-6 py-4 border-t border-white/5 bg-[#12121A]">
            {{ $keluarga->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
