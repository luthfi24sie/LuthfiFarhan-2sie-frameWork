@extends('layouts.admin.app')

@section('title', 'Detail Data Pindah')

@section('content')

<div class="px-6 py-6">

    <h1 class="text-2xl font-bold text-white mb-6">Detail Data Perpindahan</h1>

    <div class="bg-white shadow-xl rounded-2xl p-6">

        <p><strong>Nama Warga:</strong> {{ $pindah->warga->nama }}</p>
        <p><strong>Tanggal Pindah:</strong> {{ $pindah->tgl_pindah }}</p>
        <p><strong>Alamat Tujuan:</strong> {{ $pindah->alamat_tujuan }}</p>
        <p><strong>Alasan:</strong> {{ $pindah->alasan }}</p>
        <p><strong>No Surat:</strong> {{ $pindah->no_surat }}</p>

        <a href="{{ route('pindah.index') }}"
           class="mt-6 inline-block bg-gray-500 text-white py-2 px-4 rounded-xl">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

    </div>

</div>

@endsection
