@extends('layouts.guest')

@section('title', 'Ubah KK')
@section('page-title', 'Ubah Data Keluarga KK')

@section('content')
    <section class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50">
            <div>
                <p class="text-xs uppercase text-slate-400 tracking-wide">Perbarui Informasi KK</p>
                <h2 class="text-2xl font-semibold text-slate-800">Nomor KK: {{ $keluarga->kk_nomor }}</h2>
                <p class="text-sm text-slate-500">ID internal: {{ $keluarga->kk_id }}</p>
            </div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-blue-100 text-blue-600 text-sm font-semibold">
                <i class="ni ni-check-bold"></i> Mode Ubah
            </span>
        </div>
        <div class="p-6 md:p-8">
            <form action="{{ route('guest.keluarga-kk.update', $keluarga) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                @include('guest.keluarga_kk.partials.form')
            </form>
        </div>
    </section>
@endsection

