@extends('layouts.admin.app')
@section('title','Tambah Kelahiran')
@section('content')
<div class="px-6 py-6">
    <div class="text-white mb-6"><nav class="text-sm opacity-70">Pages / <span class="font-semibold">Kelahiran</span></nav>
    <h1 class="text-2xl font-bold">Tambah Kelahiran</h1></div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <form action="{{ route('peristiwa_kelahiran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Warga (yang dicatat)</label>
                    <select name="warga_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih --</option>
                        @foreach($warga as $w) <option value="{{ $w->warga_id }}">{{ $w->nama }} ({{ $w->no_ktp }})</option> @endforeach
                    </select>
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input name="tempat_lahir" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>No Akta</label>
                    <input name="no_akta" class="w-full border rounded px-3 py-2">
                    @error('no_akta')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label>Ayah (warga_id)</label>
                    <select name="ayah_warga_id" class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih --</option>
                        @foreach($warga as $w) <option value="{{ $w->warga_id }}">{{ $w->nama }}</option> @endforeach
                    </select>
                </div>

                <div>
                    <label>Ibu (warga_id)</label>
                    <select name="ibu_warga_id" class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih --</option>
                        @foreach($warga as $w) <option value="{{ $w->warga_id }}">{{ $w->nama }}</option> @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label>Bukti (file)</label>
                    <input type="file" name="file" class="w-full">
                    <p class="text-sm text-gray-500">Unggah scan akta atau bukti lain (opsional).</p>
                </div>
            </div>

            <div class="mt-4 flex gap-3">
                <button class="bg-[#6c63ff] text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('peristiwa_kelahiran.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
