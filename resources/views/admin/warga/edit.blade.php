@extends('layouts.admin.app')

@section('title', 'Edit Data Warga')

@section('content')

<div class="text-white mb-8">
    <div class="text-sm opacity-70">
        Pages / <span class="font-semibold">Warga</span>
    </div>
    <h1 class="text-2xl font-bold mt-1">Edit Data Warga</h1>
    <p class="opacity-80 text-sm">Perbarui data warga.</p>
</div>

<div class="bg-white shadow-[0_4px_20px_rgba(0,0,0,0.08)] rounded-2xl p-8 border border-gray-100">

    <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-yellow-500 text-white rounded-xl flex items-center justify-center shadow">
            <i class="ni ni-ruler-pencil text-xl"></i>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Edit Data Warga</h2>
            <p class="text-gray-500 text-sm">Ubah informasi yang diperlukan.</p>
        </div>
    </div>

    <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold text-gray-700">No KTP</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 
                              focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 
                              focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white 
                               focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih</option>
                    <option value="L" {{ $warga->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
                    <option value="P" {{ $warga->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="font-semibold text-gray-700">Agama</label>
                <input type="text" name="agama" value="{{ old('agama', $warga->agama) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Telp</label>
                <input type="text" name="telp" value="{{ old('telp', $warga->telp) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $warga->email) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

        </div>

        <div class="mt-8 flex gap-4">
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2.5 rounded-xl shadow">
                Update Data
            </button>

            <a href="{{ route('warga.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2.5 rounded-xl">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection
