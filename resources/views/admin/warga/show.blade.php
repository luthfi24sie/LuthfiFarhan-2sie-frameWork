@extends('layouts.admin.app')

@section('title', 'Detail Warga')

@section('content')

<div class="px-6 py-6">

    {{-- BREADCRUMB --}}
    <div>
        <nav class="text-sm text-white/80 mb-1">
            Pages / Data Warga / <span class="font-semibold text-white">Detail</span>
        </nav>
        <h1 class="text-2xl font-bold text-white">Detail Warga</h1>
    </div>

    {{-- CARD DETAIL --}}
    <div class="bg-white shadow-xl rounded-2xl p-6 mt-8">

        <h2 class="text-xl font-bold mb-4">Informasi Lengkap Warga</h2>

        <div class="space-y-3 text-gray-700 text-sm">

            <p><strong>No KTP:</strong> {{ $warga->no_ktp }}</p>
            <p><strong>Nama:</strong> {{ $warga->nama }}</p>

            <p>
                <strong>Jenis Kelamin:</strong>
                {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
            </p>

            <p><strong>Agama:</strong> {{ $warga->agama ?? '-' }}</p>
            <p><strong>Pekerjaan:</strong> {{ $warga->pekerjaan ?? '-' }}</p>
            <p><strong>Telp:</strong> {{ $warga->telp ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $warga->email ?? '-' }}</p>

        </div>

        {{-- BUTTON KEMBALI --}}
        <div class="mt-6">
            <a href="{{ route('warga.index') }}"
               class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl shadow">
                <i class="fa fa-arrow-left"></i> <span>Kembali</span>
            </a>
        </div>

    </div>

</div>

@endsection
