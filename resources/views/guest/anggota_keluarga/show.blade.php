@extends('layouts.guest')

@section('title', 'Detail Anggota Keluarga')
@section('page-title', 'Detail Anggota Keluarga')

@section('content')
    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up">
        <div class="px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">Detail Data</p>
                <h2 class="text-2xl font-bold text-white">Anggota Keluarga #{{ $anggota->anggota_id }}</h2>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 border border-purple-500/20">
                <i class="fa-solid fa-user-group"></i>
            </div>
        </div>
        
        <div class="p-6 md:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#0B0B0F] p-5 rounded-2xl border border-white/5 hover:border-purple-500/20 transition-colors group">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-2">Nama Lengkap</p>
                    <p class="text-white text-lg font-bold group-hover:text-purple-400 transition-colors">{{ $anggota->warga->nama ?? '-' }}</p>
                </div>
                <div class="bg-[#0B0B0F] p-5 rounded-2xl border border-white/5 hover:border-purple-500/20 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-2">Nomor KK</p>
                    <p class="text-white font-mono">{{ $anggota->kk->kk_nomor ?? '-' }}</p>
                </div>
                <div class="bg-[#0B0B0F] p-5 rounded-2xl border border-white/5 hover:border-purple-500/20 transition-colors">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-2">Hubungan</p>
                    <span class="inline-block px-3 py-1 rounded-lg bg-purple-500/10 border border-purple-500/20 text-purple-400 text-sm font-bold">
                        {{ $anggota->hubungan ?? '-' }}
                    </span>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-gradient-to-b from-blue-500 to-cyan-500 rounded-full"></span>
                    Dokumen Pendukung
                </h3>
                
                @if($anggota->media->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($anggota->media as $media)
                            <div class="group relative aspect-square bg-[#0B0B0F] rounded-xl overflow-hidden border border-white/10 hover:border-blue-500/30 transition-all">
                                @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                    <img src="{{ asset('storage/' . $media->file_url) }}" alt="{{ $media->caption }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-gray-500 p-4 text-center">
                                        <i class="fa-solid fa-file-lines text-4xl mb-2 group-hover:text-blue-400 transition-colors"></i>
                                        <span class="text-xs truncate w-full">{{ basename($media->file_url) }}</span>
                                    </div>
                                @endif
                                <a href="{{ asset('storage/' . $media->file_url) }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white transition-all backdrop-blur-sm">
                                    <span class="text-sm font-bold flex items-center gap-2"><i class="fa-solid fa-eye"></i> Lihat</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-gray-500 italic text-center py-8 bg-[#0B0B0F] rounded-2xl border border-white/5">
                        Tidak ada dokumen pendukung.
                    </div>
                @endif
            </div>

            <div class="mt-8 flex gap-3 pt-6 border-t border-white/5">
                <a href="{{ route('guest.anggota-keluarga.index') }}" class="px-5 py-2.5 rounded-xl bg-[#0B0B0F] border border-white/10 text-gray-300 hover:text-white hover:bg-[#1A1A23] transition-all font-medium text-sm flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </section>
@endsection
