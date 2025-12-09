@extends('layouts.admin.app')

@section('title', 'Tambah Data Warga')

@section('content')

<!-- TOP HEADER -->
<div class="text-white mb-8">
    <div class="text-sm opacity-70">
        Pages / <span class="font-semibold">Warga</span>
    </div>
    <h1 class="text-2xl font-bold mt-1">Tambah Data Warga</h1>
    <p class="opacity-80 text-sm">Form untuk menambahkan data warga baru.</p>
</div>

<!-- CARD -->
<div class="bg-white shadow-[0_4px_20px_rgba(0,0,0,0.08)] rounded-2xl p-8 border border-gray-100">

    <!-- CARD HEADER -->
    <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow">
            <i class="ni ni-fat-add text-xl"></i>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Tambah Data Warga</h2>
            <p class="text-gray-500 text-sm">Isi data warga dengan lengkap.</p>
        </div>
    </div>

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- No KTP -->
            <div>
                <label class="font-semibold text-gray-700">No KTP <span class="text-red-500">*</span></label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Masukkan nomor KTP" required>
                @error('no_ktp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Nama -->
            <div>
                <label class="font-semibold text-gray-700">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Masukkan nama lengkap" required>
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label class="font-semibold text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih</option>
                    <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                </select>
            </div>

            <!-- Agama -->
            <div>
                <label class="font-semibold text-gray-700">Agama</label>
                <input type="text" name="agama" value="{{ old('agama') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Pekerjaan -->
            <div>
                <label class="font-semibold text-gray-700">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Telp -->
            <div>
                <label class="font-semibold text-gray-700">Telp</label>
                <input type="text" name="telp" value="{{ old('telp') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div>
                <label class="font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-8 flex gap-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl shadow">
                Simpan Data
            </button>

            <a href="{{ route('warga.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2.5 rounded-xl">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection
