@extends('layouts.guest')

@section('title', 'Data Warga')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-10 text-center">
            <span class="text-purple-500 font-semibold tracking-wider uppercase text-sm">Data Kependudukan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">Data Warga Desa</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Daftar lengkap penduduk desa dengan informasi detail. Gunakan fitur pencarian untuk menemukan data spesifik.
            </p>
        </div>

        <!-- Filter & Search -->
        <div class="bg-[#1A1A23] rounded-3xl p-6 border border-white/5 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-500"></i>
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama / NIK..." 
                           class="w-full bg-[#0B0B0F] border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>
                
                <div class="relative">
                    <i class="fa-solid fa-briefcase absolute left-4 top-3.5 text-gray-500"></i>
                    <input type="text" name="pekerjaan" value="{{ $pekerjaan }}" placeholder="Filter Pekerjaan..." 
                           class="w-full bg-[#0B0B0F] border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white placeholder-gray-500 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                </div>

                <div class="relative">
                    <i class="fa-solid fa-praying-hands absolute left-4 top-3.5 text-gray-500"></i>
                    <select name="agama" class="w-full bg-[#0B0B0F] border border-white/10 rounded-xl py-3 pl-10 pr-4 text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all appearance-none">
                        <option value="">Semua Agama</option>
                        <option value="Islam" {{ $agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ $agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ $agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ $agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ $agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-semibold py-3 px-6 rounded-xl transition-all shadow-lg shadow-purple-500/20">
                        Filter
                    </button>
                    <a href="{{ route('guest.warga.index') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-white border border-white/10 transition-all flex items-center justify-center">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Data Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($warga as $item)
                @php
                    $photo = optional($item->media->sortBy('sort_order')->first())->file_url;
                    $anggota = $item->anggotaKeluarga->first();
                    $kk = $anggota ? $anggota->kk : null;
                @endphp
                <div class="group bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden hover:border-purple-500/30 transition-all hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-500/10">
                    <div class="p-6">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-2xl bg-[#0B0B0F] border border-white/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($photo)
                                    <img src="{{ asset('storage/'.$photo) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fa-solid fa-user text-2xl text-gray-600"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white mb-1 group-hover:text-purple-400 transition-colors">{{ $item->nama }}</h3>
                                <p class="text-xs font-mono text-purple-400 bg-purple-500/10 px-2 py-1 rounded-lg inline-block border border-purple-500/20">
                                    {{ $item->no_ktp }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                                <span class="text-gray-500">Jenis Kelamin</span>
                                <span class="text-gray-300">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                                <span class="text-gray-500">Agama</span>
                                <span class="text-gray-300">{{ $item->agama }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm border-b border-white/5 pb-2">
                                <span class="text-gray-500">Pekerjaan</span>
                                <span class="text-gray-300">{{ $item->pekerjaan }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm pt-1">
                                <span class="text-gray-500">Alamat</span>
                                <span class="text-gray-300 text-right max-w-[60%] truncate">{{ $kk->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 bg-[#12121A] border-t border-white/5 flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            <i class="fa-solid fa-clock mr-1"></i> Update: {{ $item->updated_at ? $item->updated_at->diffForHumans() : '-' }}
                        </span>
                        <a href="{{ route('guest.warga.show', $item->warga_id) }}" class="text-sm font-medium text-purple-400 hover:text-purple-300 flex items-center gap-1 transition-colors">
                            Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-folder-open text-3xl text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-medium text-white mb-2">Tidak ada data ditemukan</h3>
                    <p class="text-gray-400">Coba ubah kata kunci pencarian atau filter Anda.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $warga->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
