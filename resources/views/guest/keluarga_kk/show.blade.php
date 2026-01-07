@extends('layouts.guest')

@section('title', 'Detail Keluarga KK')
@section('page-title', 'Detail Keluarga KK')

@section('content')
    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up">
        <div class="px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">Kartu Keluarga</p>
                <h2 class="text-2xl font-bold text-white">Informasi Keluarga</h2>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 border border-purple-500/20">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="p-6 md:p-8">
            @php
                $media = $keluarga->kepalaKeluarga ? $keluarga->kepalaKeluarga->media : collect();
                $photo = optional($media->sortBy('sort_order')->first())->file_url;
            @endphp
            <div class="flex flex-col md:flex-row items-start gap-6">
                <div class="w-32 h-32 rounded-2xl overflow-hidden border border-white/10 bg-[#0B0B0F] flex items-center justify-center flex-shrink-0 relative group">
                    <div class="absolute inset-0 bg-gradient-to-tr from-purple-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    @if($photo)
                        <img src="{{ asset('storage/'.$photo) }}" alt="foto" class="w-full h-full object-cover relative z-10">
                    @else
                        <i class="fa-solid fa-user-tie text-4xl text-gray-600 relative z-10"></i>
                    @endif
                </div>
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-300">
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Nomor KK</p>
                        <p class="text-white font-mono text-lg">{{ $keluarga->kk_nomor }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Kepala Keluarga</p>
                        <p class="text-white text-lg">{{ $keluarga->kepalaKeluarga->nama ?? '-' }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Alamat</p>
                        <p class="text-white">{{ $keluarga->alamat }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">RT / RW</p>
                        <p class="text-white">{{ $keluarga->rt ?? '-' }} / {{ $keluarga->rw ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-10">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-gradient-to-b from-purple-500 to-blue-500 rounded-full"></span>
                    Anggota Keluarga
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($keluarga->anggota as $a)
                        <a href="{{ route('guest.warga.show', $a->warga) }}" class="group block rounded-2xl border border-white/5 bg-[#0B0B0F] p-4 hover:border-purple-500/30 transition-all hover:-translate-y-1">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#1A1A23] border border-white/10 flex items-center justify-center text-gray-400 group-hover:text-purple-400 group-hover:border-purple-500/30 transition-colors">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    <p class="text-white font-bold group-hover:text-purple-400 transition-colors">{{ $a->warga->nama }}</p>
                                    <p class="text-gray-500 text-xs">Hubungan: {{ $a->hubungan }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-gray-500 italic text-center py-8 bg-[#0B0B0F] rounded-2xl border border-white/5">
                            Belum ada anggota keluarga terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-10">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-gradient-to-b from-emerald-500 to-teal-500 rounded-full"></span>
                    Dokumen Pendukung
                </h3>
                @php $docs = $keluarga->media->where('caption', 'Dokumen Pendukung'); @endphp
                @if($docs->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($docs as $doc)
                            <div class="relative group rounded-xl overflow-hidden border border-white/10 bg-[#0B0B0F]">
                                @if(str_starts_with($doc->mime_type, 'image/'))
                                    <img src="{{ asset('storage/'.$doc->file_url) }}" class="w-full h-32 object-cover transition-transform duration-500 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                                @else
                                    <div class="w-full h-32 flex flex-col items-center justify-center p-4 text-center group-hover:bg-[#1A1A23] transition-colors">
                                        <i class="fa-solid fa-file-lines text-3xl text-gray-500 mb-2 group-hover:text-emerald-400 transition-colors"></i>
                                        <span class="text-xs text-gray-400 truncate w-full group-hover:text-white transition-colors">{{ basename($doc->file_url) }}</span>
                                    </div>
                                @endif
                                <a href="{{ asset('storage/'.$doc->file_url) }}" target="_blank" class="absolute inset-0 bg-black/60 hidden group-hover:flex items-center justify-center text-white text-sm font-bold backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100">
                                    <i class="fa-solid fa-eye mr-2"></i> Lihat
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

            <div class="mt-10 flex gap-3 pt-6 border-t border-white/5">
                <a href="{{ route('guest.keluarga-kk.index') }}" class="px-5 py-2.5 rounded-xl bg-[#0B0B0F] border border-white/10 text-gray-300 hover:text-white hover:bg-[#1A1A23] transition-all font-medium text-sm flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </section>
@endsection
