@extends('layouts.guest')

@section('title', 'Detail Warga')
@section('page-title', 'Detail Warga')

@section('content')
    @php
        $currentAnggota = $warga->anggotaKeluarga->first();
        $kk = $currentAnggota ? $currentAnggota->kk : null;
    @endphp
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up">
        <!-- Sidebar Profile -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 p-8 text-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                
                @php $photo = optional($warga->media->where('caption', 'Foto Profil')->first())->file_url; @endphp
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-[#0B0B0F] shadow-2xl relative z-10 group-hover:scale-105 transition-transform duration-500">
                    @if($photo)
                        <img src="{{ asset('storage/'.$photo) }}" alt="foto" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#0B0B0F] flex items-center justify-center text-gray-600">
                            <i class="fa-solid fa-user text-4xl"></i>
                        </div>
                    @endif
                </div>
                
                <h2 class="mt-6 text-xl font-bold text-white">{{ $warga->nama }}</h2>
                <p class="text-gray-500 text-sm font-mono mt-1">{{ $warga->nik ?? $warga->no_ktp }}</p>
                
                <div class="mt-6 flex justify-center gap-2">
                    <!-- Edit button removed for read-only access -->
                </div>
            </div>

            <!-- Status Info -->
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 p-6">
                <h3 class="font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 bg-purple-500 rounded-full"></span>
                    Status & Kontak
                </h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex justify-between items-center border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <span class="text-gray-500">Status Kawin</span>
                        <span class="font-medium text-gray-300">{{ $warga->status_perkawinan ?? '-' }}</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <span class="text-gray-500">Pekerjaan</span>
                        <span class="font-medium text-gray-300">{{ $warga->pekerjaan ?? '-' }}</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <span class="text-gray-500">Telepon</span>
                        <span class="font-medium text-gray-300">{{ $warga->telp ?? '-' }}</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <span class="text-gray-500">Email</span>
                        <span class="font-medium text-gray-300">{{ $warga->email ?? '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Biodata Lengkap -->
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
                    <h3 class="font-bold text-white">Biodata Lengkap</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                        <p class="font-medium text-gray-300">
                            {{ $warga->tempat_lahir ?? '-' }}, {{ $warga->tanggal_lahir ? \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Jenis Kelamin</p>
                        <p class="font-medium text-gray-300">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Agama</p>
                        <p class="font-medium text-gray-300">{{ $warga->agama ?? '-' }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Pendidikan Terakhir</p>
                        <p class="font-medium text-gray-300">{{ $warga->pendidikan_terakhir ?? '-' }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Nama Ayah</p>
                        <p class="font-medium text-gray-300">{{ $warga->nama_ayah ?? '-' }}</p>
                    </div>
                    <div class="bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Nama Ibu</p>
                        <p class="font-medium text-gray-300">{{ $warga->nama_ibu ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2 bg-[#0B0B0F] p-4 rounded-xl border border-white/5">
                        <p class="text-gray-500 text-xs uppercase font-bold tracking-wider mb-1">Alamat Lengkap</p>
                        <p class="font-medium text-gray-300">
                            {{ $warga->alamat ?? '-' }}
                            @if($warga->rt || $warga->rw)
                                RT {{ $warga->rt }}/RW {{ $warga->rw }}
                            @endif
                            @if($warga->kelurahan)
                                , Kel. {{ $warga->kelurahan }}
                            @endif
                            @if($warga->kecamatan)
                                , Kec. {{ $warga->kecamatan }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Keluarga -->
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl flex justify-between items-center">
                    <h3 class="font-bold text-white">Kartu Keluarga</h3>
                    @if($currentAnggota && $kk)
                        <a href="{{ route('guest.keluarga-kk.show', $kk) }}" class="text-xs text-purple-400 hover:text-purple-300 transition-colors flex items-center gap-1">
                            Lihat KK #{{ $kk->kk_nomor }} <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
                <div class="p-6">
                    @if($currentAnggota && $kk)
                        <div class="mb-6 p-4 rounded-xl bg-purple-500/10 border border-purple-500/20">
                            <p class="text-sm text-purple-300">
                                Terdaftar di KK Nomor <strong class="text-purple-200">{{ $kk->kk_nomor }}</strong> 
                                sebagai <strong class="text-purple-200">{{ $currentAnggota->hubungan }}</strong>
                            </p>
                        </div>
                        <h4 class="text-sm font-bold text-gray-400 mb-4 uppercase tracking-wider">Anggota Keluarga Lainnya:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($kk->anggota as $member)
                                @if($member->warga_id != $warga->warga_id)
                                    <a href="{{ route('guest.warga.show', $member->warga) }}" class="flex items-center gap-3 p-3 rounded-xl bg-[#0B0B0F] border border-white/5 hover:border-purple-500/30 hover:bg-[#12121A] transition-all">
                                        <div class="w-10 h-10 rounded-full bg-[#1A1A23] border border-white/10 flex items-center justify-center text-xs font-bold text-gray-400">
                                            {{ substr($member->warga->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-300">{{ $member->warga->nama }}</p>
                                            <p class="text-xs text-gray-500">{{ $member->hubungan }}</p>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-gray-500 italic text-center py-4 bg-[#0B0B0F] rounded-xl border border-white/5">
                            Belum terdaftar dalam Kartu Keluarga manapun.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Dokumen Pendukung -->
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
                    <h3 class="font-bold text-white">Dokumen Pendukung</h3>
                </div>
                <div class="p-6">
                    @php $docs = $warga->media->where('caption', 'Dokumen Pendukung'); @endphp
                    @if($docs->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($docs as $doc)
                                <div class="relative group rounded-xl overflow-hidden border border-white/10 bg-[#0B0B0F]">
                                    @if(str_starts_with($doc->mime_type, 'image/'))
                                        <img src="{{ asset('storage/'.$doc->file_url) }}" class="w-full h-32 object-cover transition-transform duration-500 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                                    @else
                                        <div class="w-full h-32 flex flex-col items-center justify-center p-4 text-center group-hover:bg-[#1A1A23] transition-colors">
                                            <i class="fa-solid fa-file-lines text-3xl text-gray-500 mb-2 group-hover:text-purple-400 transition-colors"></i>
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
                        <div class="text-gray-500 italic text-center py-4 bg-[#0B0B0F] rounded-xl border border-white/5">
                            Tidak ada dokumen pendukung.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Riwayat Peristiwa -->
            <div class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
                    <h3 class="font-bold text-white">Riwayat Peristiwa</h3>
                </div>
                <div class="p-6 space-y-4">
                    @if($warga->kelahiran)
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-emerald-500/5 border border-emerald-500/20 hover:bg-emerald-500/10 transition-colors">
                            <div class="p-2 bg-emerald-500/20 rounded-lg text-emerald-400"><i class="fa-solid fa-baby"></i></div>
                            <div>
                                <h4 class="text-sm font-bold text-emerald-400">Data Kelahiran</h4>
                                <p class="text-xs text-gray-400 mt-1">Lahir pada <span class="text-gray-300">{{ $warga->kelahiran->tgl_lahir }}</span> di <span class="text-gray-300">{{ $warga->kelahiran->tempat_lahir }}</span>. No Akta: <span class="font-mono">{{ $warga->kelahiran->no_akta }}</span></p>
                            </div>
                        </div>
                    @endif

                    @if($warga->pindah->count() > 0)
                        @foreach($warga->pindah as $pindah)
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-orange-500/5 border border-orange-500/20 hover:bg-orange-500/10 transition-colors">
                                <div class="p-2 bg-orange-500/20 rounded-lg text-orange-400"><i class="fa-solid fa-truck"></i></div>
                                <div>
                                    <h4 class="text-sm font-bold text-orange-400">Pindah Keluar</h4>
                                    <p class="text-xs text-gray-400 mt-1">Pindah ke <span class="text-gray-300">{{ $pindah->alamat_tujuan }}</span> pada <span class="text-gray-300">{{ $pindah->tgl_pindah }}</span>. Alasan: {{ $pindah->alasan }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    @if(!$warga->kelahiran && $warga->pindah->count() == 0)
                        <div class="text-gray-500 italic text-center py-4 bg-[#0B0B0F] rounded-xl border border-white/5">
                            Belum ada riwayat peristiwa tercatat.
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="flex gap-3 pt-2">
                <a href="{{ route('guest.warga.index') }}" class="px-5 py-2.5 rounded-xl bg-[#0B0B0F] border border-white/10 text-gray-300 hover:text-white hover:bg-[#1A1A23] transition-all font-medium text-sm flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Warga
                </a>
            </div>
        </div>
    </div>
@endsection
