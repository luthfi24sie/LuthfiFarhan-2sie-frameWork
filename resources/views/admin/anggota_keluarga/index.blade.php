@extends('layouts.admin.app')

@section('title', 'Data Anggota Keluarga')

@section('content')

<div class="px-6 py-6">

    <div>
        <nav class="text-sm text-white/80 mb-1">
            Pages / <span class="font-semibold text-white">Data Anggota Keluarga</span>
        </nav>
        <h1 class="text-2xl font-bold text-white">Data Anggota Keluarga</h1>
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-6 mt-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">List Anggota Keluarga</h2>

            <a href="{{ route('anggota.create') }}"
               class="bg-[#6c63ff] hover:bg-[#5a54e6] text-white py-2 px-4 rounded-xl shadow">
                <i class="fa fa-plus mr-1"></i> Tambah Anggota
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">

                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">KK</th>
                        <th class="p-3 border">Nama Warga</th>
                        <th class="p-3 border">Hubungan</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($anggota as $item)
                        <tr class="border">
                            <td class="p-3 border">{{ $item->anggota_id }}</td>
                            <td class="p-3 border">{{ $item->kk->kk_nomor }}</td>
                            <td class="p-3 border">{{ $item->warga->nama }}</td>
                            <td class="p-3 border">{{ $item->hubungan }}</td>

                            <td class="p-3 border flex gap-1">
                                <a href="{{ route('anggota.show', $item) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>

                                <a href="{{ route('anggota.edit', $item) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('anggota.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">Belum ada anggota keluarga.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $anggota->links() }}
        </div>

    </div>

</div>

@endsection
