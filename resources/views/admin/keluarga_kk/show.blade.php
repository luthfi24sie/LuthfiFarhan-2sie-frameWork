@extends('layouts.admin.app')
@section('title','Detail Keluarga')

@section('content')
<div class="px-6 py-6">
    <div>
        <nav class="text-sm text-white/80 mb-1">
            Pages / Keluarga / <span class="font-semibold text-white">Detail</span>
        </nav>
        <h1 class="text-2xl font-bold text-white">Detail Keluarga</h1>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h2 class="text-xl font-bold">KK {{ $kk->kk_nomor }}</h2>

        <p class="text-gray-700">
            Kepala: {{ optional($kk->kepalaKeluarga)->nama ?? '-' }}
        </p>

        <p class="text-gray-700">
            Alamat: {{ $kk->alamat ?? '-' }}
        </p>

        {{-- ⭐ RT RW DITAMBAHKAN DI SINI --}}
        <p class="text-gray-700">
            RT: {{ $kk->rt ?? '-' }}
        </p>

        <p class="text-gray-700">
            RW: {{ $kk->rw ?? '-' }}
        </p>

        <div class="mt-6">
            <a href="{{ route('keluarga_kk.index') }}"
               class="bg-gray-200 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
