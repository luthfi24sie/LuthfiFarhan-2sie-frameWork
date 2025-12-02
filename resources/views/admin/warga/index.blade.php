@extends('layouts.admin.app')

@section('title', 'Data Warga')

@section('content')

<div class="px-6 py-6">

    {{-- TOP TITLE + BREADCRUMB --}}
    <div>
        <nav class="text-sm text-white/80 mb-1">
            Pages / <span class="font-semibold text-white">Data Warga</span>
        </nav>
        <h1 class="text-2xl font-bold text-white">Data Warga</h1>
    </div>

    {{-- CARD UTAMA --}}
    <div class="bg-white shadow-xl rounded-2xl p-6 mt-8">

        {{-- 🔥 FILTER & SEARCH (DITAMBAHKAN) --}}
        <form method="GET" class="flex gap-3 mb-6">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="border px-3 py-2 rounded"
                   placeholder="Cari nama / KTP / pekerjaan">

            <input type="text"
                   name="agama"
                   value="{{ request('agama') }}"
                   class="border px-3 py-2 rounded"
                   placeholder="Agama">

            <select name="jenis_kelamin" class="border px-3 py-2 rounded">
                <option value="">Jenis Kelamin</option>
                <option value="L" {{ request('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                <option value="P" {{ request('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
            </select>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>

            <a href="{{ route('warga.index') }}" class="px-4 py-2 text-purple-600">
                Reset
            </a>

        </form>
        {{-- 🔥 END FILTER --}}


        {{-- HEADER CARD --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">List Data Seluruh Warga</h2>

            <a href="{{ route('warga.create') }}" class="bg-[#6c63ff] hover:bg-[#5a54e6] text-white py-2 px-4 rounded-xl shadow">
                <i class="fa fa-plus mr-1"></i> Tambah Warga
            </a>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">

                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="p-3 border">No</th> {{-- 🔥 NOMOR URUT DITAMBAHKAN --}}
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">No KTP</th>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Jenis Kelamin</th>
                        <th class="p-3 border">Agama</th>
                        <th class="p-3 border">Pekerjaan</th>
                        <th class="p-3 border">Telp</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($warga as $item)
                        <tr class="border">

                            {{-- 🔥 NOMOR URUT --}}
                            <td class="p-3 border">
                                {{ ($warga->currentPage() - 1) * $warga->perPage() + $loop->iteration }}
                            </td>

                            <td class="p-3 border">{{ $item->warga_id }}</td>
                            <td class="p-3 border">{{ $item->no_ktp }}</td>
                            <td class="p-3 border">{{ $item->nama }}</td>

                            <td class="p-3 border">
                                @if($item->jenis_kelamin === 'L')
                                    Laki-laki
                                @elseif($item->jenis_kelamin === 'P')
                                    Perempuan
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="p-3 border">{{ $item->agama ?? '-' }}</td>
                            <td class="p-3 border">{{ $item->pekerjaan ?? '-' }}</td>
                            <td class="p-3 border">{{ $item->telp ?? '-' }}</td>
                            <td class="p-3 border">{{ $item->email ?? '-' }}</td>

                            {{-- 🔥 Aksi --}}
                            <td class="p-3 border flex gap-2">

                                {{-- LIHAT --}}
                                <a href="{{ route('warga.show', $item) }}"
                                   class="flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    <i class="fa fa-eye"></i> <span>Lihat</span>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('warga.edit', $item) }}"
                                   class="flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    <i class="fa fa-edit"></i> <span>Edit</span>
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('warga.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        <i class="fa fa-trash"></i> <span>Hapus</span>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center p-4 text-gray-500">Belum ada data warga</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $warga->withQueryString()->links() }}
        </div>

    </div>

</div>

@endsection
