@extends('layouts.guest')

@section('title', 'Data Media')
@section('page-title', 'Data Media')

@section('content')
    <section class="bg-[#1A1A23] rounded-3xl border border-white/5 overflow-hidden animate-fade-in-up">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 py-6 border-b border-white/5 bg-[#12121A]/50 backdrop-blur-xl">
            <div>
                <p class="text-xs font-bold uppercase text-purple-400 tracking-wider mb-1">Arsip</p>
                <h3 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-images text-purple-500"></i> Data Media
                </h3>
                <p class="text-sm text-gray-400 mt-1">Arsip dokumen dan media pendukung.</p>
            </div>
            
            <form method="GET" class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                <div class="flex items-center w-full md:w-64 bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 focus-within:border-purple-500/50 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 mr-3"></i>
                    <input type="text" name="q" value="{{ $q }}" class="flex-1 bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none" placeholder="Cari caption / file...">
                </div>
                
                <div class="relative w-full md:w-48">
                    <select name="ref_table" class="w-full bg-[#0B0B0F] rounded-xl px-4 py-2.5 border border-white/10 text-sm text-white focus:outline-none focus:border-purple-500/50 appearance-none transition-colors">
                        <option value="">Semua Tabel</option>
                        @foreach($tables as $table)
                            <option value="{{ $table }}" {{ $ref_table == $table ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $table)) }}</option>
                        @endforeach
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 text-xs pointer-events-none"></i>
                </div>

                <a href="{{ route('guest.media.index') }}" class="px-4 py-2.5 rounded-xl bg-white/5 text-gray-400 text-sm font-bold hover:bg-white/10 hover:text-white transition-all text-center">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
                
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-blue-600 text-white text-sm font-bold shadow-lg shadow-purple-500/20 hover:shadow-purple-500/30 transition-all hover:-translate-y-0.5">
                    Filter
                </button>
            </form>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto rounded-2xl border border-white/5">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#0B0B0F] text-gray-400 font-bold uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Preview</th>
                            <th class="px-6 py-4">Caption</th>
                            <th class="px-6 py-4">Referensi</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-[#12121A]">
                        @forelse($media as $index => $item)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4 text-gray-500 font-mono">{{ $media->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-lg bg-[#0B0B0F] border border-white/10 flex items-center justify-center overflow-hidden">
                                    @if(str_starts_with($item->mime_type, 'image/'))
                                        <img src="{{ asset('storage/' . $item->file_url) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-file-lines text-gray-500 text-xl"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-medium block mb-1">{{ $item->caption }}</span>
                                <span class="text-xs text-gray-500 font-mono truncate max-w-[200px] block">{{ basename($item->file_url) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-purple-400 text-xs font-bold uppercase tracking-wide bg-purple-500/10 px-2 py-1 rounded-md w-fit mb-1">
                                        {{ str_replace('_', ' ', $item->ref_table) }}
                                    </span>
                                    <span class="text-gray-500 text-xs">ID: {{ $item->ref_id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs font-mono">{{ $item->mime_type }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ asset('storage/' . $item->file_url) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 hover:scale-110 transition-all" title="Lihat File">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-folder-open text-2xl text-gray-600"></i>
                                </div>
                                <h3 class="text-white font-bold mb-1">Tidak ada data</h3>
                                <p class="text-gray-500 text-sm">Belum ada media yang tersimpan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 border-t border-white/5 pt-6">
                {{ $media->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
@endsection
