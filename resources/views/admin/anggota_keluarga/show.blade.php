@extends('layouts.admin.app')

@section('title', 'Detail Anggota Keluarga')

@section('content')

<div class="px-6 py-6">

    <h1 class="text-2xl font-bold text-white mb-6">Detail Anggota Keluarga</h1>

    <div class="bg-white shadow-xl rounded-2xl p-6">

        <p><strong>KK:</strong> {{ $anggota->kk->kk_nomor }}</p>
        <p><strong>Nama Warga:</strong> {{ $anggota->warga->nama }}</p>
        <p><strong>Hubungan:</strong> {{ $anggota->hubungan }}</p>

        <a href="{{ route('anggota.index') }}"
           class="mt-6 inline-block bg-gray-500 text-white py-2 px-4 rounded-xl">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

    </div>

</div>

@endsection
