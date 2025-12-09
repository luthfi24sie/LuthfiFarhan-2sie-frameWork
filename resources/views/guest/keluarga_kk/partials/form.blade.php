@php($current = $keluarga ?? null)

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-2">Nomor KK <span class="text-rose-500">*</span></label>
        <input type="text" name="kk_nomor"
               class="w-full rounded-2xl border px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('kk_nomor') border-rose-300 @enderror"
               placeholder="Contoh: 3275012300001234"
               value="{{ old('kk_nomor', optional($current)->kk_nomor) }}">
        @error('kk_nomor')
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-2">Kepala Keluarga</label>
        <select name="kepala_keluarga_warga_id"
                class="w-full rounded-2xl border px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('kepala_keluarga_warga_id') border-rose-300 @enderror">
            <option value="">- Pilih Kepala Keluarga -</option>
            @foreach($kepalaOptions as $id => $nama)
                <option value="{{ $id }}" @selected(old('kepala_keluarga_warga_id', optional($current)->kepala_keluarga_warga_id) == $id)>
                    {{ $nama }}
                </option>
            @endforeach
        </select>
        @error('kepala_keluarga_warga_id')
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-600 mb-2">Alamat Lengkap <span class="text-rose-500">*</span></label>
        <textarea name="alamat" rows="4"
                  class="w-full rounded-2xl border px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('alamat') border-rose-300 @enderror"
                  placeholder="Tuliskan alamat lengkap">{{ old('alamat', optional($current)->alamat) }}</textarea>
        @error('alamat')
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-2">RT</label>
        <input type="text" name="rt"
               class="w-full rounded-2xl border px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('rt') border-rose-300 @enderror"
               placeholder="001"
               value="{{ old('rt', optional($current)->rt) }}">
        @error('rt')
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-600 mb-2">RW</label>
        <input type="text" name="rw"
               class="w-full rounded-2xl border px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 @error('rw') border-rose-300 @enderror"
               placeholder="002"
               value="{{ old('rw', optional($current)->rw) }}">
        @error('rw')
        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="flex flex-col md:flex-row justify-end gap-3 mt-8">
    <a href="{{ route('guest.keluarga-kk.index') }}" class="px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 text-center">
        Batal
    </a>
    <button type="submit" class="px-6 py-3 rounded-2xl bg-blue-600 text-white text-sm font-semibold shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
        <i class="ni ni-send text-base"></i> Simpan Data
    </button>
</div>

