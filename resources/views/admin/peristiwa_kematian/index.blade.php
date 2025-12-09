@extends('layouts.admin.app')
@section('title','Peristiwa Kematian')
@section('content')
<div class="px-6 py-6">
    <div><nav class="text-sm text-white/80 mb-1">Pages / <span class="font-semibold text-white">Kematian</span></nav>
    <h1 class="text-2xl font-bold text-white">Data Kematian</h1></div>

    <div class="bg-white p-6 mt-8 rounded-2xl shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl">List Kematian</h2>
            <a href="{{ route('peristiwa_kematian.create') }}" class="bg-[#6c63ff] text-white px-3 py-2 rounded">Tambah</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="bg-gray-100">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Warga</th>
                    <th class="p-3 border">Tgl Meninggal</th>
                    <th class="p-3 border">Sebab</th>
                    <th class="p-3 border">Aksi</th>
                </tr></thead>
                <tbody>
                    @forelse($data as $it)
                    <tr class="border">
                        <td class="p-3">{{ $it->kematian_id }}</td>
                        <td class="p-3">{{ optional($it->warga)->nama }}</td>
                        <td class="p-3">{{ $it->tgl_meninggal }}</td>
                        <td class="p-3">{{ $it->sebab }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('peristiwa_kematian.show',$it) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Lihat</a>
                            <form action="{{ route('peristiwa_kematian.destroy',$it) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-4 text-center">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $data->links() }}</div>
    </div>
</div>
@endsection
