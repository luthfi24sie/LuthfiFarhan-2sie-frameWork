@extends('layouts.guest')

@section('title', 'Data Keluarga KK')
@section('page-title', 'Data Keluarga KK')

@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <article class="bg-white rounded-3xl shadow-lg p-6 border border-slate-100">
            <p class="text-xs uppercase text-slate-400">Total KK</p>
            <div class="flex items-center justify-between mt-2">
                <div>
                    <p class="text-3xl font-semibold text-slate-800">{{ $totalKk }}</p>
                    <p class="text-sm text-slate-500 mt-1">Keseluruhan data keluarga</p>
                </div>
                <span class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">
                    <i class="ni ni-collection"></i>
                </span>
            </div>
        </article>
        <article class="bg-white rounded-3xl shadow-lg p-6 border border-slate-100">
            <p class="text-xs uppercase text-slate-400">Kepala Terdata</p>
            <div class="flex items-center justify-between mt-2">
                <div>
                    <p class="text-3xl font-semibold text-slate-800">{{ $kepalaTerisi }}</p>
                    <p class="text-sm text-slate-500 mt-1">KK memiliki kepala keluarga</p>
                </div>
                <span class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-500 flex items-center justify-center text-2xl">
                    <i class="ni ni-single-02"></i>
                </span>
            </div>
        </article>
        <article class="bg-gradient-to-br from-blue-600 to-cyan-400 rounded-3xl p-6 shadow-xl text-white">
            <p class="text-sm uppercase text-white/80">Tambah Data</p>
            <p class="text-lg font-semibold mt-1">Lengkapi KK baru dengan validasi otomatis.</p>
            <a href="{{ route('guest.keluarga-kk.create') }}" class="mt-4 inline-flex items-center gap-2 bg-white text-blue-600 font-semibold px-5 py-3 rounded-2xl shadow-lg">
                <i class="ni ni-fat-add text-lg"></i> Tambah KK
            </a>
        </article>
    </section>

    <section class="mt-8 bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-6 border-b border-slate-100">
            <div>
                <p class="text-xs uppercase text-slate-400 tracking-wide">Daftar KK</p>
                <h3 class="text-2xl font-semibold text-slate-800">Monitoring Data Keluarga</h3>
                <p class="text-sm text-slate-500">Menampilkan {{ $keluarga->count() }} dari total {{ $keluarga->total() }} data.</p>
            </div>
            <form method="GET" class="flex items-center gap-3">
                <div class="flex items-center w-64 bg-slate-50 rounded-2xl px-3 py-2 border border-transparent focus-within:border-blue-500">
                    <i class="ni ni-zoom-split-in text-slate-400"></i>
                    <input type="text" name="q" value="{{ $search }}" class="flex-1 bg-transparent text-sm text-slate-600 focus:outline-none px-2" placeholder="Cari nomor KK / alamat / kepala">
                </div>
                <button type="submit" class="px-4 py-2 rounded-2xl bg-blue-600 text-white text-sm font-semibold shadow-lg shadow-blue-600/20">
                    Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Nomor KK</th>
                    <th class="px-6 py-3 text-left">Kepala Keluarga</th>
                    <th class="px-6 py-3 text-left">Alamat</th>
                    <th class="px-6 py-3 text-left">RT/RW</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                @forelse($keluarga as $item)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-6 py-4 font-semibold text-slate-400">{{ $keluarga->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $item->kk_nomor }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $item->kepalaKeluarga ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>
                                {{ $item->kepalaKeluarga->nama ?? 'Belum diatur' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $item->alamat }}</td>
                        <td class="px-6 py-4">{{ $item->rt ?? '-' }}/{{ $item->rw ?? '-' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('guest.keluarga-kk.edit', $item) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-2xl border border-blue-200 text-blue-600 hover:bg-blue-50">
                                <i class="ni ni-ruler-pencil"></i>
                            </a>
                            <form action="{{ route('guest.keluarga-kk.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-2xl border border-rose-200 text-rose-600 hover:bg-rose-50">
                                    <i class="ni ni-fat-remove"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400">
                            Belum ada data keluarga. Klik tombol tambah di atas untuk memulai.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 rounded-b-3xl">
            {{ $keluarga->links('pagination::tailwind') }}
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function confirmDelete(form) {
            return confirm('Hapus data KK ini?');
        }
    </script>
@endpush

