<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PeristiwaKematian;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class PeristiwaKematianGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $lokasi = $request->query('lokasi');
        $sebab = $request->query('sebab');
        $tgl = $request->query('tgl');
        $data = PeristiwaKematian::with(['warga', 'media'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('sebab', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('no_surat', 'like', "%{$search}%")
                        ->orWhereHas('warga', fn($w) => $w->where('nama', 'like', "%{$search}%"));
                });
            })
            ->when($lokasi, fn($q) => $q->where('lokasi', 'like', "%{$lokasi}%"))
            ->when($sebab, fn($q) => $q->where('sebab', 'like', "%{$sebab}%"))
            ->when($tgl, fn($q) => $q->where('tgl_meninggal', $tgl))
            ->orderByDesc('kematian_id')
            ->paginate(12)
            ->withQueryString();

        return view('guest.kematian.index', ['kematian' => $data, 'search' => $search, 'lokasi' => $lokasi, 'sebab' => $sebab, 'tgl' => $tgl]);
    }

    public function create()
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.kematian.create', ['wargaOptions' => $wargaOptions]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_meninggal' => ['required', 'date'],
            'sebab' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'no_surat' => ['nullable', 'string', 'max:100'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $kematian = PeristiwaKematian::create(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kematian_documents', 'public');
                \App\Models\Media::create([
                    'ref_table' => 'peristiwa_kematian',
                    'ref_id' => $kematian->kematian_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Kematian',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.kematian.index')->with('success', 'Data kematian ditambahkan.');
    }

    public function show(PeristiwaKematian $kematian)
    {
        $kematian->load(['warga', 'media']);
        return view('guest.kematian.show', ['kematian' => $kematian]);
    }

    public function edit(PeristiwaKematian $kematian)
    {
        $wargaOptions = Warga::orderBy('nama')->get();
        return view('guest.kematian.edit', ['kematian' => $kematian, 'wargaOptions' => $wargaOptions]);
    }

    public function update(Request $request, PeristiwaKematian $kematian)
    {
        $validated = $request->validate([
            'warga_id' => ['required', 'exists:warga,warga_id'],
            'tgl_meninggal' => ['required', 'date'],
            'sebab' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'no_surat' => ['nullable', 'string', 'max:100'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ]);

        $kematian->update(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kematian_documents', 'public');
                \App\Models\Media::create([
                    'ref_table' => 'peristiwa_kematian',
                    'ref_id' => $kematian->kematian_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Kematian',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.kematian.index')->with('success', 'Data kematian diperbarui.');
    }

    public function destroy(PeristiwaKematian $kematian)
    {
        $kematian->delete();
        return redirect()->route('guest.kematian.index')->with('success', 'Data kematian dihapus.');
    }
}
