<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PeristiwaKelahiran;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class PeristiwaKelahiranGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $noAkta = $request->query('no_akta');
        $tempat = $request->query('tempat');
        $tgl = $request->query('tgl');
        $data = PeristiwaKelahiran::with(['warga', 'ayah', 'ibu', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('tempat_lahir', 'like', "%{$search}%")
                        ->orWhere('no_akta', 'like', "%{$search}%")
                        ->orWhereHas('warga', fn($w) => $w->where('nama', 'like', "%{$search}%"));
                });
            })
            ->when($noAkta, fn($q) => $q->where('no_akta', 'like', "%{$noAkta}%"))
            ->when($tempat, fn($q) => $q->where('tempat_lahir', 'like', "%{$tempat}%"))
            ->when($tgl, fn($q) => $q->where('tgl_lahir', $tgl))
            ->orderByDesc('kelahiran_id')
            ->paginate(12)
            ->withQueryString();

        return view('guest.kelahiran.index', ['kelahiran' => $data, 'search' => $search, 'noAkta' => $noAkta, 'tempat' => $tempat, 'tgl' => $tgl]);
    }

    public function create()
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.kelahiran.create', ['wargaOptions' => $wargaOptions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'ayah_warga_id' => ['nullable', 'exists:warga,warga_id'],
            'ibu_warga_id' => ['nullable', 'exists:warga,warga_id'],
            'no_akta' => ['required', 'string', 'max:100', 'unique:peristiwa_kelahiran,no_akta'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $kelahiran = PeristiwaKelahiran::create(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kelahiran_documents', 'public');
                Media::create([
                    'ref_table' => 'peristiwa_kelahiran',
                    'ref_id' => $kelahiran->kelahiran_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Kelahiran',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.kelahiran.index')->with('success', 'Data kelahiran ditambahkan.');
    }

    public function show(PeristiwaKelahiran $kelahiran)
    {
        $kelahiran->load(['warga', 'ayah', 'ibu', 'media']);
        return view('guest.kelahiran.show', ['kelahiran' => $kelahiran]);
    }

    public function edit(PeristiwaKelahiran $kelahiran)
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.kelahiran.edit', ['kelahiran' => $kelahiran, 'wargaOptions' => $wargaOptions]);
    }

    public function update(Request $request, PeristiwaKelahiran $kelahiran)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'ayah_warga_id' => ['nullable', 'exists:warga,warga_id'],
            'ibu_warga_id' => ['nullable', 'exists:warga,warga_id'],
            'no_akta' => ['required', 'string', 'max:100', 'unique:peristiwa_kelahiran,no_akta,'.$kelahiran->kelahiran_id.',kelahiran_id'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $kelahiran->update(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kelahiran_documents', 'public');
                Media::create([
                    'ref_table' => 'peristiwa_kelahiran',
                    'ref_id' => $kelahiran->kelahiran_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Kelahiran',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.kelahiran.index')->with('success', 'Data kelahiran diperbarui.');
    }

    public function destroy(PeristiwaKelahiran $kelahiran)
    {
        $kelahiran->delete();
        return redirect()->route('guest.kelahiran.index')->with('success', 'Data kelahiran dihapus.');
    }
}
