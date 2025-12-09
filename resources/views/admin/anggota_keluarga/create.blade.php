@extends('layouts.admin.app')

@section('title', 'Tambah Anggota Keluarga')

@section('content')

<div class="px-6 py-6">

    <h1 class="text-2xl font-bold text-white mb-6">Tambah Anggota Keluarga</h1>

    <div class="bg-white shadow-xl rounded-2xl p-6">

        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Kartu Keluarga (KK)</label>
                    <select name="kk_id" class="w-full border p-2 rounded outline-blue-500">
                        @foreach ($kk as $item)
                            <option value="{{ $item->kk_id }}">{{ $item->kk_nomor }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Warga</label>
                    <select name="warga_id" class="w-full border p-2 rounded outline-blue-500">
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label>Hubungan</label>
                    <input type="text" name="hubungan"
                           class="w-full border p-2 rounded outline-blue-500" required>
                </div>

            </div>

            <button class="mt-6 bg-[#6c63ff] text-white py-2 px-4 rounded-xl">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection
