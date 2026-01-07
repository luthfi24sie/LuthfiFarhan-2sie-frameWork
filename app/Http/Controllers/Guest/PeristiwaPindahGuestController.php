<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PeristiwaPindah;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class PeristiwaPindahGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $alamat = $request->query('alamat');
        $alasan = $request->query('alasan');
        $tgl = $request->query('tgl');
        $data = PeristiwaPindah::with(['warga', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('alamat_tujuan', 'like', "%{$search}%")
                        ->orWhere('alasan', 'like', "%{$search}%")
                        ->orWhere('no_surat', 'like', "%{$search}%")
                        ->orWhereHas('warga', fn($w) => $w->where('nama', 'like', "%{$search}%"));
                });
            })
            ->when($alamat, fn($q) => $q->where('alamat_tujuan', 'like', "%{$alamat}%"))
            ->when($alasan, fn($q) => $q->where('alasan', 'like', "%{$alasan}%"))
            ->when($tgl, fn($q) => $q->where('tgl_pindah', $tgl))
            ->orderByDesc('pindah_id')
            ->paginate(12)
            ->withQueryString();

        return view('guest.pindah.index', ['pindah' => $data, 'search' => $search, 'alamat' => $alamat, 'alasan' => $alasan, 'tgl' => $tgl]);
    }

    public function create()
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.pindah.create', ['wargaOptions' => $wargaOptions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_pindah' => ['required', 'date'],
            'alamat_tujuan' => ['required', 'string', 'max:255'],
            'alasan' => ['nullable', 'string', 'max:255'],
            'no_surat' => ['nullable', 'string', 'max:100'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $pindah = PeristiwaPindah::create(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/pindah_documents', 'public');
                \App\Models\Media::create([
                    'ref_table' => 'peristiwa_pindah',
                    'ref_id' => $pindah->pindah_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pindah',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.pindah.index')->with('success', 'Data pindah ditambahkan.');
    }

    public function show(PeristiwaPindah $pindah)
    {
        $pindah->load(['warga', 'media']);
        return view('guest.pindah.show', ['pindah' => $pindah]);
    }

    public function edit(PeristiwaPindah $pindah)
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.pindah.edit', ['pindah' => $pindah, 'wargaOptions' => $wargaOptions]);
    }

    public function update(Request $request, PeristiwaPindah $pindah)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_pindah' => ['required', 'date'],
            'alamat_tujuan' => ['required', 'string', 'max:255'],
            'alasan' => ['nullable', 'string', 'max:255'],
            'no_surat' => ['nullable', 'string', 'max:100'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $pindah->update(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/pindah_documents', 'public');
                \App\Models\Media::create([
                    'ref_table' => 'peristiwa_pindah',
                    'ref_id' => $pindah->pindah_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pindah',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.pindah.index')->with('success', 'Data pindah diperbarui.');
    }

    public function destroy(PeristiwaPindah $pindah)
    {
        $pindah->delete();
        return redirect()->route('guest.pindah.index')->with('success', 'Data pindah dihapus.');
    }
}

