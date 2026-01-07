@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-20 pb-32">
        <!-- Background Glows -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-20 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-white/5 border border-white/10 text-purple-400 text-xs font-semibold tracking-wider uppercase mb-6 backdrop-blur-sm">
                Sistem Informasi Desa Terpadu
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight mb-8 leading-tight">
                Data Desa Kependudukan <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-blue-500">Transparan & Akurat</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                Dengan Ini Saya Perkenalkan Platform digital untuk pengelolaan dan transparansi data kependudukan desa. Akses data warga, data keluarga kk, data anggota keluarga, data kematian dan peristiwa penting secara real-time.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#features" class="px-8 py-4 rounded-full bg-white text-dark-900 font-bold hover:bg-gray-100 transition-all shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                    Jelajahi Data
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik Section (Section Data Desa) -->
    <div class="relative py-12 border-y border-white/5 bg-[#0B0B0F]/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $wargaCount }}</p>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">Total Warga</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $kkCount }}</p>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">Kartu Keluarga</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $kelahiranCount }}</p>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">Kelahiran</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $kematianCount }}</p>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">Kematian</p>
                </div>
                <div class="text-center col-span-2 md:col-span-1">
                    <p class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $pindahCount }}</p>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">Perpindahan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features / Data Grid -->
    <div id="features" class="relative py-24 bg-[#0B0B0F]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Portal Data Desa Kependudukan</h2>
                <p class="text-gray-400 max-w-xl mx-auto">Akses berbagai kategori data kependudukan desa dengan mudah dan cepat.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Data Warga -->
                <a href="{{ route('guest.warga.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-purple-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-purple-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500/20 to-blue-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-users text-2xl text-purple-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Data Warga</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Daftar lengkap penduduk desa dengan detail informasi personal.</p>
                </a>

                <!-- Data KK -->
                <a href="{{ route('guest.keluarga-kk.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-blue-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-house-chimney text-2xl text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Kartu Keluarga</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Arsip data Kartu Keluarga beserta anggotanya.</p>
                </a>

                <!-- Anggota Keluarga -->
                <a href="{{ route('guest.anggota-keluarga.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-cyan-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-cyan-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-teal-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-people-roof text-2xl text-cyan-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Anggota Keluarga</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Detail hubungan dan status anggota dalam keluarga.</p>
                </a>

                 <!-- Media -->
                 <a href="{{ route('guest.media.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-pink-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-pink-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500/20 to-rose-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-images text-2xl text-pink-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Galeri Media</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Arsip dokumentasi dan file pendukung data desa.</p>
                </a>

                <!-- Kelahiran -->
                <a href="{{ route('guest.kelahiran.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-green-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-green-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-baby text-2xl text-green-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Data Kelahiran</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Pencatatan peristiwa kelahiran warga baru.</p>
                </a>

                <!-- Kematian -->
                <a href="{{ route('guest.kematian.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-red-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-red-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-ribbon text-2xl text-red-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Data Kematian</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Arsip data kematian warga desa.</p>
                </a>

                <!-- Pindah -->
                <a href="{{ route('guest.pindah.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-orange-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-orange-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500/20 to-yellow-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-truck-moving text-2xl text-orange-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Data Pindah</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Arsip data perpindahan penduduk.</p>
                </a>

                <!-- Users -->
                <a href="{{ route('guest.users.index') }}" class="group relative p-8 rounded-3xl bg-[#1A1A23] border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500/20 to-violet-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-users-gear text-2xl text-indigo-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Data Users</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Informasi pengguna sistem dan role akses.</p>
                </a>
            </div>
        </div>
    </div>
@endsection
