@extends('layouts.admin.app')
@section('title','Tambah Kematian')
@section('content')
<div class="px-6 py-6">
    <div class="text-white mb-6"><nav class="text-sm opacity-70">Pages / <span class="font-semibold">Kematian</span></nav><h1 class="text-2xl font-bold">Tambah Kematian</h1></div>

    <div class="bg-white p-6 rounded-2xl shadow">
        <form action="{{ route('peristiwa_kematian.store') }}" method="POST" enctype="multipart/form-data">@csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label>Warga</label><select name="warga_id" class="w-full border rounded px-3 py-2">@foreach($warga as $w)<option value="{{ $w->warga_id }}">{{ $w->nama }}</option>@endforeach</select></div>
                <div><label>Tanggal Meninggal</label><input type="date" name="tgl_meninggal" class="w-full border rounded px-3 py-2"></div>
                <div class="md:col-span-2"><label>Sebab</label><input name="sebab" class="w-full border rounded px-3 py-2"></div>
                <div class="md:col-span-2"><label>Bukti (file)</label><input type="file" name="file" class="w-full"></div>
            </div>
            <div class="mt-4 flex gap-3"><button class="bg-[#6c63ff] text-white px-4 py-2 rounded">Simpan</button><a href="{{ route('peristiwa_kematian.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a></div>
        </form>
    </div>
</div>
@endsection
