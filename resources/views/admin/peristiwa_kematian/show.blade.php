@extends('layouts.admin.app')
@section('title','Detail Kematian')
@section('content')
<div class="px-6 py-6">
    <div><nav class="text-sm text-white/80 mb-1">Pages / Kematian / <span class="font-semibold text-white">Detail</span></nav><h1 class="text-2xl font-bold text-white">Detail Kematian</h1></div>

    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h2 class="text-xl">Kematian ID: {{ $data->kematian_id }}</h2>
        <p><strong>Nama:</strong> {{ optional($data->warga)->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $data->tgl_meninggal }}</p>
        <p><strong>Sebab:</strong> {{ $data->sebab }}</p>

        <hr class="my-3"><h3 class="font-semibold">Bukti</h3>
        <div class="mt-2 space-y-2">
            @foreach($data->media ?? [] as $m)
                <div class="flex items-center justify-between p-2 border rounded">
                    <div>@if(Str::contains($m->mime_type,'image'))<img src="{{ asset('storage/'.$m->file_url) }}" class="h-20 rounded">@else<a href="{{ asset('storage/'.$m->file_url) }}" target="_blank" class="text-blue-600 underline">Lihat File</a>@endif<div class="text-sm text-gray-600">{{ $m->caption }}</div></div>
                    <form action="{{ route('media.destroy',$m->media_id) }}" method="POST">@csrf @method('DELETE')<button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button></form>
                </div>
            @endforeach
        </div>

        <div class="mt-4"><a href="{{ route('peristiwa_kematian.index') }}" class="bg-gray-200 px-4 py-2 rounded">Kembali</a></div>
    </div>
</div>
@endsection
