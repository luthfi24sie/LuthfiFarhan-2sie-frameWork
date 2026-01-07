@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Card Warga -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Warga</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $wargaCount }}</h3>
            </div>
            <div class="p-3 bg-blue-50 rounded-xl">
                <i class="fa-solid fa-users text-blue-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm text-gray-500">
            <span class="text-green-500 font-bold flex items-center mr-2">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +2.5%
            </span>
            <span>dari bulan lalu</span>
        </div>
    </div>

    <!-- Card KK -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Kartu Keluarga</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $kkCount }}</h3>
            </div>
            <div class="p-3 bg-purple-50 rounded-xl">
                <i class="fa-solid fa-house-chimney text-purple-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm text-gray-500">
            <span class="text-green-500 font-bold flex items-center mr-2">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +1.2%
            </span>
            <span>dari bulan lalu</span>
        </div>
    </div>

    <!-- Card Kelahiran -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Kelahiran</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $kelahiranCount }}</h3>
            </div>
            <div class="p-3 bg-green-50 rounded-xl">
                <i class="fa-solid fa-baby text-green-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm text-gray-500">
            <span class="text-gray-400 text-xs">Total data tercatat</span>
        </div>
    </div>

    <!-- Card Kematian -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Kematian</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $kematianCount }}</h3>
            </div>
            <div class="p-3 bg-red-50 rounded-xl">
                <i class="fa-solid fa-ribbon text-red-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm text-gray-500">
            <span class="text-gray-400 text-xs">Total data tercatat</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h4 class="font-bold text-gray-800 mb-4">Akses Cepat</h4>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('warga.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-blue-500/50 hover:bg-blue-50 transition-all group text-center">
                <div class="w-10 h-10 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-blue-600">Tambah Warga</span>
            </a>
            <a href="{{ route('keluarga_kk.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-purple-500/50 hover:bg-purple-50 transition-all group text-center">
                <div class="w-10 h-10 mx-auto bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-purple-600">Buat KK Baru</span>
            </a>
            <a href="{{ route('peristiwa_kelahiran.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-green-500/50 hover:bg-green-50 transition-all group text-center">
                <div class="w-10 h-10 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-baby-carriage"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-green-600">Catat Kelahiran</span>
            </a>
            <a href="{{ route('peristiwa_kematian.create') }}" class="p-4 rounded-xl border border-gray-100 hover:border-red-500/50 hover:bg-red-50 transition-all group text-center">
                <div class="w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-3 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-book-skull"></i>
                </div>
                <span class="text-sm font-semibold text-gray-600 group-hover:text-red-600">Catat Kematian</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h4 class="font-bold text-gray-800 mb-4">Statistik Peristiwa</h4>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                        <i class="fa-solid fa-truck-moving"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">Perpindahan Penduduk</p>
                        <p class="text-xs text-gray-500">Total data perpindahan</p>
                    </div>
                </div>
                <span class="text-lg font-bold text-gray-800">{{ $pindahCount }}</span>
            </div>
            <!-- More stats can go here -->
        </div>
    </div>
</div>
@endsection
