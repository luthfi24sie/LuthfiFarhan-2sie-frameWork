@extends('layouts.admin.app')

@section('title', 'Edit Data Kelahiran')

@section('content')

<div class="px-6 py-6">

    <h1 class="text-2xl font-bold text-white mb-6">Edit Data Kelahiran</h1>

    <div class="bg-white shadow-xl rounded-2xl p-6">

        <form action="{{ route('kelahiran.update', $kelahiran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label>Nama Bayi (Warga)</label>
                    <select name="warga_id" class="w-full border p-2 rounded">
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}" 
                                {{ $kelahiran->warga_id == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ $kelahiran->tgl_lahir }}" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $kelahiran->tempat_lahir }}" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label>Ayah</label>
                    <select name="ayah_warga_id" class="w-full border p-2 rounded">
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}"
                                {{ $kelahiran->ayah_warga_id == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Ibu</label>
                    <select name="ibu_warga_id" class="w-full border p-2 rounded">
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}"
                                {{ $kelahiran->ibu_warga_id == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label>No Akta</label>
                    <input type="text" name="no_akta" value="{{ $kelahiran->no_akta }}" class="w-full border p-2 rounded">
                </div>

            </div>

            <button class="mt-6 bg-yellow-500 text-white py-2 px-4 rounded-xl">
                Update
            </button>

        </form>

    </div>

</div>

@endsection
