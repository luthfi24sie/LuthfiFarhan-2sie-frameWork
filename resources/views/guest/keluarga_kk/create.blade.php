@extends('layouts.guest')

@section('title', 'Tambah KK')
@section('page-title', 'Tambah Data Keluarga KK')

@section('content')
    <section class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-cyan-400 px-6 py-8 text-white">
            <p class="text-sm uppercase text-white/80 tracking-widest">Formulir KK Baru</p>
            <h2 class="text-3xl font-semibold mt-2">Tambah Data Keluarga</h2>
            <p class="text-sm text-blue-50 mt-2 max-w-2xl">
                Pastikan Nomor KK unik. Sistem akan melakukan validasi, menampilkan flash message, dan mengembalikan input ketika terjadi kesalahan.
            </p>
        </div>
        <div class="p-6 md:p-8">
            <form action="{{ route('guest.keluarga-kk.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('guest.keluarga_kk.partials.form')
            </form>
        </div>
    </section>
@endsection

